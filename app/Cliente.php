<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = ["rut", "nombre", "ap_pat", "ap_mat",
                           "telefono", "direccion", "n_dir", "correo"];

    
}
