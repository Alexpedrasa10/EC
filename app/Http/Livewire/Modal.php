<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $show = false, $orderId;

    protected $listeners = [
        'show' => 'show'
    ];

    public function show ( int $orderId)
    {
        $this->orderId = $orderId;
        $this->show = true;
    }
}
