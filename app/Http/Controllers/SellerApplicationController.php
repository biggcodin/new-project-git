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
     * پاک‌سازی قیمت و تبدیل به عدد صحیح
     */
    private function cleanPrice($price): int
    {
        // حذف کاما و کاراکترهای غیرعددی (به جز نقطه)
        $clean = preg_replace('/[^0-9.]/', '', (string) $price);
        return (int) round((float) $clean);
    }

    public function createProduct()
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'لطفاً ابتدا وارد شوید.');
        }

        $user = auth()->user();

        $showIdentityStep = true;

        if ($user->isSeller() || $user->hasApprovedIdentity()) {
            $showIdentityStep = false;
        }

        if ($user->hasPendingOrApprovedIdentity()) {
            $showIdentityStep = false;
        }

        if ($user->sellerApplications()->where('status', 'rejected')->exists()) {
            return redirect()->route('user.identity.edit')
                ->with('info', 'درخواست هویت شما رد شده است. لطفاً اطلاعات خود را ویرایش کنید.');
        }

        $identityData = null;
        if (!$showIdentityStep) {
            $identityData = SellerApplication::where('user_id', $user->id)
                ->whereIn('status', ['pending', 'approved'])
                ->latest()
                ->first();
        }

        $gameTypes = SubSubcategory::whereHas('subcategory', function ($q) {
            $q->where('name', 'اکانت')->whereHas('category', function ($qq) {
                $qq->where('name', 'بازی');
            });
        })->get();

        $tags = Tag::orderBy('name')->get();

        return view('seller.product.create', compact(
            'gameTypes',
            'tags',
            'showIdentityStep',
            'identityData'
        ));
    }

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

    public function store(Request $request)
    {
        $user = auth()->user();

        $identityNotApproved = $request->boolean('identity_not_approved', !$user->hasApprovedIdentity());
        if ($user->isSeller()) {
            $identityNotApproved = false;
        }

        $rules = [
            'sub_subcategory_id' => 'required|exists:sub_subcategories,id',
            'name'               => 'required|string|max:255',
            'price'              => 'required|numeric|min:0',
            'description'        => 'nullable|string',
            'cover'              => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'media.*'            => 'nullable|file|mimes:jpeg,png,jpg,webp,mp4,mov,avi,mkv|max:20480',
            'tags'               => 'nullable|string',
            'attributes'         => 'nullable|array',
        ];

        if ($identityNotApproved) {
            $rules['is_adult'] = 'required|in:yes,no';
            $rules['first_name'] = 'required|string|max:100';
            $rules['last_name'] = 'required|string|max:100';
            $rules['national_code'] = [
                'required',
                'string',
                'size:10',
                Rule::unique('seller_applications', 'national_code')->where(function ($query) {
                    return $query->whereIn('status', ['pending', 'approved']);
                }),
            ];
            $rules['phone'] = 'required|string|max:20';
            $rules['card_number'] = 'required|string|max:20';
            $rules['id_card_image'] = 'nullable|image|mimes:jpeg,png,jpg|max:2048';
        }

        $validated = $request->validate($rules);

        // ========== بررسی فیلد یکتا (is_unique) ==========
        $uniqueKey = CustomField::getUniqueFieldKeyForSubSubcategory($request->sub_subcategory_id);
        if ($uniqueKey) {
            $uniqueValue = $request->input('attributes.' . $uniqueKey);
            if ($uniqueValue) {
                $exists = Product::where('sub_subcategory_id', $request->sub_subcategory_id)
                    ->whereHas('attributes', function ($q) use ($uniqueKey, $uniqueValue) {
                        $q->where('key', $uniqueKey)->where('value', (string)$uniqueValue);
                    })
                    ->whereIn('status', ['pending', 'approved'])
                    ->exists();

                if ($exists) {
                    return back()->withInput()->with('error', 'یک اکانت با این مشخصات (فیلد ' . $uniqueKey . ') قبلاً برای این نوع بازی ثبت شده است.');
                }
            }
        }

        DB::beginTransaction();

        try {
            if ($identityNotApproved) {
                $rejectedApplication = SellerApplication::where('user_id', $user->id)
                    ->where('sub_subcategory_id', $request->sub_subcategory_id)
                    ->where('status', 'rejected')
                    ->latest()
                    ->first();

                if ($rejectedApplication) {
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
                } else {
                    $imagePath = null;
                    if ($request->hasFile('id_card_image')) {
                        $imagePath = $request->file('id_card_image')->store('seller_documents/national_cards', 'public');
                    }

                    SellerApplication::create([
                        'user_id'              => $user->id,
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

                $user->update(['seller_request_status' => 'pending']);
            }

            // ========== ذخیره محصول ==========
            $subSub = SubSubcategory::with('subcategory.category')->findOrFail($request->sub_subcategory_id);
            $coverPath = $request->file('cover')->store('products', 'public');
            $slug = $this->generateUniqueSlug($request->name);

            $product = Product::create([
                'user_id'            => $user->id,
                'category_id'        => $subSub->subcategory->category->id,
                'subcategory_id'     => $subSub->subcategory->id,
                'sub_subcategory_id' => $subSub->id,
                'name'               => $request->name,
                'slug'               => $slug,
                'description'        => $request->description,
                'price'              => $this->cleanPrice($request->price),
                'quantity'           => 1,
                'cover'              => $coverPath,
                'status'             => 'pending',
                'published_at'       => now(),
            ]);

            if ($request->filled('tags')) {
                $tagIds = json_decode($request->tags, true) ?? [];
                if (!empty($tagIds)) {
                    $product->tags()->sync($tagIds);
                }
            }

            $attributes = $request->input('attributes', []);
            foreach ($attributes as $key => $value) {
                if (!empty($value)) {
                    $product->attributes()->create([
                        'key'   => $key,
                        'value' => is_array($value) ? json_encode($value) : (string)$value,
                    ]);
                }
            }

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