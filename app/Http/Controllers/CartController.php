<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // بعداً کامل می‌شود
        return view('user.cart');
    }

    public function store($product)
    {
        // بعداً کامل می‌شود
        return back()->with('success', 'محصول به سبد خرید اضافه شد.');
    }

    public function update($cart)
    {
        // بعداً کامل می‌شود
        return back()->with('success', 'سبد خرید بروزرسانی شد.');
    }

    public function destroy($cart)
    {
        // بعداً کامل می‌شود
        return back()->with('success', 'آیتم از سبد خرید حذف شد.');
    }
}