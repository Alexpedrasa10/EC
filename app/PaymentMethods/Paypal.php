<?php

namespace App\PaymentMethods;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use Sample\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use Helper;
use stdClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartProduct;
use App\Models\User;

class Paypal 
{

    private $apiContext;

    public function __construct()
    {
        // Set Connection
        $payPalConfig = config("payment-methods.paypal");

        $this->apiContext = new PayPalHttpClient(
                new SandboxEnvironment(
                $payPalConfig['client_id'], 
                $payPalConfig['secret']
            )
        );
            
        // User Data
        $this->user = User::where('id', Auth::user()->id)->first();
        $this->cart = $this->user->cart()->first();
        $this->order = $this->cart->order()->first();
    }

    public function generatePayment()
    {
        $request = new OrdersCreateRequest();
        $request->prefer('return=representation');
        $request->body = $this->buildRequestBody();
    
        $client = $this->apiContext;
    
        $response = $client->execute($request);

        if ($response->statusCode == 201) {

            $this->order->payment_id = $response->result->id;
            $this->order->save();
            
            return $response->result->links[1]->href;
        }        
    }


    private function buildRequestBody()
    {
        return array(
            'intent' => 'CAPTURE',
            'application_context' =>
                array(
                    'return_url' => route('paySuccess'),
                    'cancel_url' => 'https://example.com/cancel'
                ),
            'purchase_units' =>
                array(
                    0 =>
                        array(
                            'amount' =>
                                array(
                                    'currency_code' => 'USD',
                                    'value' => $this->order->total_amount
                                )
                        )
                )
        );
    }
}