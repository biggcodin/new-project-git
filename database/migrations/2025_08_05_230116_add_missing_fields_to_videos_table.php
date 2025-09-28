<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            // اضافه کردن فیلد status اگر وجود نداشته باشد
            if (!Schema::hasColumn('videos', 'status')) {
                $table->boolean('status')->default(true)->after('description');
            }
            
            // اضافه کردن فیلد order اگر وجود نداشته باشد
            if (!Schema::hasColumn('videos', 'order')) {
                $table->integer('order')->default(0)->after('status');
            }
            
            // اضافه کردن فیلد duration اگر وجود نداشته باشد
            if (!Schema::hasColumn('videos', 'duration')) {
                $table->string('duration')->nullable()->after('path');
            }
            
            // اضافه کردن فیلد thumbnail اگر وجود نداشته باشد
            if (!Schema::hasColumn('videos', 'thumbnail')) {
                $table->string('thumbnail')->nullable()->after('duration');
            }
            
            // اضافه کردن فیلد views اگر وجود نداشته باشد
            if (!Schema::hasColumn('videos', 'views')) {
                $table->integer('views')->default(0)->after('thumbnail');
            }
            
            // اضافه کردن soft deletes اگر وجود نداشته باشد
            if (!Schema::hasColumn('videos', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('videos', function (Blueprint $table) {
            if (Schema::hasColumn('videos', 'status')) {
                $table->dropColumn('status');
            }
            
            if (Schema::hasColumn('videos', 'order')) {
                $table->dropColumn('order');
            }
            
            if (Schema::hasColumn('videos', 'duration')) {
                $table->dropColumn('duration');
            }
            
            if (Schema::hasColumn('videos', 'thumbnail')) {
                $table->dropColumn('thumbnail');
            }
            
            if (Schema::hasColumn('videos', 'views')) {
                $table->dropColumn('views');
            }
            
            if (Schema::hasColumn('videos', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};