<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            // اضافه کردن فیلد status اگر وجود نداشته باشد
            if (!Schema::hasColumn('sliders', 'status')) {
                $table->boolean('status')->default(true)->after('link');
            }
            
            // اضافه کردن فیلد order اگر وجود نداشته باشد
            if (!Schema::hasColumn('sliders', 'order')) {
                $table->integer('order')->default(0)->after('status');
            }
            
            // اضافه کردن فیلدهای قیمت اگر وجود نداشته باشند
            if (!Schema::hasColumn('sliders', 'price_text')) {
                $table->string('price_text')->nullable()->after('description');
            }
            
            if (!Schema::hasColumn('sliders', 'price_value')) {
                $table->decimal('price_value', 10, 2)->nullable()->after('price_text');
            }
            
            if (!Schema::hasColumn('sliders', 'price_unit')) {
                $table->string('price_unit')->nullable()->after('price_value');
            }
            
            // اضافه کردن soft deletes اگر وجود نداشته باشد
            if (!Schema::hasColumn('sliders', 'deleted_at')) {
                $table->softDeletes()->after('updated_at');
            }
        });
    }

    public function down()
    {
        Schema::table('sliders', function (Blueprint $table) {
            if (Schema::hasColumn('sliders', 'status')) {
                $table->dropColumn('status');
            }
            
            if (Schema::hasColumn('sliders', 'order')) {
                $table->dropColumn('order');
            }
            
            if (Schema::hasColumn('sliders', 'price_text')) {
                $table->dropColumn('price_text');
            }
            
            if (Schema::hasColumn('sliders', 'price_value')) {
                $table->dropColumn('price_value');
            }
            
            if (Schema::hasColumn('sliders', 'price_unit')) {
                $table->dropColumn('price_unit');
            }
            
            if (Schema::hasColumn('sliders', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};