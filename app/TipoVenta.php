<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoVenta extends Model
{
    public function MetodoPago(){
        return $this->belongsTo('App\MetodoPago');
    }
}
