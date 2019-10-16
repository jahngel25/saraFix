@extends('layouts.app')

@section('content')
    <div class="container formRegister" style="margin-top: 10%">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Registrar Servicios</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('crearServicio') }}" files="true" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Servicio</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="stylesInput" name="name" value="{{ old('name') }}" required autofocus>
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Descripcion</label>

                                <div class="col-md-6">
                                    <input id="description" type="text" class="stylesInput" name="description" value="{{ old('description') }}" required autofocus>

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('img') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Imagen servicio</label>

                                <div class="col-md-6">
                                    <input id="img" type="file" class="stylesInput" name="img" value="{{ old('img') }}" required autofocus>

                                    @if ($errors->has('img'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('img') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('precio') ? ' has-error' : '' }}">
                                <label for="precio" class="col-md-4 control-label">Precio</label>

                                <div class="col-md-6">
                                    <input id="precio" type="text" class="stylesInput" name="precio" value="{{ old('precio') }}" required autofocus>

                                    @if ($errors->has('precio'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('precio') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('id_area') ? ' has-error' : '' }}">
                                <label for="id_area" class="col-md-4 control-label">Area</label>

                                <div class="col-md-6">
                                    <select name="id_area" id="id_area" class="stylesInput">
                                        <option value="0">Seleccione</option>
                                        @foreach($areas as $values)
                                            <option value="{{$values->id}}">{{$values->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('id_area'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('id_area') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-warning colorBtn">
                                        Crear
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
