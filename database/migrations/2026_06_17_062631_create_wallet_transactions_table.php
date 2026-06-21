<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wallet_transactions', function (Blueprint $table) {
            $table->id();
            
            // کاربر مربوطه
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            
            // مبلغ تراکنش (مثبت = شارژ، منفی = برداشت یا خرید)
            $table->decimal('amount', 15, 0);
            
            // موجودی قبل و بعد از تراکنش (برای گزارش‌گیری)
            $table->decimal('balance_before', 15, 0);
            $table->decimal('balance_after', 15, 0);
            
            // نوع تراکنش: deposit, withdraw, purchase, refund, bonus
            $table->string('type', 50)->default('deposit');
            
            // وضعیت: pending, completed, failed, canceled
            $table->string('status', 20)->default('pending');
            
            // توضیحات یا دلیل تراکنش (مثلاً شماره فاکتور یا کد تخفیف)
            $table->string('description', 255)->nullable();
            
            // شناسه ارجاع (مثلاً order_id یا payment_id)
            $table->string('reference_id', 100)->nullable();
            $table->string('reference_type', 50)->nullable(); // مدل مرجع
            
            // اطلاعات اضافی به صورت JSON
            $table->json('meta')->nullable();
            
            $table->timestamps();
            $table->softDeletes();
            
            // ایندکس‌ها برای جستجوی سریع
            $table->index(['user_id', 'status']);
            $table->index(['user_id', 'type']);
            $table->index(['reference_id', 'reference_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wallet_transactions');
    }
};