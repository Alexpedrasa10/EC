<?php

namespace App\Actions\Jetstream;

use \App\PaymentMethods\Mercadopago;

class Pay
{
    
    public function createOrder($preOrder)
    {
        $allowedPaymentMethods = config('payment-methods.enabled');
    
        // $order = $this->setUpOrder($preOrder);
    
        // $this->notify($order);
    
        $url = $this->generatePaymentGateway(
            //$request->get('payment_method'), 
            $preOrder
        );
    
        return redirect()->to($url);
    }


    protected function generatePaymentGateway($order) : string
    {
        $method = new Mercadopago();
        return $method->setupPaymentAndGetRedirectURL($order);
    }


}
