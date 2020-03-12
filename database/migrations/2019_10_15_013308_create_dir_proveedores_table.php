<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirProveedoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dir_proveedores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('direccion', 50);
            $table->unsignedInteger('n_dir');
            $table->string('ciudad', 50);
            $table->unsignedInteger('proveedores_id');
            $table->foreign('proveedores_id', 'fk_dir_proveedores_proveedores')->references('id')->on('proveedores')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('dir_proveedores');
    }
}
