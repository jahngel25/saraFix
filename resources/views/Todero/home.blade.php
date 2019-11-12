@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 3%">
    <h3 align="center">Trabajos para realizar aceptación</h3>
    <br>
    @foreach($dataOrdenServicio as $value)
    <form action="{{route('aceptarServicio')}}" method="post" enctype="multipart/form-data" id="formHome">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style="border-color: #c3c3c3; background-color: rgba(233,233,233,0.95); ">
                    <div class="row" style="padding: 3%">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="col-md-1">
                                {{$value->name}}
                            </div><div class="col-md-1">
                                <h4 class="product-name"><strong><span id="lblText_0">{{$value->description}}</span></strong></h4>
                            </div>
                            <div class="col-md-10">
                                <div class="col-md-3 text-center">
                                    <h4><strong><span id="lblPrecio_0">{{$value->date}}</span></strong></h4>
                                </div>
                                <div class="col-md-3 text-center">
                                    <h4><strong><span id="lblPrecio_0">${{$value->total}}</span></strong></h4>
                                </div>
                                <div class="col-md-3 text-center" style="padding-top: 2%;">
                                    <a href="" data-toggle="modal" data-target="#exampleModal" onclick="infoServicios({{$value->id}})">
                                        <i class="fa fa-eye fa-2x" style="color: #000" aria-hidden="true"></i>
                                    </a>
                                </div>
                                <div class="col-md-3" align="right" style="padding-top: 2%;">
                                    <input type="hidden" name="id_orden" value="{{$value->id}}">
                                    <input type="hidden" name="id_todero" value="{{ Auth::user()->id }}">
                                    <a href="javascript:{}" onclick="document.getElementById('formHome').submit();">
                                        <i class="fa fa-check-circle fa-2x iconColor" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endforeach
</div>
<div class="modal fade" id="exampleModal" style="background-color: transparent" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Información del Servcio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
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
@endsection
@section('contentScript')
    <script>
        function infoServicios(id) {
            $('#infoServicios').html('');
            var stringDiv = '{{route('infoServicios', ['parameter'])}}';
            var result = stringDiv.replace("parameter", id);

            $.ajax({
                type:'GET',
                url: result,
                success:function(data) {
                    $.each(data, function( index, value) {
                        $('#infoServicios').append('<div class="row"><div class="col-md-3">\n' +
                            '    <input type="image" name="img_0" id="img_0" class="img-responsive" src="/img/'+value['img']+'">\n' +
                            '</div><div class="col-md-3">\n' +
                            '    <h4><strong>'+value['name']+'</strong></h4>\n' +
                            '</div>\n' +
                            '<div class="col-md-3">\n' +
                            '    <h4><strong>$'+value['precio']+'</strong></h4>\n' +
                            '</div>\n' +
                            '<div class="col-md-3">\n' +
                            '    <h4><strong>'+value['area']+'</strong></h4>\n' +
                            '</div></div>');
                    });
                }
            });
        }
    </script>
@endsection
