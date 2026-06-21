<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\WalletTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * نمایش صفحه تسویه حساب (اختیاری)
     */
    public function index()
    {
        $cartItems = Cart::where('user_id', auth()->id())->get();
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        return view('user.checkout', compact('cartItems', 'total'));
    }

    /**
     * پرداخت از کیف پول
     */
    public function payWithWallet()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'سبد خرید شما خالی است.');
        }

        // محاسبه جمع کل
        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        // بررسی موجودی کیف پول
        if ($user->balance < $total) {
            return back()->with('error', 'موجودی کیف پول شما کافی نیست. لطفاً ابتدا کیف پول خود را شارژ کنید.');
        }

        DB::beginTransaction();

        try {
            // 1. ایجاد سفارش
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $total,
                'paid_amount' => $total,
                'status' => 'pending', // ابتدا pending
                'payment_method' => 'wallet',
                'notes' => 'پرداخت از طریق کیف پول',
            ]);

            // 2. ایجاد آیتم‌های سفارش از سبد خرید
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name ?? 'محصول حذف شده',
                    'unit_price' => $item->price,
                    'quantity' => $item->quantity,
                    'discount' => 0,
                    'subtotal' => $item->price * $item->quantity,
                ]);
            }

            // 3. ثبت تراکنش برداشت از کیف پول
            $transaction = WalletTransaction::createTransaction(
                user: $user,
                amount: -$total,
                type: 'purchase',
                status: 'completed',
                description: "پرداخت سفارش #{$order->order_number}",
                reference: $order,
                meta: ['order_id' => $order->id]
            );

            // 4. به‌روزرسانی سفارش با شناسه تراکنش و تغییر وضعیت
            $order->update([
                'wallet_transaction_id' => $transaction->id,
                'status' => 'paid',
            ]);

            // 5. خالی کردن سبد خرید
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('user.purchases')
                ->with('success', "پرداخت با موفقیت انجام شد. شماره سفارش: {$order->order_number}");

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'خطا در پرداخت: ' . $e->getMessage());
        }
    }

    /**
     * پرداخت از درگاه (شبیه‌سازی)
     */
    public function payWithGateway()
    {
        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->get();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'سبد خرید شما خالی است.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        DB::beginTransaction();

        try {
            // 1. ایجاد سفارش با وضعیت pending
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => Order::generateOrderNumber(),
                'total_amount' => $total,
                'paid_amount' => 0,
                'status' => 'pending',
                'payment_method' => 'gateway',
                'notes' => 'پرداخت از طریق درگاه',
            ]);

            // 2. ایجاد آیتم‌های سفارش
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name ?? 'محصول حذف شده',
                    'unit_price' => $item->price,
                    'quantity' => $item->quantity,
                    'discount' => 0,
                    'subtotal' => $item->price * $item->quantity,
                ]);
            }

            DB::commit();

            // شبیه‌سازی هدایت به درگاه
            // در واقعیت، کاربر به درگاه بانکی هدایت می‌شود و بعد از پرداخت به callback برمی‌گردد
            // فعلاً یک شبیه‌سازی ساده انجام می‌دهیم

            // ذخیره شناسه سفارش در جلسه برای استفاده در callback
            session(['pending_order_id' => $order->id]);

            // هدایت به صفحه شبیه‌سازی درگاه
            return redirect()->route('gateway.simulate', ['order' => $order->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'خطا در ایجاد سفارش: ' . $e->getMessage());
        }
    }

    /**
     * شبیه‌سازی بازگشت از درگاه (callback)
     */
    public function gatewayCallback(Request $request)
    {
        $orderId = $request->query('order_id');
        $status = $request->query('status', 'success');

        $order = Order::with('items')->findOrFail($orderId);

        // بررسی اینکه سفارش متعلق به کاربر جاری باشد
        if ($order->user_id !== auth()->id()) {
            abort(403, 'دسترسی غیرمجاز');
        }

        if ($status === 'success') {
            // پرداخت موفق
            DB::beginTransaction();

            try {
                // به‌روزرسانی وضعیت سفارش
                $order->update([
                    'paid_amount' => $order->total_amount,
                    'status' => 'paid',
                ]);

                // خالی کردن سبد خرید کاربر
                Cart::where('user_id', auth()->id())->delete();

                DB::commit();

                return redirect()->route('user.purchases')
                    ->with('success', "پرداخت با موفقیت انجام شد. شماره سفارش: {$order->order_number}");

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('cart.index')
                    ->with('error', 'خطا در تکمیل پرداخت: ' . $e->getMessage());
            }
        } else {
            // پرداخت ناموفق
            $order->update(['status' => 'failed']);
            return redirect()->route('cart.index')
                ->with('error', 'پرداخت ناموفق بود. لطفاً مجدداً تلاش کنید.');
        }
    }

    /**
     * صفحه شبیه‌سازی درگاه (برای تست)
     */
    public function simulateGateway($orderId)
    {
        $order = Order::findOrFail($orderId);

        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.gateway-simulate', compact('order'));
    }
}