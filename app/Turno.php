<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    

    public function trabajadores()
    {
        return $this->hasMany('App\Trabajador');
    }
}
