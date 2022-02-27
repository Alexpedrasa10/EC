<?php

namespace App\Models;

use Helper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function photo () :HasOne
    {
        return $this->HasOne(PhotoProduct::class, 'id', 'photo_id');
    }

    public function photos () :HasMany
    {
        return $this->HasMany(PhotoProduct::class, 'product_id', 'id');
    }

    public function quantitySells (): ?int
    {
        return self::join('cart_products as cp', 'cp.product_id', '=', 'products.id')
            ->join('user_cart as uc', 'uc.id', '=', 'cp.user_cart_id')
            ->join('orders as o', 'o.user_cart_id', '=', 'uc.id')
            ->where([
                ['o.status_id', '=', Helper::getProperties('OSTA','SUCC')->id],
                ['products.id', $this->id]
            ])
            ->count();
    }

}
