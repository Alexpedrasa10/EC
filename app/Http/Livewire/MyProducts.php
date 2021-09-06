<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Property;

class MyProducts extends Component
{
    public $productName, $filter, $category, $productIdEdit;
    public $categories;

    public function getPropertiesStr ($properties) :string
    {
        $res = "";
        $qProp = count($properties);

        foreach ($properties as $idx => $prop) {
            
            if ( ($qProp - 1) != $idx ) {
                $res = $res." {$prop->name},";       
            }
            else{
                $res = $res." y {$prop->name}.";       
            }
        }

        return $res;
    }

    public function getStockData ($data)
    {
        if (!is_null($data) && !empty($data)) {

            $sizes = isset(json_decode($data)->sizes) ? json_decode($data)->sizes : null ;

            if ($sizes) {
                
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
    }

    public function render()
    {   
        
        if (Auth::user()->id == 1) {
            
            $this->categories = Property::all();
            $products = Product::with('categories', 'photo');

            if (!empty($this->productName)) {
                $products->where('name', 'like', '%'.$this->productName.'%');
            }

            if ($this->filter == "sale") {
                $products->whereNotNull('sale_price');
            }
    
            if ($this->filter == "priceLower") {
                $products->orderBy('price', 'ASC');
            }
    
            if ($this->filter == "priceHigher") {
                $products->orderBy('price', 'DESC');
            }


            if (!empty($this->category)) {
                $products->whereHas('categories', function ($query) {
                    return $query->where('id', '=', $this->category);
                });
            }

            return view('livewire.my-products', [ 
                'products' => $products->get()
            ]);
        }
    }
}
