<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = ["rut", "nombre", "telefono", "correo"];

    public function dirProveedores(){
        return $this->hasMany('App\DirProveedor');
    }
}
