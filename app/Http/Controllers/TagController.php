<?php

namespace App\Http\Controllers;

use App\Http\Requests\TagStoreRequest;
use App\Http\Requests\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::orderByDesc('id')->paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function store(TagStoreRequest $request)
    {
        $slug = $this->generateUniqueSlug($request->name);

        Tag::create([
            'name'  => $request->name,
            'slug'  => $slug,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('success', 'برچسب با موفقیت ایجاد شد.');
    }

    public function update(TagUpdateRequest $request, Tag $tag)
    {
        $slug = $this->generateUniqueSlug($request->name, $tag->id);

        $tag->update([
            'name'  => $request->name,
            'slug'  => $slug,
            'color' => $request->color,
        ]);

        return redirect()->back()->with('success', 'برچسب با موفقیت ویرایش شد.');
    }

    public function destroy(Tag $tag)
    {
        $hasRelations = $tag->articles()->exists()
            || $tag->products()->exists()
            || $tag->sliders()->exists()
            || $tag->videos()->exists();

        if ($hasRelations) {
            return redirect()->back()->with('error', 'این تگ به محتواهایی متصل است و قابل حذف نیست.');
        }

        $tag->delete();
        return redirect()->back()->with('success', 'برچسب با موفقیت حذف شد.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;

        while (
            Tag::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
