<?php

namespace App\Http\Controllers;


use App\Http\Requests\WalletChargeRequest;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
class UserController extends Controller
{
    // نمایش صفحه شارژ کیف پول
    public function walletCharge()
{
    return view('user.wallet-charge');
}


    /**
 * نمایش تاریخچه تراکنش‌های کیف پول
 */
public function walletHistory(Request $request)
{
    // کوئری پایه: فقط تراکنش‌های کاربر جاری
    $query = WalletTransaction::where('user_id', auth()->id());

    // فیلتر بر اساس نوع تراکنش
    if ($request->filled('type')) {
        $query->where('type', $request->type);
    }

    // فیلتر بر اساس وضعیت
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // مرتب‌سازی نزولی بر اساس جدیدترین
    $transactions = $query->orderByDesc('id')->paginate(15);

    // موجودی فعلی کاربر
    $balance = auth()->user()->balance ?? 0;

    // لیست انواع و وضعیت‌ها برای فیلتر dropdown
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
    public function charge(WalletChargeRequest $request)
    {
        // حالا نیازی به validate() در اینجا نیست، چون اعتبارسنجی قبلاً انجام شده
        $amount = (int) $request->input('amount');
        $user = auth()->user();

        DB::beginTransaction();

        try {
            // ثبت تراکنش با وضعیت pending
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

            // شبیه‌سازی درگاه پرداخت (در آینده کد واقعی جایگزین می‌شود)
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
        // در آینده اینجا کد واقعی درگاه می‌آید
        $transaction->complete();
    }


/**
 * نمایش خریدهای کاربر
 */
public function purchases(Request $request)
{
    $query = Order::where('user_id', auth()->id());

    // فیلتر بر اساس وضعیت
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // مرتب‌سازی نزولی
    $purchases = $query->orderByDesc('id')->paginate(10);

    // لیست وضعیت‌ها برای فیلتر
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

public function orderDetails(Order $order)
{
    // اطمینان از اینکه سفارش متعلق به کاربر جاری است
    if ($order->user_id !== auth()->id()) {
        abort(403, 'دسترسی غیرمجاز');
    }
    
    $order->load('items.product');
    return view('user.order-details', compact('order'));
}

    // نمایش آگهی‌های من
    public function ads()
    {
        return view('user.ads');
    }

    // نمایش صفحه چت و پیام‌ها
    public function chat()
    {
        return view('user.chat');
    }

    // نمایش فرم ویرایش پروفایل
    public function profileEdit()
    {
        return view('user.profile-edit');
    }

    // به‌روزرسانی پروفایل
    public function profileUpdate(Request $request)
    {
        // بعداً تکمیل می‌شود
        return back()->with('success', 'پروفایل با موفقیت به‌روزرسانی شد.');
    }
}