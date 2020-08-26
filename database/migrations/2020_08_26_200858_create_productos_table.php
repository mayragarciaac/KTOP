<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->integer('idProducto')->unsigned();
            $table->integer('sku')->nullable();
            $table->string('brand',50)->nullable();
            $table->string('model',50)->nullable();
            $table->string('description');
            $table->integer('category');
            $table->integer('stockUnits');
            $table->primary(array('idProducto'));
        });
        DB::statement('ALTER TABLE productos MODIFY idProducto INTEGER NOT NULL AUTO_INCREMENT');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
