<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Traits\HasStatusText;

class Tag extends Model
{
    use HasFactory, SoftDeletes, HasStatusText;

    protected $fillable = [
        'name',
        'slug',
        'status',
        'description',
        'color',
        'count',
        'order'
    ];

    protected $attributes = [
        'status' => true,
        'count' => 0,
        'order' => 0
    ];

    protected $casts = [
        'status' => 'boolean',
        'count' => 'integer',
        'order' => 'integer'
    ];

    // روابط polymorphic
    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }

    public function videos()
    {
        return $this->morphedByMany(Video::class, 'taggable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'taggable');
    }

    public function sliders()
    {
        return $this->morphedByMany(Slider::class, 'taggable');
    }

    // روالات برای مدیریت تگ‌ها
    public function taggables()
    {
        return $this->hasMany(Taggable::class);
    }

    // اسکوپ‌های کاربردی
    public function scopeActive($query)
    {
        return $query->where('status', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('count', 'desc');
    }

    // تولید خودکار slug
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tag) {
            if (empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
                
                $originalSlug = $tag->slug;
                $count = 1;
                
                while (static::withTrashed()->where('slug', $tag->slug)->exists()) {
                    $tag->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($tag) {
            if ($tag->isDirty('name') && empty($tag->slug)) {
                $tag->slug = Str::slug($tag->name);
                
                $originalSlug = $tag->slug;
                $count = 1;
                
                while (static::withTrashed()->where('slug', $tag->slug)->where('id', '!=', $tag->id)->exists()) {
                    $tag->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }
}
