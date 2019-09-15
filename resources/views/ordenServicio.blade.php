<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>FixContract</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Kumar+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="{{asset('img/contractLogo.png')}}" />
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('css/agency.css')}}">
    <link rel="stylesheet" href="{{asset('css/redes.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/orden.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.css')}}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <!-- Styles -->
    <style>
        nav{
            margin: 0px;
            font-weight: bolder;
            font-family: Raleway,sans-serif;
            font-size: 14px;
        }

        .navbar
        {
            margin-bottom: 0px !important;
        }

        .navbar-default .navbar-nav>li>a, .navbar-default .navbar-text {
            color: #777 !important;
        }


    </style>
</head>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{url('/')}}">
                <img src="{{asset('img/navLogo.png')}}" alt="" style="display: initial !important;">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ route('login') }}">Iniciar Sesion</a></li>
                    <li><a href="{{ url('/register') }}">Registrame</a></li>
                    <li><a href="{{ route('registerProvider') }}">Trabaja con nosotros</a></li>
                @else
                    @if(roleUser() == 1)
                        @include('layouts.menuTodero')
                    @elseif(roleUser() == 2)
                        @include('layouts.menuCliente')
                    @elseif(roleUser() == 3)
                        @include('layouts.menuAdministrador')
                    @endif
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Cerrar Sesion
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<body>
<div class="container" style="margin-top: 3%">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-warning">
                <div class="panel-heading clickable">
                    <h3 class="panel-title text-center">
                        PREGUNTAS FRECUENTES</h3>
                    <span class="pull-right "><i class="glyphicon glyphicon-minus"></i></span>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>Tienes 3 meses de garantía por mano de obra.</li>
                        <li>Puedes cancelar el servicio con 24 Horas de anticipación.</li>
                        <li>Contamos con herramientas de última tecnología.</li>
                        <li>Contamos con pólizas de seguros para los servicios.</li>
                        <li> Nuestros profesionales cuentan con la experiencia para cada tipo de trabajo.</li>
                        <li>Nuestros profesionales son verificados por Fix-Contract.</li>
                        <li>Nuestros profesionales van debidamente identificados por Fix-Contract.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 text-center">
            <h5>Llena los campos para procesar tu solicitud</h5>
        </div>
    </div>
    <br><br>
    <div class="borde_marco" >
        <form action="{{route('crearOrdenServicio')}}" enctype="multipart/form-data" method="post">
            {{ csrf_field() }}
            <div class="col-sm-5">
                <div class="panel panel-default" style="border-color: #c3c3c3;">
                    <div class="panel-body form-horizontal payment-form">
                        <div class="form-group">
                            <label for="status"  class="col-sm-3 control-label">Email:</label>
                            <div class="col-sm-9">
                                <input type="email" style="border-color: #c0c0c0" placeholder="Email de contacto:" class="form-control" name="email" id="email"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="concept" class="col-sm-3 control-label">Nombre: </label>
                            <div class="col-sm-9">
                                <input type="text" style="border-color: #c0c0c0" placeholder="Nombre quien recibe:"  class="form-control" name="name" id="name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Dirección:</label>
                            <div class="col-sm-9">
                                <input type="text" style="border-color: #c0c0c0" placeholder="Dirección indicaciones Ej.casa o apto: "  class="form-control" name="address" id="address"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="amount" class="col-sm-3 control-label">Teléfono:</label>
                            <div class="col-sm-9">
                                <input type="number" style="border-color: #c0c0c0" placeholder="Teléfono de contacto:" class="form-control" name="telefono" id="telefono"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date" class="col-sm-3 control-label">Instrucciones</label>
                            <div class="col-sm-9">
                                <input type="text" style="border-color: #c0c0c0" placeholder="Comentarios, detalles adicionales." class="form-control" name="description"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12 text-center">
                                <label>Cuando quieres recibir tu servicio?</label>
                                <div class='input-group date' id='datetimepicker6' style="margin-left: 3%">
                                    <input type='text' name="date" id="date" class="form-control" style="border-color: #c0c0c0;"/>
                                    <span class="input-group-addon">
                                        <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                </div>
                            </div>
                            <br />
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7"  >
                <div class="row">
                    <div class="col-xs-12">
                        <div class="panel panel-info" style="border-color: #c3c3c3;">
                            <div class="panel-heading">
                                <div class="panel-title">
                                    <div class="row">
                                        <div class="col-xs-5">
                                            <h5><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart</h5>
                                        </div>
                                        <div class="col-xs-7">
                                            <a href="javascript:history.back()" class="btn btn-default btn-sm btn-block">
                                                <i class="fa fa-reply" aria-hidden="true"></i> Necesitas mas servicios?
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(isset($modelServicio))
                                @foreach($modelServicio as $value)
                                    <div class="row" style="padding: 3%" id="contenedor_{{$value->id}}">
                                        <div class="col-xs-2">
                                            <input type="image" name="img_0" id="img_0" class="img-responsive" src="{{asset('img/'.$value->img)}}">
                                        </div><div class="col-xs-3">
                                            <h4 class="product-name"><strong><span id="lblText_0">{{$value->name}}</span></strong></h4>
                                            <h4 class="Incluye"><small><a id="lblRef_0" href="javascript:__doPostBack('lblRef_0','')">Que incluye este servicio</a></small></h4>
                                        </div>
                                        <div class="col-xs-6">
                                            <div class="col-xs-6 text-right">
                                                <h6><strong><span id="lblPrecio_0">${{$value->precio}} Pesos</span></strong></h6>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="hidden" name="servicios[]" value="{{$value->id}}">
                                                <button onclick="eliminarContenedor('contenedor_{{$value->id}}')" class="btn btn-xs">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            <div class="panel-body" style="padding: 6%">
                                <div class="row">
                                    <div class="row text-center">
                                        <div class="col-xs-6">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-gift" aria-hidden="true"></i></span>
                                                <input type="text" style="border-color: #c0c0c0" class="form-control" placeholder="Tienes un codigo promocional?" id="TextBox2" />
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <a href="#" class="btn ">+ Añadir Codigo</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <div class="row text-center">
                                    <div class="col-xs-9">
                                        <input type="hidden" name="total" id="total" value="{{$total}}">
                                        <h4 class="text-right">Total ${{$total}}<strong><label Text="0" ID="lblTotalPagar" runat="server" /></strong></h4>
                                    </div>
                                    <div class="col-xs-3">
                                        <input type="submit" id="btnRealizarPedidido" class="btn btn-danger" value="Solicitar Servicio">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.js')}}"></script>
