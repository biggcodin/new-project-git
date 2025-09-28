<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Database\Eloquent\SoftDeletes; // اضافه شده

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait, SoftDeletes; // SoftDeletes اضافه شد

    protected $fillable = [
        'name',
        'username',
        'role',
        'email',
        'phone',
        'password',
        'email_verified_at', // اضافه شده
        'remember_token'     // اضافه شده
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', // هش خودکار پسورد
        'role' => 'string'      // تضمین نوع داده
    ];

    // متد بهبود یافته برای بررسی نقش
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    public function isAdmin(): bool
    {
        return $this->hasRole('admin');
    }

    public function isUser(): bool
    {
        return $this->hasRole('user');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // اضافه شده: اگر کاربر مقاله هم ثبت کند
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}