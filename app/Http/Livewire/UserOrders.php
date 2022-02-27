<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserOrders extends Component
{
    public $user;

    public function mount ()
    {
        $this->user = User::whereId(Auth::user()->id)->first();
    }

    public function render()
    {
        $orders = $this->user->allCarts()
            ->with('order.adress', 'products')
            ->whereHas('order')
            ->get();

        return view('profile.user-orders', [
            'orders' => $orders
        ]);
    }
}
