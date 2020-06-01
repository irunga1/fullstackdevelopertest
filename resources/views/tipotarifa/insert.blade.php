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
        <h1> <?php echo ($action=="insert")?"Insertar Tarifa":"Actualizar Tarifa" ?></h1>
            {{ Form::open(array('url' => ($action=="insert")?"tipotarifa/insertpost":"tipotarifa/insertput/$id", 'method' => ($action=="insert")?"post":"put")) }}
                <div class="form-group">
                    <label for="" class="label">Descripcion</label>
                    <input
                        type ="text"
                        class="form-control"
                        name= "desc"
                        placeholder="Ingrese..."
                        value="<?php echo($action!="insert")?$tipotarifa->desc:""; ?>">
                </div>
                <div class="form-group">
                    <label for="" class="label">Monto</label>
                    <input
                        type ="text"
                        class="form-control"
                        name= "monto"
                        placeholder="Ingrese..."
                        value="<?php echo($action!="insert")?$tipotarifa->monto:""; ?>">
                </div>


                <button class="btn btn-primary">
                    Guardar
                </button>
                <a href=" {{url('tipotarifa/listar')}} ">Listado de Tipos de Tarifas</a>
            {{ Form::close() }}
        </div>
        <div class="col-md-4"></div>
    </div>
</div>

@endsection
