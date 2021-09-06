<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Property;
use App\Models\Category;
use App\Models\ProductCategory;
use stdClass;
use Livewire\WithFileUploads;
use App\Models\PhotoProduct;
use Storage;
use League\Flysystem\Filesystem;
use Spatie\Dropbox\Client;
use Spatie\FlysystemDropbox\DropboxAdapter;
use Helper;

class EditMyProducts extends Component
{

    // Upload product img
    use WithFileUploads;
    public $photos = [], $confirmDetelePhoto = false, $photoToDeleted;
    private $dropbox;

    public $product, $properties, $products, $coverPhoto, $hasSizes = false, $newSize = FALSE;

    // Forms sizes
    public $size, $qSize;

    // Forms inputs
    public $name, $URL, $price, $salePrice, $url_photos, $description, 
            $categories, $stock = 0, $sizes, $productsRelationed;
    
    protected $rules = [
        'name' => 'required|min:6',
        'price' => 'required|numeric',
        'description' => 'required|min:10',
        'stock' => 'int',
    ];

    public function __construct ()
    {
        $this->dropbox = Storage::disk('dropbox')->getDriver()->getAdapter()->getClient();   
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
        $this->URL = str_replace(" ", "", $this->name);
    }

    public function addProperty (int $id)
    {
        $property = Category::where('id', $id)->first();
        $exist = FALSE;


        if (!empty($this->categories)) {
            
            foreach ($this->categories as $idx => $prop) {

                if (gettype($this->categories) == 'array') {
                    
                    if ($prop['id'] == $id) {
    
                        $exist = TRUE;
                        unset($this->categories[$idx]);
                    }
                }
                else {

                    if ($prop->id == $id) {
    
                        $exist = TRUE;
                        $this->categories->forget($idx);
                    }
                }
            }
        }

        if (!$exist) {

            if (!is_null($this->product)) {
                $this->categories->push($property);
            }
            else {
                $this->categories[] = $property;
            }
        }
    }

