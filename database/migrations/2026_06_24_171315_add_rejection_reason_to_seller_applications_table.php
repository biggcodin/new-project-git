<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seller_applications', function (Blueprint $table) {
            if (!Schema::hasColumn('seller_applications', 'rejection_reason')) {
                $table->text('rejection_reason')->nullable()->after('admin_message');
            }
        });
    }

    public function down(): void
    {
        Schema::table('seller_applications', function (Blueprint $table) {
            if (Schema::hasColumn('seller_applications', 'rejection_reason')) {
                $table->dropColumn('rejection_reason');
            }
        });
    }
};