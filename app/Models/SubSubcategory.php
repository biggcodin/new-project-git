<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Traits\HasCategoryFields;

class SubSubcategory extends Model
{
    use HasFactory, SoftDeletes, HasCategoryFields;
    
    protected $fillable = [
        'subcategory_id',
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
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class)->withDefault();
    }
    
    public function category()
    {
        return $this->hasOneThrough(
            Category::class,
            Subcategory::class,
            'id',
            'id',
            'subcategory_id',
            'category_id'
        );
    }
    
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function sellerApplications()
{
    return $this->hasMany(SellerApplication::class);
}
}