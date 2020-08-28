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
            $table->string('name',50)->nullable();
            $table->integer('sku')->nullable();
            $table->string('brand',50)->nullable();
            $table->string('model',50)->nullable();
            $table->string('description')->default('');
            $table->integer('stockUnits')->default(0);
            $table->integer('category')->nullable(false);
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
