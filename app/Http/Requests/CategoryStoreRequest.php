<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    /**
     * مجوز دسترسی برای ذخیره دسته‌بندی
     */
    public function authorize(): bool
    {
        return true; // اگر نیاز به محدودیت ادمین هست، middleware اضافه کن
    }

    /**
     * قوانین اعتبارسنجی برای ذخیره دسته، زیر دسته یا زیر زیر دسته
     */
    public function rules(): array
    {
        return [
            'name'           => 'required|string|max:255', // نام الزامی
            'type'           => 'required|in:category,subcategory,sub_subcategory', // نوع معتبر
            'category_id'    => 'nullable|exists:categories,id', // برای زیر دسته
            'subcategory_id' => 'nullable|exists:subcategories,id', // برای زیر زیر دسته
        ];
    }

    /**
     * پیام‌های خطا برای اعتبارسنجی
     */
    public function messages(): array
    {
        return [
            'name.required' => 'نام الزامی است.',
            'type.in'       => 'نوع ورودی نامعتبر است.',
        ];
    }
}
