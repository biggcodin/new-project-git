<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApprovalController extends Controller
{
    // نمایش محصولات در انتظار تایید
    public function index()
    {
        $pendingProducts = Product::with(['user', 'subSubcategory'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.pending-products', compact('pendingProducts'));
    }

    // تایید محصول
    public function approve(Product $product)
    {
        $product->update(['status' => 'approved']);
        return back()->with('success', 'محصول تایید شد.');
    }

    // رد محصول
    public function reject(Product $product)
    {
        $product->update(['status' => 'rejected']);
        return back()->with('success', 'محصول رد شد.');
    }
}
