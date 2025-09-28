<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentStoreRequest;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct()
    {
        // اکشن‌های مدیریت فقط برای ادمین/احراز هویت
        $this->middleware('auth')->only(['index', 'approve', 'reject', 'destroy', 'reply']);
    }

    // ثبت نظر (عمومی)
    public function store(CommentStoreRequest $request, Article $article)
    {
        DB::transaction(function () use ($request, $article) {
            Comment::create([
                'article_id' => $article->id,
                'user_id'    => optional($request->user())->id,
                'parent_id'  => $request->input('parent_id'),
                'name'       => $request->input('name'),
                'email'      => $request->input('email'),
                'body'       => $request->input('body'),
                'status'     => 'pending', // ابتدا در انتظار تأیید
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
            ]);
        });

        return back()->with('success', 'نظر شما ثبت شد و پس از تأیید منتشر می‌شود.');
    }

    // لیست نظرات (ادمین)
    public function index(Request $request)
    {
        $filters = $request->validate([
            'status'     => 'nullable|in:pending,approved,rejected,spam',
            'search'     => 'nullable|string|max:100',
            'article_id' => 'nullable|integer|exists:articles,id',
            'page'       => 'nullable|integer|min:1',
        ]);

        $comments = Comment::query()
            ->with(['article:id,title,slug', 'user:id,name'])
            ->when($filters['status'] ?? null, fn($q, $s) => $q->where('status', $s))
            ->when($filters['article_id'] ?? null, fn($q, $aid) => $q->where('article_id', $aid))
            ->when($filters['search'] ?? null, function ($q, $s) {
                $q->where(function ($qq) use ($s) {
                    $qq->where('body', 'like', "%{$s}%")
                       ->orWhere('name', 'like', "%{$s}%")
                       ->orWhere('email', 'like', "%{$s}%");
                });
            })
            ->orderByDesc('id')
            ->paginate(15)
            ->appends($filters);

        return view('admin.comments.index', compact('comments', 'filters'));
    }

    // تأیید نظر (ادمین)
    public function approve(Comment $comment)
    {
        $comment->update(['status' => 'approved']);
        return back()->with('success', 'نظر تأیید شد.');
    }

    // رد نظر (ادمین)
    public function reject(Comment $comment)
    {
        $comment->update(['status' => 'rejected']);
        return back()->with('success', 'نظر رد شد.');
    }

    // پاسخ ادمین به نظر
    public function reply(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'body' => 'required|string|min:2',
        ]);

        DB::transaction(function () use ($request, $comment, $data) {
            Comment::create([
                'article_id' => $comment->article_id,
                'user_id'    => $request->user()->id,
                'parent_id'  => $comment->id,
                'name'       => $request->user()->name,
                'email'      => $request->user()->email,
                'body'       => $data['body'],
                'status'     => 'approved', // پاسخ ادمین مستقیم منتشر می‌شود
                'ip_address' => $request->ip(),
                'user_agent' => substr((string) $request->userAgent(), 0, 255),
            ]);
        });

        return back()->with('success', 'پاسخ شما ثبت شد.');
    }

    // حذف نظر (ادمین)
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back()->with('success', 'نظر حذف شد.');
    }
}
