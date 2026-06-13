<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleUpdateRequest extends FormRequest
{
    // بررسی مجوز دسترسی برای ویرایش مقاله
    public function authorize(): bool
    {
        return true;
    }

    // قوانین اعتبارسنجی برای بروزرسانی مقاله
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'], // عنوان جدید مقاله
            'content'     => ['required', 'string'],             // محتوای جدید مقاله
            'status'      => ['required', Rule::in(['draft', 'published'])], // وضعیت جدید
            'tags'        => ['nullable', 'array'],              // لیست تگ‌ها
            'tags.*'      => ['integer', 'exists:tags,id'],      // اعتبارسنجی تگ‌ها
            'image'       => ['nullable', 'image', 'max:2048'],  // تصویر جدید مقاله
            'attachments' => ['nullable', 'array'],              // فایل‌های جدید ضمیمه
            'attachments.*' => ['file', 'max:5120'],             // هر فایل حداکثر ۵ مگابایت
        ];
    }
}
