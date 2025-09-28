<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasCategoryFields;

class Subcategory extends Model
{
    use HasFactory, SoftDeletes, HasCategoryFields;
    
    protected $fillable = [
        'category_id',
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
    
    // روالات
    public function category()
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
    
    public function subSubcategories()
    {
        return $this->hasMany(SubSubcategory::class)->orderBy('order');
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    
    public function customFields()
    {
        return $this->hasMany(CustomField::class);
    }
}