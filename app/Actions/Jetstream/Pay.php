<?php

namespace App\Actions\Jetstream;

use \App\PaymentMethods\Mercadopago;
use App\Models\UserCart;
use App\Models\Order;
use App\Models\Product;

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
        self::updateStock($cart);

        // Guardar datos proveniente del checkout
        Order::create([
            'method_id' => 1, // Luego hacer dinamico con un helper
            'user_cart_id' => $cart->id,
            'status_id' => 2,
            'payment_id' => $data->payment_id
        ]);
        
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
