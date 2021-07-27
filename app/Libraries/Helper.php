<?php

use App\Models\Property;

class Helper 
{

    public static function getProperties($category, $code = null, $forProducts = true)
    {
        if (is_null($code)) {
            
            $response = Property::where('category', $category)
                ->where('for_products', $forProducts)
                ->get();
        }
        else {

            $response = Property::where('category', $category)
                ->where('code', $code)
                ->where('for_products', $forProducts)
                ->first();
        }

        return $response;
    }


}