<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_producto', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('compras_id');
            $table->unsignedInteger('productos_id');
            $table->foreign('compras_id', 'fk_cp_compras')->references('id')->on('compras')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('productos_id', 'fk_cp_productos')->references('id')->on('productos')->onUpdate('restrict')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compra_producto');
    }
}
