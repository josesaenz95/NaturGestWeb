<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    protected $table = "alertas";

    protected $fillable = ['titulo', 'alerta', 'estado', 
                           'respuesta', 'trabajadores_id', 'sucursales_id'];

    public function trabajador(){
        return $this->belongsTo('App\Trabajador');
    }
}
