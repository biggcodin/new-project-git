<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'article_id',
        'user_id',
        'parent_id',
        'name',
        'email',
        'body',
        'status',
        'ip_address',
        'user_agent',
    ];

    protected $attributes = [
        'status' => 'pending',
    ];

    // روابط
    public function article()
    {
        return $this->belongsTo(Article::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    // اسکوپ‌ها
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    // کمک: ساخت درخت نظرات (تبدیل لیست به درخت)
    public static function buildTree($comments)
    {
        $items = $comments->groupBy('parent_id');
        $attach = function ($parentId) use (&$attach, $items) {
            return ($items[$parentId] ?? collect())->map(function ($comment) use (&$attach) {
                $comment->childrenTree = $attach($comment->id);
                return $comment;
            });
        };
        return $attach(null);
    }
}
