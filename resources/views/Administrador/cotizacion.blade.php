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
                        <h3><b>Cotizacion</b></h3>
                    </div>
                    <div class="row" style="margin-top: 2%">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table id="tableCotizacion" class="display dataTable">
                                <thead>
                                <tr>
                                    <th><b>Nombre</b></th>
                                    <th><b>Email</b></th>
                                    <th><b>Telefono</b></th>
                                    <th><b>Mensaje</b></th>
                                    <th><b>Responder</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelCotizacion as $value)
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->telefono}}</td>
                                        <td>{{$value->mensaje}}</td>
                                        <td style="text-align: center">
                                            <a href="" data-toggle="modal" data-target="#exampleModal">
                                                <i class="fa fa-check-circle fa-2x iconColor" aria-hidden="true" onclick="valueInput('{{$value->email}}','{{$value->name}}')"></i>
                                            </a>
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
            <div class="modal fade" id="exampleModal" style="background-color: transparent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title textAlingCenter" id="exampleModalLabel">Responder cotización.</h3>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('emailCotizacion')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('respuesta') ? ' has-error' : '' }}">
                                        <label for="respuesta" class="col-md-4 control-label">Respuesta</label>
                                        <div class="col-md-12">
                                            <textarea name="respuesta" id="respuesta" cols="30" rows="30" style="height: 6rem;"></textarea>
                                            @if ($errors->has('respuesta'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('respuesta') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <input type="hidden" name="email" id="email">
                                    <input type="hidden" name="name" id="name">
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" class="btn btn-primary" value="Responder">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contentScript')
    <script>
        function valueInput(email, name)
        {
            $('#email').val(email);
            $('#name').val(name);
        }
        $(document).ready( function () {
            $('#tableCotizacion').DataTable({
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
