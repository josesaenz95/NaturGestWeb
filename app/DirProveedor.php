<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DirProveedor extends Model
{
    protected $table = "dir_proveedores";
    protected $fillable = ["direccion", "n_dir", 
                           "ciudad", "proveedores_id"];
    public function proveedor(){
        return $this->belongsTo('App\Proveedor');
    }
}
