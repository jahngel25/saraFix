@extends('layouts.app')

@section('content')

    <div class="container formRegister">
        <div class="col-md-8 col-md-offset-4">
            <div class="panel panel-default classTransparent">
                <div class="panel-heading classTransparent classTitlePanel">Contactenos</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('crearContactenos') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo Electronico</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('telefono') ? ' has-error' : '' }}">
                            <label for="telefono" class="col-md-4 control-label">Telefono</label>

                            <div class="col-md-6">
                                <input id="telefono" type="text" class="form-control" name="telefono" required>

                                @if ($errors->has('telefono'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('mensaje') ? ' has-error' : '' }}">
                            <label for="mensaje" class="col-md-4 control-label">Mensaje</label>

                            <div class="col-md-6">
                                <textarea name="mensaje" id="mensaje" cols="30" rows="10" style="height: 5rem;color: #fff" required>

                                </textarea>
                                @if ($errors->has('mensaje'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mensaje') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-default colorBtn">
                                    Enviar
                                </button>
                            </div>
                        </div>

                        <input type="hidden" name="type_user" id="type_user" value="2">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
