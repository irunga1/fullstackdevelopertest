<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tipo_tarifa;
use App\Vehiculo;

class TipotarifaController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index(){
        $tipotarifa = Tipo_tarifa::select('*')->get();
        return view("tipotarifa.list",compact('tipotarifa'));

    }
    public function insertar(){

        $action = "insert";
        $message ="";
        return view('tipotarifa.insert',compact('action',"message"));
    }
    public function modificar($id){
        $tipotarifa = Tipo_tarifa::find($id);
        $action = "modifcar";
        if(isset($tipotarifa)){
            return view('tipotarifa.insert',compact('action','tipotarifa','id'));
        }
        else{
            return redirect('tipotarifa');
        }
    }
    public function insertpost(Request $request){
        $post = $request->all();
        $validateData = $request->validate([
            'desc'=>'required|max:50|min:5',
            'monto'=>'required|numeric'
        ]);
        $tipotarifa = new Tipo_tarifa();
        $tipotarifa->desc = $validateData["desc"];
        $tipotarifa->monto = $validateData["monto"];
        $tipotarifa->save();
        return redirect()->back()->with('message', 'Insercion Exitosa !');
    }
    public function insertput(Request $request, $id){
        $post = $request->all();
        $p = "unique:vehiculo,placa,$id";
        $validateData = $request->validate([
            'desc'=>'required|max:50|min:5',
            'monto'=>'required|numeric'
        ]);
        Tipo_tarifa::where("id","=",$id)->update($validateData);
        return redirect()->back()->with('message', 'Actualizacion Exitosa!');
    }
}
