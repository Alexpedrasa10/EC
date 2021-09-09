<?php

use App\Models\Property;
use App\Models\Category;
use App\Services\ConvertApi;
use Illuminate\Support\Facades\Auth;

class Helper 
{

    public static function getProperties($category, $code = null, $active = true)
    {
        if (is_null($code)) {
            
            $response = Property::where('category', $category)
                ->where('active', $active)
                ->get();
        }
        else {

            $response = Property::where('category', $category)
                ->where('code', $code)
                ->where('active', $active)
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

    public static function getAssetId ( $methodId )
    {
        $method = self::getPropertiesById($methodId);
        $data = !is_null($method->data) ? json_decode($method->data) : null;
        $assetCode = config("payment-methods.default_asset");

        if (!is_null($data) && $assetCode != $data->asset) {
            $assetCode = $data->asset;
        }

        return self::getProperties('CURR', $assetCode)->id;
    }

    public static function getTotalAmount ($amount, $methodId, $assetId)
    {
        $method = self::getPropertiesById($methodId);
        $data = !is_null($method->data) ? json_decode($method->data) : null;
        $assetCode = config("payment-methods.default_asset");

        if (!is_null($data) && $assetCode != $data->asset) {

            $to = $data->asset;
            $funApi = "{$assetCode}to{$to}";
            $amount = ConvertApi::$funApi($amount);
        }

        return $amount;
    }

    public static function getPropertiesById (int $id)
    {
        return Property::where('id', $id)->first();
    }

    public static function cleanNamespace ($str)
    {
        $res = str_replace("{","",$str);
        $res =  str_replace("}","",$res);
        return $res;
    }


}