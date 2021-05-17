<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ConfirmDeleteProduct extends Component
{
    public $confirmDelete = FALSE, $idProduct;

    public function mount(int $id)
    {
        $this->idProduct = $id;
    }

    //    @livewire('cart-products', [ 'confirm' => $confirmDelete, 'id' => $idProduct, 'type' => "product" ])


    public function confirm ()
    {
        return $this->confirmDelete = true;
    }

    public function render()
    {
        return view('cart.confirm-delete-product');
    }
}
