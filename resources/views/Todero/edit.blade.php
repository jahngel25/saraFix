@extends('layouts.app')
@section('contentStyles')

    <style>
        .btn-file {
            position: relative;
            overflow: hidden;
        }
        .btn-file input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;
            background: white;
            cursor: inherit;
            display: block;
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

        .form-group{
            margin-bottom: 0px !important;
        }
    </style>
@endsection
@section('content')
    <div class="container" style="margin-top: 3%">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center">
                        <h5><b>Registro de información adicional del construtor</b></h5>
                    </div>
                    <form action="{{route('informacionAdicionalEdit')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row" style="padding: 3%">
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('img_foto') ? ' has-error' : '' }}">
                                    <label for="tipo_identificacion" class="col-md-12 control-label">Carga tu foto</label>
                                    <div class="col-md-12">
                                        <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                <i class="fa fa-hand-o-up fa-stack-2x"></i>
                                <input type="file" id="img_foto" name="img_foto" class="stylesInput" value="{{$dataTodero->img_foto}}">
                            </span>
                        </span>
                                            <input type="text" class="form-control styleImgInput" value="{{$dataTodero->img_foto}}" readonly>
                                        </div>
                                        <center><img id='img-upload' src="{{asset('uploads/'.$dataTodero->img_foto)}}"/></center>
                                        @if ($errors->has('img_foto'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('img_foto') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('id_tipo_documento') ? ' has-error' : '' }}">
                                    <label for="id_tipo_documento" class="col-md-12 control-label">Tipo de Identificación</label>

                                    <div class="col-md-12">
                                        <select name="id_tipo_documento" id="id_tipo_documento" class="stylesInput">
                                            <option value="">Seleccione</option>
                                            @foreach($dataTipoDocumento as $value)
                                                <option value="{{$value->id}}">{{$value->description}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_tipo_documento'))
                                            <span class="help-block">
                            <strong>{{ $errors->first('id_tipo_documento') }}</strong>
                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('identificacion') ? ' has-error' : '' }}" >
                                    <label for="identificacion" class="col-md-12 control-label">Numero de identificación</label>

                                    <div class="col-md-12">
                                        <input id="identificacion" type="number" class="stylesInput" name="identificacion" value="{{$dataTodero->identificacion}}" required autofocus>
                                        @if ($errors->has('identificacion'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('identificacion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                                    <label for="fecha_nacimiento" class="col-md-12 control-label">Fecha de Nacimientos</label>
                                    <div class="form-group">
                                        <div class="col-lg-12 text-center">
                                            <div class='input-group date' id='datetimepickerInfo'>
                                                <input type='text' name="fecha_nacimiento" id="fecha_nacimiento" value="{{$dataTodero->fecha_nacimiento}}" class="form-control" style="border-color: #c0c0c0;"/>
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                            @if ($errors->has('fecha_nacimiento'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('fecha_nacimiento') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <br />
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('direccion') ? ' has-error' : '' }}" >
                                    <label for="direccion" class="col-md-12 control-label">Dirección</label>

                                    <div class="col-md-12">
                                        <input id="direccion" type="text" class="stylesInput" name="direccion" value="{{$dataTodero->direccion}}" required autofocus>
                                        @if ($errors->has('direccion'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('direccion') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('pais') ? ' has-error' : '' }}">
                                    <label for="pais" class="col-md-12 control-label">Pais de recidencia</label>

                                    <div class="col-md-12">
                                        <select name="pais" id="pais" class="stylesInput" onchange="traerDepartamneto(this.value)">
                                            <option value="">Seleccione</option>
                                            @foreach($dataPais as $value)
                                                <option value="{{$value->id}}">{{$value->description}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('pais'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('pais') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('departamento') ? ' has-error' : '' }}">
                                    <label for="departamento" class="col-md-12 control-label">Departamento de Recidencia</label>

                                    <div class="col-md-12">
                                        <select name="departamento" id="departamento" class="stylesInput" onchange="traerCiudad(this.value)">
                                            <option value="">Seleccione</option>
                                            @foreach($dataDepartamento as $value)
                                                <option value="{{$value->id}}">{{$value->description}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('departamento'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('departamento') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('id_ciudad') ? ' has-error' : '' }}">
                                    <label for="id_ciudad" class="col-md-12 control-label">Ciudad de Recidencia</label>

                                    <div class="col-md-12">
                                        <select name="id_ciudad" id="id_ciudad" class="stylesInput">
                                            <option value="">Seleccione</option>
                                            @foreach($dataCiudad as $value)
                                                <option value="{{$value->id}}">{{$value->description}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('id_ciudad'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('id_ciudad') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group{{ $errors->has('transporte') ? ' has-error' : '' }}">
                                    <label for="transporte" class="col-md-12 control-label">¿Que medio de transporte utiliza?</label>

                                    <div class="col-md-12">
                                        <input id="transporte" type="text" class="stylesInput" name="transporte" value="{{$dataTodero->transporte}}" required autofocus>
                                        @if ($errors->has('transporte'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('transporte') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('experiencia') ? ' has-error' : '' }}">
                                    <label for="experiencia" class="col-md-12 control-label">Experiencia en años</label>

                                    <div class="col-md-12">
                                        <input id="experiencia" type="number" class="stylesInput" name="experiencia" value="{{$dataTodero->experiencia}}" required autofocus>
                                        @if ($errors->has('experiencia'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('experiencia') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('perfil') ? ' has-error' : '' }}">
                                    <label for="perfil" class="col-md-12 control-label">Perfil profesional</label>

                                    <div class="col-md-12">
                                        <textarea class="stylesInput" rows="5" id="perfil" name="perfil" value="{{$dataTodero->perfil}}" style="height: 100% !important;">{{$dataTodero->perfil}}</textarea>
                                        @if ($errors->has('perfil'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('perfil') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('documento_doc') ? ' has-error' : '' }}">
                                    <label for="documento_doc" class="col-md-12 control-label">Fotocopia de Cedula</label>
                                    <div class="col-md-12" style="margin-bottom: 4% !important;">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    <i class="fa fa-hand-o-up fa-stack-2x"></i> <input type="file" id="documento_doc" name="documento_doc" class="stylesInput">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control styleImgInput" readonly>
                                        </div>
                                        <div align="center">
                                            <a href="{{route('download',$dataTodero->documento_doc)}}" target="_blank">
                                                <i class="fa fa-download fa-2x iconColor" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        @if ($errors->has('documento_doc'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('documento_doc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('certificado_doc') ? ' has-error' : '' }}">
                                    <label for="certificado_doc" class="col-md-12 control-label">Certificaciones</label>
                                    <div class="col-md-12" style="margin-bottom: 4% !important;">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    <i class="fa fa-hand-o-up fa-stack-2x"></i> <input type="file" id="certificado_doc" name="certificado_doc" class="stylesInput">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control styleImgInput" readonly>
                                        </div>
                                        <div align="center">
                                            <a href="{{route('download',$dataTodero->certificado_doc)}}" target="_blank">
                                                <i class="fa fa-download fa-2x iconColor" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        @if ($errors->has('certificado_doc'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('certificado_doc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('eps_doc') ? ' has-error' : '' }}">
                                    <label for="eps_doc" class="col-md-12 control-label">Certificado EPS</label>
                                    <div class="col-md-12" style="margin-bottom: 4% !important;">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    <i class="fa fa-hand-o-up fa-stack-2x"></i> <input type="file" id="eps_doc" name="eps_doc" class="stylesInput">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control styleImgInput" readonly>
                                        </div>
                                        <div align="center">
                                            <a href="{{route('download',$dataTodero->eps_doc)}}" target="_blank">
                                                <i class="fa fa-download fa-2x iconColor" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        @if ($errors->has('eps_doc'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('eps_doc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('bachiller_doc') ? ' has-error' : '' }}">
                                    <label for="bachiller_doc" class="col-md-12 control-label">Acta de bachiller</label>
                                    <div class="col-md-12" style="margin-bottom: 4% !important;">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file">
                                                    <i class="fa fa-hand-o-up fa-stack-2x"></i> <input type="file" id="bachiller_doc" name="bachiller_doc" class="stylesInput">
                                                </span>
                                            </span>
                                            <input type="text" class="form-control styleImgInput" readonly>
                                        </div>
                                        <div align="center">
                                            <a href="{{route('download',$dataTodero->bachiller_doc)}}" target="_blank">
                                                <i class="fa fa-download fa-2x iconColor" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        @if ($errors->has('bachiller_doc'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('bachiller_doc') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h3 align="center">Seleccione las area en la cuales tiene experiencia</h3>
                                <br>
                                @foreach($modelAreas as $value)
                                    <div class="col-md-4">
                                        <input type="checkbox" name="id_area[]" id="{{$value->id}}" value="{{$value->id}}">  {{$value->name}}<br>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-5">
                                        <input type="hidden" value="{{$dataTodero->id}}" name="id" id="id">
                                        <button type="submit" class="btn btn-warning colorBtn">
                                            Registrar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('contentScript')
    <script>
        $(document).ready( function() {
            @if($dataAreas != "")
                @foreach($dataAreas as $value)
                    $("#{{$value->id_area}}").attr("checked", true);
                @endforeach
            @endif
            $("#id_tipo_documento option[value="+ {{$dataTodero->id_tipo_documento}} +"]").attr("selected",true);
            $("#pais option[value="+ {{$dataTodero->id_pais}} +"]").attr("selected",true);
            $("#departamento option[value="+ {{$dataTodero->id_departamento}} +"]").attr("selected",true);
            $("#id_ciudad option[value="+ {{$dataTodero->id_ciudad}} +"]").attr("selected",true);
        });

        $('#datetimepickerInfo').datetimepicker({
            format: "yyyy-mm-dd",
            autoclose: true,
            pickTime: false
        });

        $(document).ready( function() {
            $(document).on('change', '.btn-file :file', function() {
                var input = $(this),
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [label]);
            });

            $('.btn-file :file').on('fileselect', function(event, label) {

                var input = $(this).parents('.input-group').find(':text'),
                    log = label;

                if( input.length ) {
                    input.val(log);
                } else {
                    if( log ) alert(log);
                }

            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#img-upload').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#img_foto").change(function(){
                readURL(this);
            });
        });

        function traerDepartamneto(id)
        {
            var stringDiv = '{{route('traerDepartamento', 'parameter')}}';
            var result = stringDiv.replace("parameter", id);

            $.ajax({
                type:'GET',
                url: result,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    $('#departamento').html('');
                    $('#departamento').append(' <option value="">Seleccione</option>');
                    $.each(data, function( index, value )
                    {
                        $('#departamento').append(' <option value="'+value['id']+'">'+value['description']+'</option>');
                    });
                }
            });
        }

        function traerCiudad(id)
        {
            var stringDiv = '{{route('traerCiudad', 'parameter')}}';
            var result = stringDiv.replace("parameter", id);

            $.ajax({
                type:'GET',
                url: result,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success:function(data){
                    $('#id_ciudad').html('');
                    $('#id_ciudad').append(' <option value="">Seleccione</option>');
                    $.each(data, function( index, value )
                    {
                        $('#id_ciudad').append(' <option value="'+value['id']+'">'+value['description']+'</option>');
                    });
                }
            });
        }
    </script>
@endsection
