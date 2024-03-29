<?php

namespace App\Actions\Jetstream;

use App\Mail\OrderFinish;
use App\PaymentMethods\Mercadopago;
use App\Models\UserCart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Team;
use App\Models\TeamInvitation;
use Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Laravel\Jetstream\Mail\TeamInvitation as MailTeamInvitation;

class Pay
{
    
    public function createOrder(Order $order)
    {
        $allowedPaymentMethods = config('payment-methods.enabled');

        // $method = $order->method()->first();

        // if (!$this->verifyPaymentMethosAvalaible($method, $allowedPaymentMethods)) {
        //     $url = $this->generatePaymentGateway($order);
        // }
    
        $url = $this->generatePaymentGateway($order);
    
        return redirect()->to($url);
    }


    protected function generatePaymentGateway(Order $order) : string
    {
        $methodName = Helper::getPropertiesById($order->method_id)->name;
        $method = Helper::cleanNamespace("App\PaymentMethods\{$methodName}");

        if (class_exists($method)) {
            $generatePayment = new $method;
            return $generatePayment->generatePayment();
        }
    }

    public static function paySucess (object $data)
    {
        // Actualiza el estado del carrito
        $cart = self::getCart($data);
        $cart->buy = TRUE;
        $cart->save();

        // Resta el stock
        self::updateStock($cart);

        // Actualiza orden
        $order = $cart->order()->first();
        self::updateOrder($order, $data, "SUCC");

        $email = $cart->user()->first()->email;
        self::sendEmail($order, $email);

        return redirect()->to('/');
    }

    public static function payPending (object $data)
    {
        // Actualiza el estado del carrito
        $cart = self::getCart($data);

        // Actualiza orden
        $order = $cart->order()->first();
        self::updateOrder($order, $data, "PEND");
        
        $email = $cart->user()->first()->email;
        self::sendEmail($order, $email);

        return redirect()->to('/');
    }

    public static function updateOrder (Order $order, object $data, string $statusCode) :void
    {
        $order->data = json_encode($data->all());
        $order->status_id = Helper::getProperties('OSTA', $statusCode)->id;

        if (is_null($order->payment_id)) {
            $order->payment_id = $data->payment_id;
        }
        
        $order->save();
    }

    public static function getCart ($data) :UserCart
    {
        if ($data->external_reference) {
            $cart = UserCart::where('id', $data->external_reference)->first();
        }
        else {
            
            $order = Order::where('payment_id', $data->token)->first();
            $cart = $order->cart()->first();
        }

        return $cart;
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

    public static function sendEmail (Order $order, string $email)
    {
        Mail::to($email)->send(new OrderFinish($order));
    }
}
