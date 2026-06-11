<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('sub_subcategories', function (Blueprint $table) {
            if (!Schema::hasColumn('sub_subcategories', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down()
    {
        Schema::table('sub_subcategories', function (Blueprint $table) {
            if (Schema::hasColumn('sub_subcategories', 'deleted_at')) {
                $table->dropSoftDeletes();
            }
        });
    }
};