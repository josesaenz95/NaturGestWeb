<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductoVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producto_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('productos_id');
            $table->unsignedInteger('ventas_id');
            $table->foreign('productos_id', 'fk_vp_productos')->references('id')->on('productos')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('ventas_id', 'fk_vp_ventas')->references('id')->on('ventas')->onUpdate('restrict')->onDelete('restrict');
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
        Schema::dropIfExists('producto_venta');
    }
}
