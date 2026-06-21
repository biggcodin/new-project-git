<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            
            // کاربر
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // شناسه یکتا برای پیگیری (شماره فاکتور)
            $table->string('order_number', 50)->unique();
            
            // مبلغ کل سفارش
            $table->decimal('total_amount', 15, 0);
            
            // مبلغ پرداخت‌شده (اگر با کیف پول پرداخت شده)
            $table->decimal('paid_amount', 15, 0)->default(0);
            
            // وضعیت سفارش
            $table->enum('status', ['pending', 'paid', 'processing', 'completed', 'canceled', 'failed'])
                  ->default('pending');
            
            // روش پرداخت (wallet, gateway, etc)
            $table->string('payment_method', 50)->nullable();
            
            // شناسه تراکنش کیف پول (در صورت پرداخت با کیف پول)
            $table->foreignId('wallet_transaction_id')->nullable()->constrained()->nullOnDelete();
            
            // توضیحات اضافی
            $table->text('notes')->nullable();
            
            // اطلاعات ارسال (برای آینده)
            $table->string('shipping_address')->nullable();
            $table->string('shipping_phone')->nullable();
            
            // متادیتا (اطلاعات اضافی مثل آدرس IP)
            $table->json('meta')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // ایندکس‌ها
            $table->index(['user_id', 'status']);
            $table->index('order_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};