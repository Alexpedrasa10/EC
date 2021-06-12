<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class Producto extends Component
{
    public $product;
    
    public function mount($slug = NULL)
    {
        $this->product = Product::where('slug', $slug)->first();
    }


    public function render()
    {
        return view('livewire.producto');
    }
}
