<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product; // فرض کنید محصولات در مدل Product ذخیره شده‌اند
use App\Models\Slider; // مدل اسلایدرها
class HomeController extends Controller
{
    public function index()
{
    $products = Product::with(['category', 'subcategory', 'tags'])
        ->where('status', 'approved')
        ->latest()
        ->limit(8)
        ->get();

    $sliders = \Illuminate\Support\Facades\Cache::remember('homepage_sliders', 3600, function () {
        return Slider::orderByDesc('created_at')->get();
    });

    return view('index', compact('products', 'sliders'));
}

}