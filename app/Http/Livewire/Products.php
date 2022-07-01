<?php

namespace App\Http\Livewire;

use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Property;
use App\Models\Category;
use App\Models\User;
use App\Models\UserCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use stdClass;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Products extends Component
{
    public $categories, $categoriesFilter = [], $user, $cart, $dataProducts = array();

    use WithPagination;
    public $filter = null, $priceLimit, $page = 1, $until = null, $since = null,
    $category = "";

    protected $queryString = [
        'filter' => ['except' => null],
        'page' => ['except' => 1],
        'until' => ['except' => null],
        'since' => ['except' => null],
        'category' => ['except' => '']
    ];

    public function addProductToCart(int $idProduct)
    {
        if (empty($this->user)) {
            
            $this->dispatchBrowserEvent('alert',[
                'title' => 'Debes iniciar sesión para agregar productos al carrito.',
                'type'=>'error', 
            ]);
            return;
        }

        $product = Product::find($idProduct);

        if ( $this->checkDataProducts($idProduct, FALSE) ) {
            

            if (empty($this->cart->id)){
                $this->cart->user_id = $this->user->id;
                $this->cart->amount = 0;
                $this->cart->save();
            }

            if (!empty($product->sale_price)) {
                $product->price = $product->sale_price;
            }    
        
            $productCart = CartProduct::where('user_cart_id', '=', $this->cart->id)
                    ->where('product_id', '=', $product->id)
                    ->first();
                
                if (empty($productCart)){
    
                    $newProductCart = new CartProduct();
                    $newProductCart->user_cart_id = $this->cart->id;
                    $newProductCart->product_id = $product->id;
                    $newProductCart->quantity = 1;
                    $newProductCart->data = $this->getSizeJSON($idProduct);
                    $newProductCart->amount += $product->price;
                    $newProductCart->save();
    
                    $this->cart->amount += $product->price;
                    $this->cart->save();
    
                    $this->dispatchBrowserEvent('alert',[
                        'title' => 'Producto agregado al carrito.',
                        'type'=>'success', 
                    ]);
                }
                else{
    
                    if ( $this->checkStock($productCart->data, $product->data, $idProduct) ) {

                        $productCart->quantity++;
                        $productCart->data = $this->checkDataInCart($productCart->data, $idProduct);
                        $productCart->amount = $productCart->amount + $product->price;
                        $productCart->save();
        
                        $this->cart->amount += $product->price;
                        $this->cart->save();
        
                        $this->dispatchBrowserEvent('alert',[
                            'title' => 'Producto agregado al carrito.',
                            'type'=>'success', 
                        ]);
                    }
                    else{
                        $this->dispatchBrowserEvent('alert',[
                            'title' => 'No hay mas unidades disponibles para este talle.',
                            'type'=>'error', 
                        ]);
                    }
                }

            $this->emit('showCartBanner');
        }
        else{
            $this->dispatchBrowserEvent('alert',[
                'title' => 'Tienes que elegir un talle.',
                'type'=>'error', 
            ]);
        }
    }

    public function checkStock ($orderCart, $stockData, $idProduct )
    {
        $hasStock = FALSE;
        $current_size = $this->getSizeJSON($idProduct, TRUE);
        $dataOrder = json_decode($orderCart);
        $dataStock = json_decode($stockData)->sizes;
        $quantitySize = NULL;

        // Checkea que este en el cart_product.data
        foreach ($dataOrder as $order) {
            
            if ($order->size == $current_size) {
                
                $quantitySize = $order->quantity;
            }
        }

        if (!is_null($quantitySize)) {
            
            foreach ($dataStock as $stock) {
                
                if ($stock->size == $current_size) {
                    
                    $avalaible = $stock->quantity - $quantitySize;

                    if ($avalaible > 1) {
                        return $hasStock = TRUE;
                    }
                }
            }
            
        }
        else{
            $hasStock = TRUE;
        }

        return $hasStock;
    }

    public function setProductSizes(int $idProduct, string $size)
    {
        if ( !$this->checkDataProducts($idProduct, TRUE, NULL, $size) ) {
           
            $obj = new stdClass;
            $obj->product_id = $idProduct;
            $obj->size = $size;
            array_push($this->dataProducts, $obj);
        }
    }

    public function checkDataProducts( int $idProduct, bool $update, string $color = NULL, string $size = NULL, bool $get = NULL )
    {
        $exist = FALSE;

        if (!empty($this->dataProducts)) {

            foreach ($this->dataProducts as $key => $value) {

                $value = (array)$value;

                if ($value['product_id'] == $idProduct){
                
                    if ($update){
                        
                        if (!is_null($size)) {
                            $this->dataProducts[$key]['size'] = $size;
                            $exist = TRUE;
                        }
                    }
                    else {

                        if (isset($value['size'])) {
                           $exist = TRUE;
                        }
                    }
                }
            }
        }


        return $exist;
    }

    public function getSizeJSON( int $idProduct, bool $onlySize = NULL, bool $color = NULL) :string
    {
        $res = NULL;
        $data = array();

        foreach ($this->dataProducts as $key => $value) {

            if ($value['product_id'] == $idProduct){

                $size = $value['size'];

                if (is_null($onlySize)) {
                    $arr = array();
                    $arr['quantity'] = 1;
                    $arr['size'] = $size;
                    array_push($data, $arr);
                    return json_encode($data);
                }
                elseif($onlySize){
                    return $size;
                }
            }
        }
    }

    public function getFilteredProducts ()
    {
        $products = Product::with('categories');
        
        if (!empty($this->categoriesFilter)) {

            $this->category = implode(' ', $this->categoriesFilter);

            $products->whereHas('categories', function ($query) {
                return $query->whereIn('code', $this->categoriesFilter);
            });
        }
        
        if (!is_null($this->filter)) {
            
            if ($this->filter == "sale") {
                $products->whereNotNull('sale_price');
            }
    
            if ($this->filter == "priceLower") {
                $products->orderBy('price', 'ASC');
            }
    
            if ($this->filter == "priceHigher") {
                $products->orderBy('price', 'DESC');
            }
        }

        if (!is_null($this->until) || !empty($this->until)) {
            $products->where('price', '>=', $this->until);
        }

        if (!is_null($this->since) || !empty($this->since)) {
            $products->where('price', '<=', $this->since);
        }
        
        return $products;
    }

    public function checkDataInCart($productSizes, int $idProduct) :string
    {
        $data = json_decode($productSizes);
        $current_size = $this->getSizeJSON($idProduct, TRUE);

        // Si está ese talle , aumenta la cantidad
        foreach ($data as $key => $order) {

            if ($order->size == $current_size) {

                $order->quantity++;
                return json_encode($data);
            }
        }

        $newData = json_decode($this->getSizeJSON($idProduct));
        array_push($data, $newData[0]);
        return json_encode($data);
    }

    public function mount ($category)
    {
        if (Auth::user()) {
            $this->user = User::find(Auth::user()->id);
            $this->cart = !empty($this->user->cart()->first()) ? $this->user->cart()->first() : new UserCart();
        }

        if (!is_null($category)) array_push($this->categoriesFilter, $category);
    }

    public function render()
    {
        $products = $this->getFilteredProducts();

        return view('livewire.products', [ 
            'products' => $products->paginate(9)
        ]);
    }
}
