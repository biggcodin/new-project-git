<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seller_applications', function (Blueprint $table) {
            $table->id();

            // ===== ارتباط با کاربر =====
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            // ===== اطلاعات مرحله اول (شخصی) =====
            $table->boolean('is_over_18')->default(false);
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('national_code', 10)->unique();
            $table->string('phone', 20);
            $table->date('birth_date');
            $table->string('bank_card_number', 20);
            $table->string('national_card_image')->nullable(); // مسیر تصویر

            // ===== اطلاعات مرحله دوم (نوع بازی) =====
            $table->foreignId('sub_subcategory_id')
                ->nullable()
                ->constrained('sub_subcategories')
                ->onDelete('set null');

            // فیلدهای اختصاصی به صورت JSON ذخیره می‌شوند
            $table->json('custom_fields_data')->nullable();

            // ===== وضعیت و اطلاعات بررسی توسط ادمین =====
            $table->enum('status', ['pending', 'approved', 'rejected'])
                ->default('pending');

            $table->text('admin_message')->nullable(); // دلیل تأیید یا رد

            $table->foreignId('admin_id')
                ->nullable()
                ->constrained('users')
                ->onDelete('set null');

            $table->timestamp('reviewed_at')->nullable();

            $table->timestamps();

            // ایندکس‌ها برای جستجوی سریع
            $table->index(['user_id', 'status']);
            $table->index('national_code');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seller_applications');
    }
};