<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('status');
            $table->softDeletes()->after('updated_at');
        });
    }

    public function down()
    {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn(['order', 'deleted_at']);
        });
    }
};