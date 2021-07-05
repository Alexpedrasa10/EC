<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductProperties extends Model
{
    protected $table = 'product_properties';
    protected $fillable = ['product_id', 'property_id'];
}
