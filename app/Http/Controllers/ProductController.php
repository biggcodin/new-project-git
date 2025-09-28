<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;

class ProductController extends Controller
{
    // لیست محصولات با فیلتر دسته‌بندی و جستجو
    public function index(Request $request)
    {
        $filters = $request->validate([
            'search'    => 'nullable|string|max:100',
            'category'  => 'nullable|integer|exists:categories,id',
            'page'      => 'nullable|integer|min:1',
        ]);

        $products = Product::query()
            ->with('category:id,name')
            ->when($filters['search'] ?? null, fn($q, $s) =>
                $q->where('name', 'like', "%{$s}%")
            )
            ->when($filters['category'] ?? null, fn($q, $catId) =>
                $q->where('category_id', $catId)
            )
            ->orderByDesc('id')
            ->paginate(10)
            ->appends($filters);

        $categories = Category::select('id', 'name')->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    // ذخیره محصول جدید
    public function store(ProductStoreRequest $request)
    {
        $this->authorize('create', Product::class);

        $data = $request->validated();

        DB::transaction(function () use ($request, $data) {
            $slug = $this->uniqueSlug(Str::slug($data['name']));

$product = Product::create([
    'name'         => $data['name'],
    'slug'         => $slug,
    'description'  => $data['description'],
    'price'          => $data['price'],
    'discount_price' => $data['discount_price'] ?? null,
    'quantity'       => $data['quantity'] ?? 0,
    'category_id'  => $data['category_id'],
    'image'        => null,
    'status'       => $data['status'],
]);

            // ذخیره تصویر محصول
            if ($request->hasFile('image')) {
                $product->image = $request->file('image')->store('products', 'public');
                $product->save();
            }
        });

        return redirect()->route('products.index')->with('success', 'محصول با موفقیت ثبت شد.');
    }

    // بروزرسانی محصول
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $this->authorize('update', $product);

        $data = $request->validated();

        DB::transaction(function () use ($request, $product, $data) {
            $product->fill([
    'name'         => $data['name'],
    'description'  => $data['description'],
    'price'          => $data['price'],
    'discount_price' => $data['discount_price'] ?? null,
    'quantity'       => $data['quantity'] ?? 0,
    'category_id'  => $data['category_id'],
    'status'       => $data['status'],
]);

            // اگر نام تغییر کرده، slug جدید بساز
            if ($product->isDirty('name')) {
                $product->slug = $this->uniqueSlug(Str::slug($data['name']), $product->id);
            }

            // جایگزینی تصویر
            if ($request->hasFile('image')) {
                Storage::disk('public')->delete($product->image);
                $product->image = $request->file('image')->store('products', 'public');
            }

            $product->save();
        });

        return redirect()->route('products.index')->with('success', 'محصول با موفقیت ویرایش شد.');
    }

    // حذف محصول و تصویر آن
    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);

        DB::transaction(function () use ($product) {
            Storage::disk('public')->delete($product->image);
            $product->delete();
        });

        return redirect()->route('products.index')->with('success', 'محصول با موفقیت حذف شد.');
    }

    // حذف تصویر محصول
    public function destroyImage(Product $product)
    {
        $this->authorize('update', $product);

        Storage::disk('public')->delete($product->image);
        $product->update(['image' => null]);

        return back()->with('success', 'تصویر محصول با موفقیت حذف شد.');
    }

    // نمایش محصولات در سمت کاربر
    public function showProducts()
    {
        $products = Product::with('category:id,name')
            ->where('status', 'active')
            ->latest('created_at')
            ->paginate(12);

        return view('shop.products', compact('products'));
    }

    // نمایش محصول تکی
    public function showSingleProduct($slug)
    {
        $product = Product::with('category:id,name')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->latest('created_at')
            ->take(4)
            ->get();

        return view('shop.product-single', compact('product', 'relatedProducts'));
    }

    // ساخت slug یکتا برای محصول
    private function uniqueSlug(string $base, ?int $ignoreId = null): string
    {
        $slug = $base ?: Str::random(8);
        $original = $slug;
        $i = 1;

        while (
            Product::where('slug', $slug)
                ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
