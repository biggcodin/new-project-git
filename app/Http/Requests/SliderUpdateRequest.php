<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_text' => 'nullable|string|max:255',
            'price_value' => 'nullable|string|max:255',
            'price_unit' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ];
    }
}
