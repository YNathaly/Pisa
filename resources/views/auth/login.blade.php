@extends('layouts.principal')

@section('content')
<div id="main_logo">
    <img src="{{ asset('/img/logo.png') }}">
</div>
<div class="container">
    <div class="row justify-content-left">
        <!--<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>-->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-default" style="margin-top: 50px;">
                <div class="panel-heading">ACCEDE A TU CUENTA</div>




                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-12">Usuario</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-12">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password"     required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>password</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">

                                <a class="btn btn-link" href="{{ route('password.request') }}" style="margin-left:-10px;">
                                   ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <!-- <div class="col-md-12 col-md-offset-4"> -->
                            <div class="col-xs-6 col-sm-6 col-lg-6">
                                <button type="submit" class="btn btn-primary" style="width: 130px; border-radius:0px;">
                                    {{ __('INICIAR SESIÓN') }}
                                </button>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-lg-6" style="text-align: right;">
                               <a class="btn btn-primary" style="width: 130px;  border-radius:0px; color:white;" href="{{ route('register') }}">{{ __('REGÍSTRATE') }}</a>
                                <!--<a class="btn btn-link" href="{{ route('password.request') }}">
                                   {{ __('¿Olvidaste tu contraseña?') }}
                                </a>-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

       <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <img src="{{ asset('/img/logo.jpg') }}" class="logo">
        </div>
       
       
            
        
    </div>
</div>
@endsection
