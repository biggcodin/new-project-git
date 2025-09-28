<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\MorphedByMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use ReflectionClass;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class ModelsMapCommand extends Command
{
    protected $signature = 'models:map
        {--path=app/Models : Base path to scan}
        {--namespace=App\\Models : Base namespace for models}
        {--format=md : Output format: md or json}
        {--columns : Include DB columns (uses Schema)}
        {--no-details : Hide relation key details}';

    protected $description = 'List all Eloquent models and their relations (safe, read-only).';

    public function handle(): int
    {
        $basePath = base_path($this->option('path'));
        $baseNamespace = rtrim($this->option('namespace'), '\\');
        $format = strtolower($this->option('format'));
        $withColumns = (bool) $this->option('columns');
        $noDetails = (bool) $this->option('no-details');

        if (!is_dir($basePath)) {
            $this->error("Path not found: {$basePath}");
            return self::FAILURE;
        }

        $classes = $this->discoverClasses($basePath, $baseNamespace);

        $result = [];
        foreach ($classes as $class) {
            if (!class_exists($class)) {
                continue;
            }
            if (!is_subclass_of($class, Model::class)) {
                continue;
            }

            // skip abstract
            $ref = new ReflectionClass($class);
            if ($ref->isAbstract()) {
                continue;
            }

            try {
                $model = new $class;
            } catch (\Throwable $e) {
                $this->warn("Could not instantiate {$class}: {$e->getMessage()}");
                continue;
            }

            $modelInfo = [
                'class'        => $class,
                'table'        => method_exists($model, 'getTable') ? $model->getTable() : null,
                'primaryKey'   => property_exists($model, 'primaryKey') ? $model->getKeyName() : 'id',
                'keyType'      => property_exists($model, 'keyType') ? $model->getKeyType() : 'int',
                'incrementing' => property_exists($model, 'incrementing') ? (bool) $model->getIncrementing() : true,
                'timestamps'   => method_exists($model, 'usesTimestamps') ? $model->usesTimestamps() : true,
                'soft_deletes' => in_array('Illuminate\\Database\\Eloquent\\SoftDeletes', class_uses_recursive($class), true),
                'fillable'     => method_exists($model, 'getFillable') ? $model->getFillable() : [],
                'guarded'      => method_exists($model, 'getGuarded') ? $model->getGuarded() : ['*'],
                'hidden'       => method_exists($model, 'getHidden') ? $model->getHidden() : [],
                'casts'        => method_exists($model, 'getCasts') ? $model->getCasts() : [],
                'appends'      => property_exists($model, 'appends') ? $model->appends : [],
                'relations'    => [],
            ];

            if ($withColumns && $modelInfo['table'] && Schema::hasTable($modelInfo['table'])) {
                try {
                    $modelInfo['columns'] = Schema::getColumnListing($modelInfo['table']);
                } catch (\Throwable $e) {
                    $modelInfo['columns'] = ['(error reading columns: ' . $e->getMessage() . ')'];
                }
            }

            $modelInfo['relations'] = $this->detectRelations($model, $noDetails);

            $result[] = $modelInfo;
        }

        if ($format === 'json') {
            $this->line(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
        } else {
            $this->renderMarkdown($result);
        }

        return self::SUCCESS;
    }

    protected function discoverClasses(string $basePath, string $baseNamespace): array
    {
        $classes = [];
        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($basePath));
        foreach ($it as $file) {
            if (!$file->isFile()) continue;
            if ($file->getExtension() !== 'php') continue;

            $relative = trim(str_replace($basePath, '', $file->getPathname()), DIRECTORY_SEPARATOR);
            $relativeNoExt = preg_replace('/\.php$/', '', $relative);
            $class = $baseNamespace . '\\' . str_replace(DIRECTORY_SEPARATOR, '\\', $relativeNoExt);
            $classes[] = $class;
        }
        return $classes;
    }

    protected function detectRelations(Model $model, bool $noDetails = false): array
    {
        $relations = [];
        $class = get_class($model);
        $ref = new ReflectionClass($class);
        $declaredHereOrTraits = array_values(class_uses_recursive($class));
        $declaredHereOrTraits[] = $class;

        foreach ($ref->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
            // Only parameterless instance methods declared in model or its traits
            if ($method->isStatic()) continue;
            if ($method->getNumberOfRequiredParameters() > 0) continue;
            $declaring = $method->getDeclaringClass()->getName();
            if (!in_array($declaring, $declaredHereOrTraits, true)) continue;

            $name = $method->getName();
            // Skip common non-relation accessors/mutators/scopes
            if (Str::startsWith($name, ['get', 'set', 'scope'])) continue;

            try {
                $ret = $model->{$name}();
            } catch (\Throwable $e) {
                // If method throws, skip silently
                continue;
            }

            if ($ret instanceof Relation) {
                $info = [
                    'name'          => $name,
                    'type'          => class_basename($ret),
                    'related_model' => get_class($ret->getRelated()),
                ];

                if (!$noDetails) {
                    $details = $this->relationDetails($ret);
                    if (!empty($details)) {
                        $info['details'] = $details;
                    }
                }

                $relations[] = $info;
            }
        }

        // sort relations by name for stable output
        usort($relations, fn($a, $b) => $a['name'] <=> $b['name']);

        return $relations;
    }

    protected function relationDetails(Relation $rel): array
    {
        $d = [];

        // BelongsTo
        if ($rel instanceof BelongsTo) {
            $d['foreignKey'] = method_exists($rel, 'getForeignKeyName') ? $rel->getForeignKeyName() : null;
            $d['ownerKey']   = method_exists($rel, 'getOwnerKeyName') ? $rel->getOwnerKeyName() : null;
        }

        // HasOne / HasMany
        if ($rel instanceof HasOne || $rel instanceof HasMany) {
            $d['foreignKey'] = method_exists($rel, 'getForeignKeyName') ? $rel->getForeignKeyName() : null;
            $d['localKey']   = method_exists($rel, 'getLocalKeyName') ? $rel->getLocalKeyName() : null;
        }

        // BelongsToMany
        if ($rel instanceof BelongsToMany) {
            $d['pivotTable']         = method_exists($rel, 'getTable') ? $rel->getTable() : null;
            $d['foreignPivotKey']    = method_exists($rel, 'getForeignPivotKeyName') ? $rel->getForeignPivotKeyName() : null;
            $d['relatedPivotKey']    = method_exists($rel, 'getRelatedPivotKeyName') ? $rel->getRelatedPivotKeyName() : null;
            $d['parentKey']          = method_exists($rel, 'getParentKeyName') ? $rel->getParentKeyName() : null;
            $d['relatedKey']         = method_exists($rel, 'getRelatedKeyName') ? $rel->getRelatedKeyName() : null;
        }

        // MorphOne / MorphMany / MorphToMany / MorphedByMany
        if ($rel instanceof MorphOne || $rel instanceof MorphMany || $rel instanceof MorphToMany || $rel instanceof MorphedByMany) {
            $d['morphType'] = method_exists($rel, 'getMorphType') ? $rel->getMorphType() : null;
            $d['morphClass'] = method_exists($rel, 'getMorphClass') ? $rel->getMorphClass() : null;
            if ($rel instanceof MorphToMany || $rel instanceof MorphedByMany) {
                $d['pivotTable'] = method_exists($rel, 'getTable') ? $rel->getTable() : null;
            }
        }

        // MorphTo (polymorphic inverse)
        if ($rel instanceof MorphTo) {
            $d['morphType'] = method_exists($rel, 'getMorphType') ? $rel->getMorphType() : null;
            $d['ownerKey']  = method_exists($rel, 'getOwnerKeyName') ? $rel->getOwnerKeyName() : null;
        }

        // HasOneThrough / HasManyThrough
        if ($rel instanceof HasOneThrough || $rel instanceof HasManyThrough) {
            $d['firstKey']  = method_exists($rel, 'getFirstKeyName') ? $rel->getFirstKeyName() : null;
            $d['secondKey'] = method_exists($rel, 'getSecondKeyName') ? $rel->getSecondKeyName() : null;
            $d['localKey']  = method_exists($rel, 'getLocalKeyName') ? $rel->getLocalKeyName() : null;
            $d['secondLocalKey'] = method_exists($rel, 'getSecondLocalKeyName') ? $rel->getSecondLocalKeyName() : null;
        }

        // Remove nulls
        return array_filter($d, fn($v) => !is_null($v));
    }

    protected function renderMarkdown(array $result): void
    {
        foreach ($result as $model) {
            $this->line('# ' . $model['class']);
            $this->line('');
            $this->line('- **Table**: ' . ($model['table'] ?? '-'));
            $this->line('- **Primary key**: ' . ($model['primaryKey'] ?? '-'));
            $this->line('- **Key type**: ' . ($model['keyType'] ?? '-'));
            $this->line('- **Incrementing**: ' . (isset($model['incrementing']) && $model['incrementing'] ? 'true' : 'false'));
            $this->line('- **Timestamps**: ' . ($model['timestamps'] ? 'true' : 'false'));
            $this->line('- **Soft deletes**: ' . ($model['soft_deletes'] ? 'true' : 'false'));
            if (!empty($model['fillable'])) {
                $this->line('- **Fillable**: ' . implode(', ', $model['fillable']));
            }
            if (!empty($model['guarded'])) {
                $this->line('- **Guarded**: ' . implode(', ', $model['guarded']));
            }
            if (!empty($model['hidden'])) {
                $this->line('- **Hidden**: ' . implode(', ', $model['hidden']));
            }
            if (!empty($model['casts'])) {
                $this->line('- **Casts**: ' . json_encode($model['casts'], JSON_UNESCAPED_UNICODE));
            }
            if (!empty($model['appends'])) {
                $this->line('- **Appends**: ' . implode(', ', $model['appends']));
            }
            if (isset($model['columns'])) {
                $this->line('- **Columns**: ' . (is_array($model['columns']) ? implode(', ', $model['columns']) : $model['columns']));
            }

            $this->line('');
            $this->line('## Relations');
            if (empty($model['relations'])) {
                $this->line('- (none)');
            } else {
                foreach ($model['relations'] as $rel) {
                    $details = '';
                    if (!empty($rel['details'])) {
                        $pairs = [];
                        foreach ($rel['details'] as $k => $v) {
                            $pairs[] = "{$k}: {$v}";
                        }
                        $details = ' [' . implode(', ', $pairs) . ']';
                    }
                    $this->line("- **{$rel['name']}** ({$rel['type']}) -> {$rel['related_model']}{$details}");
                }
            }
            $this->line("\n---\n");
        }
    }
}
