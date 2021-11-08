<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public static function getAllCategories ()
    {
        return self::whereNull('code')->get();
    }

    public static function getCategories()
    {
        $cat = self::getAllCategories();

        foreach ($cat as $c) {
            
            $othersC = self::whereCategory($c->category)->whereNotNull('code')->get();
            $c->options = $othersC;
            $c->optionsSelected = null;
        }

        return $cat;
    }
}
