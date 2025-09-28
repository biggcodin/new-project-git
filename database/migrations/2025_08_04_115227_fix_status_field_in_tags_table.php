<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        // تغییر نوع فیلد status از varchar به boolean
        DB::statement("ALTER TABLE tags MODIFY status BOOLEAN DEFAULT 1");
        
        // به‌روزرسانی مقادیر موجود
        DB::table('tags')->where('status', 'active')->update(['status' => true]);
        DB::table('tags')->where('status', '!=', 'active')->update(['status' => false]);
    }

    public function down()
    {
        // بازگشت به حالت قبلی
        DB::statement("ALTER TABLE tags MODIFY status VARCHAR(255) DEFAULT 'active'");
        
        // به‌روزرسانی مقادیر موجود
        DB::table('tags')->where('status', true)->update(['status' => 'active']);
        DB::table('tags')->where('status', false)->update(['status' => 'inactive']);
    }
};