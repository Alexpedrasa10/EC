<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cart_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_cart_id');
            $table->unsignedBigInteger('product_id');
            $table->decimal('quantity');
            $table->decimal('amount');
            $table->jsonb('data')->nullable();
            $table->timestamps();

            $table->foreign('user_cart_id')->references('id')->on('user_cart');
            $table->foreign('product_id')->references('id')->on('products');

            $table->index(array('product_id', 'user_cart_id', 'quantity'), 'cart_product_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cart_products');
    }
}
