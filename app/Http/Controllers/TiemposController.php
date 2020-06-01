<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Vehiculo;
use App\Vehiculo_tiempo;
use App\Tipo_tarifa;
use DateTime;


class TiemposController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
    }
    public function insertar(){
        $v = Vehiculo::select("id","placa")->get();
        $vt = Vehiculo_tiempo::select("vehiculo.placa","vehiculo_tiempo.hora_entrada","vehiculo_tiempo.hora_salida","tipo_tarifa.monto")
        ->join('vehiculo', 'vehiculo.id', '=', 'vehiculo_tiempo.vehiculo_id')
        ->join('tipo_tarifa', 'vehiculo.tipo_tarifa_id', '=', 'tipo_tarifa.id')
        ->orderBy('vehiculo.id','desc')->get();

        foreach($vt as $it){
            $date1 = new DateTime($it->hora_entrada);
            if($it->hora_salida!=""){
                $date2= new DateTime($it->hora_salida);
                $diff = $date1->diff($date2);
                $it->tiempo = $minutes = ($diff->days * 24 * 60) +  ($diff->h * 60) + $diff->i;
                $it->calculo = $it->tiempo * $it->monto;
            }
            else{
                $it->tiempo = "Sigue Parqueado";
            }
        }
        return view("tiempos.insert",compact('v','vt'));
    }
    public function insertpost(Request $request){
        $post = $request->all();
        $validateData = $request->validate([
            'vehiculo_id'=>'required|integer',
            'tipooperacion'=>'required|integer',
            'id'=>'required|integer',

        ]);
        if($validateData['tipooperacion'] == "1"){
            $vt = new Vehiculo_tiempo();
            $vt->vehiculo_id = $validateData['vehiculo_id'];
            $vt->hora_entrada = date("Y-m-d H:i");
            $vt->save();
        }
        else{
            $horas = ["hora_salida"=>date("Y-m-d H:i")];
            Vehiculo_tiempo::where("id","=",$validateData['id'])->update($horas);
        }
        return redirect()->back()->with('message', 'Actualizacion Exitosa!');
    }
    public function getOperacion(Request $request){
        $post = $request->all();
        $validateData = $request->validate([
            'vehiculo_id'=>'required|integer'
        ]);
        $data = Vehiculo_tiempo::select("id","vehiculo_id","hora_entrada","hora_salida")
        ->where('vehiculo_id',$validateData["vehiculo_id"])
        ->orderBy('id','desc')->limit(1)->get();
        $str ="";


        if(count($data)>0){
            if($data[0]->hora_entrada !=null){
                $str.="1";
            }
            else{
                $str.="0";
            }

            if($data[0]->hora_salida !=null){
                $str.="1";
            }
            else{
                $str.="0";
            }
        }
        else{
            $str ="00";
        }

        if($str =="\n10"){

            $res =["action"=>$str,"id"=>$data[0]->id ];
        }
        else{
            $res =["action"=>$str];
        }
        return response()->json($res);

    }
    public function pruebatiempo(){
        $date1 = new DateTime("2020-06-1 12:00:00");
        $date2 = new DateTime("2020-06-1 12:17:00");




    }
}
