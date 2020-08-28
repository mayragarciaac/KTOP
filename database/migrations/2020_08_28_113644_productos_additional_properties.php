<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProductosAdditionalProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos_additional_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idProducto')->nullable(false);
            $table->integer('idPropertie')->nullable(false);
            $table->string('value',200);
            $table->unique(array('id'));
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos_additional_properties');
    }
}
