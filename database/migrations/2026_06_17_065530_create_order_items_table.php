<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            
            // رابطه با سفارش
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            
            // رابطه با محصول (اگر محصول بعداً حذف شد، اطلاعات باقی بماند)
            $table->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            
            // عنوان محصول (در زمان خرید ذخیره می‌شود)
            $table->string('product_name');
            
            // قیمت واحد در زمان خرید
            $table->decimal('unit_price', 15, 0);
            
            // تعداد
            $table->integer('quantity')->default(1);
            
            // تخفیف اعمال‌شده روی این آیتم
            $table->decimal('discount', 15, 0)->default(0);
            
            // مبلغ نهایی این آیتم (unit_price * quantity - discount)
            $table->decimal('subtotal', 15, 0);
            
            // اطلاعات اضافی (مثلاً ویژگی‌های انتخابی)
            $table->json('options')->nullable();
            
            $table->timestamps();
            
            // ایندکس
            $table->index('order_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};