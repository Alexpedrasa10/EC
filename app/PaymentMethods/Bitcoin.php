<?php

namespace App\PaymentMethods;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartProduct;
use App\Models\User;
use GuzzleHttp\Client;
use Helper;
use stdClass;
use GuzzleHttp\RequestOptions;
use GuzzleHttp\Psr7\Request as RequestAshe;

class Bitcoin
{

    protected $api_key, $secret, $url, $market;

    protected $user, $cart, $products;

    public function __construct()
    {
        // Keys for API BUDA
        $this->api_key = config("payment-methods.bitcoin.key");
        $this->secret = config("payment-methods.bitcoin.secret");
        $this->url = config("payment-methods.bitcoin.url");
        $this->market = config("payment-methods.bitcoin.market");

        // User information
        //$this->user = Auth::user();
        $this->user = User::find(2);
        $this->cart = $this->user->cart()->first();
        $this->products = CartProduct::with('product')->where('user_cart_id', $this->cart->id)->get();
    }
    
    public function run()
    {
        $amount_satoshis = $this->getAmountBTC();
        dump($amount_satoshis);
        $invoice_lightining = $this->generateInvoice($amount_satoshis);

        return $amount_satoshis;
    }

    public function getAmountBTC()
    {
        // Call API for quote
        $path = "markets/{$this->market}/ticker";
        $getFullQuote = $this->call("GET", $path);

        // Set amounts
        $lastQuote = $getFullQuote->response->ticker->last_price[0];
        $arsAmount = $this->cart->amount;
        $totalAmount = $arsAmount / $lastQuote;

        return $totalAmount;
    }

    public function generateInvoice ($amount)
    {
        // Call API for generate invoice
        $path = "lightning_network_invoices";
        $body = $this->getPayloadInvoice($amount);
        //$generateInvoice = $this->call("POST", $path, true, $body);

        //PRUEBA
        $pathbalance = "balances";
        $balance = $this->call("GET", $pathbalance, true);
    }

    public function call ($method, $path, $private = false, $body = null)
    {
        $fullPath = "{$this->url}{$path}";
        $client = new Client();

        if ($private) {

            $nonce = $this->getNonce();
            $path = "/api/v2/" .$path;
            $sign = $this->getSign($method, $path, $nonce, $body);
            $headers = array(
                'X-SBTC-APIKEY' => $this->api_key,
                'X-SBTC-NONCE' => $nonce,
                'X-SBTC-SIGNATURE' => $sign,
            );

            $request = new RequestAshe($method, $fullPath, [
                'X-SBTC-APIKEY' => $this->api_key,
                'X-SBTC-NONCE' => $nonce,
                'X-SBTC-SIGNATURE' => $sign,
            ]);
            dump($request);
            $call = $client->send($request);

            dump($call);
        }
        else {
            $call = $client->$method($fullPath);
        }

        if ($method == "GET") {
            $res = new stdClass();
            $res->code = $call->getStatusCode();
            $res->response = json_decode($call->getBody()->getContents());
        }

        return $res;
    }

    public function getNonce () :string
    {
        list($msec, $sec) = explode(' ', microtime());
        return $sec . substr($msec, 2, 3);
    }

    public function getSign($method, $path, $nonce, $body = null)
    {
        $components = [$method, $path];

        if (!is_null($body)) {
            $components[] = base64_encode($body);
        }

        $components[] = $nonce;
        $msg = implode(" ", $components);
        dump($msg);
        $sign = hash_hmac("sha384", $msg, $this->secret);

        return bin2hex($sign);
    }

    public function getPayloadInvoice($amount)
    {
        $data = new stdClass();
        $data->amount_satoshis = $amount;
        $data->currency = "BTC";
        $data->memo = "Anashe";
        //$data->expiry_seconds = $amount;

        return json_encode($data);
    }

}