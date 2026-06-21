<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WalletChargeRequest extends FormRequest
{
    /**
     * آیا کاربر مجاز به انجام این درخواست است؟
     * در اینجا فقط کاربران لاگین‌شده مجازند (که در مسیر middleware('auth') گرفته شده)
     */
    public function authorize(): bool
    {
        return true; // اجازه دسترسی به همه کاربران احراز هویت شده
    }

    /**
     * قوانین اعتبارسنجی
     */
    public function rules(): array
    {
        return [
            'amount' => [
                'required',
                'integer',
                'min:10000',          // حداقل ۱۰ هزار تومان
                'max:100000000',      // حداکثر ۱۰۰ میلیون تومان
            ],
        ];
    }

    /**
     * پیام‌های خطا به فارسی
     */
    public function messages(): array
    {
        return [
            'amount.required' => 'لطفاً مبلغ شارژ را وارد کنید.',
            'amount.integer'  => 'مبلغ شارژ باید عدد باشد.',
            'amount.min'      => 'حداقل مبلغ شارژ ۱۰,۰۰۰ تومان است.',
            'amount.max'      => 'حداکثر مبلغ شارژ ۱۰۰,۰۰۰,۰۰۰ تومان است.',
        ];
    }

    /**
     * در صورت نیاز، داده‌ها را قبل از اعتبارسنجی آماده کنید
     * مثلاً حذف کاما از عدد ورودی (اگر کاربر با کاما وارد کند)
     */
    protected function prepareForValidation(): void
    {
        // اگر کاربر عدد را با کاما وارد کرده باشد (مثلاً ۱۰۰,۰۰۰)
        if ($this->has('amount')) {
            $cleanAmount = str_replace(',', '', $this->input('amount'));
            $this->merge([
                'amount' => $cleanAmount,
            ]);
        }
    }
}