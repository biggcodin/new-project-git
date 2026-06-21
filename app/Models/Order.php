<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'paid_amount',
        'status',
        'payment_method',
        'wallet_transaction_id',
        'notes',
        'shipping_address',
        'shipping_phone',
        'meta',
    ];

    protected $casts = [
        'total_amount' => 'decimal:0',
        'paid_amount' => 'decimal:0',
        'meta' => 'array',
    ];

    // ============== روابط ==============
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function walletTransaction()
    {
        return $this->belongsTo(WalletTransaction::class);
    }

    // ============== اکسسورها ==============
    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'pending'    => 'در انتظار پرداخت',
            'paid'       => 'پرداخت شده',
            'processing' => 'در حال پردازش',
            'completed'  => 'تکمیل شده',
            'canceled'   => 'لغو شده',
            'failed'     => 'ناموفق',
            default      => $this->status,
        };
    }

    public function getStatusBadgeAttribute()
    {
        return match ($this->status) {
            'pending'    => 'badge-pending',
            'paid'       => 'badge-completed',
            'processing' => 'badge-pending',
            'completed'  => 'badge-completed',
            'canceled'   => 'badge-canceled',
            'failed'     => 'badge-failed',
            default      => '',
        };
    }

    public function getTotalFormattedAttribute()
    {
        return number_format($this->total_amount) . ' تومان';
    }

    // ============== متدهای کمکی ==============
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isPaid()
    {
        return $this->status === 'paid' || $this->status === 'processing' || $this->status === 'completed';
    }

    /**
     * تولید شماره سفارش یکتا
     */
    public static function generateOrderNumber(): string
    {
        $prefix = 'ORD';
        $date = now()->format('ymd');
        $random = str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        
        $number = $prefix . $date . $random;
        
        // اطمینان از یکتایی
        while (self::where('order_number', $number)->exists()) {
            $random = str_pad(random_int(1, 99999), 5, '0', STR_PAD_LEFT);
            $number = $prefix . $date . $random;
        }
        
        return $number;
    }

    /**
     * ایجاد سفارش جدید از سبد خرید (برای آینده)
     */
    public static function createFromCart(User $user, array $items, array $data = []): self
    {
        $total = 0;
        $orderItems = [];

        foreach ($items as $item) {
            $subtotal = $item['unit_price'] * $item['quantity'] - ($item['discount'] ?? 0);
            $total += $subtotal;
            
            $orderItems[] = [
                'product_id'   => $item['product_id'] ?? null,
                'product_name' => $item['product_name'],
                'unit_price'   => $item['unit_price'],
                'quantity'     => $item['quantity'],
                'discount'     => $item['discount'] ?? 0,
                'subtotal'     => $subtotal,
                'options'      => $item['options'] ?? null,
            ];
        }

        $order = self::create([
            'user_id'        => $user->id,
            'order_number'   => self::generateOrderNumber(),
            'total_amount'   => $total,
            'paid_amount'    => 0,
            'status'         => 'pending',
            'payment_method' => $data['payment_method'] ?? null,
            'notes'          => $data['notes'] ?? null,
            'shipping_address' => $data['shipping_address'] ?? null,
            'shipping_phone' => $data['shipping_phone'] ?? null,
            'meta'           => $data['meta'] ?? [],
        ]);

        // ذخیره آیتم‌ها
        foreach ($orderItems as $item) {
            $order->items()->create($item);
        }

        return $order;
    }

    /**
     * پرداخت با کیف پول
     */
    public function payWithWallet(): bool
    {
        if ($this->status !== 'pending') {
            return false;
        }

        $user = $this->user;
        
        if ($user->balance < $this->total_amount) {
            return false;
        }

        // ثبت تراکنش برداشت از کیف پول
        $transaction = WalletTransaction::createTransaction(
            user: $user,
            amount: -$this->total_amount, // منفی = برداشت
            type: 'purchase',
            status: 'completed',
            description: "پرداخت سفارش #{$this->order_number}",
            reference: $this,
            meta: ['order_id' => $this->id]
        );

        // به‌روزرسانی سفارش
        $this->update([
            'paid_amount' => $this->total_amount,
            'status' => 'paid',
            'payment_method' => 'wallet',
            'wallet_transaction_id' => $transaction->id,
        ]);

        return true;
    }
}