<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Tipo_tarifa;

class OtroController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index(){
        echo "loquesea";
    }
    public function listar(){
        $tarifa = Tipo_tarifa::all();
        echo "<pre>";
        print_r($tarifa);
        echo "<pre>";

    }
}
