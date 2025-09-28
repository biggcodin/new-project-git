<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    // بررسی مجوز دسترسی برای ایجاد محصول
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Product::class);
    }

    // قوانین اعتبارسنجی برای ذخیره محصول جدید
    public function rules(): array
    {
        return [
            'name'               => ['required', 'string', 'max:255'], // نام محصول
            'slug'               => ['nullable', 'string', 'max:255'], // slug اختیاری
            'description'        => ['nullable', 'string'],            // توضیحات محصول
            'meta_title'         => ['nullable', 'string', 'max:255'], // عنوان سئو
            'meta_description'   => ['nullable', 'string', 'max:255'], // توضیح سئو
            'price'              => ['required', 'numeric', 'min:0'],  // قیمت اصلی
            'discount_price'     => ['nullable', 'numeric', 'min:0', 'lt:price'], // قیمت با تخفیف
            'quantity'           => ['required', 'integer', 'min:0'],  // موجودی انبار
            'category_id'        => ['required', 'integer', 'exists:categories,id'], // دسته اصلی
            'subcategory_id'     => ['nullable', 'integer', 'exists:subcategories,id'], // زیر دسته
            'sub_subcategory_id' => ['nullable', 'integer', 'exists:sub_subcategories,id'], // زیر زیر دسته
            'sku'                => ['nullable', 'string', 'max:100'], // کد محصول
            'cover'              => ['nullable', 'image', 'max:2048'], // تصویر اصلی
            'status'             => ['required', Rule::in(['pending', 'approved', 'rejected'])], // وضعیت انتشار
            'featured'           => ['nullable', 'boolean'],           // محصول ویژه
            'order'              => ['nullable', 'integer', 'min:0'],  // ترتیب نمایش
            'published_at'       => ['nullable', 'date'],              // زمان انتشار
        ];
    }
}
