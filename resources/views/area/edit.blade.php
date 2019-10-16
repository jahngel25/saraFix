@extends('layouts.app')

@section('content')
    <div class="container formRegister" style="margin-top: 5%">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar Area</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('actionEditArea', $modelArea->id) }}" files="true" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Area</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="stylesInput" name="name" value="{{$modelArea->name}}" required autofocus>
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
                                    <input id="description" type="text" class="stylesInput" name="description" value="{{$modelArea->description}}" required autofocus>

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
                                    <input id="img" type="file" class="stylesInput" name="img" value="{{$modelArea->img}}" autofocus>

                                    @if ($errors->has('img'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('img') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('texto') ? ' has-error' : '' }}">
                                <label for="texto" class="col-md-4 control-label">Texto</label>

                                <div class="col-md-6">
                                    <input id="texto" type="text" class="stylesInput" name="texto" value="{{$modelArea->texto}}" required autofocus>

                                    @if ($errors->has('texto'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('texto') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('img_inter') ? ' has-error' : '' }}">
                                <label for="img_inter" class="col-md-4 control-label">Segunda Imagen</label>

                                <div class="col-md-6">
                                    <input id="img_inter" type="file" class="stylesInput" name="img_inter" value="{{$modelArea->img_inter}}}}" autofocus>

                                    @if ($errors->has('img_inter'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('img_inter') }}</strong>
                                </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-warning colorBtn">
                                        Editar
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
