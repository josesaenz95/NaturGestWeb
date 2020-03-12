<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura_bn extends Model
{
    protected $table = "facturas_bn";
    protected $fillable = ["folio", "total", "documento"];

    public function compra(){
        return $this->hasOne('App\Compra');
    }
}
