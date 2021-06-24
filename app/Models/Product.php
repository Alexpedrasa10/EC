<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    
    /**
     * Get all of the properties for the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function properties(): HasManyThrough
    {
        return $this->hasManyThrough(Property::class, ProductProperties::class);
    }

}
