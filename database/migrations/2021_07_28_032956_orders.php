<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Orders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('method_id')->nullable();
            $table->unsignedBigInteger('user_cart_id');
            $table->unsignedBigInteger('adress_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->jsonb('data')->nullable();
            $table->longtext('payment_id')->nullable();
            $table->unsignedBigInteger('asset_id')->nullable();
            $table->float('total_amount');
            $table->timestamps();

            $table->foreign('user_cart_id')->references('id')->on('user_cart');
            $table->foreign('status_id')->references('id')->on('properties');
            $table->foreign('asset_id')->references('id')->on('properties');
            $table->foreign('method_id')->references('id')->on('properties');
            $table->foreign('adress_id')->references('id')->on('user_adresses');

            $table->index(array('method_id', 'user_cart_id', 'adress_id', 'status_id'), 'order_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
