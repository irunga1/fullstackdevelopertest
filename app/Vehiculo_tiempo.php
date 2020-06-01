<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Vehiculo_tiempo extends Model
{
    //
    protected $table = "vehiculo_tiempo";
    public  function vehiculo_id(){
        return $this->hasOne('App\Vehiculo');
    }
}
