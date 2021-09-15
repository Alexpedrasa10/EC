<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhotoProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_products', function (Blueprint $table) {

            $table->id();
            $table->text('filename')->nullable(true);
            $table->string('url');
            $table->unsignedBigInteger('product_id')->nullable(true);
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products');
            $table->index(array('product_id'), 'product_photo_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photo_products');
    }
}
