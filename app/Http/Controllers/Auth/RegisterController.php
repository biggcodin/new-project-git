<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;
use App\Rules\IranianPhone;





class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register'); //نمایش صفحه ثبت نام
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|iranian_phone|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'name.required' => 'لطفا نام خود را وارد کنید',
            'username.required' => 'لطفا نام کاربری را وارد کنید',
            'username.unique' => 'این نام کاربری قبلا ثبت شده است',
            'email.required' => 'لطفا ایمیل خود را وارد کنید',
            'email.unique' => 'این ایمیل قبلا ثبت شده است',
            'phone.required' => 'لطفا شماره تلفن خود را وارد کنید',
            'phone.unique' => 'این شماره تلفن قبلا ثبت شده است',
            'password.required' => 'لطفا رمز عبور را وارد کنید',
            'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد',
            'password.confirmed' => 'تکرار رمز عبور با رمز عبور مطابقت ندارد',
        ]);

        // اگر ناموفق بود
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        //ساختن کاربر
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user', // مقدار پیش‌فرض
        ]);
        //ورود به پروفایل پس از ثبت نام موفق
        auth()->login($user);

        return redirect('/dashboard')->with('success', 'ثبت نام شما با موفقیت انجام شد!');
    }
}




