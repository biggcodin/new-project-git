<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class IranianPhone implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^(\+98|0)?9\d{9}$/', $value);
    }

    public function message()
    {
        return 'شماره تلفن معتبر نیست (فرمت صحیح: 09123456789)';
    }
}
