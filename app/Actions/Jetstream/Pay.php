<?php

namespace App\Actions\Jetstream;

use \App\PaymentMethods\Mercadopago;

class Pay
{
    
    public function createOrder($preOrder)
    {
        $allowedPaymentMethods = config('payment-methods.enabled');
        
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

    public static function paySucess ($data)
    {
        // Actualiza el estado del carrito
        $cart = UserCart::where('id', $data->external_reference)->first();
        $cart->buy = TRUE;
        $cart->save();

        // Resta el stock
        //$this->updateStock($cart);

        // Guardar datos proveniente del checkout
        

        return view('dashboard');
    }


}
