<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\User;
use Livewire\Component;

class DeleteProductCart extends Component
{
    protected $listeners = ['showDeleteProductCart' => 'showDeleteProductCart'];
    
    public $show = false, $idProduct;

    public function showDeleteProductCart(int $id)
    {
        $this->show = true;
        $this->idProduct = $id;
    }

    public function confirm()
    {
        $product = $this->cart->products()->where('cart_products.id', '=', $this->idProduct)->first();

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

            $this->emit('refreshCartProducts');
        }
        else {

            $product->delete();
            $this->cart->delete();
            redirect(route('dashboard'));
        }
    }

    public function cancel()
    {
        $this->show = false;
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->cart = $user->cart()->first();
    }

    public function render()
    {
        return view('cart.confirm-delete-product-cart');
    }
}
