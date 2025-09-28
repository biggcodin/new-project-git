<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CommentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // اگر Policy داری می‌تونی تغییر بدی
    }

    public function rules(): array
    {
        $article = $this->route('article'); // از Route Model Binding می‌آد

        return [
            'name'      => ['nullable','string','max:100'], // برای مهمان
            'email'     => ['nullable','email','max:150'],
            'body'      => ['required','string','min:3'],
            'parent_id' => [
                'nullable',
                Rule::exists('comments', 'id')->where(function ($q) use ($article) {
                    $q->where('article_id', $article->id);
                }),
            ],
        ];
    }

    public function prepareForValidation(): void
    {
        // اگر کاربر لاگین است، name/email لازم نیست
        if ($this->user()) {
            $this->merge([
                'name'  => $this->user()->name ?? $this->input('name'),
                'email' => $this->user()->email ?? $this->input('email'),
            ]);
        }
    }

    public function messages(): array
    {
        return [
            'body.required' => 'متن نظر الزامی است.',
            'parent_id.exists' => 'پاسخ به نظر نامعتبر است.',
        ];
    }
}
