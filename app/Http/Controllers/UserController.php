<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletChargeRequest;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\SubSubcategory;
use App\Models\WalletTransaction;
use App\Models\Order;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * نمایش صفحه شارژ کیف پول
     */
    public function walletCharge()
    {
        return view('user.wallet-charge');
    }

    /**
     * نمایش تاریخچه تراکنش‌های کیف پول
     */
    public function walletHistory(Request $request)
    {
        $query = WalletTransaction::where('user_id', auth()->id());

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $transactions = $query->orderByDesc('id')->paginate(15);
        $balance = auth()->user()->balance ?? 0;

        $types = [
            'deposit'  => 'شارژ',
            'withdraw' => 'برداشت',
            'purchase' => 'خرید',
            'refund'   => 'بازگشت وجه',
            'bonus'    => 'پاداش',
        ];

        $statuses = [
            'pending'   => 'در انتظار',
            'completed' => 'تکمیل شده',
            'failed'    => 'ناموفق',
            'canceled'  => 'لغو شده',
        ];

        return view('user.wallet-history', compact('transactions', 'balance', 'types', 'statuses'));
    }

    /**
     * شارژ کیف پول
     */
    public function charge(WalletChargeRequest $request)
    {
        $amount = (int) $request->input('amount');
        $user = auth()->user();

        DB::beginTransaction();

        try {
            $transaction = WalletTransaction::createTransaction(
                user: $user,
                amount: $amount,
                type: 'deposit',
                status: 'pending',
                description: 'شارژ کیف پول از طریق درگاه بانکی',
                meta: [
                    'ip'          => $request->ip(),
                    'user_agent'  => $request->userAgent(),
                ]
            );

            DB::commit();

            $this->mockPaymentGateway($transaction);

            return redirect()
                ->route('wallet.charge')
                ->with('success', "کیف پول شما با موفقیت به مبلغ " . number_format($amount) . " تومان شارژ شد.");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()
                ->withInput()
                ->with('error', 'خطا در انجام تراکنش: ' . $e->getMessage());
        }
    }

    /**
     * شبیه‌سازی درگاه پرداخت (موقت)
     */
    private function mockPaymentGateway(WalletTransaction $transaction): void
    {
        $transaction->complete();
    }

    /**
     * نمایش خریدهای کاربر
     */
    public function purchases(Request $request)
    {
        $query = Order::where('user_id', auth()->id());

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $purchases = $query->orderByDesc('id')->paginate(10);

        $statuses = [
            'pending'    => 'در انتظار پرداخت',
            'paid'       => 'پرداخت شده',
            'processing' => 'در حال پردازش',
            'completed'  => 'تکمیل شده',
            'canceled'   => 'لغو شده',
            'failed'     => 'ناموفق',
        ];

        return view('user.purchases', compact('purchases', 'statuses'));
    }

    /**
     * نمایش جزئیات یک سفارش
     */
    public function orderDetails(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(403, 'دسترسی غیرمجاز');
        }

        $order->load('items.product');
        return view('user.order-details', compact('order'));
    }

    // ======================== بخش آگهی‌های من ========================

    /**
     * نمایش لیست محصولات (آگهی‌های) کاربر
     */
    public function ads()
    {
        $products = Product::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('user.ads', compact('products'));
    }

    /**
     * نمایش فرم ویرایش آگهی ردشده
     */
    public function editProductApplication(Product $product)
    {
        // بررسی مالکیت
        if ($product->user_id !== auth()->id()) {
            abort(403, 'دسترسی غیرمجاز');
        }

        // فقط آگهی‌های ردشده قابل ویرایش هستند
        if ($product->status !== 'rejected') {
            return redirect()->route('user.ads')
                ->with('error', 'فقط آگهی‌های ردشده قابل ویرایش هستند.');
        }

        // دریافت نوع بازی‌ها برای نمایش در فرم
        $gameTypes = SubSubcategory::whereHas('subcategory', function ($q) {
            $q->where('name', 'اکانت')->whereHas('category', function ($qq) {
                $qq->where('name', 'بازی');
            });
        })->get();

        $tags = Tag::orderBy('name')->get();

        return view('user.edit-ad', compact('product', 'gameTypes', 'tags'));
    }

    /**
     * بروزرسانی آگهی ردشده و ارسال مجدد
     */
    public function updateProductApplication(Request $request, Product $product)
    {
        // بررسی مالکیت
        if ($product->user_id !== auth()->id()) {
            abort(403, 'دسترسی غیرمجاز');
        }

        // فقط آگهی‌های ردشده قابل ویرایش هستند
        if ($product->status !== 'rejected') {
            return redirect()->route('user.ads')
                ->with('error', 'فقط آگهی‌های ردشده قابل ویرایش هستند.');
        }

        // ====== تبدیل tags از JSON به آرایه (قبل از اعتبارسنجی) ======
        if ($request->has('tags')) {
            $tags = json_decode($request->tags, true);
            $request->merge(['tags' => is_array($tags) ? $tags : []]);
        }

        // ====== اعتبارسنجی ======
        $validated = $request->validate([
            'sub_subcategory_id' => 'required|exists:sub_subcategories,id',
            'name'               => 'required|string|max:255',
            'price'              => 'required|numeric|min:0',
            'quantity'           => 'required|integer|min:0',
            'description'        => 'nullable|string',
            'cover'              => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'media.*'            => 'nullable|file|mimes:jpeg,png,jpg,webp,mp4,mov,avi,mkv|max:20480',
            'tags'               => 'nullable|array',
            'tags.*'             => 'integer|exists:tags,id',
            'attributes'         => 'nullable|array',
            'remove_cover'       => 'nullable|boolean',
        ]);

        // دریافت زیرزیردسته جدید برای به‌روزرسانی دسته‌بندی
        $subSub = SubSubcategory::with('subcategory.category')->findOrFail($request->sub_subcategory_id);

        DB::beginTransaction();

        try {
            // به‌روزرسانی فیلدهای اصلی و دسته‌بندی
            $product->sub_subcategory_id = $request->sub_subcategory_id;
            $product->category_id = $subSub->subcategory->category->id;
            $product->subcategory_id = $subSub->subcategory->id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->description = $request->description;

            // حذف کاور در صورت درخواست
            if ($request->boolean('remove_cover')) {
                if ($product->cover) {
                    Storage::disk('public')->delete($product->cover);
                    $product->cover = null;
                }
            }

            // آپلود کاور جدید (در صورت وجود)
            if ($request->hasFile('cover')) {
                if ($product->cover) {
                    Storage::disk('public')->delete($product->cover);
                }
                $coverPath = $request->file('cover')->store('products', 'public');
                $product->cover = $coverPath;
            }

            $product->save(); // ذخیره اولیه برای دسته‌بندی و کاور

            // آپلود مدیاهای جدید (فقط اضافه می‌شوند، حذف جداگانه انجام می‌شود)
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

            // بروزرسانی تگ‌ها
            if ($request->has('tags')) {
                $product->tags()->sync($request->tags);
            }

            // بروزرسانی ویژگی‌های اختصاصی (attributes)
            $product->attributes()->delete();
            $attributes = $request->input('attributes', []);
            foreach ($attributes as $key => $value) {
                if (!empty($value)) {
                    $product->attributes()->create([
                        'key'   => $key,
                        'value' => is_array($value) ? json_encode($value) : (string)$value,
                    ]);
                }
            }

            // تغییر وضعیت به pending و پاک کردن دلیل رد
            $product->status = 'pending';
            $product->rejection_reason = null;

            // ====== اصلاح بخش meta ======
            $meta = $this->safeMeta($product->meta);
            unset($meta['admin_message']);
            $product->meta = $meta;

            $product->save();

            DB::commit();

            return redirect()->route('user.ads')
                ->with('success', 'آگهی شما با موفقیت ویرایش و دوباره برای بررسی ارسال شد.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'خطا در ویرایش آگهی: ' . $e->getMessage());
        }
    }

    /**
     * حذف یک فایل رسانه (برای کاربر عادی)
     */
    public function destroyMedia($id)
    {
        $media = ProductMedia::findOrFail($id);

        // بررسی مالکیت محصول
        if ($media->product->user_id !== auth()->id()) {
            return response()->json(['success' => false, 'message' => 'دسترسی غیرمجاز'], 403);
        }

        Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return response()->json(['success' => true]);
    }

    // ======================== سایر متدها ========================

    /**
     * نمایش صفحه چت و پیام‌ها
     */
    public function chat()
    {
        return view('user.chat');
    }

    /**
     * نمایش فرم ویرایش پروفایل
     */
    public function profileEdit()
    {
        return view('user.profile-edit');
    }

    /**
     * به‌روزرسانی پروفایل
     */
    public function profileUpdate(Request $request)
    {
        return back()->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
    }

    /**
     * تبدیل ایمن meta به آرایه
     *
     * @param mixed $meta
     * @return array
     */
    private function safeMeta($meta): array
    {
        if (is_array($meta)) {
            return $meta;
        }
        if (is_string($meta)) {
            $decoded = json_decode($meta, true);
            return is_array($decoded) ? $decoded : [];
        }
        return [];
    }
}