<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAccountStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:255',   // قبلاً title
            'price'              => 'required|numeric|min:0',
            'description'        => 'nullable|string',
            'discount_price'     => 'nullable|numeric|min:0|lt:price', // قبلاً discount
            'quantity'           => 'required|integer|min:0',    // قبلاً stock_status
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
            'name.required' => 'عنوان الزامی است.',
            'price.required' => 'قیمت الزامی است.',
            'quantity.required' => 'موجودی الزامی است.',
            'discount_price.lt' => 'قیمت تخفیفی باید کمتر از قیمت اصلی باشد.',
        ];
    }
}