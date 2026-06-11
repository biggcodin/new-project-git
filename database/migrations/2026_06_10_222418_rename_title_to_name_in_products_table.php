<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // 1. تغییر نام ستون title به name اگر title وجود داشته باشد و name وجود نداشته باشد
            if (Schema::hasColumn('products', 'title') && !Schema::hasColumn('products', 'name')) {
                DB::statement('ALTER TABLE products CHANGE COLUMN title name VARCHAR(255) NOT NULL');
            }

            // 2. اضافه کردن description اگر وجود نداشته باشد
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('name');
            }

            // 3. slug
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('name');
            }

            // 4. quantity
            if (!Schema::hasColumn('products', 'quantity')) {
                $table->integer('quantity')->default(0)->after('price');
            }

            // 5. discount_price
            if (!Schema::hasColumn('products', 'discount_price')) {
                $table->decimal('discount_price', 10, 2)->nullable()->after('quantity');
            }

            // 6. featured
            if (!Schema::hasColumn('products', 'featured')) {
                $table->boolean('featured')->default(false)->after('status');
            }

            // 7. order
            if (!Schema::hasColumn('products', 'order')) {
                $table->integer('order')->default(0)->after('featured');
            }

            // 8. views
            if (!Schema::hasColumn('products', 'views')) {
                $table->integer('views')->default(0)->after('order');
            }

            // 9. published_at
            if (!Schema::hasColumn('products', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('views');
            }

            // 10. soft deletes
            if (!Schema::hasColumn('products', 'deleted_at')) {
                $table->softDeletes();
            }

            // 11. sku
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku', 100)->unique()->nullable()->after('id');
            }

            // 12. meta_title و meta_description
            if (!Schema::hasColumn('products', 'meta_title')) {
                $table->string('meta_title', 255)->nullable()->after('description');
            }
            if (!Schema::hasColumn('products', 'meta_description')) {
                $table->text('meta_description')->nullable()->after('meta_title');
            }
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // فقط ستون‌هایی که توسط این migration اضافه شده‌اند را حذف می‌کنیم
            // اما برای سادگی، حذف نمی‌کنیم (چون دیتا از دست می‌رود)
        });
    }
};