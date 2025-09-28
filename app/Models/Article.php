<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Traits\HasStatusText; 

class Article extends Model
{
    use HasFactory, SoftDeletes, HasStatusText; // اضافه کردن HasStatusText
    


    protected $fillable = [
        'title',
        'slug',
        'content',
        'author',
        'image',
        'status',
        'published_at',
        'order',
        'views',
        'reading_time'
    ];

    protected $attributes = [
        'status' => 'draft',
        'order' => 0,
        'views' => 0,
        'reading_time' => 0
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'status' => 'string',
        'order' => 'integer',
        'views' => 'integer',
        'reading_time' => 'integer'
    ];

    // رابطه پلی‌مورفیک با تگ‌ها
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    //کامنت
    public function comments()
{
    // فقط ریشه‌ها برای لیست اولیه
    return $this->hasMany(\App\Models\Comment::class)->whereNull('parent_id');
}

public function allComments()
{
    return $this->hasMany(\App\Models\Comment::class);
}


    // رابطه با فایل‌های ضمیمه
    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    // اکسسور برای نمایش URL تصویر
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // اکسسور برای نمایش محتوای خلاصه شده
    public function getExcerptAttribute()
    {
        return Str::limit(strip_tags($this->content), 200, '...');
    }


    // تبدیل created_at به تاریخ شمسی برای نمایش در سمت کاربر
    public function getPersianDateAttribute()
    {
        return \Morilog\Jalali\Jalalian::fromCarbon($this->created_at)->format('Y/m/d');
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

    // اکسسور برای نمایش زمان مطالعه به صورت خوانا
    public function getReadingTimeFormattedAttribute()
    {
        if ($this->reading_time < 1) {
            return 'کمتر از 1 دقیقه';
        } elseif ($this->reading_time == 1) {
            return '1 دقیقه';
        } else {
            return $this->reading_time . ' دقیقه';
        }
    }

    // اکسسور برای وضعیت انتشار
    public function getStatusTextAttribute()
    {
        $statuses = [
            'published' => 'منتشر شده',
            'draft' => 'پیش‌نویس',
            'archived' => 'بایگانی'
        ];
        return $statuses[$this->status] ?? 'نامشخص';
    }

    // اکسسور برای بررسی اینکه آیا مقاله منتشر شده است
    public function getIsPublishedAttribute()
    {
        return $this->status === 'published';
    }

    // اکسسور برای بررسی اینکه آیا مقاله پیش‌نویس است
    public function getIsDraftAttribute()
    {
        return $this->status === 'draft';
    }

    // اسکوپ‌های کاربردی
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('views', 'desc');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    public function scopeByAuthor($query, $author)
    {
        return $query->where('author', $author);
    }

    // متد برای افزایش تعداد بازدید
    public function incrementViews()
    {
        $this->increment('views');
        return $this;
    }

    // متد برای انتشار مقاله
    public function publish()
    {
        $this->status = 'published';
        $this->published_at = now();
        $this->save();
        return $this;
    }

    // متد برای تبدیل به پیش‌نویس (تغییر نام از draft به makeDraft)
    public function makeDraft()
    {
        $this->status = 'draft';
        $this->save();
        return $this;
    }

    // متد برای بایگانی کردن مقاله
    public function archive()
    {
        $this->status = 'archived';
        $this->save();
        return $this;
    }

    // متد برای افزودن تگ به مقاله
    public function addTag($tagName)
    {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $this->tags()->syncWithoutDetaching([$tag->id]);
        return $this;
    }

    // متد برای حذف تگ از مقاله
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

    // متد برای محاسبه زمان مطالعه (تخمینی)
    public function calculateReadingTime()
    {
        // محاسبه تعداد کلمات
        $wordCount = str_word_count(strip_tags($this->content));
        
        // فرض می‌کنیم سرعت مطالعه متوسط 200 کلمه در دقیقه
        $readingTime = ceil($wordCount / 200);
        
        $this->reading_time = $readingTime;
        $this->save();
        
        return $this;
    }

    // تولید خودکار slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
                
                $originalSlug = $article->slug;
                $count = 1;
                
                while (static::withTrashed()->where('slug', $article->slug)->exists()) {
                    $article->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });

        static::updating(function ($article) {
            if ($article->isDirty('title') && empty($article->slug)) {
                $article->slug = Str::slug($article->title);
                
                $originalSlug = $article->slug;
                $count = 1;
                
                while (static::withTrashed()->where('slug', $article->slug)->where('id', '!=', $article->id)->exists()) {
                    $article->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }
}