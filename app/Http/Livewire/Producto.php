<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\UserCart;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Actions\Jetstream\Pay;
use stdClass;
use App\Models\CartProduct;

class Producto extends Component
{
    public $product, $photos, $url, $current_quantity, $current_size, $price;
    
    public $user, $cart, $cartProduct;
    
    public function mount($slug)
    {
        $this->product = Product::with('categories')->where('slug', $slug)->first();
        $this->photos = $this->product->photos()->get();
        $this->url = $this->product->photo->filename;
        $this->price = !is_null($this->product->sale_price) ? $this->product->sale_price : $this->product->price;
        $this->current_quantity = 1;

        if ( Auth::user() ) {

            $this->user = User::where('id', Auth::user()->id)->first();
            $this->cart = $this->user->cart()->first();

            if (!is_null($this->cart)) {
                
                $this->cartProduct = CartProduct::where('product_id', $this->product->id)
                    ->where('user_cart_id', $this->cart->id)
                    ->first();
            }
        }
    }

    public function setPhoto($url)
    {
        if ($url != $this->url) {
            
            $this->url = $url;
            $this->render();
        }
    }

    public function checkQuantity()
    {
        $hasStock = FALSE;
        $q = $this->current_quantity;
        $size = $this->current_size;

        if ( !empty($size) ) {

            $data = json_decode($this->product->data)->sizes;
    
            foreach ($data as $d) {
                
                if ($d->size == $size) {

                    // Si el producto ya esta en el carrito
                    if ( !empty($this->cartProduct) ) {
                       
                        $orderInCart = json_decode($this->cartProduct->data);
                        $hasSizeInCart = FALSE;

                        foreach ($orderInCart as $order) {
                            
                            if ($order->size == $size) {
                                
                                $stockForSize = $d->quantity - $order->quantity;
                                $hasSizeInCart = TRUE;

                                if ($stockForSize > $q) {
                                    $hasStock = TRUE;
                                }
                                elseif ($d->quantity == $order->quantity){
                                    $this->current_quantity = 0;
                                }
                            }
                        }

                        // Si el talle no está en el data
                        if (!$hasSizeInCart) {
                            if ($d->quantity > $q ) {
                                $hasStock = TRUE;
                            }
                        }
                    }
                    else{

                        if ($d->quantity > $q ) {
                            $hasStock = TRUE;
                        }
                    }
                }
    
            }
        }
        else{

            $stock = $this->product->stock;

            if ($stock > $q) {
                $hasStock = TRUE;
            }

        }

        if (!$hasStock) {
            $this->toaster("No hay más unidad disponibles", "error");
        }

        return $hasStock;
    }

    public function checkSize ($size)
    {
        $hasStock = FALSE;
        $dataStock = json_decode($this->product->data)->sizes;
        $q = $this->current_quantity;

        foreach ($dataStock as $dStock) {
                
            if ($dStock->size == $size) {

                // Si el producto ya esta en el carrito
                if ( !empty($this->cartProduct) ) {
                   
                    $orderInCart = json_decode($this->cartProduct->data);
                    $hasSizeInCart = FALSE;

                    foreach ($orderInCart as $order) {
                        
                        // El talle esta en el data
                        if ($order->size == $size) {
                            
                            $stockForSize = $dStock->quantity - $order->quantity;
                            $hasSizeInCart = TRUE;
                            $hasStock = TRUE;

                            if ($dStock->quantity == $order->quantity){
                                $this->current_quantity = 0;
                            }
                            elseif ($q > $stockForSize) {
                                $this->current_quantity = $stockForSize;
                            }
                        }
                    }

                    // Si el talle no está en el data
                    if (!$hasSizeInCart) {

                        if ($dStock->quantity >= $q ) {
                            $hasStock = TRUE;
                        }
                        elseif ($dStock->quantity < $q){
                            $this->current_quantity = $dStock->quantity;
                        }
                    }
                }
                else{

                    if ($dStock->quantity >= $q ) {
                        $hasStock = TRUE;
                    }
                    elseif ($q > $dStock->quantity){

                        $hasStock = TRUE;
                        $this->current_quantity = $q - ($q - $dStock->quantity);
                    }
                }
            }

        }

        if (!$hasStock) {
            $this->toaster("No hay más unidad disponibles para este talle", "error");
        }
        
        if ( $hasStock && $q == 0){
            $this->current_quantity = 1;
        }

        return $hasStock;
    }

    public function increment()
    {
        if ($this->checkQuantity()) {
            $this->current_quantity++;
        }
    }

    public function decrement()
    {
        if ($this->current_quantity > 1) {
            $this->current_quantity--;
        }
    }

    public function setSize ($size)
    {
        if ( $this->checkSize($size) ) {
            $this->current_size = $size;
        }
    }

    public function getAmount ()
    {
        return $this->current_quantity * $this->price;
    }

    public function productHasSizes()
    {
        return isset(json_decode($this->product->data)->sizes) ? true : false;
    }

    public function addToCart ()
    {
        if (Auth::user()) {
            
            $user = $this->user;
            $cart = $this->cart;
            $product = $this->product;

            if ( !is_null($this->current_size) || !$this->productHasSizes() ) {
            
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
                    $newCart->amount = $this->getAmount();
                    $newCart->save();
        
                    $newProductCart = new CartProduct();
                    $newProductCart->user_cart_id = $newCart->id;
                    $newProductCart->product_id = $product->id;
                    $newProductCart->quantity = $this->current_quantity;
                    $newProductCart->data = $this->getSizeJSON();
                    $newProductCart->amount = $this->getAmount();
                    $newProductCart->save();

                    $this->cart = $newCart;
                    $this->toaster('Producto agregado al carrito.', 'success');
                }
            }
            else{
                $this->toaster('Tienes que elegir un talle.', 'error');
            }
        }
        else{
            $this->toaster("Para agregar productos, debes registrarte", "error");
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
        return view('livewire.producto',[
            'url' => $this->url,
        ]);
    }
}
