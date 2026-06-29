<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Tag;
use App\Models\ProductMedia;
use App\Models\CustomField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Schema;

class ProductController extends Controller
{
    /**
     * پاک‌سازی قیمت و تبدیل به عدد صحیح
     */
    private function cleanPrice($price): int
    {
        $clean = preg_replace('/[^0-9.]/', '', (string) $price);
        return (int) round((float) $clean);
    }

    public function create()
    {
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $subcategories = Subcategory::select('id', 'name', 'category_id')->orderBy('name')->get();
        $subSubcategories = SubSubcategory::select('id', 'name', 'subcategory_id')->orderBy('name')->get();
        $tags = Tag::select('id', 'name')->orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'subcategories', 'subSubcategories', 'tags'));
    }

    public function edit(Product $product)
    {
        $product->load('tags', 'media', 'attributes');
        
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $subcategories = Subcategory::select('id', 'name', 'category_id')->orderBy('name')->get();
        $subSubcategories = SubSubcategory::select('id', 'name', 'subcategory_id')->orderBy('name')->get();
        $tags = Tag::select('id', 'name')->orderBy('name')->get();
        
        $attributes = $product->attributes->pluck('value', 'key')->toArray();

        return view('admin.products.edit', compact('product', 'categories', 'subcategories', 'subSubcategories', 'tags', 'attributes'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $category = $request->input('category');
        $subcategory = $request->input('subcategory');
        $subSubcategory = $request->input('sub_subcategory');

        $products = Product::query()
            ->with(['category:id,name', 'subcategory:id,name', 'subSubcategory:id,name'])
            ->with('attributes')
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', "%{$search}%");
            })
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category);
            })
            ->when($subcategory, function ($query) use ($subcategory) {
                return $query->where('subcategory_id', $subcategory);
            })
            ->when($subSubcategory, function ($query) use ($subSubcategory) {
                return $query->where('sub_subcategory_id', $subSubcategory);
            })
            ->orderByDesc('id')
            ->paginate($request->input('per', 10))
            ->appends([
                'search' => $search,
                'category' => $category,
                'subcategory' => $subcategory,
                'sub_subcategory' => $subSubcategory,
                'per' => $request->input('per', 10),
            ]);

        $categories = Category::select('id', 'name')->orderBy('name')->get();
        $subcategories = Subcategory::select('id', 'name', 'category_id')->orderBy('name')->get();
        $subSubcategories = SubSubcategory::select('id', 'name', 'subcategory_id')->orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories', 'subcategories', 'subSubcategories'));
    }

    public function store(ProductStoreRequest $request)
    {
        $validated = $request->validated();
                
        if (!isset($validated['subcategory_id'])) {
            return back()->withErrors(['subcategory_id' => 'زیردسته اول الزامی است.'])->withInput();
        }

        if (!empty($validated['slug']) && Product::where('slug', $validated['slug'])->exists()) {
            return back()->withErrors(['slug' => 'این نامک (slug) قبلاً استفاده شده است.'])->withInput();
        }
        if (!empty($validated['sku']) && Product::where('sku', $validated['sku'])->exists()) {
            return back()->withErrors(['sku' => 'این کد محصول (sku) قبلاً استفاده شده است.'])->withInput();
        }

        // ===== بررسی فیلد یکتا (is_unique) برای ادمین =====
        $uniqueKey = CustomField::getUniqueFieldKeyForSubSubcategory($validated['sub_subcategory_id']);
        if ($uniqueKey) {
            $attributes = $validated['attributes'] ?? [];
            $uniqueValue = $attributes[$uniqueKey] ?? null;
            if ($uniqueValue) {
                $exists = Product::where('sub_subcategory_id', $validated['sub_subcategory_id'])
                    ->whereHas('attributes', function ($q) use ($uniqueKey, $uniqueValue) {
                        $q->where('key', $uniqueKey)->where('value', (string)$uniqueValue);
                    })
                    ->whereIn('status', ['pending', 'approved'])
                    ->exists();

                if ($exists) {
                    return back()->withInput()->with('error', 'یک محصول با این مشخصات (فیلد ' . $uniqueKey . ') قبلاً برای این نوع بازی ثبت شده است.');
                }
            }
        }

        $slug = null;
        if (Schema::hasColumn('products', 'slug')) {
            $slug = $this->generateUniqueSlug($validated['name']);
        }

        $productData = [
            'name'              => $validated['name'],
            'slug'              => $slug,
            'description'       => $validated['description'] ?? '',
            'price'             => $this->cleanPrice($validated['price']), // ✅ اصلاح قیمت
            'discount_price'    => isset($validated['discount_price']) ? $this->cleanPrice($validated['discount_price']) : null,
            'quantity'          => $validated['quantity'] ?? 0,
            'category_id'       => $validated['category_id'],
            'subcategory_id'    => $validated['subcategory_id'],
            'sub_subcategory_id'=> $validated['sub_subcategory_id'] ?? null,
            'sku'               => $validated['sku'] ?? null,
            'status'            => $validated['status'] ?? 'pending',
            'featured'          => $request->boolean('featured'),
            'order'             => $validated['order'] ?? 0,
            'meta_title'        => $validated['meta_title'] ?? null,
            'meta_description'  => $validated['meta_description'] ?? null,
            'user_id'           => auth()->id(),
            'published_at'      => isset($validated['published_at']) && $validated['published_at'] ? \Carbon\Carbon::parse($validated['published_at']) : now(),
        ];

        $product = Product::create($productData);

        if ($request->hasFile('cover')) {
            $product->cover = $request->file('cover')->store('products', 'public');
            $product->save();
        }

        if ($request->has('tags')) {
            $product->tags()->sync($request->tags);
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products_media', 'public');
                $product->media()->create([
                    'file_path' => $path,
                    'file_type' => $image->getClientMimeType(),
                    'file_name' => $image->getClientOriginalName(),
                    'file_size' => $image->getSize(),
                    'order' => 0
                ]);
            }
        }

        if ($request->has('attributes')) {
            $attributes = $request->input('attributes');
            if (is_array($attributes)) {
                foreach ($attributes as $key => $value) {
                    if (!empty($value)) {
                        $product->addAttribute($key, $value);
                    }
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'محصول با موفقیت ثبت شد.');
    }

    private function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $i = 1;
        while (Product::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
        ) {
            $slug = $original . '-' . $i++;
        }
        return $slug;
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->validated();

        if (!empty($data['slug']) && Product::where('slug', $data['slug'])->where('id', '!=', $product->id)->exists()) {
            return back()->withErrors(['slug' => 'این نامک (slug) قبلاً استفاده شده است.'])->withInput();
        }
        if (!empty($data['sku']) && Product::where('sku', $data['sku'])->where('id', '!=', $product->id)->exists()) {
            return back()->withErrors(['sku' => 'این کد محصول (sku) قبلاً استفاده شده است.'])->withInput();
        }

        DB::transaction(function () use ($request, $product, $data) {
            $product->fill([
                'name'              => $data['name'],
                'slug'              => $data['slug'] ?? null,
                'description'       => $data['description'] ?? '',
                'price'             => $this->cleanPrice($data['price']), // ✅ اصلاح قیمت
                'discount_price'    => isset($data['discount_price']) ? $this->cleanPrice($data['discount_price']) : null,
                'quantity'          => $data['quantity'] ?? 0,
                'category_id'       => $data['category_id'],
                'subcategory_id'    => $data['subcategory_id'],
                'sub_subcategory_id'=> $data['sub_subcategory_id'] ?? null,
                'sku'               => $data['sku'] ?? null,
                'status'            => $data['status'],
                'featured'          => $request->boolean('featured'),
                'order'             => $data['order'] ?? 0,
                'meta_title'        => $data['meta_title'] ?? null,
                'meta_description'  => $data['meta_description'] ?? null,
                'published_at'      => $data['published_at'] ? \Carbon\Carbon::parse($data['published_at']) : now(),
            ]);

            if ($product->isDirty('name')) {
                $product->slug = $this->generateUniqueSlug($data['name'], $product->id);
            }

            if ($request->hasFile('cover')) {
                if ($product->cover) {
                    Storage::disk('public')->delete($product->cover);
                }
                $product->cover = $request->file('cover')->store('products', 'public');
            }

            $product->save();

            $product->attributes()->delete();
            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            } else {
                $product->tags()->detach();
            }

            if ($request->has('attributes')) {
                $attributes = $request->input('attributes');
                if (is_array($attributes)) {
                    foreach ($attributes as $key => $value) {
                        if (!empty($value)) {
                            $product->addAttribute($key, $value);
                        }
                    }
                }
            }

            if ($request->has('attribute_keys') && $request->has('attribute_values')) {
                $keys = $request->input('attribute_keys');
                $values = $request->input('attribute_values');
                for ($i = 0; $i < count($keys); $i++) {
                    if (!empty($keys[$i]) && !empty($values[$i])) {
                        $product->addAttribute($keys[$i], $values[$i]);
                    }
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'محصول با موفقیت ویرایش شد.');
    }

    public function destroy(Product $product)
    {
        DB::transaction(function () use ($product) {
            if ($product->cover) {
                Storage::disk('public')->delete($product->cover);
            }
            foreach ($product->media as $media) {
                Storage::disk('public')->delete($media->file_path);
                $media->delete();
            }
            $product->delete();
        });
        return redirect()->route('admin.products.index')->with('success', 'محصول با موفقیت حذف شد.');
    }

    public function destroyImage(Product $product)
    {
        if ($product->cover) {
            Storage::disk('public')->delete($product->cover);
        }
        $product->update(['cover' => null]);
        return back()->with('success', 'تصویر محصول با موفقیت حذف شد.');
    }

    public function destroyMedia($id)
    {
        $media = ProductMedia::findOrFail($id);
        if ($media->product->user_id != auth()->id() && !auth()->user()->isAdmin()) {
            return response()->json(['success' => false, 'message' => 'دسترسی غیرمجاز'], 403);
        }
        Storage::disk('public')->delete($media->file_path);
        $media->delete();
        return response()->json(['success' => true]);
    }

    public function showProducts()
    {
        $products = Product::with('category:id,name')
            ->where('status', 'approved')
            ->latest('created_at')
            ->paginate(12);
        return view('shop.products', compact('products'));
    }

    public function showSingleProduct($slug)
    {
        $product = Product::with('category:id,name')
            ->where('slug', $slug)
            ->where('status', 'approved')
            ->firstOrFail();
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'approved')
            ->latest('created_at')
            ->take(4)
            ->get();
        return view('shop.product-single', compact('product', 'relatedProducts'));
    }

    public function getSubcategories($categoryId)
    {
        $subcategories = Subcategory::where('category_id', $categoryId)->get();
        return response()->json($subcategories);
    }

    public function getSubSubcategories($subcategoryId)
    {
        $subSubcategories = SubSubcategory::where('subcategory_id', $subcategoryId)->get();
        return response()->json($subSubcategories);
    }
}