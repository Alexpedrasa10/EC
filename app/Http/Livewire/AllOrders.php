<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class AllOrders extends Component
{
    public function render()
    {
        $orders = Order::with('adress', 'cart.products', 'method', 'status', 'asset')->get();

        return view('profile.all-orders', [
            'orders' => $orders
        ]);
    }
}
