<?php

namespace App\Http\Livewire;

use App\Models\CartProduct;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Actions\Jetstream\Pay; 
use stdClass;

class CartProducts extends Component
{
    public $cart, $user, $products, $idProductDelete,
    $confirmDeleteProduct = FALSE,
    $confirmCancelCart = FALSE;

    // Eliminar product
    public function cancel()
    {
        $this->idProductDelete = NULL;
        return $this->confirmDeleteProduct = false;
    }

    public function confirmDeleteProduct(int $id)
    {
        $this->idProductDelete = $id;
        return $this->confirmDeleteProduct = true;
    }

    public function deleteProduct()
    {
        if ( !empty($this->idProductDelete) ){

            $product = CartProduct::where('id', '=', $this->idProductDelete)->first();

            // Si es el unico producto
            if ($product->amount != $this->cart->amount) {
                
                $product->delete();

                $this->cart->amount -= $product->amount;
                $this->cart->save();

                $this->cancel();

                $this->dispatchBrowserEvent('alert',[
                    'title' => 'Producto eliminado del carrito.',
                    'type'=>'success', 
                ]);

            }
            else {

                $product->delete();
                $this->cart->delete();
                return redirect('/productos');
            }
        }
    }

    public function checkStock( $stockData, $size, $quantity)
    {
        $data = json_decode($stockData)->sizes;
        $response = FALSE;

        foreach ($data as $stock) {
            
            if ($stock->size == $size) {
                
                if ($stock->quantity > $quantity) {
                    $response = TRUE;
                }
            }
        }

        if (!$response) {
            $this->toaster("No hay mas unidades para este talle", 'error');
        }

        return $response;
    }


    public function increment ($productID, $size)
    {   

        foreach ($this->products as $product) {
            
            if ($product->id == $productID) {
                
                $data = json_decode($product->data);

                foreach ($data as $order) {

                    if ($order->size == $size ) {

                        $productToEdit = Product::where('id', $product->product_id)->first();
                        $hasStock = $this->checkStock($productToEdit->data, $size, $order->quantity);

                        if ($hasStock) {

                            if (!is_null($productToEdit->sale_price)) {
                                $productToEdit->price = $productToEdit->sale_price;
                            }    

                            $order->quantity++;
                            $this->updateProduct($product->id, $data, $productToEdit->price, TRUE);
                        }
                    }
                }
            }

        }
    }

    public function decrement ($productID, $size)
    {
        foreach ($this->products as $product) {
            
            if ($product->id == $productID) {
                
                $data = json_decode($product->data);

                foreach ($data as $order) {

                    if ($order->size == $size ) {

                        $productToEdit = Product::where('id', $product->product_id)->first();

                        if (!is_null($productToEdit->sale_price)) {
                            $productToEdit->price = $productToEdit->sale_price;
                        }

                        if ($order->quantity > 1) {

                            $order->quantity--;
                            $this->updateProduct($product->id, $data, $productToEdit->price, FALSE);
                        }
                        else{
                            $this->confirmDeleteProduct($product->id);
                        }
                        
                    }
                }
            }

        }    }

    public function updateProduct (int $id, $data, $unitPrice, bool $action)
    {
        $cartProduct = CartProduct::where('id', $id)->first();
        $cartProduct->data = json_encode($data);

        if ($action) {

            $cartProduct->amount += $unitPrice;
            $this->cart->amount += $unitPrice;
            $cartProduct->quantity++;
        }
        else{
            $cartProduct->amount -= $unitPrice;
            $this->cart->amount -= $unitPrice;
            $cartProduct->quantity--;
        }

        $cartProduct->save();
        $this->cart->save();
    }

    public function toaster(string $title, string $type)
    {
        $this->dispatchBrowserEvent('alert',[
            'title' => $title,
            'type'=> $type, 
        ]);
    }

    

    // Pagar producto
    public function paymentMercadopago(Pay $MP)
    {
        $product = $this->user->products()->select('cart_products.*')
        ->addSelect('p.name as name', 'p.price as unit_price', 'cart_products.data as data',
         'p.id as product_id')
        ->leftjoin('products as p', 'p.id', '=', 'cart_products.product_id')->get();

        $MP->createOrder($product);
    }

    public function getSizes ($data)
    {
        return json_decode($data);
    }

    public function render()
    {
        $this->user = User::where('id', '=', Auth::user()->id)->first();
        $this->products = $this->user->products()->select('cart_products.*')
            ->addSelect('p.name as name', 'p.slug as slug', 'p.price as unit_price',
            'p.data as stock_size', 'p.sale_price as sale_price', 'p.url_photos')
            ->leftjoin('products as p', 'p.id', '=', 'cart_products.product_id')->get();
        $this->cart = $this->user->cart()->first();

        return view('cart.cart-products');
    }
}
