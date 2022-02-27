<?php

namespace App\PaymentMethods;

use Illuminate\Support\Facades\Auth;
use App\Models\CartProduct;
use App\Models\User;
use ExchangeAuth;
use GuzzleHttp\Client;
use Helper;
use stdClass;
/**
 * Payment for buda's api
 */
class Bitcoin
{
    use ExchangeAuth;

    protected $api_key, $secret, $url, $market;

    protected $user, $cart, $products;

    public function __construct()
    {
        // Keys for API BUDA
        $this->api_key = config("payment-methods.bitcoin.key");
        $this->secret = config("payment-methods.bitcoin.secret");
        $this->url = config("payment-methods.bitcoin.url");
        $this->market = config("payment-methods.bitcoin.market");
    }
    

    /**
     * Método principal para generar invoice lightining
     * @return mixed
     */
    public function run()
    {
        $amount_satoshis = $this->getAmountBTC();

        $invoice_lightining = $this->generateInvoice($amount_satoshis);
        dump($invoice_lightining);

        return $invoice_lightining;
    }


    /**
    * Método para convertir precio en ARS al valor del BTC actual
    * @return mixed
    */
    public function getAmountBTC ()
    {
        // Call API for quote
        $path = "markets/{$this->market}/ticker";
        $getFullQuote = $this->call("GET", $path);

        // Set amounts
        $lastQuote = $getFullQuote->response->ticker->last_price[0];
        $arsAmount = 35000; //to do
        $totalAmount = $arsAmount / $lastQuote;

        return $totalAmount;
    }

    /**
    * Método para generar invoice lightinig
    * @param $amount
    * @return mixed
    */
    public function generateInvoice ($amount)
    {
        $path = "lightning_network_invoices";
        $body = $this->getPayloadInvoice($amount);
        $generateInvoice = $this->call("POST", $path, true, $body);

        return $generateInvoice;
    }

    /**
     * Enpoint a la API de Buda de forma dinámica
     * 
     * @param string $method
     * @param string $path
     * @param bool $private
     * @param string $body
     * @return mixed
     */
    public function call ($method, $path, $private = false, $body = null)
    {
        $fullPath = "{$this->url}{$path}";

        if ($private) {

            // Get data for auth
            $nonce = $this->getNonce();
            $path = "/api/v2/" .$path;
            $sign = $this->getSign($method, $path, $nonce, $body);
            $headers = array(
                "X-SBTC-APIKEY:{$this->api_key}",
                "X-SBTC-NONCE:{$nonce}",
                "X-SBTC-SIGNATURE:{$sign}",
                'Content-Type: application/json'
            );

            $ch = curl_init($fullPath);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            if ($method == "POST") {
                
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt( $ch, CURLOPT_POSTFIELDS, $body );
            }

            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

            $res = (object)[
                'response' => curl_exec($ch),
                'code' => curl_getinfo($ch, CURLINFO_HTTP_CODE),
            ];


            curl_close($ch);
        }
        else {

            $client = new Client();
            $call = $client->$method($fullPath);
        }

        if ($method == "GET") {

            $res = (object)[
                'response' => json_decode($call->getBody()->getContents()),
                'code' => $call->getStatusCode(),
            ];
        }

        return $res;
    }

    /**
     * Método que devuelve el body para generar invoice
     * @param $amount
     * @return string
     */
    public function getPayloadInvoice($amount)
    {
        $data = new stdClass();
        $data->amount_satoshis = $amount;
        $data->currency = "BTC";
        $data->memo = "Anashe"; //to do

        return json_encode($data);
    }

}