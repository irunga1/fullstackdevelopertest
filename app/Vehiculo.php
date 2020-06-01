<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    //
    protected $table = "vehiculo";
    public  function tipo_tarifa(){
        return $this->hasOne('App\Tipo_tarifa');
    }
}
