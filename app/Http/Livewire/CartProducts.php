<?php

namespace App\Http\Livewire;

use App\Models\CartProduct;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Actions\Jetstream\Pay; 
use stdClass;

class CartProducts extends Component
{
    public $cart, $user, $products, 
    $confirmDeleteProduct = FALSE, $idProductDelete = NULL,
    $editProductCart = FALSE, $productEdit = NULL, $editDataProduct= NULL, $stock = NULL,
    $productEditID,
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
        if (!empty($this->idProductDelete) && $this->confirmDeleteProduct){

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

    // Editar product
    public function showModelEditProduct(int $id)
    {
        $this->editProductCart = TRUE;
        $this->productEdit = $this->user->products()->select('cart_products.*')
            ->addSelect('p.name as name', 'p.price as unit_price', 
                'p.id as product_id', 'p.stock as stock', 'p.data as data_stock', 'cart_products.data as order')
            ->leftjoin('products as p', 'p.id', '=', 'cart_products.product_id')
            ->where('cart_products.id', '=', $id)
            ->first();
        $this->productEditID = $id;
        $this->getProductData($this->productEdit);
        //$this->getStockQuantityOptions($this->productEdit->stock);
    }

    public function getStockQuantityOptions(int $stock)
    {
        $s = [];

        for ($i=1; $i < ($stock + 1); $i++) { 
            $n = $i .'.00';
            if ($n !== $this->productEditQuantity ){
                $s[($i - 1)] = $n;
            }
            else{
                $s[($this->productEditQuantity - 1)] = $this->productEditQuantity;
            }
        }

        return $this->stock = $s;
    }

    public function getProductData(CartProduct $product)
    {
        $editDataProduct = array();
        $editDataProduct['name'] = $product->name;
        $editDataProduct['order'] = json_decode($product->order);
        $editDataProduct['quantity'] = $product->quantity;
        $editDataProduct['amount'] = $product->amount;
        $editDataProduct['unit_price'] = $product->unit_price;
        $editDataProduct['stock'] = $product->stock;
        $editDataProduct['data_stock'] = json_decode($product->data_stock);
        $this->editDataProduct = $editDataProduct;
    }

    public function incrementQuantity($order)
    {
        $data = $this->editDataProduct['order'];

        foreach ($data as $key => $value) {

            if ($value['size'] == $order['size']) {
                $data[$key]['quantity']++;
            }
        }      
        
        $this->editDataProduct['order'] = $data;
        $this->editDataProduct['quantity']++;
        $this->editDataProduct['amount'] += $this->editDataProduct['unit_price'];
    }

    public function decrementQuantity($order)
    {
        $data = $this->editDataProduct['order'];

        foreach ($data as $key => $value) {

            if ($value['size'] == $order['size']) {

                if ($value['quantity'] !== 1) {
                    $data[$key]['quantity']--;
                }
                else{
                    unset($data[$key]);
                }
            }
        }      
        
        $this->editDataProduct['order'] = $data;
        $this->editDataProduct['quantity']--;
        $this->editDataProduct['amount'] -= $this->editDataProduct['unit_price'];
    }

    // public function getStockSize($order)
    // {
    //     $stockSize = $this->editDataProduct['data_stock'];
    //     $orderQ = $order->quantity;
    //     $orderSize = $order->size;

    //     foreach ($stockSize as $key => $value) {
    //         dump($value);
    //         if ($value->$orderSize == $orderSize) {
    //             dump('asheee');
    //         }
    //     }


    //     return true;
    // }

    public function cancelEditProduct()
    {
        $this->editProductCart = false;
        $this->productEdit = NULL;
        $this->productEditID = NULL;
        $this->editDataProduct = NULL;
    }

    public function editProduct()
    {
        $productCart = CartProduct::where('id', '=', $this->productEditID)->first();
        $productCart->data = $this->editDataProduct['order'];
        $productCart->quantity =$this->editDataProduct['quantity'];

        $this->cart->amount = ($this->cart->amount - $productCart->amount) +  $this->editDataProduct['amount'];

        $productCart->amount = $this->editDataProduct['amount'];

        $productCart->save();
        $this->cart->save();
        
        $this->cancelEditProduct();
        $this->dispatchBrowserEvent('alert',[
            'title' => 'Producto editado.',
            'type'=>'success', 
        ]);
    }

    // Cancelar carrito

    public function cancelCart()
    {
        return $this->confirmCancelCart = !$this->confirmCancelCart;
    }

    public function confirmCancelCart()
    {
        $this->cart->canceled = true;
        $this->cart->save();
        $this->confirmCancelCart = false;
        return redirect('/productos');
    }

    // Pagar producto

    public function paymentMercadopago(Pay $MP)
    {
        $product = $this->user->products()->select('cart_products.*')
        ->addSelect('p.name as name', 'p.price as unit_price', 'p.id as product_id')
        ->leftjoin('products as p', 'p.id', '=', 'cart_products.product_id')->get();

        $MP->createOrder($product);
    }

    public function render()
    {
        $this->user = User::where('id', '=', Auth::user()->id)->first();
        $this->products = $this->user->products()->select('cart_products.*')
            ->addSelect('p.name as name', 'p.price as unit_price', 'p.id as product_id')
            ->leftjoin('products as p', 'p.id', '=', 'cart_products.product_id')->get();
        $this->cart = $this->user->cart()->first();

        return view('cart.cart-products');
    }
}
