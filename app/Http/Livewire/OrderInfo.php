<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Modal;
use App\Models\Order;

class OrderInfo extends Modal
{

    public function getStockData ($data)
    {
        if (!is_null($data) && !empty($data)) {

            
            $sizes = json_decode($data);
            $qSizes = count($sizes);
            $res = "";
    
            foreach ($sizes as $idx => $size) {

                if ($size->quantity > 0) {

                    if ($idx == 0) {
                        $res = $res." {$size->quantity} en {$size->size}";       
                    }
                    elseif ( ($qSizes - 1) != $idx ) {
                        $res = $res." , {$size->quantity} en {$size->size},";       
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
        $order = Order::whereId($this->orderId)->with('cart.products.product')->first();

        return view('livewire.order-info', [
            'order' => $order
        ]);
    }
}
