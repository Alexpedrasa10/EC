<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Property;
use App\Models\ProductProperties;
use stdClass;

class EditMyProducts extends Component
{

    public $product, $properties, $hasSizes, $newSize = FALSE;

    // Forms sizes
    public $size, $qSize;

    // Forms inputs
    public $name, $URL, $price, $salePrice, $url_photos, $description, 
            $categories, $stock = 0, $sizes;
    
    protected $rules = [
        'name' => 'required|min:6',
        'price' => 'required|numeric',
        'description' => 'required|min:10',
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

    public function addProperties (int $idProd)
    {
        $categories = $this->categories;

        if (!empty($categories)) {
            
            $currentProperties = ProductProperties::where('product_id', $idProd)->get();

            // Agrega las categorias
            foreach ($categories as $cat) {

                $exist = FALSE;
                
                // Verifica que no este
                if (!empty($currentProperties)) {
                    
                    foreach ($currentProperties as $cProp) {
                        
                        if ($cProp->property_id == $cat->id) {
                            $exist = TRUE;
                        }
                    }
                }

                if (!$exist) {

                    $newCat = new ProductProperties;
                    $newCat->product_id = $idProd;
                    $newCat->property_id = $cat->id;
                    $newCat->save();
                }
            }

            // Elimina las categorias que ya no estan
            foreach ($currentProperties as $cProp) {
                
                $propId = $cProp->property_id;
                $stillExist = FALSE;

                foreach ($categories as $cat) {
                    
                    if ($cat->id == $cProp->property_id) {
                        $stillExist = TRUE;
                    }
                }

                if (!$stillExist) {
                    
                    ProductProperties::where('product_id', $idProd)
                        ->where('property_id', $cProp->property_id)
                        ->delete();
                }
            }
        }
    }

    public function editProduct ()
    {
        $this->validate();
        $isEdit = !is_null($this->product) ? TRUE : FALSE;

        if ($isEdit) {
            $product = Product::where('id', $this->product->id)->first();
        }
        else {
            $product = new Product();
        }

        $product->name = $this->name;
        $product->slug = $this->URL;
        $product->description = $this->description;
        $product->price = $this->price;

        // Precio oferta
        if (!empty($this->salePrice)) {
            
            // Verifica que el precio de oferta sea menor al normal
            if ($this->salePrice < $this->price) {
                $product->sale_price = $this->salePrice;
            }
            else {
                $this->toaster('El precio de oferta es mayor o igual al del precio normal', 'error');
                return;
            }
        }

        $product->stock = $this->stock;
        $currentData = !is_null($product->data) ? json_decode($product->data) : new StdClass();

        // Talles
        if ($this->hasSizes) {
            $currentData->sizes = $this->sizes;
        }
        elseif ($isEdit && !$this->hasSizes && isset($currentData->sizes)){
            unset($currentData->sizes);
        }

        if (!empty($currentData)) {
            $product->data = json_encode($currentData);
        }
        
        $product->save();

        $this->addProperties($product->id);
        $this->toaster("Producto editado", "success");
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
