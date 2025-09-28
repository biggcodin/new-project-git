<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAccountStoreRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UserAccountController extends Controller
{
    public function create()
    {
        $category = Category::where('name', 'بازی')->firstOrFail();
        $subcategory = Subcategory::where('category_id', $category->id)
            ->where('name', 'اکانت')
            ->firstOrFail();
        $subSubcategories = SubSubcategory::where('subcategory_id', $subcategory->id)->get();
        $tags = Tag::orderBy('name')->get();

        return view('user.account.create', compact('subcategory', 'subSubcategories', 'tags'));
    }

    public function store(UserAccountStoreRequest $request)
    {
        $subSubcategory = SubSubcategory::with('subcategory.category')
            ->findOrFail($request->sub_subcategory_id);

        $uploadedFiles = [];

        DB::beginTransaction();
        try {
            $product = Product::create([
                'title'              => $request->title,
                'price'              => $request->price,
                'description'        => $request->description,
                'discount'           => $request->discount ?? 0,
                'stock_status'       => $request->stock_status,
                'category_id'        => $subSubcategory->subcategory->category->id,
                'subcategory_id'     => $subSubcategory->subcategory->id,
                'sub_subcategory_id' => $subSubcategory->id,
                'user_id'            => $request->user()->id,
                'status'             => 'pending',
            ]);

            // تگ‌ها
            if ($request->filled('tags')) {
                $product->tags()->sync($request->tags);
            }

            // ویژگی‌ها
            $attributes = $request->input('attributes', []);
            foreach ($attributes as $key => $value) {
                $product->attributes()->create([
                    'key'   => $key,
                    'value' => is_array($value) ? json_encode($value) : (string)$value,
                ]);
            }

            // کاور
            if ($request->hasFile('cover')) {
                $coverPath = $request->file('cover')->store('products', 'public');
                $uploadedFiles[] = $coverPath;
                $product->update(['cover' => $coverPath]);
            }

            // مدیا
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $path = $file->store('products_media', 'public');
                    $uploadedFiles[] = $path;
                    $product->media()->create([
                        'file_path' => $path,
                        'file_type' => $file->getClientMimeType(),
                        'file_name' => $file->getClientOriginalName(),
                        'file_size' => $file->getSize(),
                    ]);
                }
            }

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            foreach ($uploadedFiles as $path) {
                Storage::disk('public')->delete($path);
            }
            throw $e;
        }

        return redirect()
            ->route('user.account.create')
            ->with('success', 'اکانت شما با موفقیت ثبت شد و در انتظار تأیید مدیر است.');
    }
}
