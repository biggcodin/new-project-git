<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->string('file_path'); // مسیر فایل
            $table->string('file_name'); // نام فایل
            $table->string('file_type'); // نوع فایل (تصویر، PDF و ...)
            $table->unsignedBigInteger('attachable_id'); // شناسه مدل مرتبط
            $table->string('attachable_type'); // نوع مدل مرتبط
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attachments');
    }
};