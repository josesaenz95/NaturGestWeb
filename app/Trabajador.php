<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trabajador extends Model
{
    protected $table = "trabajadores";

    protected $fillable = ["rut", "nombre", "ap_pat", "ap_mat",
                           "telefono", "direccion", "n_direccion", "correo", "sucursales_id", "users_id"];

    public function alertas(){
        return $this->hasMany("App\Alerta");
    }
    
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function turno(){
        return $this->belongsTo("App\Turno");
    }

    public function sucursal(){
        return $this->belongsTo('App\Sucursal');
    }
}
