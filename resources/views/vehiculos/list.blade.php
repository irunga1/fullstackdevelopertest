@extends("layouts.app")
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <span class="btn btn-primary">
                <a href=" {{url("vehiculo/insertar")}}">Crear</a>
            </span>
        </div>
        <div class="col-md-2"></div>
    </div>
    <div class="row"><hr></div>
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">

            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Propietario</th>
                        <th>Telefono/Whatsapp</th>
                        <th>Tipo de Tarifa</th>
                        <th>Modificar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($vehiculos as $it)
                    <tr>
                        <td>{{$it->placa}}</td>
                        <td>{{$it->propietario}}</td>
                        <td>{{$it->contacto}}</td>
                        <td>{{$it->desc}}</td>
                        <td><a href="{{url("vehiculo/modificar/$it->id")}}" class="btn btn-info">Modificar</a></td>
                    </tr>
                    @endforeach


                </tbody>
                <tfoot>
                    <tr>
                        <th>Placa</th>
                        <th>Ppropietario</th>
                        <th>Telefono/Whatsapp</th>
                        <th>Tipo de Tarifa</th>
                        <th>Modificar</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-1"></div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $.noConflict();
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
    } );
</script>
<style>
    .btn a{
        color:#fff;
    }
</style>
@endsection
