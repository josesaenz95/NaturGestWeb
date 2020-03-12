<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $fillable = ["fecha", "facturas_bn_id", "sucursales_id", "proveedores_id"];

    public function facturaBn(){
        return $this->belongsTo('App\FacturaBn');
    }
    
}
