<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            // اضافه کردن فیلد status اگر وجود نداشته باشد
            if (!Schema::hasColumn('articles', 'status')) {
                $table->string('status')->default('draft')->after('image');
            }
            
            // اضافه کردن فیلد published_at اگر وجود نداشته باشد
            if (!Schema::hasColumn('articles', 'published_at')) {
                $table->timestamp('published_at')->nullable()->after('status');
            }
            
            // اضافه کردن فیلد order اگر وجود نداشته باشد
            if (!Schema::hasColumn('articles', 'order')) {
                $table->integer('order')->default(0)->after('published_at');
            }
            
            // اضافه کردن فیلد views اگر وجود نداشته باشد
            if (!Schema::hasColumn('articles', 'views')) {
                $table->integer('views')->default(0)->after('order');
            }
            
            // اضافه کردن فیلد reading_time اگر وجود نداشته باشد
            if (!Schema::hasColumn('articles', 'reading_time')) {
                $table->integer('reading_time')->default(0)->after('views');
            }
            
            // اضافه کردن soft deletes اگر وجود نداشته باشد
            if (!Schema::hasColumn('articles', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            if (Schema::hasColumn('articles', 'status')) {
                $table->dropColumn('status');
            }
            
            if (Schema::hasColumn('articles', 'published_at')) {
                $table->dropColumn('published_at');
            }
            
            if (Schema::hasColumn('articles', 'order')) {
                $table->dropColumn('order');
            }
            
            if (Schema::hasColumn('articles', 'views')) {
                $table->dropColumn('views');
            }
            
            if (Schema::hasColumn('articles', 'reading_time')) {
                $table->dropColumn('reading_time');
            }
            
            if (Schema::hasColumn('articles', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};