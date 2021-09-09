<?php

namespace App\Services;

use GuzzleHttp\Client;

class ConvertApi 
{

    public static function ARStoUSD ($amount)
    {
        $quotation = self::getQuotation();
        
        $amountConverted = $amount / $quotation;

        return floatval(number_format($amountConverted, 2));
    }


    public static function getQuotation()
    {
        $prices = self::callApi();
        $quote = null;

        foreach ($prices as $q) {
            
            if ( $q->casa->nombre == 'Dolar Blue') {
                $quote = floatval($q->casa->venta);
            }
        }

        return $quote;
    }

    public static function callApi ()
    {
        $path = "www.dolarsi.com/api/api.php?type=valoresprincipales";
        $client = new Client();
        $call = $client->get($path);
        return json_decode($call->getBody()->getContents());
    }


}