<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('product_media', function (Blueprint $table) {
            // اضافه کردن فیلد file_name اگر وجود نداشته باشد
            if (!Schema::hasColumn('product_media', 'file_name')) {
                $table->string('file_name')->after('file_path');
            }
            
            // اضافه کردن فیلد file_size اگر وجود نداشته باشد
            if (!Schema::hasColumn('product_media', 'file_size')) {
                $table->integer('file_size')->default(0)->after('file_type');
            }
            
            // اضافه کردن فیلد status اگر وجود نداشته باشد
            if (!Schema::hasColumn('product_media', 'status')) {
                $table->boolean('status')->default(true)->after('file_size');
            }
            
            // اضافه کردن فیلد order اگر وجود نداشته باشد
            if (!Schema::hasColumn('product_media', 'order')) {
                $table->integer('order')->default(0)->after('status');
            }
            
            // اضافه کردن soft deletes اگر وجود نداشته باشد
            if (!Schema::hasColumn('product_media', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('product_media', function (Blueprint $table) {
            if (Schema::hasColumn('product_media', 'file_name')) {
                $table->dropColumn('file_name');
            }
            
            if (Schema::hasColumn('product_media', 'file_size')) {
                $table->dropColumn('file_size');
            }
            
            if (Schema::hasColumn('product_media', 'status')) {
                $table->dropColumn('status');
            }
            
            if (Schema::hasColumn('product_media', 'order')) {
                $table->dropColumn('order');
            }
            
            if (Schema::hasColumn('product_media', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};