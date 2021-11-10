<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Property;
use App\Models\Team;
use App\Models\User;
use Helper;
use Livewire\WithPagination;

class MyProducts extends Component
{
    use WithPagination;
    public $categories;
    public $user, $isAdmin, $teamAdmin;
    public $name = '', $filter, $category, $productIdEdit, $limit = 10;

    protected $queryString = [
        'name' => ['except' => ''],
        'filter' => ['except' => ''],
        'limit' => ['except' => 0]
    ];

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

    public function getProducts()
    {
        $products = Product::with('categories', 'photo');

        if (!empty($this->name)) {
            $products->where('name', 'like', '%'.$this->name.'%');
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


        if (!empty($this->category) && !is_null($this->category)) {

            $products->whereHas('categories', function ($query) {
                return $query->where('id', '=', $this->category);
            });
        }

        return $products;
    }

    public function mount()
    {
        if (Auth::user()) {
        
            $this->user = User::whereId(Auth::user()->id)->first();
            $this->teamAdmin = Team::whereName('Administracion')->first();
            $this->isAdmin = $this->user->belongsToTeam($this->teamAdmin);
        }
        else {
            $this->isAdmin = false;
        }
    }

    public function render()
    {   
        
        if ($this->isAdmin) {
            
            $this->categories = Helper::getAllCategories();
            $products = $this->getProducts();

            return view('livewire.my-products', [ 
                'products' => $products->paginate($this->limit)
            ]);
        }
    }
}
