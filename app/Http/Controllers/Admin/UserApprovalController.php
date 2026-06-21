<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserApprovalController extends Controller
{
    // لیست کاربران در انتظار تایید
    public function pendingIndex()
    {
        $users = User::where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.users.pending', compact('users'));
    }

    // تایید کاربر
    public function approve(User $user)
    {
        $user->update(['status' => 'approved']);
        return back()->with('success', 'کاربر با موفقیت تایید شد.');
    }

    // رد کاربر
    public function reject(User $user)
    {
        $user->update(['status' => 'rejected']);
        return back()->with('success', 'کاربر رد شد.');
    }

    // درخواست فروشندگی
    public function sellerRequestsIndex()
    {
        $users = User::where('seller_request_status', 'pending')->paginate(10);
        return view('admin.seller-requests', compact('users'));
    }

    public function approveSeller(User $user)
{
    $user->approveSellerRequest();
    
    // ذخیره پیام در session برای نمایش در پنل کاربر
    session()->flash('seller_request_message', '✅ درخواست فروشندگی شما با موفقیت تأیید شد. نقش شما به فروشنده تغییر یافت.');
    session()->flash('seller_request_status', 'approved');
    
    return back()->with('success', 'درخواست فروشندگی تایید شد.');
}

    public function rejectSeller(User $user)
{
    $user->rejectSellerRequest();
    
    // ذخیره پیام در session برای نمایش در پنل کاربر
    session()->flash('seller_request_message', '❌ درخواست فروشندگی شما رد شد. برای اطلاعات بیشتر با پشتیبانی تماس بگیرید.');
    session()->flash('seller_request_status', 'rejected');
    
    return back()->with('success', 'درخواست فروشندگی رد شد.');
}

    // لیست همه کاربران با فیلتر (مدیریت کاربران)
    public function index(Request $request)
    {
        $query = User::query();

        // فیلتر جستجو
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('username', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // فیلتر وضعیت
        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        // فیلتر نقش
        if ($role = $request->input('role')) {
            $query->where('role', $role);
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);
        $roles = User::getRoleOptions(); // دریافت لیست نقش‌ها از دیتابیس

        return view('admin.users.index', compact('users', 'roles'));
    }

    // فرم ویرایش کاربر
    public function edit(User $user)
    {
        $roles = User::getRoleOptions(); // دریافت نقش‌ها از دیتابیس
        return view('admin.users.edit', compact('user', 'roles'));
    }

    // بروزرسانی کاربر
    public function update(Request $request, User $user)
    {
        $roles = User::getRoleOptions(); // دریافت نقش‌ها برای اعتبارسنجی
        
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email'    => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone'    => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'role'     => ['required', Rule::in($roles)], // اعتبارسنجی پویا
            'status'   => 'required|in:pending,approved,rejected',
        ]);

        $user->update($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'اطلاعات کاربر با موفقیت بروزرسانی شد.');
    }

    // حذف کاربر
    public function destroy(User $user)
    {
        // جلوگیری از حذف ادمین اصلی (اختیاری)
        if ($user->isAdmin() && $user->id === 1) {
            return back()->with('error', 'شما نمی‌توانید ادمین اصلی را حذف کنید.');
        }

        $user->delete(); // soft delete چون تریت SoftDeletes در مدل User فعال است

        return redirect()->route('admin.users.index')
            ->with('success', 'کاربر با موفقیت حذف شد.');
    }
}