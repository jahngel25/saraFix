@extends('layouts.app')

@section('content')
    <div class="container formRegister" >
        <div class="row" style="margin-top: 2%">
            <a href="{{route('frmCreacionServicio')}}"><button type="button" class="btn btn-warning">Crear</button></a>
        </div>
        <div class="row" style="margin-top: 2%">
            <table id="tableServicio" class="display dataTable">
                <thead>
                <tr>
                    <th>Area</th>
                    <th>descripcion</th>
                    <th>img</th>
                    <th>Precio</th>
                    <th>Area</th>
                </tr>
                </thead>
                <tbody>
                @foreach($modelServicio as $value)
                    <tr>
                        <td>{{$value->name}}</td>
                        <td>{{$value->description}}</td>
                        <td style="text-align: center"><input type="image"  class="img-responsive" width="150" height="100" src="{{asset('uploads/'.$value->img)}}"></td>
                        <td>{{$value->precio}}</td>
                        <td>{{$value->id_area}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('contentScript')
    <script>
        $(document).ready( function () {
            $('#tableServicio').DataTable({
                pageLength: 5,
                language: {
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
                    }
                }
            });
        } );
    </script>
@endsection
