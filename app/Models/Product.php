<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    protected $appends = ['photo'];

    public function getPhotoAttribute()
    {
        return $this->photo()->first();
    }

    
    public function categories(): HasManyThrough
    {
        return $this->HasManyThrough(Category::class, ProductCategory::class, 'product_id', 'id', 'id', 'category_id');
    }

    public function photo ()
    {
        return $this->hasOne(PhotoProduct::class, 'id', 'photo_id');
    }

    public function photos () :HasMany
    {
        return $this->HasMany(PhotoProduct::class, 'product_id', 'id');
    }

}
