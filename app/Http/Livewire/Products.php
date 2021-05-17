<?php

namespace App\Http\Livewire;

use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Property;
use App\Models\User;
use App\Models\UserCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Products extends Component
{
    public $products, $categories, $user;

    public function addProductToCart(int $idProduct)
    {
        $user = $this->user;
        $cart = $user->cart()->first();
        $product = Product::where('id', '=', $idProduct)->first();

        if (!empty($cart)){

            $productCart = CartProduct::where('user_cart_id', '=', $cart->id)
                ->where('product_id', '=', $product->id)
                ->first();
            
            if (empty($productCart)){

                $newProductCart = new CartProduct();
                $newProductCart->user_cart_id = $cart->id;
                $newProductCart->product_id = $product->id;
                $newProductCart->quantity = 1;
                $newProductCart->amount = $product->price;
                $newProductCart->save();

                $cart->amount = $cart->amount + $product->price;
                $cart->save();

                $this->dispatchBrowserEvent('alert',[
                    'title' => 'Producto agregado al carrito.',
                    'type'=>'success', 
                ]);
            }
            else{

                $productCart->quantity++;
                $productCart->amount = $productCart->amount + $product->price;
                $productCart->save();

                $cart->amount += $product->price;
                $cart->save();

                $this->dispatchBrowserEvent('alert',[
                    'title' => 'Producto agregado al carrito.',
                    'type'=>'success', 
                ]);
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
            $newProductCart->amount = $product->price;
            $newProductCart->save();

            $this->dispatchBrowserEvent('alert',[
                'title' => 'Producto agregado al carrito.',
                'type'=>'success', 
            ]);
        }
    }

    public function render()
    {
        $this->products = Product::all();
        $this->categories = Property::all();
        $this->user = User::where('id', '=', Auth::user()->id)->first();


        return view('livewire.products');
    }
}
