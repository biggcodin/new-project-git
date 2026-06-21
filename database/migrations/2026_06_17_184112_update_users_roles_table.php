<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // تغییر نوع ستون role به enum با مقادیر جدید
        DB::statement("ALTER TABLE users MODIFY COLUMN role ENUM('super_admin', 'admin', 'seller', 'buyer', 'user') DEFAULT 'user'");

        // اضافه کردن ستون seller_request_status اگر وجود ندارد
        if (!Schema::hasColumn('users', 'seller_request_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('seller_request_status', ['none', 'pending', 'approved', 'rejected'])
                    ->default('none')
                    ->after('role');
            });
        }
    }

    public function down(): void
    {
        // برگرداندن به حالت قبل
        DB::statement("ALTER TABLE users MODIFY COLUMN role VARCHAR(255) DEFAULT 'user'");

        if (Schema::hasColumn('users', 'seller_request_status')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('seller_request_status');
            });
        }
    }
};