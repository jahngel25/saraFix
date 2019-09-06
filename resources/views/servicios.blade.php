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
    <div class="container">
        <header style="background-image:url('/img/{{$dataArea->img_inter}}');" class="jumbotron hero-spacer">
            <h2>{{$dataArea->name}}</h2>
            <h3 style="text-transform:none;">{{$dataArea->description}}</h3>
            <p> </p>
        </header>
        <hr>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p id="servicios" style="font-size: 16px; font-family:Droid Serif, Helvetica Neue, Helvetica, Arial, sans-serif; text-transform: none; font-style: italic;" >{{$dataArea->texto}}</p>
            </div><br />
        </div>
        <div class="row text-center">
            @foreach($dataServicio as $value)
                <div class="col-md-3 col-sm-6 hero-feature">
                    <div class="thumbnail">
                        <div>
                            <img src="{{asset('img/'.$value->img)}}" class="img-responsive" id="imgBtn_43" />
                            <div class="caption">
                                <h4>{{$value->name}}</h4>
                                <h4 style="color:darkred;">${{$value->precio}} Pesos</h4>
                                <button  class="btn btn-default"> Incluye </button>
                                <a href="{{route('ordenServicio', $value->id)}}"><button  class="btn btn-info">Contratar</button></a>
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
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    SOLICITAR PRESUPUESTO
                </button>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">CUÉNTANOS QUE NECESITAS, EL EQUIPO DE FIX-CONTRACT DESPEJARA TODAS TUS DUDAS.</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <div style="text-align: center; color: #31708f;">"Nota! En pocos minutos un asesor del área técnica se comunicara contigo"</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-primary">SOLICITAR</button>
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
