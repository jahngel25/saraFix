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
    <link rel="stylesheet" href="{{asset('css/welcome.css')}}">
    <link rel="stylesheet" href="{{asset('css/footer.css')}}">
</head>
<nav class="flex-center position-ref full-height col-md-12">
    @if (Route::has('login'))
        <div class="top-right links">
            @if (Auth::check())
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ url('/login') }}" class="textClick">Iniciar Sesion</a>
                <a href="{{ url('/register') }}" class="textClick">Registrame</a>
                <a href="{{ route('registerProvider') }}" class="textClick">Trabaja con nosotros</a>
            @endif
        </div>
    @endif

    <div class="content">
        <div class="title m-b-md textHome">
            <img src="{{asset('img/fixlog-04.png')}}" alt="" style="width: 50%">
        </div>

        <div class="links">
            <a href="#">Reparaciones para el hogar</a><br>
            <a href="#">Desde arreglar tu bicicleta, hasta remodelaciónes en general…</a>
        </div>
    </div>
    <div id="socialMobil" class="text-center center-block">  <br />
        <a href="#facebook" class="redF"><i id="social-fb2" class="fa fa-facebook-square fa-4x social"></i></a>
        <a href="#twitter" class="redT"><i id="social-tw2"  class="fa fa-twitter-square fa-4x social"></i></a>
        <a href="#google" class="redG"><i id="social-gp2" class="fa fa-google-plus-square fa-4x social"></i></a>
        <a href="mailto:contacto@sarafix.com?Subject=Hola,%20Solicito%20mas%20información"><i id="social-em" class="fa fa-envelope-square fa-4x social"></i></a>
    </div>
</nav>

<body>
    <div id="mySidenav" class="sidenav">
        <a href="#facebook" class="redF" id="facebookHeader"><i id="social-fb" class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
        <a href="#google" class="redG" id="googleHeader"><i id="social-tw"  class="fa fa-google-plus fa-lg" aria-hidden="true"></i></a>
        <a href="#twitter" class="redT" id="tweHeader"><i id="social-gp" class="fa fa-twitter fa-lg" aria-hidden="true"></i></a>
        <a href="mailto:contacto@sarafix.com?Subject=Hola,%20Solicito%20mas%20información" id="youtubeHeader"><i class="fa fa-envelope fa-lg" aria-hidden="true"></i></a>
    </div>
    <div class="container">
        <div class="col-lg-12 text-center">
            <p style="color:#dee047; margin-bottom:30px;">----------------------------------------------------------------------------- <p/>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">No hay trabajo pequeño que no hagamos</h2>
                <h3 id="servicios" class="section-subheading text-muted">"Precios económicos y sin sorpresas”</h3>
            </div>
        </div>
        <div  class="row" id="contenedorAreas">

        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <p style="color:#dee047; margin-bottom:30px;">----------------------------------------------------------------------------- <p/>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Comó Funciona</h2>
                <h3 class="section-subheading text-muted">En solo 3 pasos...</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <ul class="timeline">
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/logoRepair.png" alt="Reparaciones a domicilio">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <div class="badge">1</div>
                                <h4 class="subheading">Selecciona tu servicio</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Elije el tipo de servicio que necesitas, das click en Contratar.</p>
                            </div>
                        </div>
                    </li>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/perfilPersonal.png" alt="Reparaciones domiciliarias">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <div class="badge">2</div>
                                <h4 class="subheading">Fecha del servicio</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Llena tus datos con la fecha y la hora para la cual necesitas el servicio.</p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="timeline-image">
                            <img class="img-circle img-responsive" src="img/tratoTodaru.png" alt="Reparaciones del hogar">
                        </div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <div class="badge">3</div>
                                <h4 class="subheading">Pagas Y listo!</h4>
                            </div>
                            <div class="timeline-body">
                                <p class="text-muted">Te enviaremos un profesional totalmente capacitado para el servicio que solicitaste.</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="section-heading">Sello de garantía</h2>
                <h3 class="section-subheading text-muted">Porque cada día más clientes nos prefieren.</h3>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-clock-o fa-stack-1x fa-inverse"></i>
                        </span>
                <h4 class="service-heading">Servicio express</h4>
                <p class="text-muted">Todos nuestros profesionales son aprobados y entrenados por nuestro equipo. Validamos todos sus antecedentes para tu tranquilidad.</p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-gavel fa-stack-1x fa-inverse"></i>
                        </span>
                <h4 class="service-heading">Seguridad ante todo</h4>
                <p class="text-muted">Olvídate de las prestaciones sociales, dotaciones, herramientas y seguridad industrial, todo corre por nuestra cuenta.</p>
            </div>
            <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fa fa-circle fa-stack-2x text-primary"></i>
                            <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                        </span>
                <h4 class="service-heading">Confianza</h4>
                <p class="text-muted">Precios estandarizados, evita sorpresas con sobre costos, contrata el servicio que necesitas a un precio fijo del mercado.</p>
            </div>
        </div>
    </div>
    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/bootstrap.js')}}"></script>
    <script src="{{asset('js/todaruVideo.js')}}"></script>
    <script src="{{asset('js/ScriptMenu.js')}}"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            type:'POST',
            url: 'dataHome',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data){
                $.each(data, function( index, value ) {
                    var stringDiv = '<a href="{{route('servicios', 'parameter')}}" style="color: #fff">Ver mas...</a>';
                    var result = stringDiv.replace("parameter", value['id']);

                    $('#contenedorAreas').append('<div class="col-md-4 col-sm-6 portfolio-item" style="margin-top: 2%">\n' +
                        '<div class="containerImg">\n' +
                        '<img src="img/'+ value['img'] +'" class="img-thumbnail" alt="Servicios de plomeria" class="image">\n' +
                        '<div class="overlay">\n' +
                        '<div class="text">\n' +
                        '<h2>'+ value['name'] +'</h2>\n' +
                        '<br>\n' +
                        '<h1>'+ result +'</h1>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>')
                });
            }
        });
    });
</script>
</body>
@include('footer')
</html>
