<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_cart', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->float('amount');
            $table->boolean('buy')->nullable();
            $table->boolean('canceled')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->index(array('user_id'), 'user_cart_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_cart');
    }
}
