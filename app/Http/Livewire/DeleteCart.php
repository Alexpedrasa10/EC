<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\User;
use Livewire\Component;

class DeleteCart extends Component
{
    protected $listeners = ['showDeleteCart' => 'showDeleteCart'];
    
    public $show = false;

    public function showDeleteCart()
    {
        $this->show = true;
    }

    public function confirm()
    {
        $this->cart->delete();
        redirect(route('dashboard'));
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
        return view('cart.confirm-delete-cart');
    }
}
