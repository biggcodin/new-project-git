<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // افزودن فیلدهای مفقود
            $table->string('slug')->unique()->nullable()->after('title');
            $table->integer('quantity')->default(0)->after('price');
            $table->decimal('discount_price', 8, 2)->nullable()->after('quantity');
            $table->boolean('featured')->default(false)->after('status');
            $table->integer('order')->default(0)->after('featured');
            $table->integer('views')->default(0)->after('order');
            $table->timestamp('published_at')->nullable()->after('views');
            $table->softDeletes(); // برای soft delete
            
            // تغییر نام فیلدها برای سازگاری
            $table->renameColumn('title', 'name');
            $table->renameColumn('discount', 'old_discount'); // نگهداری موقت
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // حذف فیلدهای اضافه شده
            $table->dropColumn([
                'slug',
                'quantity',
                'discount_price',
                'featured',
                'order',
                'views',
                'published_at',
                'deleted_at'
            ]);
            
            // بازگردانی نام فیلدها
            $table->renameColumn('name', 'title');
            $table->renameColumn('old_discount', 'discount');
        });
    }
};