@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 3%">
        <div align="center">
            <h3 align="center">Historico de compras</h3>
            <br>
            <div class="row">
                <div class="col-md-4">
                    <p>En proceso de aceptación</p>
                    <i class="fa fa-retweet fa-2x iconColor" aria-hidden="true"></i>
                </div>
                <div class="col-md-4">
                    <p>Aceptada por profesional</p>
                    <i class="fa fa-check-circle fa-2x iconColor" aria-hidden="true"></i>
                </div>
                <div class="col-md-4">
                    <p>Terminada</p>
                    <i class="fa fa-thumbs-up fa-2x iconColor" aria-hidden="true"></i>
                </div>
            </div>
        </div>
        @foreach($dataOrdenServicio as $value)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="row" style="padding: 3%">
                            <div class="col-md-2 text-center">
                                <h4 class="product-name"><strong><span id="lblText_0">{{$value->description}}</span></strong></h4>
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-3 text-center">
                                    <h4><strong><span id="lblPrecio_0">{{$value->date}}</span></strong></h4>
                                </div>
                                <div class="col-md-3 text-center">
                                    <h4><strong><span id="lblPrecio_0">${{$value->total}} Pesos</span></strong></h4>
                                </div>
                                <div class="col-md-2 text-center" style="padding-top: 2%;">
                                    <a href="" data-toggle="modal" data-target="#exampleModal" onclick="infoServicios({{$value->id}})">
                                        <i class="fa fa-eye fa-2x iconColor" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-md-4 text-center" style="padding-top: 2%;">
                                    @if(isset($value->userAsignado))
                                        <a href="" data-toggle="modal" data-target="#exampleModal3" style="text-decoration: none;" onclick="infoUser({{$value->userAsignado}})">
                                            <i class="fa fa-user fa-2x" style="color: #000;" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                    <input type="hidden" name="pago_{{$value->id}}" value="{{$value->id}}">
                                    @if($value->status  == 2)
                                        <i class="fas fa-retweet fa-2x iconColor" aria-hidden="true"></i>
                                    @elseif($value->status  == 3)
                                        <i class="fa fa-check-circle fa-2x iconColor" aria-hidden="true"></i>
                                    @elseif($value->status  == 4)
                                        <i class="fas fa-thumbs-up fa-2x iconColor" aria-hidden="true"></i>
                                    @endif
                                    @if($value->calificar  != 1)
                                        <a href="" data-toggle="modal" data-target="#exampleModal2" style="text-decoration: none;" onclick="calificar({{$value->id}})">
                                            <i class="fa fa-award fa-2x" style="color: #000;" aria-hidden="true"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="modal fade" id="exampleModal" style="background-color: transparent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title textAlingCenter" id="exampleModalLabel">Información del Servcio</h3>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="row" id="infoServicios">

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal2" style="background-color: transparent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title textAlingCenter" id="exampleModalLabel">Calificacion Profesional</h3>
                </div>
                <div class="modal-body">
                    <form action="{{route('calificarTodero')}}" enctype="multipart/form-data" method="post">
                        {{ csrf_field() }}
                        <div class="row" align="center">

                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary" style="color: #fff"></i>
                            <i class="fa fa-gavel fa-stack-1x fa-inverse" style="color: #000"></i>
                        </span>
                            <br>
                            <textarea class="styleTextarea" name="description" id="description" cols="30" rows="10" placeholder="Deja tu comentario"></textarea>
                            <br><br>
                            <select id="star-rating" name="puntaje">
                                <option value="5">Excelente</option>
                                <option value="4">Muy Bien</option>
                                <option value="3">Promedio</option>
                                <option value="2">Regular</option>
                                <option value="1">Malo</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="id_orden" id="id_orden">
                            <input type="submit" class="btn btn-primary" value="Enviar">
                            <input type="hidden" name="type" id="type" value="2">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal3" style="background-color: transparent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 class="modal-title textAlingCenter" id="exampleModalLabel">Informacion del Profesional</h3>
                </div>
                <div class="modal-body">
                    <div class="row" align="center" id="infoUser">

                    </div>
                    <div class="row" align="center" id="infoRanking">

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('contentScript')
    <script>
        function infoServicios(id) {
            $('#infoServicios').html('');
            var stringDiv = '{{route('infoServi', ['parameter'])}}';
            var result = stringDiv.replace("parameter", id);

            $.ajax({
                type:'GET',
                url: result,
                success:function(data) {
                    $.each(data, function( index, value) {
                        $('#infoServicios').append('<div class="row"><div class="col-md-4">\n' +
                            '    <input type="image" name="img_0" id="img_0" class="img-responsive" src="/img/'+value['img']+'">\n' +
                            '</div><div class="col-md-4">\n' +
                            '    <h4><strong>'+value['name']+'</strong></h4>\n' +
                            '</div>\n' +
                            '<div class="col-md-4">\n' +
                            '    <h4><strong>$'+value['precio']+'</strong></h4>\n' +
                            '</div>\n' +
                            '</div>');
                    });
                }
            });
        }

        function infoUser(id) {
            $('#infoUser').html('');
            var stringDiv = '{{route('infoUserAsig', ['parameter'])}}';
            var result = stringDiv.replace("parameter", id);

            $.ajax({
                type:'GET',
                url: result,
                success:function(data) {
                    $.each(data, function( index, value) {
                        if (index == 'Foto profesional'){

                            $('#infoUser').append('<div class="col-md-12"><div class="form-group">\n' +
                                '        <div class="col-md-12">\n' +
                                '            <center><img id="img-upload" src="/uploads/'+value+'"/></center>\n' +
                                '        </div>\n' +
                                '    </div></div>');
                        }
                        else if(index == 'ranking'){
                            $('#infoRanking').html('');
                            var select = '';
                            select = select+'<select id="puntajeUser" name="puntajeUser">';
                            for (var i=1; i<6; i++) {
                                textoSelect = switchTex(i);
                                if (i == value)
                                {
                                    select = select+'<option value="'+i+'" selected>'+textoSelect+'</option>';
                                }
                                else
                                {
                                    select = select+'<option value="'+i+'">'+textoSelect+'</option>';
                                }
                            }
                            select = select+'</select>';
                            $('#infoRanking').append(select);
                            var starrating = new StarRating( document.getElementById('puntajeUser'));
                        }
                        else {
                            $('#infoUser').append('<div class="col-md-6"><div class="form-group">\n' +
                                '        <h4 for="id_tipo_documento" class="col-md-12 control-label">'+index+'</h4>\n' +
                                '        <div class="col-md-12">\n' +
                                '            <p for="">'+value+'</p>\n' +
                                '        </div>\n' +
                                '    </div></div>');
                        }

                    });
                }
            });
        }

        function calificar(id) {
            $('#id_orden').val(id);
        }

        function switchTex(value) {
            var texto;
            switch(value) {
                case 1:
                    texto = 'Malo';
                    break;
                case 2:
                    texto = 'Regular';
                    break;
                case 3:
                    texto = 'Promedio';
                    break;
                case 4:
                    texto = 'Muy Bien';
                    break;
                case 5:
                    texto = 'Excelente';
                    break;
            }

            return texto;
        }

    </script>
@endsection
