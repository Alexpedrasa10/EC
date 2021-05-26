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
    public $categories, $user, $sizeProducts = array();

    use WithPagination;

    public function addProductToCart(int $idProduct)
    {
        $user = $this->user;
        $cart = $user->cart()->first();
        $product = Product::where('id', '=', $idProduct)->first();

        if ( $this->checkProductSize($idProduct, FALSE) ) {
        
            if (!empty($cart)){

                $productCart = CartProduct::where('user_cart_id', '=', $cart->id)
                    ->where('product_id', '=', $product->id)
                    ->first();
                
                if (empty($productCart)){
    
                    $newProductCart = new CartProduct();
                    $newProductCart->user_cart_id = $cart->id;
                    $newProductCart->product_id = $product->id;
                    $newProductCart->quantity = 1;
                    $newProductCart->sizes = $this->getSizeJSON($idProduct);
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
                    $productCart->sizes = $this->checkSizesInCart($productCart->sizes, $idProduct);
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
                $newProductCart->sizes = $this->getSizeJSON($idProduct);
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
            $value->sizes = json_decode($value->sizes);
            array_push($arr, $value);
        }

        return $arr;
    }

    public function setProductSizes(int $idProduct, string $size)
    {
        if ( !$this->checkProductSize($idProduct, TRUE, $size) ) {
           
            $obj = new stdClass;
            $obj->product_id = $idProduct;
            $obj->size = $size;
            array_push($this->sizeProducts, $obj);
        }
    }

    public function checkProductSize( int $idProduct, bool $update, string $size = NULL )
    {
        $exist = FALSE;

        if (!empty($this->sizeProducts)) {

            foreach ($this->sizeProducts as $key => $value) {

                if ($value['product_id'] == $idProduct){
    
                    $exist = TRUE;
    
                    if ($update){
                        
                        if (!is_null($size)) {
                            $this->sizeProducts[$key]['size'] = $size;
                        }
                    }
                }
            }
        }


        return $exist;
    }

    public function getSizeJSON( int $idProduct, bool $onlySize = NULL) :string
    {
        $res = NULL;

        foreach ($this->sizeProducts as $key => $value) {

            if ($value['product_id'] == $idProduct){

                $size = $value['size'];

                if (is_null($onlySize)) {
                    $obj = new StdClass;
                    $obj->$size = 1;
                    return json_encode($obj);
                }
                else{
                    return $size;
                }
            }
        }
    }

    public function checkSizesInCart($productSizes, int $idProduct) :string
    {
        $sizes = json_decode($productSizes);
        $current_size = $this->getSizeJSON($idProduct, TRUE);

        // Si está ese talle, aumenta la cantidad
        foreach ($sizes as $size => $q) {
            
            if ($size == $current_size) {

                $sizes->$current_size++;
                return json_encode($sizes);
            }
        }

        $sizes->$current_size = 1;
        return json_encode($sizes);
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
