<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerApplication;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SellerApplicationAdminController extends Controller
{
    /**
     * نمایش لیست یکپارچه کاربران + وضعیت هویتی + محصولات
     * با قابلیت جستجو، فیلتر و مرتب‌سازی بر اساس آخرین درخواست
     */
    public function index()
{
    $applications = SellerApplication::with(['user', 'subSubcategory'])
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    return view('admin.seller-applications.index', compact('applications'));
}

    /**
     * نمایش جزئیات یک درخواست هویت (مودال یا صفحه)
     */
    public function showIdentity(SellerApplication $application)
    {
        $application->load(['user', 'subSubcategory', 'admin']);
        return view('admin.seller-applications.modals.identity-details', compact('application'));
    }

    /**
     * نمایش جزئیات یک محصول (مودال یا صفحه)
     */
    public function showProduct(Product $product)
    {
        $product->load(['user', 'category', 'subcategory', 'subSubcategory', 'attributes', 'media', 'tags']);
        return view('admin.seller-applications.modals.product-details', compact('product'));
    }

    // ================================================================
    // 📌 مدیریت تأیید/رد هویت
    // ================================================================

    /**
     * تأیید درخواست هویت
     */
    public function approveIdentity(Request $request, SellerApplication $application)
    {
        $request->validate([
            'admin_message' => 'nullable|string|max:500',
        ]);

        // فقط درخواست‌های pending قابل تأیید هستند
        if (!$application->isPending()) {
            return back()->with('error', 'این درخواست قبلاً بررسی شده است.');
        }

        DB::beginTransaction();
        try {
            // به‌روزرسانی درخواست
            $application->update([
                'status'        => 'approved',
                'admin_message' => $request->admin_message ?? 'هویت شما تأیید شد.',
                'admin_id'      => Auth::id(),
                'reviewed_at'   => now(),
                'rejection_reason' => null,
            ]);

            // تغییر نقش کاربر به فروشنده
            $user = $application->user;
            $user->role = 'seller';
            $user->seller_request_status = 'approved';
            $user->identity_approved_at = now();
            $user->save();

            DB::commit();

            return redirect()->route('admin.seller.applications.index')
                ->with('success', 'هویت کاربر با موفقیت تأیید شد. کاربر اکنون فروشنده است.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'خطا در تأیید هویت: ' . $e->getMessage());
        }
    }

    /**
     * رد درخواست هویت با ذخیره دلیل
     */
    public function rejectIdentity(Request $request, SellerApplication $application)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
            'admin_message'    => 'nullable|string|max:500',
        ]);

        if (!$application->isPending()) {
            return back()->with('error', 'این درخواست قبلاً بررسی شده است.');
        }

        DB::beginTransaction();
        try {
            $application->update([
                'status'           => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'admin_message'    => $request->admin_message ?? 'اطلاعات هویتی شما رد شد.',
                'admin_id'         => Auth::id(),
                'reviewed_at'      => now(),
            ]);

            // به‌روزرسانی seller_request_status در user
            $user = $application->user;
            $user->seller_request_status = 'rejected';
            $user->save();

            DB::commit();

            return redirect()->route('admin.seller.applications.index')
                ->with('success', 'درخواست هویت با موفقیت رد شد. دلیل برای کاربر ارسال شد.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'خطا در رد هویت: ' . $e->getMessage());
        }
    }

    // ================================================================
    // 📌 مدیریت تأیید/رد محصولات (آگهی‌ها)
    // ================================================================

    /**
     * تأیید محصول (آگهی) – فقط در صورتی که هویت کاربر تأیید شده باشد
     */
    public function approveProduct(Request $request, Product $product)
    {
        $request->validate([
            'admin_message' => 'nullable|string|max:500',
        ]);

        // فقط محصولات pending قابل تأیید هستند
        if ($product->status !== 'pending') {
            return back()->with('error', 'این محصول قبلاً بررسی شده است.');
        }

        // بررسی وضعیت هویت کاربر
        $user = $product->user;
        $latestIdentity = $user->sellerApplications()->latest()->first();

        // اگر هویت کاربر رد شده باشد یا اصلاً درخواست هویتی نداشته باشد، اجازه تأیید محصول داده نشود
        if (!$latestIdentity || $latestIdentity->status === 'rejected') {
            return back()->with('error', 'امکان تأیید آگهی وجود ندارد زیرا هویت کاربر تأیید نشده است.');
        }

        DB::beginTransaction();
        try {
            $product->update([
                'status'           => 'approved',
                'published_at'     => now(),
                'rejection_reason' => null,
            ]);

            // در صورت نیاز، پیام ادمین را در متا ذخیره کن
            if ($request->filled('admin_message')) {
                $meta = $this->safeMeta($product->meta);
                $meta['admin_message'] = $request->admin_message;
                $product->update(['meta' => $meta]);
            }

            DB::commit();

            return redirect()->route('admin.seller.applications.index')
                ->with('success', 'آگهی با موفقیت تأیید شد و منتشر گردید.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'خطا در تأیید آگهی: ' . $e->getMessage());
        }
    }

    /**
     * رد محصول (آگهی) با ذخیره دلیل
     */
    public function rejectProduct(Request $request, Product $product)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500',
            'admin_message'    => 'nullable|string|max:500',
        ]);

        if ($product->status !== 'pending') {
            return back()->with('error', 'این محصول قبلاً بررسی شده است.');
        }

        DB::beginTransaction();
        try {
            $product->update([
                'status'           => 'rejected',
                'rejection_reason' => $request->rejection_reason,
                'published_at'     => null,
            ]);

            // ذخیره پیام ادمین در متا
            $meta = $this->safeMeta($product->meta);
            $meta['admin_message'] = $request->admin_message ?? 'آگهی شما رد شد.';
            $product->update(['meta' => $meta]);

            DB::commit();

            return redirect()->route('admin.seller.applications.index')
                ->with('success', 'آگهی با موفقیت رد شد. دلیل برای کاربر ارسال شد.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'خطا در رد آگهی: ' . $e->getMessage());
        }
    }

    /**
     * حذف درخواست هویت (فقط در حالت pending)
     */
    public function destroyIdentity(SellerApplication $application)
    {
        if (!$application->isPending()) {
            return back()->with('error', 'فقط درخواست‌های در انتظار بررسی قابل حذف هستند.');
        }

        $application->delete();

        return redirect()->route('admin.seller.applications.index')
            ->with('success', 'درخواست هویت با موفقیت حذف شد.');
    }

    /**
     * حذف محصول (آگهی) - فقط در حالت pending یا rejected
     */
    public function destroyProduct(Product $product)
    {
        if (!in_array($product->status, ['pending', 'rejected'])) {
            return back()->with('error', 'فقط آگهی‌های در انتظار یا رد شده قابل حذف هستند.');
        }

        // حذف فایل‌های مرتبط (اختیاری)
        // ...

        $product->delete();

        return redirect()->route('admin.seller.applications.index')
            ->with('success', 'آگهی با موفقیت حذف شد.');
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