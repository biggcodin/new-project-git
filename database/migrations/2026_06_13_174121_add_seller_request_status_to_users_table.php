<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'seller_request_status')) {
                $table->enum('seller_request_status', ['none', 'pending', 'approved', 'rejected'])
                    ->default('none')
                    ->after('role');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'seller_request_status')) {
                $table->dropColumn('seller_request_status');
            }
        });
    }
};