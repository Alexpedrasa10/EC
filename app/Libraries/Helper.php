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

    public static function getAllPropertiesProducts ()
    {
        return Property::where('for_products', true)->where('active', true)->get();
    }

    public static function getLoginMethods()
    {
        $response = Property::where('category', "MLOG")
            ->where('active', true)
            ->where('for_products', false)
            ->get();
    
        return $response;
    }

    public static function getPaymentMethods()
    {
        $response = Property::where('category', "PMET")
            ->where('active', true)
            ->where('for_products', false)
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