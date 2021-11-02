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
use Helper;
use App\Models\Order;
use App\Models\UserAdress;

class CheckoutPayment extends Component
{   
    public $user, $cart, $products, $paymentMethods, $steps = 1, $userAddress, $order;

    public $provinces, $cities;

    // Form shipping
    public $province, $city, $adress, $references, $piso, $departmento, $zipCode;

    protected $rules = [
        'province' => 'required|int',
        'city' => 'int',
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

    public function pay ($methodId)
    {
        $order = $this->cart->order()->first();
        $statusOrder = Helper::getProperties('OSTA', 'PROC')->id;
        $assetId = Helper::getAssetId($methodId);
        $totalAmount = Helper::getTotalAmount($this->cart->amount, $methodId, $assetId);

        // Crea o actualiza la orden
        if (!empty($order)) {
            
            $order->method_id = $methodId;
            $order->adress_id = $this->userAddress->id;
            $order->status_id = $statusOrder;
            $order->asset_id = $assetId;
            $order->total_amount = $totalAmount;
            $order->save();
        }
        else {

            $order = Order::create([
                'user_cart_id' => $this->cart->id,
                'method_id' => $methodId,
                'adress_id' => $this->userAddress->id,
                'status_id' => $statusOrder,
                'asset_id' => $assetId,
                'total_amount' => $totalAmount
            ]);
        }

        $pay = new Pay();
        $pay->createOrder($order);
    }

    public function getLogo($methodName)
    {
        
        return asset("img/{$methodName}.png");
    }


    public function saveAddress ()
    {
        $this->validate();

        if ($this->checkAdress()) {
            
            // Guardamos la direccion del pedido
            $this->userAddress = UserAdress::firstOrCreate([
                'user_id' => $this->user->id,
                'province_id' => $this->province,
                'city_id' => $this->city,
                'zip_code' => $this->zipCode,
                'adress' => $this->adress,
                'references' => $this->references
            ]);

            $this->steps = 2;
            $this->toaster('Dirección guardada', 'success');
        }
    }

    public function checkAdress() :bool
    {
        $province = Province::where('id', $this->province)->first();
        $hasCities = $province->cities()->get();
        $ok = false;

        if (!empty($hasCities)) {
            
            foreach ($hasCities as $city) {
                
                if ($city->id == $this->city) {
                    $ok = true;
                }
            }
        }
        else {
            $this->city = null;
            $ok = true;
        }

        return $ok;
    }

    public function toaster(string $title, string $type)
    {
        $this->dispatchBrowserEvent('alert',[
            'title' => $title,
            'type'=> $type, 
        ]);
    }

    public function checkUserAddress (UserAdress $uAddress = null)
    {
        if (is_null($uAddress)) $uAddress = $this->user->adress()->first();

        if (!empty($uAddress)) {

            $this->province = $uAddress->province_id;
            $this->city = $uAddress->city_id;
            $this->zipCode = (int)$uAddress->zip_code;
            $this->adress = $uAddress->adress;
            $this->references = $uAddress->references;
            $this->userAddress = $uAddress;
        }
    }

    public function mount()
    {
        $this->user = User::whereId(Auth::user()->id)->first();
        $this->paymentMethods = Helper::getPaymentMethods();

        if (!is_null($this->user)) {
            
            $this->cart = $this->user->cart()->first();
            $this->order = $this->user->order()->first();
            $this->products = CartProduct::with('product')->where('user_cart_id', $this->cart->id)->get();
            $this->provinces = Province::all();

            if (!is_null($this->order) && !is_null($this->order->adress_id)) {

                $this->userAddress = UserAdress::whereId($this->order->adress_id)->first();
                $this->steps = 2;
                $this->checkUserAddress($this->userAddress);
            }
            else {

                if ($this->order) $this->checkUserAddress();
            }
        }
       
    }

    public function render()
    {
        return view('livewire.checkout-payment');
    }
}
