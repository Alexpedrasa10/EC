<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Actions\Jetstream\Pay;
use stdClass;
use App\Models\CartProduct;

class Producto extends Component
{
    public $product, $current_quantity, $current_size;
    
    public $user, $cart;
    
    public function mount($slug)
    {
        $this->product = Product::where('slug', $slug)->first();
        $this->current_quantity = 1;

        if (Auth::user()) {
            $this->user = User::where('id', Auth::user()->id)->first();
            $this->cart = $this->user->cart()->first();
        }

    }

    public function checkQuantity()
    {
        $stock = $this->product->stock;
        $q = $this->current_quantity;

        if ($stock > $q) {
            return true;
        }
    }

    public function increment()
    {
        if ($this->checkQuantity()) {
            $this->current_quantity++;
        }
    }

    public function decrement()
    {
        if ($this->checkQuantity() && $this->current_quantity !== 1) {
            $this->current_quantity--;
        }
    }

    public function setSize ($size)
    {
        $this->current_size = $size;
    }

    public function getOrder()
    {
        $arr = array();

        $order = new stdClass();
        $order->id = $this->product->id;
        $order->name = $this->product->name ." (talle {$this->current_size})";
        $order->unit_price = $this->product->price;
        $order->quantity = $this->current_quantity;
        $order->size = $this->current_size;
        array_push($arr, $order);

        return $arr;
    }

    public function pay (Pay $pay)
    {
        if (!empty($this->current_size)) {
            $order = $this->getOrder();
            $pay->createOrder($order);        
        }
        else{
            $this->toaster("Debes elegir un talle", "error");
        }
    }

    public function getAmount ()
    {
        return $this->current_quantity * $this->product->price;
    }

    public function addToCart ()
    {
        if (Auth::user()) {
            
            $user = $this->user;
            $cart = $this->cart;
            $product = $this->product;

            if ( !is_null($this->current_size) ) {
            
                if (!empty($cart)){

                    $productCart = CartProduct::where('user_cart_id', '=', $cart->id)
                        ->where('product_id', '=', $product->id)
                        ->first();
                    
                    if (empty($productCart)){
        
                        $newProductCart = new CartProduct();
                        $newProductCart->user_cart_id = $cart->id;
                        $newProductCart->product_id = $product->id;
                        $newProductCart->quantity = $this->current_quantity;
                        $newProductCart->data = $this->getSizeJSON();
                        $newProductCart->amount = $this->getAmount();
                        $newProductCart->save();
        
                        $cart->amount += $this->getAmount();
                        $cart->save();
        
                        $this->toaster('Producto agregado al carrito.', 'success');
                    }
                    else{
        
                        $productCart->quantity += $this->current_quantity;
                        $productCart->data = $this->checkDataInCart($productCart->data);
                        $productCart->amount += $this->getAmount();
                        $productCart->save();
        
                        $cart->amount += $this->getAmount();
                        $cart->save();
        
                        $this->toaster('Producto agregado al carrito.', 'success');
                    }
                }
                else{
        
                    $newCart = new UserCart();
                    $newCart->user_id = $user->id;
                    $newCart->amount = $product->price;
                    $newCart->save();
        
                    $newProductCart = new CartProduct();
                    $newProductCart->user_cart_id = $newCart->id;
                    $newProductCart->product_id = $product->id;
                    $newProductCart->quantity = 1;
                    $newProductCart->data = $this->getSizeJSON();
                    $newProductCart->amount = $product->price;
                    $newProductCart->save();

                    $this->cart = $newCart;
                    $this->toaster('Producto agregado al carrito.', 'success');
                }
            }
            else{
                $this->toaster('Tienes que elegir un talle.', 'error');
            }
        }
    }

    public function getSizeJSON ()
    {
        $data = array();
        $order = new stdClass();
        $order->size = $this->current_size;
        $order->quantity = $this->current_quantity;
        array_push($data, $order);

        return json_encode($data);
    }

    public function checkDataInCart($productSizes) :string
    {
        $data = json_decode($productSizes);

        // Si está ese talle , aumenta la cantidad
        foreach ($data as $key =>  $order) {

            if ($order->size == $this->current_size) {

                $order->quantity += $this->current_quantity;
                return json_encode($data);
            }
        }

        $newData = json_decode($this->getSizeJSON());
        array_push($data, $newData[0]);
        return json_encode($data);
    }

    public function toaster(string $title, string $type)
    {
        $this->dispatchBrowserEvent('alert',[
            'title' => $title,
            'type'=> $type, 
        ]);
    }


    public function render()
    {
        return view('livewire.producto');
    }
}
