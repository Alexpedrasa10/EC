<?php

namespace App\Http\Livewire;

use App\Models\CartProduct;
use App\Models\Product;
use App\Models\Property;
use App\Models\User;
use App\Models\UserCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use stdClass;
use Livewire\WithPagination;

class Products extends Component
{
    public $categories, $user, $dataProducts = array();

    use WithPagination;

    public function addProductToCart(int $idProduct)
    {
        $user = $this->user;
        $cart = $user->cart()->first();
        $product = Product::where('id', '=', $idProduct)->first();

        if ( $this->checkDataProducts($idProduct, FALSE) ) {
        
            if (!is_null($cart)){

                $productCart = CartProduct::where('user_cart_id', '=', $cart->id)
                    ->where('product_id', '=', $product->id)
                    ->first();
                
                if (empty($productCart)){
    
                    $newProductCart = new CartProduct();
                    $newProductCart->user_cart_id = $cart->id;
                    $newProductCart->product_id = $product->id;
                    $newProductCart->quantity = 1;
                    $newProductCart->data = $this->getSizeJSON($idProduct);
                    $newProductCart->amount = $product->price;
                    $newProductCart->save();
    
                    $cart->amount = $cart->amount + $product->price;
                    $cart->save();
    
                    $this->dispatchBrowserEvent('alert',[
                        'title' => 'Producto agregado al carrito.',
                        'type'=>'success', 
                    ]);
                }
                else{
    
                    $productCart->quantity++;
                    $productCart->data = $this->checkDataInCart($productCart->data, $idProduct);
                    $productCart->amount = $productCart->amount + $product->price;
                    $productCart->save();
    
                    $cart->amount += $product->price;
                    $cart->save();
    
                    $this->dispatchBrowserEvent('alert',[
                        'title' => 'Producto agregado al carrito.',
                        'type'=>'success', 
                    ]);
                }
            }
            else{
    
    
                $newCart = new UserCart();
                $newCart->user_id = $user->id;
                $newCart->amount = $product->price;
                $newCart->save();
    
                $newProductCart = new CartProduct();
                $newProductCart->user_cart_id = $newCart->id;
                $newProductCart->product_id = $product->id;
                $newProductCart->quantity = 1;
                $newProductCart->data = $this->getSizeJSON($idProduct);
                $newProductCart->amount = $product->price;
                $newProductCart->save();
    
                $this->dispatchBrowserEvent('alert',[
                    'title' => 'Producto agregado al carrito.',
                    'type'=>'success', 
                ]);
            }
        }
        else{
            $this->dispatchBrowserEvent('alert',[
                'title' => 'Tienes que elegir un talle.',
                'type'=>'error', 
            ]);
        }
    }

    // Metodo para obtener un objeto de todos los productos
    public function getProducts($products) :Array
    {
        $arr = array();

        foreach ($products as $key => $value) {

            $data = json_decode($value->data);
            $sizes = array();

            foreach ($data->sizes as $size) {
                array_push($sizes, $size);
            }

            $product = new StdClass();

            if (!is_null($value->sale_price)) {
                $product->price = $value->sale_price;
                $product->old_price = $value->price;
                $product->sale = TRUE;
            }
            else{
                $product->price = $value->price;
            }

            $product->id = intval($value->id);
            $product->sizes = $sizes;
            $product->url_photos = $value->url_photos;
            $product->name = $value->name;
            $product->slug = $value->slug;

            array_push($arr, $product);
        }

        return $arr;
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

                if (gettype($value) == "array") {
                    
                    if ($value['product_id'] == $idProduct){
                
                        if ($update){
                            
                            if (!is_null($size)) {
                                $this->dataProducts[$key]['size'] = $size;
                                $exist = TRUE;
                            }
                        }
                        elseif($update == FALSE){

                            if (isset($value['size'])) {
                               $exist = TRUE;
                            }
                        }
                    }
                }
                else{

                    if ($value->product_id == $idProduct){
        
                        $exist = TRUE;
        
                        if ($update){
                            
                            if (!is_null($size)) {
                                $this->dataProducts[$key]['size'] = $size;
                                $exist = TRUE;
                            }
                        }
                        elseif($update == FALSE){

                            if (isset($value->size)) {
                               $exist = TRUE;
                            }
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

    public function render()
    {
        $products = Product::where('is_active', 1);
        $this->categories = Property::all();

        if (Auth::user()){
            $this->user = User::where('id', '=', Auth::user()->id)->first();
        }

        return view('livewire.products', [ 
            'products' => $products->paginate(10)
        ]);
    }
}
