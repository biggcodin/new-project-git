<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ArticleStoreRequest extends FormRequest
{
    // بررسی مجوز دسترسی برای ایجاد مقاله
    public function authorize(): bool
    {
        return $this->user()->can('create', \App\Models\Article::class);
    }

    // قوانین اعتبارسنجی برای ذخیره مقاله جدید
    public function rules(): array
    {
        return [
            'title'       => ['required', 'string', 'max:255'], // عنوان مقاله
            'content'     => ['required', 'string'],             // محتوای مقاله
            'status'      => ['required', Rule::in(['draft', 'published'])], // وضعیت انتشار
            'tags'        => ['nullable', 'array'],              // لیست تگ‌ها
            'tags.*'      => ['integer', 'exists:tags,id'],      // اعتبارسنجی هر تگ
            'image'       => ['nullable', 'image', 'max:2048'],  // تصویر مقاله (حداکثر ۲ مگابایت)
            'attachments' => ['nullable', 'array'],              // فایل‌های ضمیمه
            'attachments.*' => ['file', 'max:5120'],             // هر فایل حداکثر ۵ مگابایت
        ];
    }
}
