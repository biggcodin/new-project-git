<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // ابتدا ستون‌های missing را اضافه کن، اما به جای name از title استفاده کن
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('title');
            }
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('products', 'quantity')) {
                $table->integer('quantity')->default(0)->after('price');
            }
            if (!Schema::hasColumn('products', 'discount_price')) {
                $table->decimal('discount_price', 10, 2)->nullable()->after('quantity');
            }
            if (!Schema::hasColumn('products', 'featured')) {
                $table->boolean('featured')->default(false)->after('status');
            }
            if (!Schema::hasColumn('products', 'order')) {
                $table->integer('order')->default(0)->after('featured');
            }
            if (!Schema::hasColumn('products', 'views')) {
                $table->integer('views')->default(0)->after('order');
            }
            if (!Schema::hasColumn('products', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('views');
            }
            if (!Schema::hasColumn('products', 'deleted_at')) {
                $table->softDeletes();
            }
            if (!Schema::hasColumn('products', 'sku')) {
                $table->string('sku', 100)->unique()->nullable()->after('id');
            }
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
        // حذف ستون‌ها (اختیاری)
    }
};