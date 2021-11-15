<?php

namespace App\Observers;

use App\Models\Order;
use App\Models\UserCart;
use Helper;

class UserCartObserver
{
    /**
     * Handle the UserCart "created" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function created(UserCart $userCart)
    {
        Order::create([
            'user_cart_id' => $userCart->id,
            'status_id' => Helper::getProperties('OSTA','CART')->id,
            'total_amount' => $userCart->amount
        ]);
    }

    /**
     * Handle the UserCart "updated" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function updated(UserCart $userCart)
    {
        //
    }

    /**
     * Handle the UserCart "deleted" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function deleted(UserCart $userCart)
    {
        //
    }

    /**
     * Handle the UserCart "restored" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function restored(UserCart $userCart)
    {
        //
    }

    /**
     * Handle the UserCart "force deleted" event.
     *
     * @param  \App\Models\UserCart  $userCart
     * @return void
     */
    public function forceDeleted(UserCart $userCart)
    {
        //
    }
}
