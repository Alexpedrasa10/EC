<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'stock',
        'description',
        'price',
        'sale_price',
        'data',
    ];
    
    public function properties(): HasManyThrough
    {
        return $this->HasManyThrough(Property::class, ProductProperties::class, 'product_id', 'id', 'id', 'property_id');
    }

}
