<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * تبدیل فیلدهای خالی به null برای جلوگیری از خطاهای اعتبارسنجی
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => $this->slug ?: null,
            'sku' => $this->sku ?: null,
            'discount_price' => $this->discount_price !== '' ? $this->discount_price : null,
        ]);
    }

    public function rules(): array
    {
        $productId = $this->route('product')->id ?? null;

        return [
            'name'               => ['required', 'string', 'max:255'],
            'slug'               => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'description'        => ['nullable', 'string'],
            'meta_title'         => ['nullable', 'string', 'max:255'],
            'meta_description'   => ['nullable', 'string', 'max:255'],
            'price'              => ['required', 'numeric', 'min:0'],
            'discount_price'     => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'quantity'           => ['required', 'integer', 'min:0'],
            'category_id'        => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id'     => ['nullable', 'integer', 'exists:subcategories,id'],
            'sub_subcategory_id' => ['nullable', 'integer', 'exists:sub_subcategories,id'],
            'sku'                => ['nullable', 'string', 'max:100', Rule::unique('products', 'sku')->ignore($productId)],
            'cover'              => ['nullable', 'image', 'max:2048'],
            'status'             => ['required', Rule::in(['pending', 'approved', 'rejected'])],
            'featured'           => ['nullable', 'boolean'],
            'order'              => ['nullable', 'integer', 'min:0'],
            'published_at'       => ['nullable', 'date'],
            'attributes'         => ['nullable', 'array'],
            'attributes.*'       => ['nullable', 'string'],
            'attribute_keys'     => ['nullable', 'array'],
            'attribute_keys.*'   => ['nullable', 'string', 'max:255'],
            'attribute_values'   => ['nullable', 'array'],
            'attribute_values.*' => ['nullable', 'string'],
            'images'             => ['nullable', 'array'],
            'images.*'           => ['file', 'mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi,mkv', 'max:20480'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'           => 'نام محصول الزامی است.',
            'price.required'          => 'قیمت محصول الزامی است.',
            'price.numeric'           => 'قیمت باید عدد باشد.',
            'discount_price.lt'       => 'قیمت با تخفیف باید کمتر از قیمت اصلی باشد.',
            'quantity.required'       => 'موجودی محصول الزامی است.',
            'category_id.required'    => 'دسته اصلی الزامی است.',
            'status.required'         => 'وضعیت محصول الزامی است.',
            'images.*.mimes'          => 'فرمت فایل رسانه باید تصویر یا ویدیو باشد.',
            'images.*.max'            => 'حجم هر فایل رسانه نباید بیشتر از ۲۰ مگابایت باشد.',
            'slug.unique'             => 'این نامک (slug) قبلاً استفاده شده است.',
            'sku.unique'              => 'این کد محصول (sku) قبلاً استفاده شده است.',
        ];
    }
}