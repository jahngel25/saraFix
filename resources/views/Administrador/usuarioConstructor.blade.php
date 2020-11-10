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
        #img-upload
        {
            width: 25%;
            margin-top: 6%;
            background-repeat: no-repeat;
            background-position: 65%;
            border-radius: 50%;
            background-size: 100% auto;
        }
    </style>
@endsection
@section('content')
    <div class="container" style="margin-top: 3%">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                        <h3><b>Usuarios Constructores</b></h3>
                    </div>
                    <div class="row" style="margin-top: 2%">
                        <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <table id="tableUsuariosCliente" class="display dataTable table-responsive">
                                <thead>
                                <tr>
                                    <th><b>Nombre</b></th>
                                    <th><b>Correo</b></th>
                                    <th><b>Fecha de Ingreso</b></th>
                                    <th><b>Información Adicional</b></th>
                                    <th><b>Aceptar</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelUser as $value)
                                    <tr>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->created_at}}</td>
                                        <td style="text-align: center">
                                            <a href="" data-toggle="modal" data-target="#exampleModal" onclick="infoUser({{$value->id}})">
                                                <i class="fa fa-eye fa-2x iconColor" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                        <td style="text-align: center">
                                            @if($value->status != 1)
                                                <form action="{{route('updateEstado', $value->id)}}" method="GET" id="formUpdate{{$value->id}}">
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
            <div class="modal fade" id="exampleModal" style="background-color: transparent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title textAlingCenter" id="exampleModalLabel">Información del Profesional</h3>
                        </div>
                        <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="row" id="contentUser">

                            </div>
                            <div class="modal-footer">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('contentScript')
    <script>

        function infoUser(id) {
            $('#contentUser').html('');
            var stringDiv = '{{route('infoUser', ['parameter'])}}';
            var result = stringDiv.replace("parameter", id);

            $.ajax({
                type:'GET',
                url: result,
                success:function(data) {
                    $.each(data, function( index, value) {
                        if (index == 'Foto profesional'){

                            $('#contentUser').append('<div class="col-md-12"><div class="form-group">\n' +
                                '        <div class="col-md-12">\n' +
                                '            <center><img id="img-upload" src="/uploads/'+value+'"/></center>\n' +
                                '        </div>\n' +
                                '    </div></div>');

                        }
                        else if (index == 'Documento Identidad' || index == 'Certificados' || index == 'Acta  Bachiller' || index == 'Certificado EPS') {
                            var stringRoute = '{{route('downloadAdmin', ['parameter'])}}';
                            var resultRoute = stringRoute.replace("parameter", value);
                            $('#contentUser').append('<div class="col-md-6"><div class="form-group">\n' +
                                '        <h4 for="id_tipo_documento" class="col-md-12 control-label">'+index+'</h4>\n' +
                                '        <div class="col-md-12">\n' +
                                '            <a href="'+resultRoute+'" target="_blank"><i class="fa fa-download fa-2x iconColor" aria-hidden="true"></i></a>\n' +
                                '        </div>\n' +
                                '    </div></div>');

                        }else if (index == 'ingresos') {

                            $('#contentUser').append('<div class="col-md-12" align="center"><div class="form-group">\n' +
                                '        <b><h3 for="'+index+'" class="col-md-12 control-label" style="text-transform: uppercase;">'+index+'</h3></b>\n' +
                                '        <div class="col-md-12">\n' +
                                '            <h4 for="">$'+value+'</h4>\n' +
                                '        </div>\n' +
                                '    </div></div>');

                        }
                        else{
                            $('#contentUser').append('<div class="col-md-6"><div class="form-group">\n' +
                                '        <h4 for="'+index+'" class="col-md-12 control-label">'+index+'</h4>\n' +
                                '        <div class="col-md-12">\n' +
                                '            <p for="">'+value+'</p>\n' +
                                '        </div>\n' +
                                '    </div></div>');
                        }

                    });
                }
            });
        }

        function enviarUpdate(id)
        {
            $("#formUpdate"+id).submit();
        }

        $(document).ready( function () {
            $('#tableUsuariosCliente').DataTable({
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
