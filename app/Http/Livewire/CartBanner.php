<?php

namespace App\Http\Livewire;

use Livewire\Component;

class CartBanner extends Component
{
    protected $listeners = ['showCartBanner' => 'showCartBanner'];
    
    public $show = false;

    public function showCartBanner()
    {
        $this->show = true;
    }

    public function render()
    {
        return view('components.cart-banner');
    }
}
