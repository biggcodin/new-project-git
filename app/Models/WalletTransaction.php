<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WalletTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'amount',
        'balance_before',
        'balance_after',
        'type',
        'status',
        'description',
        'reference_id',
        'reference_type',
        'meta',
    ];

    protected $casts = [
        'amount' => 'decimal:0',
        'balance_before' => 'decimal:0',
        'balance_after' => 'decimal:0',
        'meta' => 'array',
    ];

    // ============== روابط ==============
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // رابطه پلی‌مورفیک با هر مدل مرجع (مثل Order)
    public function reference()
    {
        return $this->morphTo();
    }

    // ============== اسکوپ‌ها ==============
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeDeposits($query)
    {
        return $query->where('type', 'deposit')->where('amount', '>', 0);
    }

    public function scopeWithdraws($query)
    {
        return $query->where('type', 'withdraw')->where('amount', '<', 0);
    }

    public function scopePurchases($query)
    {
        return $query->where('type', 'purchase')->where('amount', '<', 0);
    }

    // ============== اکسسورها ==============
    public function getAmountFormattedAttribute()
    {
        return number_format(abs($this->amount)) . ' تومان';
    }

    public function getTypeTextAttribute()
    {
        return match ($this->type) {
            'deposit'  => 'شارژ',
            'withdraw' => 'برداشت',
            'purchase' => 'خرید',
            'refund'   => 'بازگشت وجه',
            'bonus'    => 'پاداش',
            default    => $this->type,
        };
    }

    public function getStatusTextAttribute()
    {
        return match ($this->status) {
            'pending'   => 'در انتظار',
            'completed' => 'تکمیل شده',
            'failed'    => 'ناموفق',
            'canceled'  => 'لغو شده',
            default     => $this->status,
        };
    }

    public function getIsCreditAttribute()
    {
        return $this->amount > 0;
    }

    public function getIsDebitAttribute()
    {
        return $this->amount < 0;
    }

    // ============== متدهای کمکی ==============
    /**
     * ثبت یک تراکنش جدید و به‌روزرسانی موجودی کاربر
     */
    public static function createTransaction(
        User $user,
        int $amount,
        string $type,
        string $status = 'pending',
        ?string $description = null,
        $reference = null,
        array $meta = []
    ): self {
        // محاسبه موجودی جدید
        $balanceBefore = $user->balance ?? 0;
        $balanceAfter = $balanceBefore + $amount;

        // ساختن تراکنش
        $transaction = self::create([
            'user_id'        => $user->id,
            'amount'         => $amount,
            'balance_before' => $balanceBefore,
            'balance_after'  => $balanceAfter,
            'type'           => $type,
            'status'         => $status,
            'description'    => $description,
            'meta'           => $meta,
        ]);

        // اگر تراکنش کامل شد، موجودی کاربر را بروز کنیم
        if ($status === 'completed') {
            $user->update(['balance' => $balanceAfter]);
        }

        // اگر reference داده شده، آن را تنظیم کن
        if ($reference) {
            $transaction->reference()->associate($reference);
            $transaction->save();
        }

        return $transaction;
    }

    /**
     * تایید یک تراکنش (تغییر وضعیت به completed و اعمال موجودی)
     */
    public function complete(): self
    {
        if ($this->status === 'pending') {
            $this->status = 'completed';
            $this->save();

            // اعمال تغییر موجودی
            $this->user->update([
                'balance' => $this->balance_after
            ]);
        }

        return $this;
    }

    /**
     * لغو یک تراکنش (فقط اگر pending باشد)
     */
    public function cancel(): self
    {
        if ($this->status === 'pending') {
            $this->status = 'canceled';
            $this->save();
        }

        return $this;
    }

    /**
     * شکست خوردن تراکنش
     */
    public function fail(): self
    {
        if ($this->status === 'pending') {
            $this->status = 'failed';
            $this->save();
        }

        return $this;
    }
}