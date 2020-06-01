<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Tipo_tarifa;
use App\Vehiculo;
class VehiculoController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index(){
        $vehiculos = Vehiculo::select('vehiculo.id','vehiculo.placa','vehiculo.propietario','vehiculo.contacto','tipo_tarifa.desc')->join('tipo_tarifa', 'tipo_tarifa.id', '=', 'vehiculo.tipo_tarifa_id')->get();
        return view("vehiculos.list",compact('vehiculos'));
        // dd($vehiculos);
    }
    public function insertar(){
        $tarifa = Tipo_tarifa::all();
        $action = "insert";
        $message ="";
        return view('vehiculos.insert',compact('tarifa','action',"message"));
    }
    public function modificar($id){
        $tarifa = Tipo_tarifa::all();
        $vehiculo = Vehiculo::find($id);
        $action = "modifcar";
        if(isset($vehiculo)){
            return view('vehiculos.insert',compact('tarifa','action','vehiculo','id'));
        }
        else{
            return redirect('vehiculo');
        }
    }
    public function insertpost(Request $request){
        $post = $request->all();
        $validateData = $request->validate([
            'placa'=>'required|max:8|min:6|alpha_num|unique:vehiculo',
            'propietario'=>'required|max:100|min:6|regex:/^[a-zA-Z\s]*$/',
            'contacto'=>'required|max:15|min:8',
            'tipo_tarifa_id'=>'required|integer'
        ]);
        $vehiculo = new Vehiculo();
        $vehiculo->placa = $validateData["placa"];
        $vehiculo->propietario = $validateData["propietario"];
        $vehiculo->contacto = $validateData["contacto"];
        $vehiculo->tipo_tarifa_id = $validateData["tipo_tarifa_id"];
        $vehiculo->save();

        return back();
    }
    public function insertput(Request $request, $id){
        $post = $request->all();
        $p = "unique:vehiculo,placa,$id";
        $validateData = $request->validate([
            "placa"=>"required|max:8|min:6|alpha_num|$p",
            'propietario'=>'required|max:100|min:6|regex:/^[a-zA-Z\s]*$/',
            'contacto'=>'required|max:15|min:8',
            'tipo_tarifa_id'=>'required|integer'
        ]);
        Vehiculo::where("id","=",$id)->update($validateData);

        return redirect()->back()->with('message', 'IT WORKS!');
    }
}
