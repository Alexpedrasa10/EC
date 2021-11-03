<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class ProductsRelationed extends Component
{

    public $productRelationed, $product;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->productRelationed = $this->getProductsRelations();
    }

    public function getProductsRelations ()
    {
        $data = json_decode($this->product->data);
        $res = array();

        if ( isset($data->relations) ) {
            
            $relations = $data->relations;

            foreach ($relations as $prod) {

                $productRelationated = Product::where('id', $prod->product_id)->first();
                
                if (!empty($relations)) {
                    array_push($res, $productRelationated);
                }
            }
        }
        else {
            
            // Hay q mejorar esto
            $productRelationated = Product::with('categories')
                ->whereHas('categories', function ($query) {
                    return $query->where('id', '=', 3);
                })
                ->limit(5)
                ->get();

            if (!empty($productRelationated)) {
                
                foreach ($productRelationated as $prod) {
                    array_push($res, $prod);
                }
            }
        }

        return $res;
    }

    public function render()
    {
        return view('livewire.products-relationed');
    }
}
