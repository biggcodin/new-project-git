<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('custom_fields', function (Blueprint $table) {
        if (!Schema::hasColumn('custom_fields', 'deleted_at')) {
            $table->softDeletes()->after('updated_at');
        }
    });
}

    public function down()
    {
        Schema::table('custom_fields', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};