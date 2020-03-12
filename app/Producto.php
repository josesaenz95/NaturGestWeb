<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ["nombre", "marca","descripcion", 
                           "stock", "valor", "sucursales_id", "categorias_id"];

    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }
}
