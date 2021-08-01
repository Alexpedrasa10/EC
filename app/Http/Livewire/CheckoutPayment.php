<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\CartProduct;
use App\Models\Province;
use App\Models\City;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Actions\Jetstream\Pay; 
use stdClass;

class CheckoutPayment extends Component
{   
    public $user, $cart, $products;

    public $provinces, $cities;

    // Form shipping
    public $province, $city, $adress, $references, $piso, $departmento, $zipCode;

    protected $rules = [
        'province' => 'required|int',
        'ciudad' => 'required|int',
        'adress' => 'required|min:10',
    ];

    public function setCity($id)
    {
        $this->city = $id;
    }

    public function getCities($provinceId)
    {
        $this->province = $provinceId;
        $this->cities = City::where('province_id', $provinceId)->get();
    }

    public function mount()
    {
        $this->user = User::where('id', Auth::user()->id)->first();
        $this->cart = $this->user->cart()->first();
        $this->products = CartProduct::with('product')->where('user_cart_id', $this->cart->id)->get();
        $this->provinces = Province::all();
    }

    public function render()
    {
        return view('livewire.checkout-payment');
    }
}
