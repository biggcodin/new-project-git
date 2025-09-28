<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductUpdateRequest extends FormRequest
{
    // بررسی مجوز دسترسی برای ویرایش محصول
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('product'));
    }

    // قوانین اعتبارسنجی برای بروزرسانی محصول
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
        ];
    }
}
