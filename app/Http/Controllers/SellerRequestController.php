<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerRequestController extends Controller
{
    public function create()
    {
        return view('user.seller-request');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->hasSellerRequest()) {
            return back()->with('error', 'درخواست شما قبلاً ثبت شده و در انتظار بررسی است.');
        }
        
        if ($user->isSeller()) {
            return back()->with('error', 'شما قبلاً فروشنده هستید.');
        }
        
        $user->requestSeller();
        
        return back()->with('success', 'درخواست شما با موفقیت ثبت شد. پس از تایید ادمین، نقش شما به فروشنده تغییر می‌کند.');
    }
}