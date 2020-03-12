<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComprasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->unsignedInteger('facturas_bn_id');
            $table->unsignedInteger('sucursales_id');
            $table->unsignedInteger('proveedores_id');
            $table->foreign('facturas_bn_id', 'fk_compras_facturas_bn')->references('id')->on('facturas_bn')->onDelete('restrict')->onUpdate('restrict');;
            $table->foreign('sucursales_id', 'fk_compras_sucursales')->references('id')->on('sucursales')->onDelete('restrict')->onUpdate('restrict');;
            $table->foreign('proveedores_id', 'fk_compras_proveedores')->references('id')->on('proveedores')->onDelete('restrict')->onUpdate('restrict');;
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
        Schema::dropIfExists('compras');
    }
}
