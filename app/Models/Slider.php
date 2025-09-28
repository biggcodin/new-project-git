<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasStatusText;

class Slider extends Model
{
    use HasFactory, SoftDeletes, HasStatusText;

    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'price_text',
        'price_value',
        'price_unit',
        'image',
        'link',
        'status',
        'order'
    ];

    protected $attributes = [
        'status' => true,
        'order' => 0
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer',
        'price_value' => 'decimal:2'
    ];

    // اکسسور برای نمایش URL تصویر
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    // اکسسور برای نمایش قیمت کامل
    public function getPriceFormattedAttribute()
    {
        if ($this->price_value) {
            $formatted = number_format($this->price_value);
            if ($this->price_unit) {
                $formatted .= ' ' . $this->price_unit;
            }
            return $formatted;
        }
        
        return $this->price_text ?? '';
    }

    // اکسسور برای نمایش URL کامل لینک
    public function getLinkUrlAttribute()
    {
        if ($this->link) {
            return strpos($this->link, 'http') === 0 ? $this->link : url($this->link);
        }
        return null;
    }

    // اکسسور برای بررسی اینکه آیا لینک خارجی است
    public function getIsExternalLinkAttribute()
    {
        return $this->link && strpos($this->link, 'http') === 0;
    }

    // روابط
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
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

    public function scopeWithPrice($query)
    {
        return $query->whereNotNull('price_value');
    }

    public function scopeWithoutPrice($query)
    {
        return $query->whereNull('price_value');
    }

    public function scopeWithLink($query)
    {
        return $query->whereNotNull('link');
    }

    public function scopeWithoutLink($query)
    {
        return $query->whereNull('link');
    }

    // متد برای بررسی اینکه آیا اسلایدر قیمت دارد
    public function hasPrice()
    {
        return $this->price_value !== null;
    }

    // متد برای بررسی اینکه آیا اسلایدر لینک دارد
    public function hasLink()
    {
        return !empty($this->link);
    }

    // متد برای افزودن تگ به اسلایدر
    public function addTag($tagName)
    {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $this->tags()->syncWithoutDetaching([$tag->id]);
        return $this;
    }

    // متد برای حذف تگ از اسلایدر
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