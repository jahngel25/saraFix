@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: 3%">
        @foreach($modelServicio as $value)
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="row" style="padding: 3%">
                            <div class="col-md-12">
                                <div class="col-md-3 text-center">
                                    <strong><h4>Profesional</h4></strong>
                                    <h5><span id="lblPrecio_0">{{$value->userProfesional}}</span></h5>
                                </div>
                                <div class="col-md-3 text-center">
                                    <strong><h4>Cliente</h4></strong>
                                    <h5><span id="lblPrecio_0">{{$value->userCliente}}</span></h5>
                                </div>
                                <div class="col-md-2 text-center">
                                    <h4><strong><span id="lblPrecio_0">{{$value->date}}</span></strong></h4>
                                </div>
                                <div class="col-md-2 text-center" style="padding-top: 2%;">
                                    @if(isset($value->puntajeProfesional))
                                        <h4>Profesional</h4>
                                        <select id="star-ratingPro{{$value->id}}" name="puntajePro{{$value->id}}">
                                            <option value="{{$value->puntajeProfesional}}">{{$value->puntajeProfesional}}</option>
                                        </select>
                                    @endif
                                </div>
                                <div class="col-md-2 text-center" style="padding-top: 2%;">
                                    @if(isset($value->puntajeCliente))
                                        <h4>Cliente</h4>
                                        <select id="star-ratingCli{{$value->id}}" name="puntajeCli{{$value->id}}">
                                            <option value="{{$value->puntajeCliente}}">{{$value->puntajeCliente}}</option>
                                        </select>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
@section('contentScript')
    <script>
        @foreach($modelServicio as $value)
            var starratingPro{{$value->id}} = new StarRating( document.getElementById('star-ratingPro{{$value->id}}'));
            var starratingCli{{$value->id}} = new StarRating( document.getElementById('star-ratingCli{{$value->id}}'));
        @endforeach
    </script>
@endsection
