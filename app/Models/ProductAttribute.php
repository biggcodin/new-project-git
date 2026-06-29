<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasStatusText;

class ProductAttribute extends Model
{
    use HasFactory, SoftDeletes, HasStatusText;

    protected $fillable = [
        'product_id',
        'key',
        'value',
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
        // 'value' => 'array' // ❌ حذف شد تا مقدار به‌صورت خام ذخیره شود
    ];

    // رابطه با محصول
    public function product()
    {
        return $this->belongsTo(Product::class)->withDefault();
    }

    // اکسسور برای نمایش مقدار به صورت مناسب
    public function getValueFormattedAttribute()
    {
        // اگر مقدار JSON است، آن را دیکود می‌کنیم (برای نمایش)
        $decoded = json_decode($this->value, true);
        if (is_array($decoded)) {
            return implode(', ', $decoded);
        }
        return $this->value;
    }

    // اکسسور برای نمایش مقدار به صورت لیست
    public function getValueListAttribute()
    {
        $decoded = json_decode($this->value, true);
        if (is_array($decoded)) {
            return $decoded;
        }
        return [$this->value];
    }

    // اکسسور برای بررسی اینکه آیا مقدار چندتایی است
    public function getIsMultipleAttribute()
    {
        $decoded = json_decode($this->value, true);
        return is_array($decoded) && count($decoded) > 1;
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

    public function scopeByKey($query, $key)
    {
        return $query->where('key', $key);
    }

    public function scopeByValue($query, $value)
    {
        return $query->where('value', 'like', "%{$value}%");
    }

    // متد برای افزودن مقدار به ویژگی‌های چندتایی
    public function addValue($newValue)
    {
        $values = $this->value_list;
        
        if (!in_array($newValue, $values)) {
            $values[] = $newValue;
            $this->value = json_encode($values);
            $this->save();
        }
        
        return $this;
    }

    // متد برای حذف مقدار از ویژگی‌های چندتایی
    public function removeValue($targetValue)
    {
        $values = $this->value_list;
        
        if (in_array($targetValue, $values)) {
            $values = array_diff($values, [$targetValue]);
            $this->value = json_encode(array_values($values));
            $this->save();
        }
        
        return $this;
    }

    // متد برای بررسی وجود مقدار
    public function hasValue($targetValue)
    {
        return in_array($targetValue, $this->value_list);
    }
}