<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up()
    {
        // اصلاح slugهای خالی موجود
        DB::table('tags')->where('slug', '')->orWhereNull('slug')->get()->each(function ($tag) {
            $slug = Str::slug($tag->name);
            $originalSlug = $slug;
            $count = 1;
            
            // بررسی تکراری نبودن slug
            while (DB::table('tags')->where('slug', $slug)->where('id', '!=', $tag->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
            
            DB::table('tags')->where('id', $tag->id)->update(['slug' => $slug]);
        });
    }

    public function down()
    {
        // برگرداندن تغییرات در صورت نیاز
        // این بخش اختیاری است
    }
};