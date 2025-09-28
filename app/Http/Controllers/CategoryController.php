<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * نمایش لیست دسته‌ها و زیرمجموعه‌ها در پنل مدیریت
     */
    public function index()
    {
        // بارگذاری دسته‌ها با زیر دسته‌ها و زیر زیر دسته‌ها
        $categories = Category::with('subcategories.subSubcategories')->get();

        // بارگذاری جداگانه برای استفاده در فرم‌ها یا فیلترها
        $subcategories = Subcategory::all();
        $subSubcategories = SubSubcategory::all();

        return view('admin.categories.index', compact('categories', 'subcategories', 'subSubcategories'));
    }

    /**
     * ذخیره دسته، زیر دسته یا زیر زیر دسته جدید
     */
    public function store(CategoryStoreRequest $request)
    {
        match ($request->type) {
            'category' => $this->storeCategory($request),
            'subcategory' => $this->storeSubcategory($request),
            'sub_subcategory' => $this->storeSubSubcategory($request),
        };

        return redirect()->back()->with('success', 'با موفقیت اضافه شد.');
    }

    /**
     * بروزرسانی دسته، زیر دسته یا زیر زیر دسته
     */
    public function update(CategoryUpdateRequest $request, string $type, int $id)
    {
        $model = $this->resolveModel($type, $id);

        if (!$model) {
            return back()->withErrors(['type' => 'نوع نامعتبر']);
        }

        // داده‌های قابل بروزرسانی
        $data = ['name' => $request->name];

        // افزودن وابستگی‌ها در صورت نیاز
        if ($type === 'subcategory') {
            $data['category_id'] = $request->category_id;
        } elseif ($type === 'sub_subcategory') {
            $data['subcategory_id'] = $request->subcategory_id;
        }

        $model->update($data);

        return redirect()->back()->with('success', 'با موفقیت ویرایش شد.');
    }

    /**
     * حذف دسته، زیر دسته یا زیر زیر دسته
     */
    public function destroy(Request $request, string $type, int $id)
    {
        $model = $this->resolveModel($type, $id);

        if (!$model) {
            return redirect()->back()->withErrors(['type' => 'نوع یا شناسه نامعتبر']);
        }

        $model->delete();

        return redirect()->back()->with('success', 'با موفقیت حذف شد.');
    }

    /**
     * متد کمکی برای یافتن مدل بر اساس نوع و شناسه
     */
    private function resolveModel(string $type, int $id): Category|Subcategory|SubSubcategory|null
    {
        return match ($type) {
            'category' => Category::find($id),
            'subcategory' => Subcategory::find($id),
            'sub_subcategory' => SubSubcategory::find($id),
            default => null,
        };
    }

    /**
     * ذخیره دسته اصلی
     */
    private function storeCategory(CategoryStoreRequest $request): void
    {
        Category::create(['name' => $request->name]);
    }

    /**
     * ذخیره زیر دسته
     */
    private function storeSubcategory(CategoryStoreRequest $request): void
    {
        Subcategory::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
        ]);
    }

    /**
     * ذخیره زیر زیر دسته
     */
    private function storeSubSubcategory(CategoryStoreRequest $request): void
    {
        SubSubcategory::create([
            'name' => $request->name,
            'subcategory_id' => $request->subcategory_id,
        ]);
    }
}
