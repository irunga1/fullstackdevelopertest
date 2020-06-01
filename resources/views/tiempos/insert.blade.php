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
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <h1>Ingresar Tiempos</h1>
            {{ Form::open(array('url' => "tiempo/insertpost", 'method' => "post")) }}
            <div class="row">
                <div class="col-md-6">
                    <label for="" class="label">Vehiculo</label>
                    <div class="form-group">
                        <select name="vehiculo_id"  class="form-control select2" id="vehiculo">
                            <option value="0">Buscar</option>
                            @foreach ($v ?? '' as $it)
                                <option value="{{$it->id}}">{{$it->placa}}</option>
                            @endforeach
                        </select>
                        <a href=" {{url('vehiculo/insertar')}} ">Crear Nuevo Vehiculo</a>
                    </div>
                    <input type="hidden" id="id" name ="id" class="id">
                </div>
                <div class="col-md-4">
                    <label for="" class="label">Tipo Operacion</label>
                    <select name="tipooperacion"  class="form-control select2" id="tipooperacion">
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary">
                        Guardar
                    </button>
                </div>
            </div>
            {{ Form::close()}}

        </div>
        <div class="col-md-1"></div>
    </div>

    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <hr>
            <h1>Resumen</h1>
            <hr>
        </div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Tiempo Minutos</th>
                        <th>Monto a Cancelar</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($vt as $it)
                    <tr>
                        <td>{{$it->placa}}</td>
                        <td>{{$it->hora_entrada}}</td>
                        <td>{{$it->hora_salida}}</td>
                        <td>{{$it->tiempo}}</td>
                        <td>{{number_format($it->calculo,2,'.','')}}</td>

                    </tr>
                    @endforeach


                </tbody>
                <tfoot>
                    <tr>
                        <th>Placa</th>
                        <th>Hora Entrada</th>
                        <th>Hora Salida</th>
                        <th>Tiempo Minutos</th>
                        <th>Monto a Cancelar</th>

                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
(function(){
    $(document).ready(function() {
        $.noConflict();
        $('.select2').select2();
        changePlaca();
        chargeTable();

    });
})();
changePlaca = function(){
    $('#vehiculo').change(function(){
        val = $('#vehiculo option:selected').val();
        val2 = $('input[type="hidden"]').val()
        info={
            "vehiculo_id":val,
            "_token":val2
        }
        $.post( "{{url('tiempo/getoperacion')}}", info , function(data) {
            switch(data.action){
                case "00":
                    $("#tipooperacion").empty();
                    $("#tipooperacion").append("<option value ='1'>Ingresar</option>")
                    $("#id").val("0");
                    break;
                case "10":
                    $("#tipooperacion").empty();
                    $("#tipooperacion").append("<option value ='2'>Actualizar</option>")
                    $("#id").val(data.id);
                    break;
                case "11":
                    $("#tipooperacion").empty();
                    $("#tipooperacion").append("<option value ='1'>Ingresar</option>")
                    $("#id").val("0");
                    break;
            }
        });

    });
}
chargeTable = function(){
    $('#example').DataTable(
            {
                "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                },
                "buttons": {
                    "copy": "Copiar",
                    "colvis": "Visibilidad"
                }
            }
        });
}
</script>
@endsection
