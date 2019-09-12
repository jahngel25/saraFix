@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 3%">
        @foreach($dataOrdenServicio as $value)
        <form action="{{route('aceptarServicio')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default" style="border-color: #c3c3c3; background-color: rgba(233,233,233,0.95); ">
                        <div class="row" style="padding: 3%">
                            <div class="col-md-1 col-xs-1">
                                <i class="fa fa-check-square-o fa-4x" aria-hidden="true" ></i>
                            </div><div class="col-md-1 col-xs-1">
                                <h4 class="product-name"><strong><span id="lblText_0">{{$value->description}}</span></strong></h4>
                            </div>
                            <div class="col-md-10 col-xs-10">
                                <div class="col-md-3 col-xs-4 text-center">
                                    <h4><strong><span id="lblPrecio_0">{{$value->date}}</span></strong></h4>
                                </div>
                                <div class="col-md-3 col-xs-4 text-center">
                                    <h4><strong><span id="lblPrecio_0">${{$value->total}} Pesos</span></strong></h4>
                                </div>
                                <div class="col-md-3 col-xs-4 text-center" style="padding-top: 2%;">
                                    <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
                                </div>
                                <div class="col-md-3 col-xs-4" align="right" style="padding-top: 2%;">
                                    <input type="hidden" name="id_orden" value="{{$value->id}}">
                                    <input type="hidden" name="id_todero" value="{{ Auth::user()->id }}">
                                    <input type="submit" class="btn-success" value="Aceptar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
    </div>
@endsection
