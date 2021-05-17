<?php

namespace App\Http\Livewire;

use App\Models\CartProduct;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CartProducts extends Component
{
    public $cart, $user, $products, 
    $confirmDeleteProduct = FALSE, $idProductDelete = NULL,
    $editProductCart = FALSE, $productEdit = NULL, $productEditQuantity= NULL, $stock = NULL,
    $productEditName= NULL, $productEditUnitPrice= NULL, $productEditAmount= NULL, $productEditID;

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
            $product->delete();

            $this->cart->amount -= $product->amount;
            $this->cart->save();

            $this->cancel();

            $this->dispatchBrowserEvent('alert',[
                'title' => 'Producto eliminado del carrito.',
                'type'=>'success', 
            ]);

        }
    }

    // Editar product
    public function showModelEditProduct(int $id)
    {
        $this->editProductCart = TRUE;
        $this->productEdit = $this->user->products()->select('cart_products.*')
            ->addSelect('p.name as name', 'p.price as unit_price', 'p.id as product_id', 'p.stock as stock')
            ->leftjoin('products as p', 'p.id', '=', 'cart_products.product_id')
            ->where('cart_products.id', '=', $id)
            ->first();
        $this->productEditID = $id;
        $this->productEditQuantity = $this->productEdit->quantity;
        $this->productEditName = $this->productEdit->name;
        $this->productEditUnitPrice = $this->productEdit->unit_price;
        $this->productEditAmount = $this->productEdit->amount;
        $this->getStockQuantityOptions($this->productEdit->stock);
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

    public function updateAmount(int $quantity)
    {
        $this->productEditQuantity = $quantity;
        $this->productEditAmount = $this->productEditUnitPrice * $quantity;
    }

    public function cancelEditProduct()
    {
        $this->editProductCart = false;
        $this->productEdit = NULL;
        $this->productEditID = NULL;
        $this->productEditQuantity =  NULL;
        $this->productEditName =  NULL;
        $this->productEditUnitPrice =  NULL;
        $this->productEditAmount = NULL;
    }

    public function editProduct()
    {
        $productCart = CartProduct::where('id', '=', $this->productEditID)->first();
        $brr = $productCart->amount;
        $productCart->quantity = $this->productEditQuantity;
        $productCart->amount = $this->productEditAmount;
        $productCart->save();

        $this->cart->amount = ($this->cart->amount - $brr) +  $productCart->amount;
        $this->cart->save();
        
        $this->cancelEditProduct();
        $this->dispatchBrowserEvent('alert',[
            'title' => 'Producto editado.',
            'type'=>'success', 
        ]);
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
