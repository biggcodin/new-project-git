<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'unit_price',
        'quantity',
        'discount',
        'subtotal',
        'options',
    ];

    protected $casts = [
        'unit_price' => 'decimal:0',
        'discount' => 'decimal:0',
        'subtotal' => 'decimal:0',
        'options' => 'array',
    ];

    // ============== روابط ==============
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ============== اکسسورها ==============
    public function getSubtotalFormattedAttribute()
    {
        return number_format($this->subtotal) . ' تومان';
    }

    public function getUnitPriceFormattedAttribute()
    {
        return number_format($this->unit_price) . ' تومان';
    }
}