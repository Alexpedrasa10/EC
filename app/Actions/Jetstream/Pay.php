<?php

namespace App\Actions\Jetstream;

use App\PaymentMethods\Mercadopago;
use App\Models\UserCart;
use App\Models\Order;
use App\Models\Product;
use Helper;

class Pay
{
    
    public function createOrder($preOrder)
    {
        $allowedPaymentMethods = config('payment-methods.enabled');

        // $this->notify($order);
    
        $url = $this->generatePaymentGateway($preOrder);
    
        return redirect()->to($url);
    }


    protected function generatePaymentGateway($order) : string
    {
        $methodName = Helper::getPropertiesById($order->method_id)->name;
        $method = Helper::cleanNamespace("App\PaymentMethods\{$methodName}");

        if (class_exists($method)) {
            $generatePayment = new $method;
            return $generatePayment->setupPaymentAndGetRedirectURL();
        }
    }

    public static function paySucess ($data)
    {
        // Actualiza el estado del carrito
        $cart = UserCart::where('id', $data->external_reference)->first();
        $cart->buy = TRUE;
        $cart->save();

        // Resta el stock
        self::updateStock($cart);

        // Actualiza orden
        $order = $cart->order->first();
        $order->payment_id = $data->payment_id;
        $order->save();

        //dump($data); Falta guardar la demas info en el data de la orden
        
        return view('dashboard');
    }

    public static function updateStock (UserCart $cart)
    {
        $products = $cart->products()->get();

        foreach ($products as $prod) {
            
            $qDiscount = $prod->quantity;
            $data = json_decode($prod->data);

            $product = Product::where('id', $prod->product_id)->first();
            $stockSizes = json_decode($product->data);

            $product->stock -= $qDiscount;

            // Updatea stock de talles
            if (!empty($stockSizes) && isset($stockSizes->sizes)) {
                
                foreach ($data as $d) {
                    
                    $qDis = $d->quantity;
                    $sDis = $d->size;

                    foreach ($stockSizes->sizes as $size) {
                        
                        if ($size->size == $sDis) {
                            $size->quantity -= $qDis;
                        }
                    }
                }
            }

            $product->data = json_encode($stockSizes);
            $product->save();
        }
    }
}
