<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipoVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tipo_venta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo', 30);
            $table->unsignedInteger('metodo_pago_id');
            $table->foreign('metodo_pago_id', 'fk_tipo_venta_meotodo_pago')->references('id')->on('metodo_pago')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('tipo_venta');
    }
}
