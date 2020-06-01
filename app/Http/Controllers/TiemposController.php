<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Tipo_tarifa;


class TiemposController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        echo "listar";
    }
    public function insertar(){

    }
    public function insertpost(){

    }
}
