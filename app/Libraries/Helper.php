<?php

use App\Models\Property;
use App\Models\Category;

class Helper 
{

    public static function getProperties($category, $code = null, $forProducts = true)
    {
        if (is_null($code)) {
            
            $response = Property::where('category', $category)
                ->get();
        }
        else {

            $response = Property::where('category', $category)
                ->where('code', $code)
                ->first();
        }

        return $response;
    }

    public static function getAllCategories ()
    {
        return Category::where('active', true)->get();
    }

    public static function getLoginMethods()
    {
        $response = Property::where('category', "MLOG")
            ->where('active', true)
            ->get();
    
        return $response;
    }

    public static function getPaymentMethods()
    {
        $response = Property::where('category', "PMET")
            ->where('active', true)
            ->get();
        
        return $response;
    }

    public static function getPropertiesById (int $id)
    {
        return $response = Property::where('id', $id)->first();
    }

    public static function cleanNamespace ($str)
    {
        $res = str_replace("{","",$str);
        $res =  str_replace("}","",$res);
        return $res;
    }


}