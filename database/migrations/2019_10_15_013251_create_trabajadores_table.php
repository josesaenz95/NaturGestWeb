<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrabajadoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trabajadores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rut', 10);
            $table->string('nombre', 50);
            $table->string('ap_pat', 50);
            $table->string('ap_mat', 50);
            $table->unsignedInteger('telefono');
            $table->string('direccion', 50);
            $table->unsignedInteger('n_direccion');
            $table->string('correo', 100)->unique()->nullable();
            $table->unsignedInteger('turnos_id')->nullable();
            $table->unsignedInteger('sucursales_id');
            $table->unsignedInteger('users_id');
            $table->foreign('turnos_id', 'fk_trabajadores_turnos')->references('id')->on('turnos')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('sucursales_id', 'fk_trabajadores_sucursales')->references('id')->on('sucursales')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('users_id', 'fk_trabajadores_users')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('trabajadores');
    }
}