<script src="{{asset('js/todaruVideo.js')}}"></script>
<script src="{{asset('js/ScriptMenu.js')}}"></script>
<script src="{{asset('js/bootstrap-datetimepicker.js')}}"></script>
<script type="application/javascript">


    $('#datetimepicker6').datetimepicker({
        dateFormat: "dd-MM-yyyy hh:ii",
        autoclose: true,
        minuteStep: 10,
    });


    function eliminarContenedor(id)
    {
        $('#'+id).remove();
    }

    function detallesProducts() {
        $('#modalPreguntas').modal('show')
    }

    function showContent() {
        element = document.getElementById("btnRegistro");
        check = document.getElementById("check");
        if (check.checked) {
            element.style.display = 'block';
        }
        else {
            element.style.display = 'none';
        }
    }

    jQuery(function () {
        jQuery(window).scroll(function () {
            if (jQuery(this).scrollTop() > 2) {
                jQuery('#logo-img')
                    .css({ 'background-color': 'rgba(255, 255, 255, 255)' });
            }
            if (jQuery(this).scrollTop() < 2) {
                jQuery('#logo-img')
                    .css({ 'background-color': 'rgba(255, 255, 255, 0.31)' });
            }
        });
    });

    $(document).on('click', '.panel-heading span.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });
    $(document).on('click', '.panel div.clickable', function (e) {
        var $this = $(this);
        if (!$this.hasClass('panel-collapsed')) {
            $this.parents('.panel').find('.panel-body').slideUp();
            $this.addClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-minus').addClass('glyphicon-plus');
        } else {
            $this.parents('.panel').find('.panel-body').slideDown();
            $this.removeClass('panel-collapsed');
            $this.find('i').removeClass('glyphicon-plus').addClass('glyphicon-minus');
        }
    });
    $(document).ready(function () {
        $('.panel-heading span.clickable').click();
        $('.panel div.clickable').click();
    });
</script>
</body>
@include('footer')
</html>
