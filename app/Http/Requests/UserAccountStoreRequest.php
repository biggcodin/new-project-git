<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAccountStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check(); // کاربر باید لاگین باشد
    }

    public function rules(): array
    {
        return [
            'title'              => 'required|string|max:255',
            'price'              => 'required|numeric|min:0',
            'description'        => 'nullable|string',
            'discount'           => 'nullable|numeric|min:0|max:100',
            'stock_status'       => 'required|in:in_stock,out_of_stock,pre_order',
            'sub_subcategory_id' => 'required|exists:sub_subcategories,id',
            'attributes'         => 'nullable|array',
            'attributes.*'       => 'nullable',
            'cover'              => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'media'              => 'nullable|array',
            'media.*'            => 'file|mimes:jpeg,png,jpg,gif,webp,mp4,mov,avi,mkv|max:20480',
            'tags'               => 'nullable|array',
            'tags.*'             => 'integer|exists:tags,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الزامی است.',
            'price.required' => 'قیمت الزامی است.',
        ];
    }
}
