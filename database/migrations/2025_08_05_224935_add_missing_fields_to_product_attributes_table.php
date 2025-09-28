<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            // اضافه کردن فیلد status اگر وجود نداشته باشد
            if (!Schema::hasColumn('product_attributes', 'status')) {
                $table->boolean('status')->default(true)->after('value');
            }
            
            // اضافه کردن فیلد order اگر وجود نداشته باشد
            if (!Schema::hasColumn('product_attributes', 'order')) {
                $table->integer('order')->default(0)->after('status');
            }
            
            // اضافه کردن soft deletes اگر وجود نداشته باشد
            if (!Schema::hasColumn('product_attributes', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('product_attributes', function (Blueprint $table) {
            if (Schema::hasColumn('product_attributes', 'status')) {
                $table->dropColumn('status');
            }
            
            if (Schema::hasColumn('product_attributes', 'order')) {
                $table->dropColumn('order');
            }
            
            if (Schema::hasColumn('product_attributes', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};