@extends('layouts.app')

@section('content')

    <div class="container formRegister">
        <div class="col-md-8 col-md-offset-4">
            <div class="panel panel-default classTransparent">
                <div class="panel-heading classTransparent classTitlePanel">Registrese como Clientes</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}" id="register">
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

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Contraseña</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox" style="text-align: initial;">
                                    <label>
                                        <input type="checkbox" name="term" id="term" {{ old('term') ? 'checked' : '' }}>
                                        <a href="{{route('downloadTer', 'TERMINOS Y CONDICIONES FIX-CONTRACT.pdf')}}">Terminos y condiciones</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <input type="button" class="btn btn-default colorBtn" onclick="clickButton()" value="Registrame">
                            </div>
                        </div>

                        <input type="hidden" name="type_user" id="type_user" value="2">
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('contentScript')
    <script>
        function clickButton()
        {
            if($('#term').prop('checked') ) {
                $('#register').submit();
            }
            else
            {
                swal({
                    title: "Opps!",
                    text: "Debes aceptar terminos y condiciones",
                    icon: "info",
                    button: "Cerrar",
                });
            }
        }
    </script>
@endsection

