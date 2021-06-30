<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Property;

class EditMyProducts extends Component
{

    public $product, $properties, $hasSizes;

    // Forms inputs
    public $name, $URL, $price, $salePrice, $url_photos, $description, 
            $categories, $stock, $sizes;
    
    protected $rules = [
        'name' => 'required|min:6',
        'price' => 'required|numeric',
        'description' => 'required|min:10',
        'salePrice' => 'numeric',
        'stock' => 'int',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->URL = str_replace(" ", "", $this->name);
    }

    public function mount (string $slug = NULL)
    {
        $this->properties = Property::all();

        if (!is_null($slug)) {

            $this->product = Product::with('properties')->where('slug', $slug)->first();
            $this->name = $this->product->name;
            $this->URL = $this->product->slug;
            $this->price = $this->product->price;
            $this->salePrice = $this->product->sale_price;
            $this->stock = intval($this->product->stock);
            $this->sizes = isset(json_decode($this->product->data)->sizes) ? json_decode($this->product->data)->sizes : NULL;
            $this->hasSizes = !is_null($this->sizes) ? TRUE : FALSE;
            $this->url_photos = $this->product->url_photos;
            $this->description = $this->product->description;
            $this->categories = $this->product->properties;
        }
    }

    public function render()
    {
        return view('livewire.edit-my-products');
    }
}
