<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasStatusText;

class Video extends Model
{
    use HasFactory, SoftDeletes, HasStatusText;

    protected $fillable = [
        'title',
        'url',
        'path',
        'description',
        'duration',
        'thumbnail',
        'status',
        'order',
        'views'
    ];

    protected $attributes = [
        'status' => true,
        'order' => 0,
        'views' => 0
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
        'views' => 'integer'
    ];

    // روالات
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    // اکسسور برای نمایش URL اصلی (بدون تغییر)
    public function getUrlAttribute()
    {
        return $this->attributes['url'] ?? null;
    }

    // اکسسور برای نمایش URL کامل ویدیو
    public function getVideoUrlAttribute()
    {
        return $this->url ?: ($this->path ? asset('storage/' . $this->path) : null);
    }

    // اکسسور برای نمایش URL تصویر بندانگشتی
    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail ? asset('storage/' . $this->thumbnail) : null;
    }

    // اکسسور برای نمایش تعداد بازدید به صورت خوانا
    public function getViewsFormattedAttribute()
    {
        if ($this->views >= 1000000) {
            return number_format($this->views / 1000000, 1) . 'M';
        } elseif ($this->views >= 1000) {
            return number_format($this->views / 1000, 1) . 'K';
        }
        
        return number_format($this->views);
    }

    // اکسسور برای استخراج ID ویدیو از YouTube
    public function getYoutubeIdAttribute()
    {
        $url = $this->url;
        if (!$url) return null;
        
        if (strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false) {
            preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&\n?#]+)/', $url, $matches);
            return $matches[1] ?? null;
        }
        
        return null;
    }

    // اکسسور برای استخراج ID ویدیو از Vimeo
    public function getVimeoIdAttribute()
    {
        $url = $this->url;
        if (!$url) return null;
        
        if (strpos($url, 'vimeo.com') !== false) {
            preg_match('/vimeo\.com\/(\d+)/', $url, $matches);
            return $matches[1] ?? null;
        }
        
        return null;
    }

    // اکسسور برای بررسی اینکه آیا ویدیو از YouTube است
    public function getIsYoutubeAttribute()
    {
        $url = $this->url;
        if (!$url) return false;
        
        return strpos($url, 'youtube.com') !== false || strpos($url, 'youtu.be') !== false;
    }

    // اکسسور برای بررسی اینکه آیا ویدیو از Vimeo است
    public function getIsVimeoAttribute()
    {
        $url = $this->url;
        if (!$url) return false;
        
        return strpos($url, 'vimeo.com') !== false;
    }

    // اکسسور برای بررسی اینکه آیا ویدیو محلی است
    public function getIsLocalAttribute()
    {
        return !empty($this->path);
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
        return $query->orderBy('views', 'desc');
    }

    public function scopeYoutube($query)
    {
        return $query->where('url', 'like', '%youtube.com%')->orWhere('url', 'like', '%youtu.be%');
    }

    public function scopeVimeo($query)
    {
        return $query->where('url', 'like', '%vimeo.com%');
    }

    public function scopeLocal($query)
    {
        return $query->whereNotNull('path');
    }

    // متد برای افزایش تعداد بازدید
    public function incrementViews()
    {
        $this->increment('views');
        return $this;
    }

    // متد برای افزودن تگ به ویدیو
    public function addTag($tagName)
    {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $this->tags()->syncWithoutDetaching([$tag->id]);
        return $this;
    }

    // متد برای حذف تگ از ویدیو
    public function removeTag($tagName)
    {
        $tag = Tag::where('name', $tagName)->first();
        if ($tag) {
            $this->tags()->detach($tag->id);
        }
        return $this;
    }

    // متد برای بررسی وجود تگ
    public function hasTag($tagName)
    {
        return $this->tags()->where('name', $tagName)->exists();
    }
}