<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomFieldUpdateRequest extends FormRequest
{
    /**
     * مجوز دسترسی برای بروزرسانی فیلد
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قوانین اعتبارسنجی برای بروزرسانی فیلد
     */
    public function rules(): array
    {
        return [
            'subcategory_id' => 'required|exists:subcategories,id',
            'key' => 'required|string|max:255', // کلید فیلد
            'label' => 'required|string|max:255', // عنوان نمایشی
            'type' => 'required|in:text,number,date,select', // نوع فیلد
            'options' => 'nullable|string', // گزینه‌ها برای select
            'sub_subcategory_id' => 'nullable|exists:sub_subcategories,id'
        ];
    }
}
