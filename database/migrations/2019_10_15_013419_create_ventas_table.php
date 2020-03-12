<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->decimal('neto');
            $table->decimal('iva');
            $table->decimal('total', 8, 2);
            $table->unsignedInteger('trabajadores_id');
            $table->unsignedInteger('sucursales_id');
            $table->unsignedInteger('clientes_id')->nullable();
            $table->unsignedInteger('tipo_venta_id');
            $table->foreign('trabajadores_id', 'fk_ventas_trabajadores')->references('id')->on('trabajadores')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('sucursales_id', 'f_ventas_sucursales')->references('id')->on('sucursales')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('clientes_id', 'fk_ventas_clientes')->references('id')->on('clientes')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('tipo_venta_id', 'fk_ventas_tipo_venta')->references('id')->on('tipo_venta')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('ventas');
    }
}
