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
        
            if (!empty($cart)){

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

    public function getProducts($products) :Array
    {
        $arr = array();

        foreach ($products as $key => $value) {

            $data = json_decode($value->data);
            $colors = array();
            $sizess = array();
            $current_color =  $this->checkDataProducts($value->id, FALSE, NULL, NULL, TRUE);

            foreach ($data as $colorin => $sizes) {
                array_push($colors, $colorin);
                $sizess[$colorin] = $sizes;
            }

            $product = new StdClass();
            $product->price = $value->price;
            $product->colors = $colors;
            $product->id = intval($value->id);
            $product->sizes = $sizess;
            $product->url_photos = $value->url_photos;
            $product->name = $value->name;
            $product->slug = $value->slug;
            $product->current_color = $current_color ? $current_color : $product->colors[0];

            array_push($arr, $product);
        }

        return $arr;
    }

    public function setCurrentColor(int $idProduct, string $color)
    {
        if ( !$this->checkDataProducts($idProduct, TRUE, $color) ) {
           
            $obj = new stdClass;
            $obj->product_id = $idProduct;
            $obj->color = $color;
            array_push($this->dataProducts, $obj);
        }
        else{
            $this->checkDataProducts($idProduct, TRUE, $color);
        }
    }

    public function setProductSizes(int $idProduct, string $color, string $size)
    {
        if ( !$this->checkDataProducts($idProduct, TRUE, $color, $size) ) {
           
            $obj = new stdClass;
            $obj->product_id = $idProduct;
            $obj->color = $color;
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

                        if (!is_null($get) && $get) {
                            return $value['color'];
                        }
                
                        if ($update){
                            
                            if (!is_null($size)) {
                                $this->dataProducts[$key]['size'] = $size;
                                $exist = TRUE;
                            }
    
                            if (!is_null($color)) {

                                if ($value['color'] != $color) {
                                    $this->dataProducts[$key]['color'] = $color;
                                    $exist = TRUE;
                                }
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

                        if (!is_null($get) && $get) {
                            return $value->color;
                        }
        
                        $exist = TRUE;
        
                        if ($update){
                            
                            if (!is_null($size)) {
                                $this->dataProducts[$key]['size'] = $size;
                                $exist = TRUE;
                            }
    
                            if (!is_null($color)) {
                                
                                if ($vale->color != $color) {
                                    $this->dataProducts[$key]['color'] = $color;
                                    $exist = TRUE;
                                }
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
                $current_color = $value['color'];

                if (is_null($onlySize)) {
                    $arr = array();
                    $arr['quantity'] = 1;
                    $arr['size'] = $size;
                    $arr['color'] = $value['color'];
                    array_push($data, $arr);
                    return json_encode($data);
                }
                elseif($onlySize){
                    return $size;
                }
                elseif($color){
                    return $current_color;
                }
            }
        }
    }

    public function checkDataInCart($productSizes, int $idProduct) :string
    {
        $data = json_decode($productSizes);
        $current_size = $this->getSizeJSON($idProduct, TRUE);
        $current_color = $this->getSizeJSON($idProduct, FALSE, TRUE);

        // Si está ese talle y color, aumenta la cantidad
        foreach ($data as $key => $order) {

            if ($order->size == $current_size && $order->color == $current_color) {

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
        $this->user = User::where('id', '=', Auth::user()->id)->first();

        return view('livewire.products', [ 
            'products' => $products->paginate(5)
        ]);
    }
}
