<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // افزودن فیلد sku بعد از id
            $table->string('sku', 100)->unique()->nullable()->after('id');
            
            // افزودن فیلدهای متا بعد از description
            $table->string('meta_title', 255)->nullable()->after('description');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn([
                'sku',
                'meta_title',
                'meta_description'
            ]);
        });
    }
};