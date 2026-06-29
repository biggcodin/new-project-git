<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasStatusText;

class CustomField extends Model
{
    use SoftDeletes, HasStatusText;

    protected $fillable = [
        'subcategory_id',
        'sub_subcategory_id',
        'key',
        'label',
        'type',
        'options',
        'status',
        'required',
        'order',
    'is_unique'
    ];

    protected $attributes = [
        'status' => true,
        'required' => false,
        'order' => 0
    ];

    protected $casts = [
        'options' => 'array',
        'status' => 'boolean',
        'required' => 'boolean',
        'order' => 'integer'
    ];

    // روالات
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class)->withDefault();
    }

    public function subSubcategory()
    {
        return $this->belongsTo(SubSubcategory::class)->withDefault();
    }


    // ویژگی منحصر به فرد برای هر بازی
    public static function getUniqueFieldKeyForSubSubcategory($subSubcategoryId): ?string
{
    $field = self::where('sub_subcategory_id', $subSubcategoryId)
        ->where('is_unique', true)
        ->first();
    return $field ? $field->key : null;
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

    public function scopeRequired($query)
    {
        return $query->where('required', true);
    }

    public function scopeOptional($query)
    {
        return $query->where('required', false);
    }

    // اسکوپ‌های بر اساس نوع
    public function scopeText($query)
    {
        return $query->where('type', 'text');
    }

    public function scopeNumber($query)
    {
        return $query->where('type', 'number');
    }

    public function scopeDate($query)
    {
        return $query->where('type', 'date');
    }

    public function scopeSelect($query)
    {
        return $query->where('type', 'select');
    }

    // اکسسور برای نمایش وضعیت required به فارسی
    public function getRequiredTextAttribute()
    {
        return $this->required ? 'اجباری' : 'اختیاری';
    }

    // اکسسور برای نمایش نوع فیلد به فارسی
    public function getTypeTextAttribute()
    {
        $types = [
            'text' => 'متنی',
            'number' => 'عددی',
            'date' => 'تاریخ',
            'select' => 'انتخابی'
        ];

        return $types[$this->type] ?? $this->type;
    }
}