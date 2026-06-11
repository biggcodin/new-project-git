<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product; // فرض کنید محصولات در مدل Product ذخیره شده‌اند
use App\Models\Slider; // مدل اسلایدرها
use App\Models\User; // مدل کاربران
use App\Models\Article; // مدل مقالات
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

    public function adminDashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'approved_products' => Product::where('status', 'approved')->count(),
            'pending_products' => Product::where('status', 'pending')->count(),
            'rejected_products' => Product::where('status', 'rejected')->count(),
            'total_users' => User::count(),
            'total_articles' => Article::count(),
        ];

        $pendingProducts = Product::with(['user', 'subSubcategory'])
            ->where('status', 'pending')
            ->latest()
            ->take(10)
            ->get();

        $recentProducts = Product::with('user')->latest()->take(5)->get();
        $recentArticles = Article::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'pendingProducts', 'recentProducts', 'recentArticles'));
    }

}