    public function addProduct (int $id)
    {
        $product = Product::select('id','name', 'slug')->where('id', $id)->first();
        $exist = FALSE;

        if (!empty($this->productsRelationed)) {
            
            foreach ($this->productsRelationed as $idx => $prod) {
            
                if ($prod['id'] == $id) {
                   $exist = TRUE;
                   array_splice($this->productsRelationed, $idx, 1);
                }
            }
        }

        if (!$exist) {
            $this->productsRelationed[] = $product;
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
            
            if ($s->size == $size && $s->quantity > 0) {
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

        if (!empty($dataSize)) {

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
        }

        return $okSize;
    }

    public function hasSizes()
    {
        $this->hasSizes = !$this->hasSizes;
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
                $dataSize = !is_null($this->sizes) ? $this->sizes : array();
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
            
            $currentProperties = ProductCategory::where('product_id', $idProd)->get();

            // Agrega las categorias
            foreach ($categories as $cat) {

                $exist = FALSE;
                
                // Verifica que no este
                if (!empty($currentProperties)) {
                    
                    foreach ($currentProperties as $cProp) {
                        
                        if ($cProp->category_id == $cat->id) {
                            $exist = TRUE;
                        }
                    }
                }

                if (!$exist) {

                    $newCat = new ProductCategory;
                    $newCat->product_id = $idProd;
                    $newCat->category_id = gettype($cat) != 'array' ? $cat->id : $cat['id'];
                    $newCat->save();
                }
            }

            // Elimina las categorias que ya no estan
            foreach ($currentProperties as $cProp) {
                
                $propId = $cProp->category_id;
                $stillExist = FALSE;

                foreach ($categories as $cat) {
                    
                    if ($cat->id == $cProp->category_id) {
                        $stillExist = TRUE;
                    }
                }

                if (!$stillExist) {
                    
                    ProductCategory::where('product_id', $idProd)
                        ->where('category_id', $cProp->category_id)
                        ->delete();
                }
            }
        }
    }

    public function checkStock ()
    {
        $ok = FALSE;

        if ($this->hasSizes) {
            
            $sizes = json_decode(json_encode($this->sizes));
            $qSizesTotal = 0;
            $stock = $this->stock;

            foreach ($sizes as $s) {
                $qSizesTotal += $s->quantity;
            }

            if ($qSizesTotal == $stock) {
                $ok = TRUE;
            }
            else {
                $this->stock = $qSizesTotal;
            }
        }
        else {
            $ok = true;
        }

        return $ok;
    }

    public function getArayProducts ()
    {
        $products = $this->productsRelationed;
        $res = [];

        foreach ($products as $prod) {
            
            $d = new stdClass();
            $d->product_id = $prod['id'];
            array_push($res, $d);
        }

        return $res;
    }

    public function setCoverPhoto($id)
    {
        $this->coverPhoto = $id;
    }

    public function cancel()
    {
        $this->photoToDeleted = null;
        $this->confirmDetelePhoto = false;
    }

    public function confirmDetelePhoto(PhotoProduct $file)
    {
        if (count($this->product->photos()->get()) != 1) {

            if ($file->id != $this->coverPhoto) {
                
                $this->photoToDeleted = $file;
                $this->confirmDetelePhoto = true;
            }
            else {
                $this->toaster('No puedes eliminar la foto de portada del producto', 'error');
            }
        }
        else {
            $this->toaster('No puedes eliminar la única foto del producto', 'error');
        }
    }

    public function destroy()
    {
        $this->dropbox->delete($this->photoToDeleted->filename);
        $this->photoToDeleted->delete();
        $this->toaster("Foto eliminada", "success");
        $this->cancel();
        $this->render();
    }

    public function download($filename)
    {
        return Storage::disk('dropbox')->download($filename);
    }

    public function storePhotos ($product)
    {
        foreach ($this->photos as $photo) {
            
            $path = Storage::disk('dropbox')->putFileAs(
                '/', 
                $photo, 
                $photo->hashName()
            );

            // Creamos el enlace publico en dropbox 
            $response = $this->dropbox->createSharedLinkWithSettings(
                $path,
                ["requested_visibility" => "public"]
            );

            $ph = PhotoProduct::create([
                'product_id' => $product->id,
                'filename' => $photo->hashName(),
                'url' => $response['url']
            ]);

            if (is_null($product->photo_id)) {
                
                $product->photo_id = $ph->id;
                $product->save();
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
        $product->photo_id = $this->coverPhoto;

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

        if ( $this->checkStock() ) {
            
            $product->stock = $this->stock;
            $currentData = !is_null($product->data) ? json_decode($product->data) : new StdClass();

            // Talles
            if ($this->hasSizes) {
                $currentData->sizes = $this->sizes;
            }
            elseif ($isEdit && !$this->hasSizes && isset($currentData->sizes)){
                unset($currentData->sizes);
            }

            // Productos relacionados
            if (!empty($this->productsRelationed)) {
                $currentData->relations = $this->getArayProducts();
            }

            // Guarda el data
            if (!empty($currentData)) {
                $product->data = json_encode($currentData);
            }
        }
        else {
            $this->toaster('La suma de la cantidad de los talles no coincide con la cantidad del stock. Ya se corrigió automáticamente.','error');
            return;
        }

        $product->save();

        // Almacena las fotos
        if (!empty($this->photos)) {
            $this->storePhotos($product);
        }

        $this->addProperties($product->id);
        $this->toaster("Producto editado", "success");
    }

    public function getProductsRelationated ()
    {
        $data = json_decode($this->product->data);
        $res = array();

        if (isset($data->relations)) {
            
            foreach ($data->relations as $prod) {
                
                $product = Product::select('id','name','slug')->where('id', $prod->product_id)->first();

                if (!empty($product)) {
                    array_push($res, $product);
                }
            }
        }

        return $res;
    }

    public function mount (string $slug = NULL)
    {
        $this->properties = Helper::getAllCategories();

        if (!is_null($slug)) {

            $this->product = Product::with('categories', 'photos')->where('slug', $slug)->first();
            $this->coverPhoto = $this->product->photo_id;
            $this->name = $this->product->name;
            $this->URL = $this->product->slug;
            $this->price = $this->product->price;
            $this->salePrice = $this->product->sale_price;
            $this->stock = intval($this->product->stock);
            $this->sizes = isset(json_decode($this->product->data)->sizes) ? json_decode($this->product->data)->sizes : NULL;
            $this->hasSizes = !is_null($this->sizes) ? TRUE : FALSE;
            $this->description = $this->product->description;
            $this->categories = !empty($this->product->categories()->get()) ? $this->product->categories()->get() : new Collection;
            $this->productsRelationed = $this->getProductsRelationated();
        }
        else {
            $this->hasSizes = false;
        }

        $this->products =  !is_null($this->product) ? Product::where('id', '<>', $this->product->id)->get() : Product::all();

    }

    public function render()
    {
        return view('livewire.edit-my-products');
    }
}
