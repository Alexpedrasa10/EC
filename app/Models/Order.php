<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'orders';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'method_id',
        'user_cart_id',
        'adress_id',
        'status_id',
        'data',
        'payment_id',
        'asset_id',
        'total_amount'
    ];

    public function cart ()
    {
        return $this->hasOne(UserCart::class, 'id', 'user_cart_id');
    }

    public function method ()
    {
        return $this->hasOne(Property::class, 'id', 'method_id');
    }

    public function adress ()
    {
        return $this->hasOne(UserAdress::class, 'id', 'adress_id');
    }

    public function status ()
    {
        return $this->hasOne(Property::class, 'id', 'status_id');
    }

    public function asset ()
    {
        return $this->hasOne(Property::class, 'id', 'asset_id');
    }

    public function user ()
    {
        return $this->hasOneThrough(User::class, UserCart::class, 'id', 'id', 'user_cart_id', 'user_id');
    }
}
