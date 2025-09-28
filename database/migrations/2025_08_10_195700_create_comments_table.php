<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('article_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // اگر مهمان بود، null
            $table->foreignId('parent_id')->nullable()->constrained('comments')->nullOnDelete(); // برای پاسخ‌ها
            $table->string('name', 100)->nullable();   // برای مهمان
            $table->string('email', 150)->nullable();  // برای مهمان
            $table->text('body');
            $table->string('status', 20)->default('pending'); // pending, approved, rejected, spam
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['article_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
