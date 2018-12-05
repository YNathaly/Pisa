@extends('layouts.principal')
@section('content')
   <script>
  $( function() {
    $("#burn_date").datepicker({ dateFormat: 'dd-mm-yy' });
  });
  </script>

<div class="container">
    <div class="row" style="margin-top: 90px;margin-bottom: 50px;">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="font-weight: bold; font-size: 16px;">REGISTRO</div>
                <div class="panel-body">
                    <div class="splitBlock"></div>

                     {!! Form::open(['url' => '/register', 'method' => 'POST']) !!}
                    <div class="col-xs-12 col-md-6 col-lg-6">
                    <!--<form class="form-horizontal" method="POST" action="{{ route('register') }}">-->
                       
                        {{ csrf_field() }}


                         @if(isset($message))
                         <span class="help-block">
                            <strong>{{ $message }}</strong>
                        </span>
                         @endif
                         

                        <div class="block-register splitBlock form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Nombre de usuario *') }}</label>

                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       

                        <div class="block-register splitBlock form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Contraseña *') }}</label>

                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="block-register splitBlock form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Confirmación de contraseña *') }}</label>

                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="block-register splitBlock form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="genero" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Genero *') }}</label>
                            
                                <div class="col-xs-2 col-sm-2 col-lg-2">
                                    <input type="radio" name="gender" value="HOMBRE">HOMBRE<br>
                                </div>
                                <div class="col-xs-2 col-sm-2 col-lg-2">
                                    <input type="radio" name="gender" value="MUJER">MUJER<br>
                                </div>
                                @if ($errors->has('genero'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('genero') }}</strong>
                                    </span>
                                @endif
                          
                        </div>

                        <div class="block-register splitBlock form-group{{ $errors->has('burn_date') ? ' has-error' : '' }}">
                            <label for="burn_date" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Fecha de Nacimiento*') }}</label>
                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="burn_date" type="text" class="form-control" name="burn_date" value="{{ old('burn_date') }}" required autofocus>
                                @if ($errors->has('burn_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('burn_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                       
                      

                        <div class="block-register splitBlock form-group{{ $errors->has('state') ? ' has-error' : '' }}">
                            <label for="state" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Estado *') }}</label>
                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="state" type="text" class="form-control" name="state" value="{{ old('state') }}" required autofocus>
                                @if ($errors->has('state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('state') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                      

                        <div class="block-register splitBlock form-group{{ $errors->has('colonia') ? ' has-error' : '' }}">
                            <label for="colonia" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Colonia *') }}</label>
                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="colonia" type="text" class="form-control" name="colonia" value="{{ old('colonia') }}" required autofocus>
                                @if ($errors->has('colonia'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('colonia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       

                        <div class="block-register splitBlock form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Correo electrónico *') }}</label>

                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                   </div>

                   <div class="col-xs-12 col-md-6 col-lg-6">
                        <div class="block-register splitBlock form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                                <label for="business_name" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Nombre del negocio *') }}</label
                                    >
                                <div class="col-xs-5 col-sm-5 col-lg-5">
                                    <input id="business_name" type="text" class="form-control" name="business_name" value="{{ old('business_name') }}" required autofocus>

                                    @if ($errors->has('business_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('business_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                        </div> 
                
                        <div class="block-register splitBlock form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Número de celular') }}</label>
                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="phone" type="text" class="form-control" name="phone" value="" required autofocus>
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    
                        <div class="block-register splitBlock form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Calle y N° *') }}</label>
                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>
                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="block-register splitBlock form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Localidad *') }}</label>
                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}"required autofocus>
                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="block-register splitBlock form-group{{ $errors->has('postal_code') ? ' has-error' : '' }}">
                            <label for="postal_code" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Código Postal *') }}</label>
                            <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="postal_code" type="text" class="form-control" name="postal_code" value="{{ old('postal_code') }}" required autofocus>
                                @if ($errors->has('postal_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="block-register splitBlock form-group{{ $errors->has('business_type') ? ' has-error' : '' }}">
                            <label for="business_type" class="col-xs-12 col-sm-6 col-lg-6">{{ __('Tipo de negocio *') }}</label>
                            <div class="col-xs-5 col-sm-5 col-lg-5">
                            <select class="form-control" id="business_type" name="business_type" style="height: 34px;">
                              <option value="1">Rancho</option>
                              <option value="2">Clinica</option>
                              <option value="3">Granja</option>
                            </select>
                                @if ($errors->has('business_type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('business_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         
                        <div class="block-register splitBlock form-group{{ $errors->has('rfc') ? ' has-error' : '' }}">
                           <label for="rfc" class="col-xs-12 col-sm-4 col-lg-4" style="text-align: left">{{ __('RFC *') }}</label>
                           
                            <div title="Agregar RFC Persona Moral.">
                                <img  src="img/sign.png" class="col-xs-1 col-sm-1 col-lg-2" >
                            </div>

                           <div class="col-xs-5 col-sm-5 col-lg-5">
                                <input id="rfc" type="rfc" class="form-control" name="rfc" value="{{ old('rfc') }}" required>

                                @if ($errors->has('rfc'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('rfc') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                        <label for="rfc" class="col-xs-12 col-sm-12 col-lg-12" style="text-align: right; font-weight: normal; font-size: 12px;">{{ __('Requisito *') }}</label>
                        <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
                                <button type="submit" class="btn btn-primary"  style="width: 130px;  border-radius:0px; color:white;">
                                    {{ __('REGÍSTRATE') }}
                                </button>
                        </div>
   {!! Form::close() !!}                
                   </div>

                   <div class="splitBlock"></div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection