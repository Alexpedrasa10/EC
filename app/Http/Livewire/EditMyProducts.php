<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Property;
use stdClass;

class EditMyProducts extends Component
{

    public $product, $properties, $hasSizes, $newSize = FALSE;

    // Forms sizes
    public $size, $qSize;

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

    public function addProperty (int $id)
    {
        $property = Property::where('id', $id)->first();
        $exist = FALSE;

        foreach ($this->categories as $idx => $prop) {
            
            if ($prop->id == $id) {

               $exist = TRUE;
               $this->categories->forget($idx);
            }
        }

        if (!$exist) {
            $this->categories->push($property);
        }
    }

    public function incrementSize ($size)
    {
        $arr = json_decode(json_encode($this->sizes));
        foreach ($arr as $s) {
            
            if ($s->size == $size) {
                $s->quantity = intval($s->quantity) + 1;
                $this->stock += 1;
            }
        }

        $this->sizes = $arr;
    }

    public function decrementSize ($size)
    {
        $arr = json_decode(json_encode($this->sizes));
        foreach ($arr as $s) {
            
            if ($s->size == $size) {
                $s->quantity = intval($s->quantity) - 1;
                $this->stock -= 1;
            }
        }

        $this->sizes = $arr;
    }

    public function checkSize ($update = FALSE)
    {
        $size = strtoupper($this->size);
        $qSize = $this->qSize;
        $dataSize = json_decode(json_encode($this->sizes));
        $okSize = TRUE;

        foreach ($dataSize as $s) {
            
            if ($s->size == $size) {

                if (!$update) {
                    $okSize = FALSE;
                }
                else {

                    $s->quantity += $qSize;
                    $this->sizes = $dataSize;
                    $this->stock += $qSize;
                    $this->viewNewSize();
                    $this->toaster("Talle editado", "success");
                }
            }
        }

        return $okSize;
    }

    public function viewNewSize()
    {
        return $this->newSize = !$this->newSize;
    }

    public function addSize ()
    {
        if (!is_null($this->size) && !is_null($this->qSize)) {
            
            $size = strtoupper($this->size);
            $qSize = $this->qSize;

            if ( $this->checkSize() ) {
                
                $newSize = new StdClass();
                $newSize->size = $size;
                $newSize->quantity = $qSize;
                $dataSize = $this->sizes;
                array_push($dataSize, $newSize);

                $this->sizes = $dataSize;
                $this->stock += $qSize;

                $this->viewNewSize();
                $this->toaster("Talle agregado", "success");
            }
            else {
                $this->checkSize(TRUE);
            }
        }
        else {
            $this->toaster("Completa los datos del formulario", "error");
        }
    }


    public function toaster(string $title, string $type)
    {
        $this->dispatchBrowserEvent('alert',[
            'title' => $title,
            'type'=> $type, 
        ]);
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
            $this->categories = $this->product->properties()->get();
        }
    }

    public function render()
    {
        return view('livewire.edit-my-products');
    }
}
