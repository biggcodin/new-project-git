<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Support\Facades\DB;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait, SoftDeletes, Authorizable;

    protected $fillable = [
        'name',
        'username',
        'role',
        'email',
        'phone',
        'password',
        'email_verified_at',
        'remember_token',
        'balance',
        'status',
        'seller_request_status',
        'identity_approved_at',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'role' => 'string',
        'status' => 'string',
        'seller_request_status' => 'string',
        'balance' => 'decimal:0',
        'identity_approved_at' => 'datetime',
    ];

    // ============== متد جدید برای دریافت نقش‌ها از دیتابیس ==============
    public static function getRoleOptions(): array
    {
        try {
            $type = DB::select("SHOW COLUMNS FROM users WHERE Field = 'role'")[0]->Type ?? '';
            preg_match('/^enum\((.*)\)$/', $type, $matches);
            if (empty($matches)) {
                return ['super_admin', 'admin', 'seller', 'buyer', 'user'];
            }
            $values = str_getcsv($matches[1], ',', "'");
            return array_map(fn($v) => trim($v, "'"), $values);
        } catch (\Exception $e) {
            return ['super_admin', 'admin', 'seller', 'buyer', 'user'];
        }
    }

    // ============== متدهای بررسی نقش ==============

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin' || $this->isSuperAdmin();
    }

    public function isSeller(): bool
    {
        return $this->role === 'seller';
    }

    public function isBuyer(): bool
    {
        return $this->role === 'buyer';
    }

    public function isUser(): bool
    {
        return $this->role === 'user';
    }

    // ============== درخواست فروشندگی ==============

    public function hasSellerRequest(): bool
    {
        return $this->seller_request_status === 'pending';
    }

    public function requestSeller()
    {
        $this->seller_request_status = 'pending';
        $this->save();
    }

    public function approveSellerRequest()
    {
        $this->role = 'seller';
        $this->seller_request_status = 'approved';
        $this->identity_approved_at = now();
        $this->save();
    }

    public function rejectSellerRequest()
    {
        $this->seller_request_status = 'rejected';
        $this->save();
    }

    /**
     * دریافت متن وضعیت درخواست فروشندگی
     */
    public function getSellerRequestStatusText(): string
    {
        return match ($this->seller_request_status) {
            'pending'  => 'در انتظار بررسی',
            'approved' => 'تایید شده',
            'rejected' => 'رد شده',
            default    => 'ثبت نشده',
        };
    }

    /**
     * بررسی اینکه کاربر می‌تواند درخواست فروشندگی بدهد یا خیر
     */
    public function canRequestSeller(): bool
    {
        if ($this->isSeller() || $this->hasSellerRequest()) {
            return false;
        }
        return true;
    }

    // ============== وضعیت هویت ==============

    /**
     * بررسی اینکه آیا کاربر هویت تأیید شده دارد
     */
    public function hasApprovedIdentity(): bool
    {
        return $this->isSeller() || $this->seller_request_status === 'approved' || !is_null($this->identity_approved_at);
    }

    /**
     * بررسی اینکه کاربر حداقل یک درخواست هویت با وضعیت pending یا approved دارد
     */
    public function hasPendingOrApprovedIdentity(): bool
    {
        return $this->sellerApplications()->whereIn('status', ['pending', 'approved'])->exists();
    }

    // ============== روابط ==============

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function sellerApplications()
    {
        return $this->hasMany(SellerApplication::class);
    }

    public function latestSellerApplication()
    {
        return $this->hasOne(SellerApplication::class)->latestOfMany();
    }

    public function hasPendingSellerApplication(): bool
    {
        return $this->sellerApplications()->where('status', 'pending')->exists();
    }
}