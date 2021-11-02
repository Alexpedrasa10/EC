<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;

class User extends AuthUser
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'email_verified_at', 'current_team_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function cart () :HasOne
    {
        return $this->hasOne(UserCart::class, 'user_id', 'id')->whereNull('user_cart.buy')->whereNull('user_cart.canceled');
    }

    public function adress ()
    {
        return $this->hasMany(UserAdress::class, 'user_id', 'id');
    }

    public function allCarts () :HasMany
    {
        return $this->HasMany(UserCart::class);
    }

    public function shops() :HasMany
    {
        return $this->hasMany(Transfer::class);
    }

    public function products() :HasManyThrough
    {
        return $this->hasManyThrough(CartProduct::class, UserCart::class, 'user_id', 'user_cart_id', 'id', 'id')->whereNull('user_cart.buy')->whereNull('user_cart.canceled');;
    }

    public function order () :HasOneThrough
    {
        return $this->hasOneThrough(Order::class, UserCart::class)->whereNull('user_cart.buy')->whereNull('user_cart.canceled');
    }
}
