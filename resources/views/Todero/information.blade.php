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
                    @if($dataTodero != '')
                        @include('Todero.informacionEdit', $dataTodero)
                    @else
                        @include('Todero.informacionCreate')
                    @endif
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
            @if($dataTodero != '')
                $("#id_tipo_documento option[value="+ {{$dataTodero->id_tipo_documento}} +"]").attr("selected",true);
                $("#pais option[value="+ {{$dataTodero->id_pais}} +"]").attr("selected",true);
                $("#departamento option[value="+ {{$dataTodero->id_departamento}} +"]").attr("selected",true);
                $("#id_ciudad option[value="+ {{$dataTodero->id_ciudad}} +"]").attr("selected",true);
            @endif
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
