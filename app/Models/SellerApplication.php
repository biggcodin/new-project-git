<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'is_over_18',
        'first_name',
        'last_name',
        'national_code',
        'phone',
        'birth_date',
        'bank_card_number',
        'national_card_image',
        'sub_subcategory_id',
        'custom_fields_data',
        'status',
        'admin_message',
        'rejection_reason', // ✅ اضافه شد
        'admin_id',
        'reviewed_at',
    ];

    protected $casts = [
        'is_over_18' => 'boolean',
        'birth_date' => 'date',
        'custom_fields_data' => 'array',
        'reviewed_at' => 'datetime',
        'rejection_reason' => 'string', // ✅ اضافه شد
    ];

    // ============== روابط ==============

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subSubcategory()
    {
        return $this->belongsTo(SubSubcategory::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    // ============== متدهای کمکی ==============

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function getStatusText(): string
    {
        return match ($this->status) {
            'pending'  => 'در انتظار بررسی',
            'approved' => 'تایید شده',
            'rejected' => 'رد شده',
            default    => 'نامشخص',
        };
    }

    /**
     * دریافت دلیل رد (اگر وجود داشته باشد)
     */
    public function getRejectionReason(): ?string
    {
        return $this->rejection_reason;
    }

    /**
     * بررسی اینکه آیا درخواست بررسی شده است یا خیر
     */
    public function hasBeenReviewed(): bool
    {
        return !is_null($this->reviewed_at);
    }

    /**
     * بررسی اینکه آیا کاربر می‌تواند این درخواست را ویرایش کند
     * (فقط در صورتی که رد شده باشد)
     */
    public function canBeEdited(): bool
    {
        return $this->isRejected();
    }
}