<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

class MyProducts extends Component
{
    public $products;

    public function getStockData ($data)
    {
        if (!is_null($data)) {

            $sizes = json_decode($data)->sizes;
            $qSizes = count($sizes);
            $res = "";
    
            foreach ($sizes as $idx => $size) {

                if ($size->quantity > 0) {

                    if ( ($qSizes - 1) != $idx ) {
                        $res = $res." {$size->quantity} en {$size->size},";       
                    }
                    else{
                        $res = $res." y {$size->quantity} en {$size->size}";       
                    }
                }
            }
    
            return $res;
        }
    }

    public function render()
    {   
        
        if (Auth::user()->id == 1) {
            
            $this->products = Product::all();

            return view('livewire.my-products');
        }
    }
}
