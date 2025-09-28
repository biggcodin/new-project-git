<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasCategoryFields;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasCategoryFields;
    
    protected $fillable = [
        'name',
        'description',
        'image',
        'status',
        'order'
    ];
    
    protected $attributes = [
        'status' => 'active',
        'order' => 0
    ];
    
    protected $casts = [
        'status' => 'string',
        'order' => 'integer'
    ];
    
    // روابط
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class)->orderBy('order');
    }
    
    public function subSubcategories()
    {
        return $this->hasManyThrough(
            SubSubcategory::class,
            Subcategory::class,
            'category_id',
            'subcategory_id'
        );
    }
}