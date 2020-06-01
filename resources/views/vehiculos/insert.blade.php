@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="col-md-4"></div>
        <div class="col-md-4">
        <h1> <?php echo ($action=="insert")?"Insertar Vehiculos":"Actualizar" ?></h1>
            {{ Form::open(array('url' => ($action=="insert")?"vehiculo/insertpost":"vehiculo/insertput/$id", 'method' => ($action=="insert")?"post":"put")) }}
                <div class="form-group">
                    <label for="" class="label">Placa</label>
                    <input
                        type ="text"
                        class="form-control"
                        name= "placa"
                        placeholder="Ingrese..."
                        value="<?php echo($action!="insert")?$vehiculo->placa:""; ?>">
                </div>
                <div class="form-group">
                    <label for="" class="label">Propietario</label>
                    <input
                        type ="text"
                        class="form-control"
                        name= "propietario"
                        placeholder="Ingrese..."
                        value="<?php echo($action!="insert")?$vehiculo->propietario:""; ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="" class="label">Whatsapp</label>
                    <input
                        type ="text"
                        class="form-control"
                        name= "contacto"
                        placeholder="Ingrese..."
                        value="<?php echo($action!="insert")?$vehiculo->contacto:""; ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="" class="label">Tipo Tarifa</label>
                    <select name="tipo_tarifa_id"  class="form-control" id="">
                        @foreach ($tarifa as $it)
                        @if (isset($vehiculo))
                            <option <?php echo ($it->id ==$vehiculo->tipo_tarifa_id)?"selected":""  ?> value="{{$it->id}}">{{$it->desc}}</option>
                        @else
                            <option value="{{$it->id}}">{{$it->desc}}</option>
                        @endif

                        @endforeach
                    </select>
                </div>
                <button class="btn btn-primary">
                    Guardar
                </button>
                <a href=" {{url('vehiculo/listar')}} ">Listado de Vehiculos</a>
            {{ Form::close() }}
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

@endsection
