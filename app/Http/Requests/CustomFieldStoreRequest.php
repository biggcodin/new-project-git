<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomFieldStoreRequest extends FormRequest
{
    /**
     * مجوز دسترسی برای ذخیره فیلد
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قوانین اعتبارسنجی برای ذخیره فیلد جدید
     */
    public function rules(): array
    {
        return [
            'subcategory_id' => 'required|exists:subcategories,id', // وابستگی به زیر دسته
            'key' => [
                'required',
                'string',
                // کلید باید در همان زیر دسته یکتا باشد
                Rule::unique('custom_fields')->where(fn($query) => 
                    $query->where('subcategory_id', $this->subcategory_id)
                        ->whereNull('sub_subcategory_id')
                )
            ],
            'label' => 'required|string', // عنوان نمایشی
            'type' => 'required|in:text,number,date,select', // نوع فیلد
            'options' => 'nullable|string', // گزینه‌ها برای select
            'sub_subcategory_id' => 'nullable|exists:sub_subcategories,id' // وابستگی اختیاری
        ];
    }
}
