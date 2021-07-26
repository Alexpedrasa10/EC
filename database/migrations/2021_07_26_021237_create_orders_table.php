<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->unsignedBigInteger('method_id');
            $table->unsignedBigInteger('user_cart_id');
            $table->unsignedBigInteger('status_id');
            $table->jsonb('data')->nullable();
            $table->longtext('payment_id')->nullable();
            $table->timestamps();

            $table->foreign('user_cart_id')->references('id')->on('user_cart');
            $table->foreign('status_id')->references('id')->on('properties');
            $table->foreign('method_id')->references('id')->on('properties');
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
