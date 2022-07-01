<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CartProduct;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserCart extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "user_cart";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'amount',
        'buy',
        'cancelled'
    ];

    public function products ()
    {
        return $this->HasMany(CartProduct::class, 'user_cart_id', 'id');
    }

    public function order()
    {
        return $this->hasOne(Order::class, 'user_cart_id', 'id');
    }

    public function user ()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
