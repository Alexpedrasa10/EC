<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class CartProduct extends Model
{
    use HasFactory;

    protected $table = "cart_products";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'amount',
        'data'
    ];

    public function product ()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
