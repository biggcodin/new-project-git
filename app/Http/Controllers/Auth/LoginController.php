<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Validation\ValidationException;
class LoginController extends Controller
{
    // نمایش فرم ورود
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // عملیات ورود
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ], [
            'login.required' => 'لطفا شماره تلفن یا ایمیل خود را وارد کنید.',
            'password.required' => 'لطفا رمز عبور خود را وارد کنید.'
        ]);

        $loginType = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';

        $user = User::where($loginType, $credentials['login'])->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw ValidationException::withMessages([
                'login' => ['اطلاعات وارد شده صحیح نیست.'],
            ]);
        }

        // فعال کردن remember me
        $remember = $request->has('remember');
        Auth::login($user, $remember);

        $route = $user->isAdmin() ? 'admin.dashboard' : 'dashboard';

        return redirect()->intended(route($route));
    }


    // خروج کاربر
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}