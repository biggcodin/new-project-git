<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taggable extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'tag_id',
        'taggable_id',
        'taggable_type'
    ];

    protected $casts = [
        'tag_id' => 'integer',
        'taggable_id' => 'integer',
    ];

    // روابط
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }

    public function taggable()
    {
        return $this->morphTo();
    }
}