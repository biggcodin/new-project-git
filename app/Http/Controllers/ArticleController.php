<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Tag;
use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;

class ArticleController extends Controller
{
    // لیست مقالات با فیلتر و تگ‌ها
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search' => 'nullable|string|max:100',
            'tag'    => 'nullable|integer|exists:tags,id',
            'page'   => 'nullable|integer|min:1',
        ]);

        $articles = Article::query()
            ->with(['tags:id,name,slug'])
            ->when($filters['search'] ?? null, fn($q, $s) =>
                $q->where(fn($qq) =>
                    $qq->where('title', 'like', "%{$s}%")
                    ->orWhere('content', 'like', "%{$s}%")
                )
            )
            ->when($filters['tag'] ?? null, fn($q, $tagId) =>
                $q->whereHas('tags', fn($qq) => $qq->where('tags.id', $tagId))
            )
            ->orderByDesc('id')
            ->paginate(10)
            ->appends($filters);

        $allTags = Tag::select('id','name','slug')->orderBy('name')->get();

        return view('admin.articles.index', compact('articles', 'allTags'));
    }

    // ذخیره مقاله جدید با تگ‌ها و فایل‌ها
    public function store(ArticleStoreRequest $request)
    {
        $this->authorize('create', Article::class); // کنترل دسترسی با Policy

        $data = $request->validated();

        DB::transaction(function () use ($request, $data) {
            $slug = $this->uniqueSlug(Str::slug($data['title'])); // ساخت slug یکتا

            $article = Article::create([
                'title'   => $data['title'],
                'slug'    => $slug,
                'content' => $data['content'],
                'status'  => $data['status'],
                'image'   => null,
            ]);

            // ذخیره تصویر مقاله
            if ($request->hasFile('image')) {
                $article->image = $request->file('image')->store('articles', 'public');
                $article->save();
            }

            // اتصال تگ‌ها
            $article->tags()->sync($data['tags'] ?? []);

            // ذخیره فایل‌های ضمیمه
            foreach ($request->file('attachments', []) as $file) {
                $article->attachments()->create([
                    'file_path' => $file->store('attachments', 'public'),
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        });

        return redirect()->route('articles.index')->with('success', 'مقاله با موفقیت ثبت شد.');
    }

    // ویرایش مقاله موجود
    public function update(ArticleUpdateRequest $request, Article $article)
    {
        $this->authorize('update', $article); // کنترل دسترسی

        $data = $request->validated();

        DB::transaction(function () use ($request, $article, $data) {
            $article->fill([
                'title'   => $data['title'],
                'content' => $data['content'],
                'status'  => $data['status'],
            ]);

            // اگر عنوان تغییر کرده، slug جدید بساز
            if ($article->isDirty('title')) {
                $article->slug = $this->uniqueSlug(Str::slug($data['title']), $article->id);
            }

            // جایگزینی تصویر
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($article->image);
                $article->image = $request->file('image')->store('articles', 'public');
            }

            $article->save();

            // بروزرسانی تگ‌ها
            $article->tags()->sync($data['tags'] ?? []);

            // افزودن فایل‌های جدید
            foreach ($request->file('attachments', []) as $file) {
                $article->attachments()->create([
                    'file_path' => $file->store('attachments', 'public'),
                    'file_name' => $file->getClientOriginalName(),
                    'file_type' => $file->getClientMimeType(),
                    'file_size' => $file->getSize(),
                ]);
            }
        });

        return redirect()->route('articles.index')->with('success', 'مقاله با موفقیت ویرایش شد.');
    }

    // حذف مقاله و فایل‌های مرتبط
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        DB::transaction(function () use ($article) {
            Storage::disk('public')->delete($article->image);
            foreach ($article->attachments as $attachment) {
                Storage::disk('public')->delete($attachment->file_path);
            }
            $article->attachments()->delete();
            $article->tags()->detach();
            $article->delete();
        });

        return redirect()->route('articles.index')->with('success', 'مقاله با موفقیت حذف شد.');
    }

    // حذف یک فایل ضمیمه
    public function destroyAttachment(Attachment $attachment)
    {
        $this->authorize('delete', $attachment);

        Storage::disk('public')->delete($attachment->file_path);
        $attachment->delete();

        return back()->with('success', 'ضمیمه با موفقیت حذف شد.');
    }

    // حذف تصویر مقاله
    public function destroyImage(Article $article)
    {
        $this->authorize('update', $article);

        Storage::disk('public')->delete($article->image);
        $article->update(['image' => null]);

        return back()->with('success', 'تصویر مقاله با موفقیت حذف شد.');
    }

    // نمایش لیست مقالات در سمت کاربر
    public function showNews()
    {
        $articles = Article::with('tags:id,name,slug')
            ->where('status', 'published')
            ->latest('created_at')
            ->paginate(10);

        return view('news', compact('articles'));
    }

    // نمایش مقاله تکی
    public function showSingleArticle($slug)
    {
        $article = Article::with('tags:id,name,slug')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $recentArticles = Article::select('id','title','slug','created_at','image')
            ->where('id', '!=', $article->id)
            ->where('status', 'published')
            ->latest('created_at')
            ->take(4)
            ->get();

        return view('news-single', compact('article', 'recentArticles'));
    }

    // نمایش مقالات مرتبط با یک تگ
    public function showArticlesByTag($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail();

        $articles = $tag->articles()
            ->with('tags:id,name,slug')
            ->where('status', 'published')
            ->latest('created_at')
            ->paginate(10);

        $pageTitle = "مقالات مرتبط با تگ: {$tag->name}";
        return view('articles-by-tag', compact('articles', 'tag', 'pageTitle'));
    }

    // ساخت slug یکتا برای مقاله
    private function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base ?: Str::random(8);
        $original = $slug;
        $i = 1;

        while (
            Article::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
