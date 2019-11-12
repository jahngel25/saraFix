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
            <ul class="nav navbar-nav navbar-right" style="text-align: center;">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/') }}">Inicio</a></li>
                    <li><a href="{{ route('login') }}">Iniciar Sesion</a></li>
                    <li><a href="{{ url('/register') }}">Registrate</a></li>
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
    <div class="container">
        <header style="background-image:url('/uploads/{{$dataArea->img_inter}}');" class="jumbotron hero-spacer">
            <h2 style="color: #ffffff">{{$dataArea->name}}</h2>
            <h3 style="text-transform:none;color: #ffffff;">{{$dataArea->description}}</h3>
            <p> </p>
        </header>
        <hr>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p id="servicios" style="font-size: 16px; font-family:Droid Serif, Helvetica Neue, Helvetica, Arial, sans-serif; text-transform: none; font-style: italic;" >{{$dataArea->texto}}</p>
            </div><br />
        </div>
        <div class="row text-center" style="margin-right: -15px !important;margin-left: -15px !important;">
            @foreach($dataServicio as $value)
                <div class="col-md-3 hero-feature">
                    <div class="thumbnail">
                        <div>
                            <img src="{{asset('uploads/'.$value->img)}}" class="img-responsive" id="imgBtn_43" />
                            <div class="caption">
                                <h4>{{$value->name}}</h4>
                                <b><h4>${{$value->precio}} Pesos</h4></b>
                                <a href="{{route('ordenServicio', [$value->id, uniqid(), $dataArea->id])}}"><button  class="btn btn-primary">Contratar</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="container" style="background-color:aliceblue">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h3>¿No encuentras el servicio que necesitas?</h3>
                <button type="button" class="btn btn-primary" style="background-color: #666666 !important;border-color: #fff !important;" data-toggle="modal" data-target="#exampleModal">
                    SOLICITAR PRESUPUESTO
                </button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h3 class="modal-title textAlingCenter" id="exampleModalLabel">CUÉNTANOS QUE NECESITAS, EL EQUIPO DE FIX-CONTRACT DESPEJARA TODAS TUS DUDAS.</h3>
                        </div>
                        <div class="modal-body">
                            <form action="{{route('crearCotizacion')}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-2 control-label" style="margin-top: 1%;">Nombre</label>
                                        <div class="col-md-10">
                                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                        <label for="email" class="col-md-2 control-label" style="margin-top: 1%;">E-mail</label>
                                        <div class="col-md-10">
                                            <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                                        <label for="telefono" class="col-md-2 control-label" style="margin-top: 1%;">Telefono</label>
                                        <div class="col-md-10">
                                            <input id="telefono" type="text" class="form-control" name="telefono" value="{{ old('telefono') }}" required autofocus>
                                            @if ($errors->has('telefono'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('telefono') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group{{ $errors->has('mensaje') ? ' has-error' : '' }}">
                                        <label for="mensaje" class="col-md-2 control-label" style="margin-top: 1%;">Comentarios</label>
                                        <div class="col-md-10">
                                            <textarea id="mensaje" class="form-control" name="mensaje" value="{{ old('mensaje') }}" required autofocus></textarea>
                                            @if ($errors->has('mensaje'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('mensaje') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div  style="text-align: center; color: #31708f;">
                                    "Nota! En pocos minutos un asesor del área técnica se comunicara contigo"
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                    <input type="hidden" name="id" id="id" value="{{$dataArea->id}}">
                                    <input type="submit" class="btn btn-primary" value="SOLICITAR">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/todaruVideo.js')}}"></script>
    <script src="{{asset('js/ScriptMenu.js')}}"></script>
</body>
@include('footer')
</html>
