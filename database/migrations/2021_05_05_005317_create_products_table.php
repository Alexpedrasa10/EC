<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longtext('description');
            $table->decimal('stock');
            $table->float('price');
            $table->float('sale_price')->nullable();
            $table->string('code')->nullable();
            $table->jsonb('data')->nullable();
            $table->integer('photo_id');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(array('slug', 'code'), 'product_index');
            $table->index(array('photo_id'), 'photo_product_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
