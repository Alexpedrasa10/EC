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
use App\Models\CartProduct;

class Mercadopago
{

  protected $user, $cart, $products;

  public function __construct()
  {

    SDK::setAccessToken(
      config("payment-methods.mercadopago.secret")
    );

    $this->user = Auth::user();
    $this->cart = $this->user->cart()->first();
    $this->products = CartProduct::with('product')->where('user_cart_id', $this->cart->id)->get();
  }
    
  public function setupPaymentAndGetRedirectURL(): string
  {

    # Create a preference object
    $preference = new Preference();

    # Add items
    $preference->items = $this->getItems();

    # Create a payer object
    $preference->payer = $this->getPayer();

    # Save External Reference
    $preference->external_reference = $this->cart->id;

    $preference->back_urls = [
      "success" => route('success'),
      "pending" => route('dashboard'),
      "failure" => route('dashboard'),
    ];
        
    $preference->auto_return = "approved";
    //$preference->notification_url = route('dashboard');

    # Save and POST preference
    $preference->save();

    if (config('payment-methods.use_sandbox')) {
      return $preference->sandbox_init_point;
    }

    return $preference->init_point;
  }


  protected function getItems()
  {

    $allItems = array();

    foreach ($this->products as $i) {
      
      $item = new Item();
      $item->title = $i->product->name;
      $item->quantity = $i->quantity;
      $item->unit_price = is_null($i->product->sale_price) ? $i->product->price : $i->product->sale_price;
      $item->currency_id = 'ARS';
      array_push($allItems, $item);
    }

    return $allItems;
  }

  protected function getPayer()
  {

    $payer = new Payer();
    $payer->name = $this->user->name;
    $payer->email = $this->user->email;
    
    return $payer;
  }

}