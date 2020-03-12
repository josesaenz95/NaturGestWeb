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
            $table->increments('id');
            $table->string('nombre', 50);
            $table->string('marca', 50);
            $table->string('descripcion');
            $table->unsignedInteger('stock');
            $table->unsignedInteger('valor');
            $table->unsignedInteger('sucursales_id');
            $table->unsignedInteger('categorias_id');
            $table->foreign('sucursales_id', 'fk_productos_sucursales')->references('id')->on('sucursales')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('categorias_id', 'fk_productos_categorias')->references('id')->on('categorias')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('productos');
    }
}
