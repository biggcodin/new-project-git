<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // اضافه کردن ستون‌هایی که ممکن است وجود نداشته باشند
            if (!Schema::hasColumn('products', 'slug')) {
                $table->string('slug')->unique()->nullable()->after('name');
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
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'quantity', 'discount_price', 'featured',
                'order', 'views', 'published_at', 'deleted_at'
            ]);
        });
    }
};