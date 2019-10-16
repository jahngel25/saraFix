@extends('layouts.app')
@section('contentStyles')
    <style>
        select{
            background-color: rgba(255, 255, 255, 0.9);
            width: 32%;
            padding: 5px;
            border: 1px solid #DEE047;
            border-radius: 2px;
            height: 2rem;
        }
    </style>
@endsection
@section('content')
    <div class="container" style="margin-top: 3%">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                        <h3><b>Registro de información adicional del construtor</b></h3>
                        <div style="text-align: right">
                            <a href="{{route('frmCreacionServicio')}}"><button type="button" class="btn btn-warning">Crear</button></a>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 2%">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table id="tableServicio" class="display dataTable">
                                <thead>
                                <tr>
                                    <th>Area</th>
                                    <th>descripcion</th>
                                    <th>img</th>
                                    <th>Precio</th>
                                    <th>Servicio</th>
                                    <th>Editar</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelServicio as $value)
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->description}}</td>
                                        <td style="text-align: center"><input type="image"  class="img-responsive" width="100" height="80" src="{{asset('uploads/'.$value->img)}}"></td>
                                        <td>{{$value->precio}}</td>
                                        <td>{{$value->areaName}}</td>
                                        <td style="text-align: center"><a href="{{route('servicioEdit', $value->id)}}"><i class="fa fa-pencil-square-o iconColor" aria-hidden="true"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-1"></div>
                    </div>
                </div>
            </div>
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
