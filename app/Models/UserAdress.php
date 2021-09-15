<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdress extends Model
{
    use HasFactory;

    protected $table = "user_adresses";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'province_id',
        'city_id',
        'zip_code',
        'adress',
        'references',
    ];

    public function province ()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function provinceName ()
    {
        return $this->province->first()->name;
    }

    public function city ()
    {
        return $this->hasOne(City::class, 'id', 'city_id');
    }

    public function cityName ()
    {
        return $this->city->first()->name;
    }
}
