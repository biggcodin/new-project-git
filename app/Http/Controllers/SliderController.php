<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * نمایش لیست اسلایدرها
     */
    public function index(Request $request)
    {
        $query = Slider::query();

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('subtitle', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $slides = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.sliders.index', compact('slides', 'search'));
    }

    /**
     * نمایش فرم ایجاد اسلایدر جدید
     */
    public function create()
    {
        return view('admin.sliders.create');
    }

    /**
     * ذخیره اسلایدر جدید
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_text'  => 'nullable|string|max:255',
            'price_value' => 'nullable|string|max:255',
            'price_unit'  => 'nullable|string|max:255',
            'link'        => 'nullable|url',
            'image'       => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('slides', 'public');
        }

        Slider::create($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'اسلایدر با موفقیت اضافه شد.');
    }

    /**
     * نمایش یک اسلایدر
     */
    public function show(Slider $slider)
    {
        return view('admin.sliders.show', compact('slider'));
    }

    /**
     * نمایش فرم ویرایش اسلایدر
     */
    public function edit(Slider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    /**
     * بروزرسانی اسلایدر
     */
    public function update(Request $request, Slider $slider)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price_text'  => 'nullable|string|max:255',
            'price_value' => 'nullable|string|max:255',
            'price_unit'  => 'nullable|string|max:255',
            'link'        => 'nullable|url',
            'image'       => 'nullable|image|mimes:jpg,png,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($slider->image) {
                Storage::disk('public')->delete($slider->image);
            }
            $data['image'] = $request->file('image')->store('slides', 'public');
        }

        $slider->update($data);

        return redirect()->route('admin.sliders.index')
            ->with('success', 'اسلایدر با موفقیت ویرایش شد.');
    }

    /**
     * حذف اسلایدر
     */
    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            Storage::disk('public')->delete($slider->image);
        }

        $slider->delete();

        return redirect()->route('admin.sliders.index')
            ->with('success', 'اسلایدر با موفقیت حذف شد.');
    }
}