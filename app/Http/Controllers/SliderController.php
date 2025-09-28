<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ساخت Query برای جستجو
        $query = Slider::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('subtitle', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        // گرفتن اسلایدرها با ترتیب آخرین اضافه‌شده‌ها
        $slides = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.sliders.index', compact('slides', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // اعتبارسنجی داده‌ها
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_text' => 'nullable|string|max:255',
            'price_value' => 'nullable|string|max:255',
            'price_unit' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        // ذخیره تصویر (اگر ارسال شده باشد)
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slides', 'public');
        }

        // ایجاد اسلایدر جدید
        Slider::create($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'اسلایدر با موفقیت اضافه شد.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slide)
    {
        return view('admin.sliders.show', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slide)
    {
        return view('admin.sliders.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slide)
    {
        // اعتبارسنجی داده‌ها
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_text' => 'nullable|string|max:255',
            'price_value' => 'nullable|string|max:255',
            'price_unit' => 'nullable|string|max:255',
            'link' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        // آپدیت داده‌ها
        $data = [
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'price_text' => $request->price_text,
            'price_value' => $request->price_value,
            'price_unit' => $request->price_unit,
            'link' => $request->link,
        ];

        // ذخیره تصویر جدید (اگر ارسال شده باشد)
        if ($request->hasFile('image')) {
            // حذف تصویر قبلی
            if ($slide->image) {
                Storage::delete('public/' . $slide->image);
            }
            $data['image'] = $request->file('image')->store('slides', 'public');
        }

        // آپدیت اسلایدر
        $slide->update($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'اسلایدر با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slide)
    {
        // حذف تصویر از دیسک
        if ($slide->image) {
            Storage::delete('public/' . $slide->image);
        }

        // حذف اسلایدر
        $slide->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'اسلایدر با موفقیت حذف شد.');
    }
}