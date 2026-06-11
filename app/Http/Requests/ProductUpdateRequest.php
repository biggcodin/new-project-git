<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // یا اگر Policy دارید: $this->user()->can('update', $this->route('product'));
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
            'discount_price'     => ['nullable', 'numeric', 'min:0', 'lt:price'],
            'quantity'           => ['required', 'integer', 'min:0'],
            'category_id'        => ['required', 'integer', 'exists:categories,id'],
            'subcategory_id'     => ['nullable', 'integer', 'exists:subcategories,id'],
            'sub_subcategory_id' => ['nullable', 'integer', 'exists:sub_subcategories,id'],
            'sku'                => ['nullable', 'string', 'max:100'],
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
        ];
    }
}