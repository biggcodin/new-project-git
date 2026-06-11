<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'               => ['required', 'string', 'max:255'],
            'slug'               => ['nullable', 'string', 'max:255'],
            'description'        => ['nullable', 'string'],
            'meta_title'         => ['nullable', 'string', 'max:255'],
            'meta_description'   => ['nullable', 'string', 'max:255'],
            'price'              => ['required', 'numeric', 'min:0'],
            'discount_price'     => ['nullable', 'numeric', 'min:0'],
            'quantity'           => ['required', 'integer', 'min:0'],
            'category_id'        => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id'     => ['required', 'integer', 'exists:subcategories,id'],
            'sub_subcategory_id' => ['required', 'integer', 'exists:sub_subcategories,id'],
            'sku'                => ['nullable', 'string', 'max:100'],
            'cover'              => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],
            'status'             => ['required', Rule::in(['pending', 'approved', 'rejected'])],
            'featured'           => ['nullable', 'boolean'],
            'order'              => ['nullable', 'integer', 'min:0'],
            'published_at'       => ['nullable', 'date'],
            // تگ‌ها
            'tags'               => ['nullable', 'array'],
            'tags.*'             => ['integer', 'exists:tags,id'],
            // ویژگی‌های اختصاصی
            'attributes'         => ['nullable', 'array'],
            'attributes.*'       => ['nullable', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'               => 'نام محصول الزامی است.',
            'category_id.required'        => 'دسته اصلی الزامی است.',
            'subcategory_id.required'     => 'زیردسته اول الزامی است.',
            'sub_subcategory_id.required' => 'زیردسته دوم الزامی است.',
            'price.required'              => 'قیمت محصول الزامی است.',
            'quantity.required'           => 'موجودی محصول الزامی است.',
            'status.required'             => 'وضعیت محصول الزامی است.',
            'cover.image'                 => 'فایل انتخاب شده باید تصویر باشد.',
            'cover.max'                   => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'tags.*.exists'               => 'تگ انتخاب شده نامعتبر است.',
        ];
    }
}