<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;
use App\Models\Traits\HasStatusText;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasStatusText;

    protected $fillable = [
        'user_id',
        'category_id',
        'subcategory_id',
        'sub_subcategory_id',
        'sku',
        'name',
        'slug',
        'description',
        'meta_title',
        'meta_description',
        'cover',
        'price',
        'discount_price',
        'quantity',
        'status',
        'featured',
        'order',
        'published_at',
        'views'
    ];

    protected $attributes = [
        'status' => 'pending', // مقدار پیش‌فرض باید یکی از مقادیر enum باشد
        'featured' => false,
        'order' => 0,
        'views' => 0,
        'quantity' => 0,
        'discount_price' => null
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'quantity' => 'integer',
        'featured' => 'boolean',
        'order' => 'integer',
        'published_at' => 'datetime',
        'views' => 'integer'
    ];

    // روابط
    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }

    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class)->withDefault();
    }

    public function subSubcategory()
    {
        return $this->belongsTo(SubSubcategory::class)->withDefault();
    }

    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function attachments()
    {
        return $this->morphMany(Attachment::class, 'attachable');
    }

    public function media()
    {
        return $this->hasMany(ProductMedia::class)->orderBy('order');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class)->orderBy('order');
    }

    // اکسسورها
    public function getImageUrlAttribute()
    {
        if ($this->cover) {
            return asset('storage/' . $this->cover);
        }
        
        $media = $this->media->first();
        return $media?->url;
    }

    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?? $this->price;
    }

    public function getDiscountPercentageAttribute()
    {
        if (!$this->discount_price || $this->price <= 0) return 0;
        return round((($this->price - $this->discount_price) / $this->price) * 100);
    }

    public function getIsInStockAttribute()
    {
        return $this->quantity > 0;
    }

    public function getIsPublishedAttribute()
    {
        return $this->status === 'approved';
    }

    public function getIsFeaturedAttribute()
    {
        return $this->featured;
    }

    public function getViewsFormattedAttribute()
    {
        if ($this->views >= 1000000) {
            return number_format($this->views / 1000000, 1) . 'M';
        } elseif ($this->views >= 1000) {
            return number_format($this->views / 1000, 1) . 'K';
        }
        return number_format($this->views);
    }

    public function getMetaTitleAttribute($value)
    {
        return $value ?: $this->name;
    }

    public function getMetaDescriptionAttribute($value)
    {
        return $value ?: Str::limit(strip_tags($this->description), 160);
    }

    // اسکوپ‌ها (بر اساس مقادیر واقعی enum)
    public function scopeActive($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    public function scopeFeatured($query)
    {
        return $query->where('featured', true);
    }

    public function scopeInStock($query)
    {
        return $query->where('quantity', '>', 0);
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('quantity', '<=', 0);
    }

    public function scopeWithDiscount($query)
    {
        return $query->whereNotNull('discount_price');
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
        return $query->orderBy('created_at', 'desc');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeBySubcategory($query, $subcategoryId)
    {
        return $query->where('subcategory_id', $subcategoryId);
    }

    public function scopeBySubSubcategory($query, $subSubcategoryId)
    {
        return $query->where('sub_subcategory_id', $subSubcategoryId);
    }

    // متدها (بر اساس مقادیر واقعی enum)
    public function incrementViews()
    {
        $this->increment('views');
        return $this;
    }

    public function publish()
    {
        $this->status = 'approved';
        $this->published_at = now();
        $this->save();
        return $this;
    }

    public function makePending()
    {
        $this->status = 'pending';
        $this->save();
        return $this;
    }

    public function reject()
    {
        $this->status = 'rejected';
        $this->save();
        return $this;
    }

    public function toggleFeatured()
    {
        $this->featured = !$this->featured;
        $this->save();
        return $this;
    }

    public function addTag($tagName)
    {
        $tag = Tag::firstOrCreate(['name' => $tagName]);
        $this->tags()->syncWithoutDetaching([$tag->id]);
        return $this;
    }

    public function removeTag($tagName)
    {
        $tag = Tag::where('name', $tagName)->first();
        if ($tag) {
            $this->tags()->detach($tag->id);
        }
        return $this;
    }

    public function hasTag($tagName)
    {
        return $this->tags()->where('name', $tagName)->exists();
    }

    public function addMedia($filePath, $fileName, $fileType, $fileSize, $order = 0)
    {
        return $this->media()->create([
            'file_path' => $filePath,
            'file_name' => $fileName,
            'file_type' => $fileType,
            'file_size' => $fileSize,
            'order' => $order
        ]);
    }

    public function addAttribute($key, $value, $order = 0)
    {
        return $this->attributes()->create([
            'key' => $key,
            'value' => $value,
            'order' => $order
        ]);
    }

    // تولید خودکار slug
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                $originalSlug = $product->slug;
                $count = 1;
                
                while (static::withTrashed()->where('slug', $product->slug)->exists()) {
                    $product->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
        
        static::updating(function ($product) {
            if ($product->isDirty('name') && empty($product->slug)) {
                $product->slug = Str::slug($product->name);
                
                $originalSlug = $product->slug;
                $count = 1;
                
                while (static::withTrashed()->where('slug', $product->slug)->where('id', '!=', $product->id)->exists()) {
                    $product->slug = $originalSlug . '-' . $count;
                    $count++;
                }
            }
        });
    }
}