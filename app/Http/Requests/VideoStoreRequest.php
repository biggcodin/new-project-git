<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'video' => 'nullable|file|mimes:mp4,mov,avi,wmv|max:51200',
            'video_url' => 'nullable|url',
        ];
    }

    public function messages(): array
    {
        return [
            'video.required_without' => 'آپلود فایل یا وارد کردن لینک ویدیو الزامی است.',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'video_url' => $this->video_url ?? null,
        ]);
    }
}
