<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    /**
     * مجوز دسترسی برای بروزرسانی دسته‌بندی
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قوانین اعتبارسنجی برای بروزرسانی بر اساس نوع
     */
    public function rules(): array
    {
        $type = $this->route('type'); // دریافت نوع از route

        $rules = [
            'name' => 'required|string|max:255',
        ];

        // اگر نوع زیر دسته است، category_id الزامی است
        if ($type === 'subcategory') {
            $rules['category_id'] = 'required|exists:categories,id';
        }

        // اگر نوع زیر زیر دسته است، subcategory_id الزامی است
        if ($type === 'sub_subcategory') {
            $rules['subcategory_id'] = 'required|exists:subcategories,id';
        }

        return $rules;
    }

    /**
     * پیام‌های خطا برای اعتبارسنجی
     */
    public function messages(): array
    {
        return [
            'name.required' => 'نام الزامی است.',
        ];
    }
}
