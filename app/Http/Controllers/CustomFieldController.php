<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomFieldStoreRequest;
use App\Http\Requests\CustomFieldUpdateRequest;
use App\Models\CustomField;
use App\Models\Subcategory;
use App\Models\SubSubcategory;
use Illuminate\Http\Request;

class CustomFieldController extends Controller
{
    /**
     * نمایش لیست فیلدهای سفارشی با دسته‌بندی‌ها
     */
    public function index()
    {
        // بارگذاری فیلدها با روابط مرتبط و صفحه‌بندی
        $customFields = CustomField::with(['subcategory', 'subSubcategory'])->paginate(10);

        // بارگذاری دسته‌بندی‌ها برای فرم‌ها
        $subcategories = Subcategory::all();
        $subSubcategories = SubSubcategory::all();

        return view('admin.custom_fields.index', compact('customFields', 'subcategories', 'subSubcategories'));
    }

    /**
     * ذخیره فیلد سفارشی جدید
     */
    public function store(CustomFieldStoreRequest $request)
    {
        // آماده‌سازی گزینه‌ها برای فیلدهای select
        $options = $this->prepareOptions($request->type, $request->options);

        CustomField::create([
            'key' => $request->key,
            'label' => $request->label,
            'type' => $request->type,
            'options' => $options,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_id' => $request->sub_subcategory_id,
        ]);

        return redirect()->back()->with('success', 'فیلد با موفقیت اضافه شد.');
    }

    /**
     * دریافت اطلاعات فیلد برای ویرایش (AJAX)
     */
    public function edit($id)
    {
        $field = CustomField::with(['subcategory', 'subSubcategory'])->findOrFail($id);
        return response()->json(['field' => $field]);
    }

    /**
     * بروزرسانی فیلد سفارشی
     */
    public function update(CustomFieldUpdateRequest $request, CustomField $customField)
    {
        $options = $this->prepareOptions($request->type, $request->options);

        $customField->update([
            'key' => $request->key,
            'label' => $request->label,
            'type' => $request->type,
            'options' => $options,
            'subcategory_id' => $request->subcategory_id,
            'sub_subcategory_id' => $request->sub_subcategory_id,
        ]);

        return redirect()->back()->with('success', 'فیلد با موفقیت ویرایش شد.');
    }

    /**
     * حذف فیلد سفارشی
     */
    public function destroy(CustomField $customField)
    {
        $customField->delete();
        return redirect()->back()->with('success', 'فیلد با موفقیت حذف شد.');
    }

    /**
     * دریافت فیلدهای مرتبط با دسته‌بندی برای فرم محصول (AJAX)
     */
    public function getFields(Request $request)
    {
        $request->validate([
            'subcategory_id' => 'required|exists:subcategories,id',
            'sub_subcategory_id' => 'nullable|exists:sub_subcategories,id'
        ]);

        $query = CustomField::where('subcategory_id', $request->subcategory_id);

        // اگر زیر زیر دسته انتخاب شده، فیلدهای عمومی و اختصاصی را بگیر
        if ($request->filled('sub_subcategory_id')) {
            $query->where(fn($q) => 
                $q->whereNull('sub_subcategory_id')
                ->orWhere('sub_subcategory_id', $request->sub_subcategory_id)
            );
        } else {
            $query->whereNull('sub_subcategory_id');
        }

        $fields = $query->get();

        // خروجی JSON ساخت‌یافته برای فرم‌ها
        return response()->json(
            $fields->mapWithKeys(fn($field) => [
                $field->key => [
                    'label' => $field->label,
                    'type' => $field->type,
                    'options' => json_decode($field->options, true) ?? []
                ]
            ])
        );
    }

    /**
     * آماده‌سازی گزینه‌ها برای فیلدهای select
     */
    private function prepareOptions(string $type, ?string $raw): ?string
    {
        if ($type !== 'select' || !$raw) {
            return null;
        }

        $cleaned = collect(explode(',', $raw))
            ->map(fn($opt) => trim($opt))
            ->filter()
            ->values()
            ->all();

        return json_encode($cleaned);
    }
}
