<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('custom_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('subcategory_id');
            $table->unsignedBigInteger('sub_subcategory_id')->nullable();
            $table->string('key'); // اسم فیلد مثل "rank"
            $table->string('label'); // نام قابل نمایش مثل "رتبه"
            $table->string('type')->default('text')->comment('text, number, date, select');
            $table->json('options')->nullable(); // فقط وقتی type = 'select' استفاده میشه
            $table->timestamps();

            // رابطه با زیردسته اول
            $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');

            // رابطه با زیردسته دوم (اختیاری)
            $table->foreign('sub_subcategory_id')->references('id')->on('sub_subcategories')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_fields');
    }
};