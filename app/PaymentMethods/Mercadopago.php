<?php

namespace App\PaymentMethods;

use App\Order;
use Illuminate\Http\Request;
use MercadoPago\Item;
use MercadoPago\MerchantOrder;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\Preference;
use MercadoPago\SDK;
use Illuminate\Support\Facades\Auth;

class Mercadopago
{

  public function __construct()
  {

    SDK::setAccessToken(
      config("payment-methods.mercadopago.secret")
    );

  }

    
 public function setupPaymentAndGetRedirectURL($order): string
  {
     # Create a preference object
     $preference = new Preference();

    # Add items
    $preference->items = $this->getItems($order);


    # Create a payer object
    //$preference->payer = $this->getPayer();

    //   # Save External Reference
    //   $preference->external_reference = $order->id;

      $preference->back_urls = [
        "success" => route('dashboard'),
        "pending" => route('dashboard'),
        "failure" => route('dashboard'),
      ];
        
     $preference->auto_return = "approved";
    //   $preference->notification_url = route('dashboard');
    //   //dump($preference);

      # Save and POST preference
      $preference->save();

    if (config('payment-methods.use_sandbox')) {
      return $preference->sandbox_init_point;
    }

    return $preference->init_point;
  }


  protected function getItems($items)
  {

    $allItems = array();

    foreach ($items as $i) {
      
      $item = new Item();
      $item->title = $i->name;
      $item->quantity = $i->quantity;
      $item->unit_price = $i->unit_price;
      $item->currency_id = 'ARS';
      array_push($allItems, $item);
    }

    return $allItems;
  }

  protected function getPayer()
  {

    $payer = new Payer();
    $payer->name = Auth::user()->name;
    $payer->email = Auth::user()->email;
    
    return $payer;
  }

}