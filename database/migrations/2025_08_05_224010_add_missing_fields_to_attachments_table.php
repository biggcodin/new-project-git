<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('attachments', function (Blueprint $table) {
            // اضافه کردن فیلد file_size اگر وجود نداشته باشد
            if (!Schema::hasColumn('attachments', 'file_size')) {
                $table->integer('file_size')->default(0)->after('file_type');
            }
            
            // اضافه کردن فیلد status اگر وجود نداشته باشد
            if (!Schema::hasColumn('attachments', 'status')) {
                $table->boolean('status')->default(true)->after('attachable_type');
            }
            
            // اضافه کردن soft deletes اگر وجود نداشته باشد
            if (!Schema::hasColumn('attachments', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('attachments', function (Blueprint $table) {
            if (Schema::hasColumn('attachments', 'file_size')) {
                $table->dropColumn('file_size');
            }
            
            if (Schema::hasColumn('attachments', 'status')) {
                $table->dropColumn('status');
            }
            
            if (Schema::hasColumn('attachments', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};