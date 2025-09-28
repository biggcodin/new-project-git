<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            // اضافه کردن ستون deleted_at اگر وجود نداشته باشد
            if (!Schema::hasColumn('tags', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
            
            // اضافه کردن ستون order اگر وجود نداشته باشد
            if (!Schema::hasColumn('tags', 'order')) {
                $table->integer('order')->default(0)->after('status');
            }
            
            // اضافه کردن ستون count اگر وجود نداشته باشد
            if (!Schema::hasColumn('tags', 'count')) {
                $table->integer('count')->default(0)->after('color');
            }
        });
    }

    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            if (Schema::hasColumn('tags', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
            
            if (Schema::hasColumn('tags', 'order')) {
                $table->dropColumn('order');
            }
            
            if (Schema::hasColumn('tags', 'count')) {
                $table->dropColumn('count');
            }
        });
    }
};