<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerApplicationAdminController extends Controller
{
    /**
     * نمایش لیست درخواست‌های فروشندگی
     */
    public function index()
{
    $applications = SellerApplication::with(['user', 'subSubcategory'])
        ->orderBy('created_at', 'desc')
        ->paginate(15);

    return view('admin.seller-applications.index', compact('applications'));
}

    /**
     * نمایش جزئیات یک درخواست
     */
    public function show(SellerApplication $application)
    {
        $application->load(['user', 'subSubcategory', 'admin']);
        return view('admin.seller-applications.show', compact('application'));
    }

    /**
     * تأیید درخواست فروشندگی
     */
    public function approve(Request $request, SellerApplication $application)
    {
        $request->validate([
            'admin_message' => 'nullable|string|max:500',
        ]);

        // به‌روزرسانی وضعیت درخواست
        $application->update([
            'status' => 'approved',
            'admin_message' => $request->admin_message ?? 'درخواست شما تأیید شد.',
            'admin_id' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // تغییر نقش کاربر به فروشنده
        $user = $application->user;
        $user->role = 'seller';
        $user->seller_request_status = 'approved';
        $user->save();

        // ارسال پیام به کاربر (از طریق session)
        session()->flash('seller_request_message', '✅ درخواست فروشندگی شما تأیید شد. نقش شما به فروشنده تغییر یافت.');
        session()->flash('seller_request_status', 'approved');

        return redirect()->route('admin.seller.applications.index')
            ->with('success', 'درخواست فروشندگی با موفقیت تأیید شد.');
    }

    /**
     * رد درخواست فروشندگی
     */
    public function reject(Request $request, SellerApplication $application)
    {
        $request->validate([
            'admin_message' => 'required|string|max:500',
        ]);

        // به‌روزرسانی وضعیت درخواست
        $application->update([
            'status' => 'rejected',
            'admin_message' => $request->admin_message,
            'admin_id' => Auth::id(),
            'reviewed_at' => now(),
        ]);

        // به‌روزرسانی seller_request_status در جدول users
        $user = $application->user;
        $user->seller_request_status = 'rejected';
        $user->save();

        // ارسال پیام به کاربر (از طریق session)
        session()->flash('seller_request_message', '❌ درخواست فروشندگی شما رد شد. دلیل: ' . $request->admin_message);
        session()->flash('seller_request_status', 'rejected');

        return redirect()->route('admin.seller.applications.index')
            ->with('success', 'درخواست فروشندگی با موفقیت رد شد.');
    }

    /**
     * حذف درخواست (اختیاری)
     */
    public function destroy(SellerApplication $application)
    {
        // فقط درخواست‌های pending را می‌توان حذف کرد
        if ($application->status !== 'pending') {
            return back()->with('error', 'فقط درخواست‌های در انتظار بررسی قابل حذف هستند.');
        }

        $application->delete();

        return redirect()->route('admin.seller.applications.index')
            ->with('success', 'درخواست با موفقیت حذف شد.');
    }
}