<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seller_applications', function (Blueprint $table) {
            // حذف کلید یکتای ستون national_code (با نام پیش‌فرض)
            $table->dropUnique(['national_code']);
        });
    }

    public function down(): void
    {
        Schema::table('seller_applications', function (Blueprint $table) {
            // بازگرداندن کلید یکتا (در صورت نیاز)
            $table->unique('national_code');
        });
    }
};