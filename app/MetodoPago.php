<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MetodoPago extends Model
{
    public function tiposVenta(){
        return $this->hasMany('App\TipoVenta');
    }
}
