<?php

namespace App\Http\Controllers;

use App\Models\SubSubcategory;
use App\Models\SellerApplication;
use App\Models\CustomField;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerApplicationController extends Controller
{
    /**
     * نمایش فرم ویزارد (همه مراحل در یک صفحه)
     */
    public function index()
    {
        // بررسی اینکه کاربر قبلاً درخواست pending دارد یا فروشنده است
        if (Auth::user()->hasPendingSellerApplication()) {
            return redirect()->route('user.panel')
                ->with('error', 'شما قبلاً یک درخواست فروشندگی در انتظار بررسی دارید.');
        }

        if (Auth::user()->isSeller()) {
            return redirect()->route('user.panel')
                ->with('error', 'شما قبلاً فروشنده هستید.');
        }

        // دریافت لیست نوع بازی‌ها (زیرزیردسته‌های مربوط به اکانت)
        $gameTypes = SubSubcategory::whereHas('subcategory', function ($q) {
            $q->where('name', 'اکانت')->whereHas('category', function ($qq) {
                $qq->where('name', 'بازی');
            });
        })->get();

        // شناسه‌های ثابت برای دسته و زیردسته
        $gameCategoryId = Category::where('name', 'بازی')->value('id') ?? 1;
        $accountSubcategoryId = Subcategory::where('name', 'اکانت')->value('id') ?? 5;

        return view('seller.application.index', compact('gameTypes', 'gameCategoryId', 'accountSubcategoryId'));
    }

    /**
     * دریافت فیلدهای اختصاصی برای نوع بازی انتخاب‌شده (AJAX)
     */
    public function getFields(Request $request)
    {
        $request->validate([
            'sub_subcategory_id' => 'required|exists:sub_subcategories,id',
        ]);

        // دریافت فیلدهای اختصاصی مرتبط با زیرزیردسته
        $fields = CustomField::where('sub_subcategory_id', $request->sub_subcategory_id)
            ->orWhereNull('sub_subcategory_id')
            ->get();

        return response()->json(['fields' => $fields]);
    }

    /**
     * ثبت نهایی درخواست
     */
    public function store(Request $request)
    {
        // اعتبارسنجی نهایی (همه فیلدها در یک مرحله)
        $validated = $request->validate([
            // مرحله اول
            'is_adult' => 'required|in:yes,no',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'national_code' => [
                'required',
                'string',
                'size:10',
                // فقط درخواست‌های pending یا approved مانع ثبت مجدد می‌شوند
                Rule::unique('seller_applications', 'national_code')->where(function ($query) {
                    return $query->whereIn('status', ['pending', 'approved']);
                }),
            ],
            'phone' => 'required|string|max:20',
            'birth_date' => 'required|string|max:20',
            'card_number' => 'required|string|max:20',
            'id_card_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            // مرحله دوم
            'sub_subcategory_id' => 'required|exists:sub_subcategories,id',
            'attributes' => 'nullable|array',
        ]);

        // بررسی اینکه آیا کاربر قبلاً برای این نوع بازی درخواست pending یا approved دارد
        $existingApplication = SellerApplication::where('user_id', Auth::id())
            ->where('sub_subcategory_id', $request->sub_subcategory_id)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($existingApplication) {
            return back()
                ->withInput()
                ->with('error', 'شما قبلاً برای این نوع بازی درخواست ثبت کرده‌اید و در حال بررسی یا تأیید شده است.');
        }

        // ذخیره تصویر کارت ملی
        $imagePath = $request->file('id_card_image')->store('seller_documents/national_cards', 'public');

        // ایجاد رکورد در دیتابیس
        $application = SellerApplication::create([
            'user_id' => Auth::id(),
            'is_over_18' => $request->is_adult === 'yes',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'national_code' => $request->national_code,
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'bank_card_number' => $request->card_number,
            'national_card_image' => $imagePath,
            'sub_subcategory_id' => $request->sub_subcategory_id,
            'custom_fields_data' => $request->attributes ?? [],
            'status' => 'pending',
        ]);

        // به‌روزرسانی seller_request_status در جدول users
        Auth::user()->update(['seller_request_status' => 'pending']);

        return redirect()->route('user.panel')
            ->with('success', 'درخواست شما با موفقیت ثبت شد. پس از بررسی، نتیجه به شما اطلاع داده می‌شود.');
    }
}