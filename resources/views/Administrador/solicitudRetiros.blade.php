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
                        <h3><b>Retiros</b></h3>
                    </div>
                    <div class="row" style="margin-top: 2%">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table id="tableRetiros" class="display dataTable">
                                <thead>
                                <tr>
                                    <th><b>Nombre</b></th>
                                    <th><b>Email</b></th>
                                    <th><b>Cantidad</b></th>
                                    <th><b>Aceptar</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelRetiros as $value)
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->cantidad}}</td>
                                        <td style="text-align: center">
                                            @if($value->status != 1)
                                                <form action="{{route('updateEstadoRetiro', $value->id)}}" method="GET" id="formUpdate{{$value->id}}">
                                                    <i class="fa fa-check-circle fa-2x iconColor" aria-hidden="true" id="buttonSubmit" onclick="enviarUpdate({{$value->id}})"></i>
                                                </form>
                                            @endif
                                        </td>
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
        function enviarUpdate(id)
        {
            $("#formUpdate"+id).submit();
        }

        $(document).ready( function () {
            $('#tableRetiros').DataTable({
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
