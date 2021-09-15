<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {

            $table->id();
            $table->string('category');
            $table->string('code');
            $table->string('name');
            $table->jsonb('data')->nullable(true);
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->index(array('category', 'code'), 'propertie_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
