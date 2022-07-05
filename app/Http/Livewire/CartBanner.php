<?php

namespace App\Http\Livewire;

use Illuminate\Foundation\Auth\User;
use Livewire\Component;

class CartBanner extends Component
{
    protected $listeners = ['showCartBanner' => 'showCartBanner'];
    
    public $show = false;

    public function showCartBanner()
    {
        $this->show = true;
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->cart = $user->cart()->first();
        $this->show = !empty($this->cart);
    }

    public function render()
    {
        return view('components.cart-banner');
    }
}
