<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alertas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo');
            $table->string('tipo');
            $table->string('alerta', '255');
            $table->unsignedInteger('estado');
            $table->string('respuesta', '255')->nullable();
            $table->unsignedInteger('sucursales_id');
            $table->unsignedInteger('trabajadores_id');
            $table->foreign('sucursales_id', 'fk_alertas_sucursales')->references('id')->on('sucursales')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign('trabajadores_id', 'fk_alertas_trabajadores')->references('id')->on('trabajadores')->onUpdate('restrict')->onDelete('restrict');
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
        Schema::dropIfExists('alertas');
    }
}
