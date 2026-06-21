<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * اعمال کد تخفیف (شبیه‌سازی)
     */
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'total' => 'required|numeric|min:0',
        ]);

        $code = $request->code;
        $total = $request->total;

        // لیست کدهای تخفیف نمونه (در آینده از دیتابیس خوانده می‌شود)
        $discounts = [
            'DISCOUNT20' => 20, // ۲۰ درصد
            'SAVE50' => 50,     // ۵۰ درصد
            'FIXED100' => 100000, // ۱۰۰ هزار تومان تخفیف ثابت
        ];

        if (isset($discounts[$code])) {
            $discountValue = $discounts[$code];

            // اگر درصدی باشد
            if (strpos($code, 'DISCOUNT') !== false || strpos($code, 'SAVE') !== false) {
                $discountAmount = ($total * $discountValue) / 100;
            } else {
                // تخفیف ثابت
                $discountAmount = min($discountValue, $total);
            }

            return response()->json([
                'success' => true,
                'message' => "کد تخفیف با موفقیت اعمال شد. ({$discountValue}% تخفیف)",
                'discount_amount' => (int) $discountAmount,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'کد تخفیف نامعتبر است.',
                'discount_amount' => 0,
            ], 422);
        }
    }
}