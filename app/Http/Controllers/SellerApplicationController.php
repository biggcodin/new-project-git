<?php

namespace App\Http\Controllers;

use App\Models\SubSubcategory;
use App\Models\SellerApplication;
use App\Models\CustomField;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class SellerApplicationController extends Controller
{
    /**
     * نمایش فرم ویزارد سه مرحله‌ای (احراز هویت + اطلاعات اکانت)
     */
    public function createProduct()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'لطفاً ابتدا وارد شوید.');
        }

        $gameTypes = SubSubcategory::whereHas('subcategory', function ($q) {
            $q->where('name', 'اکانت')->whereHas('category', function ($qq) {
                $qq->where('name', 'بازی');
            });
        })->get();

        $tags = Tag::orderBy('name')->get();

        return view('seller.product.create', compact('gameTypes', 'tags'));
    }

    /**
     * دریافت فیلدهای اختصاصی برای نوع بازی انتخاب‌شده (AJAX)
     */
    public function getFields(Request $request)
    {
        $request->validate([
            'sub_subcategory_id' => 'required|exists:sub_subcategories,id',
        ]);

        $fields = CustomField::where('sub_subcategory_id', $request->sub_subcategory_id)
            ->orWhereNull('sub_subcategory_id')
            ->get();

        return response()->json(['fields' => $fields]);
    }

    /**
     * ذخیره نهایی اطلاعات (هم هویت و هم محصول) – ویزارد سه مرحله‌ای
     */
    public function store(Request $request)
    {
        // ========== ۱. اعتبارسنجی ==========
        $validated = $request->validate([
            // ---------- بخش هویت ----------
            'is_adult'           => 'required|in:yes,no',
            'first_name'         => 'required|string|max:100',
            'last_name'          => 'required|string|max:100',
            'national_code'      => [
                'required',
                'string',
                'size:10',
                // یکتایی فقط در برابر درخواست‌های pending و approved (بدون در نظر گرفتن کاربر فعلی)
                Rule::unique('seller_applications', 'national_code')->where(function ($query) {
                    return $query->whereIn('status', ['pending', 'approved']);
                }),
            ],
            'phone'              => 'required|string|max:20',
            'birth_date'         => 'nullable|string|max:20',
            'card_number'        => 'required|string|max:20',
            'id_card_image'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',

            // ---------- بخش محصول ----------
            'sub_subcategory_id' => 'required|exists:sub_subcategories,id',
            'name'               => 'required|string|max:255',
            'price'              => 'required|numeric|min:0',
            'quantity'           => 'required|integer|min:0',
            'description'        => 'nullable|string',
            'cover'              => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'media.*'            => 'nullable|file|mimes:jpeg,png,jpg,webp,mp4,mov,avi,mkv|max:20480',
            'tags'               => 'nullable|string',
            'attributes'         => 'nullable|array',
        ]);

        // ========== ۲. بررسی وضعیت هویت کاربر ==========

        // آیا کاربر قبلاً هویت تأییدشده دارد؟
        if (auth()->user()->hasApprovedIdentity()) {
            return back()->withInput()->with('error', 'شما قبلاً هویت خود را تأیید کرده‌اید و نیازی به ثبت مجدد ندارید.');
        }

        // آیا کاربر درخواست هویت در وضعیت pending یا approved دارد (برای هر نوع بازی)؟
        $existingPendingOrApproved = SellerApplication::where('user_id', auth()->id())
            ->whereIn('status', ['pending', 'approved'])
            ->exists();

        if ($existingPendingOrApproved) {
            return back()->withInput()->with('error', 'شما قبلاً یک درخواست هویت در حال بررسی یا تأیید شده دارید. لطفاً منتظر بمانید.');
        }

        // ========== ۳. بررسی تکراری نبودن آگهی ==========
        $existingProduct = Product::where('user_id', auth()->id())
            ->where('sub_subcategory_id', $request->sub_subcategory_id)
            ->where('status', 'pending')
            ->exists();

        if ($existingProduct) {
            return back()->withInput()->with('error', 'شما قبلاً یک آگهی در انتظار بررسی برای این نوع بازی ثبت کرده‌اید.');
        }

        // ========== ۴. بررسی فیلد یکتا (is_unique) ==========
        $uniqueKey = CustomField::getUniqueFieldKeyForSubSubcategory($request->sub_subcategory_id);
        if ($uniqueKey) {
            $uniqueValue = $request->attributes[$uniqueKey] ?? null;
            if ($uniqueValue) {
                $exists = Product::whereHas('attributes', function ($q) use ($uniqueKey, $uniqueValue) {
                    $q->where('key', $uniqueKey)->where('value', (string)$uniqueValue);
                })->where('status', 'pending')->exists();

                if ($exists) {
                    return back()->withInput()->with('error', 'یک اکانت با این مشخصات (فیلد ' . $uniqueKey . ') قبلاً ثبت شده است.');
                }
            }
        }

        // ========== ۵. مدیریت درخواست هویت ==========

        // آیا کاربر درخواست ردشده برای این sub_subcategory دارد؟
        $rejectedApplication = SellerApplication::where('user_id', auth()->id())
            ->where('sub_subcategory_id', $request->sub_subcategory_id)
            ->where('status', 'rejected')
            ->latest()
            ->first();

        DB::beginTransaction();

        try {
            if ($rejectedApplication) {
                // ✅ ویرایش درخواست ردشده
                $imagePath = $rejectedApplication->national_card_image;
                if ($request->hasFile('id_card_image')) {
                    if ($imagePath) {
                        Storage::disk('public')->delete($imagePath);
                    }
                    $imagePath = $request->file('id_card_image')->store('seller_documents/national_cards', 'public');
                }

                $rejectedApplication->update([
                    'is_over_18'           => $request->is_adult === 'yes',
                    'first_name'           => $request->first_name,
                    'last_name'            => $request->last_name,
                    'national_code'        => $request->national_code,
                    'phone'                => $request->phone,
                    'birth_date'           => $request->birth_date,
                    'bank_card_number'     => $request->card_number,
                    'national_card_image'  => $imagePath,
                    'sub_subcategory_id'   => $request->sub_subcategory_id,
                    'custom_fields_data'   => $request->attributes ?? [],
                    'status'               => 'pending',
                    'rejection_reason'     => null,
                    'admin_message'        => null,
                    'admin_id'             => null,
                    'reviewed_at'          => null,
                ]);

                $identity = $rejectedApplication;
            } else {
                // 🆕 ایجاد درخواست جدید
                $imagePath = null;
                if ($request->hasFile('id_card_image')) {
                    $imagePath = $request->file('id_card_image')->store('seller_documents/national_cards', 'public');
                }

                $identity = SellerApplication::create([
                    'user_id'              => auth()->id(),
                    'is_over_18'           => $request->is_adult === 'yes',
                    'first_name'           => $request->first_name,
                    'last_name'            => $request->last_name,
                    'national_code'        => $request->national_code,
                    'phone'                => $request->phone,
                    'birth_date'           => $request->birth_date,
                    'bank_card_number'     => $request->card_number,
                    'national_card_image'  => $imagePath,
                    'sub_subcategory_id'   => $request->sub_subcategory_id,
                    'custom_fields_data'   => $request->attributes ?? [],
                    'status'               => 'pending',
                ]);
            }

            // به‌روزرسانی seller_request_status در جدول users
            auth()->user()->update(['seller_request_status' => 'pending']);

            // ========== ۶. ذخیره محصول (آگهی) ==========
            $subSub = SubSubcategory::with('subcategory.category')->findOrFail($request->sub_subcategory_id);

            $coverPath = $request->file('cover')->store('products', 'public');
            $slug = $this->generateUniqueSlug($request->name);

            $product = Product::create([
                'user_id'            => auth()->id(),
                'category_id'        => $subSub->subcategory->category->id,
                'subcategory_id'     => $subSub->subcategory->id,
                'sub_subcategory_id' => $subSub->id,
                'name'               => $request->name,
                'slug'               => $slug,
                'description'        => $request->description,
                'price'              => $request->price,
                'quantity'           => $request->quantity,
                'cover'              => $coverPath,
                'status'             => 'pending',
                'published_at'       => now(),
            ]);

            // تگ‌ها
            if ($request->filled('tags')) {
                $tagIds = json_decode($request->tags, true) ?? [];
                if (!empty($tagIds)) {
                    $product->tags()->sync($tagIds);
                }
            }

            // ویژگی‌های اختصاصی
            $attributes = $request->input('attributes', []);
            foreach ($attributes as $key => $value) {
                if (!empty($value)) {
                    $product->attributes()->create([
                        'key'   => $key,
                        'value' => is_array($value) ? json_encode($value) : (string)$value,
                    ]);
                }
            }

            // مدیا
            if ($request->hasFile('media')) {
                foreach ($request->file('media') as $file) {
                    $path = $file->store('products_media', 'public');
                    $product->media()->create([
                        'file_path' => $path,
                        'file_type' => $file->getClientMimeType(),
                        'file_name' => $file->getClientOriginalName(),
                        'file_size' => $file->getSize(),
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('user.ads')
                ->with('success', 'آگهی شما با موفقیت ثبت شد و در انتظار تأیید ادمین است.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'خطا در ذخیره اطلاعات: ' . $e->getMessage());
        }
    }

    /**
     * تولید slug یکتا برای محصول
     */
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
}