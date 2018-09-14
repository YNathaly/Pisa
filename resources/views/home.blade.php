@extends('layouts.app')
@section('content')
  @if(Auth::user()->role_id == 1)
          <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Pendientes por aprobar</div>

                        <div class="panel-body">
                             <div id="mensaje"></div>
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                                 <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="panel">
                                            <div class="panel-body">

                                                <!--<label class="title-table">Resumen de movimientos</label>-->
                                                 <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
                                                    <thead>
                                                        <tr class="tr-style">
                                                            <th>A. P. N/A</th>
                                                            <th>No. identificación</th>
                                                            <th>Factura</th>
                                                            <th>Unidad</th>
                                                            <th>Descripción</th>
                                                            <th>Cantidad</th>
                                                            <th>Importe</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($productos as $producto)
                                                        <tr id="productoRow_{{ $producto->id }}">
                                                            <td>
                                                                <input type="radio" class="validar-producto" data-id="{{ $producto->id }}" id="accion_{{ $producto->id }}" name="accion_{{ $producto->id }}" value="aprobado" {{ $producto->estatus === 'APROBADO' ? 'checked' : '' }}>
                                                                <input type="radio" class="validar-producto" data-id="{{ $producto->id }}" id="accion_{{ $producto->id }}" name="accion_{{ $producto->id }}" value="pendiente" {{ $producto->estatus === 'PENDIENTE' ? 'checked' : '' }}>
                                                                <input type="radio" class="validar-producto" data-id="{{ $producto->id }}" id="accion_{{ $producto->id }}" name="accion_{{ $producto->id }}" value="no_aprobados" {{ $producto->estatus === 'NO APROBADO' ? 'checked' : '' }}>
                                                            </td>
                                                            <td> {{ $producto->no_identificacion }} </td>
                                                            <td> {{ $producto->id_factura }} </td>
                                                            <td> {{ $producto->unidad }} </td>
                                                            <td> {{ $producto->descripcion }} </td>
                                                            <td> $ {{ $producto->cantidad }} </td>
                                                            <td> $ {{ $producto->importe }} </td>
                                                            <!--<td>
                                                                 <a class="btn btn-{{ $producto->estatus == 'APROBADO' ? 'primary' : ($producto->estatus == 'PENDIENTE' ? 'success' : 'danger') }} validar-producto" id="validar-producto" data-id="{{ $producto->id }}" name="validar-producto" style="width: 130px" data-toggle="modal" data-target="#estatusModal">{{ $producto->estatus }}</a> 
                                                            </td>-->
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>  
                                    </div>            
                                </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @else

        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">INFORMACIÓN</div>

                        <div class="panel-body">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif

                           <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12">{{ __('Nombre del negocio') }}</label>
                                <p class="col-xs-12 col-sm-12 col-lg-12">{{ __($user[0]['business_name']) }}</p>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12">{{ __('Número de celular') }}</label>
                                <p class="col-xs-12 col-sm-12 col-lg-12">{{ __($user[0]['phone']) }}</p>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12">{{ __('Dirección') }}</label>
                                <p class="col-xs-12 col-sm-12 col-lg-12">{{ __($user[0]['address']) }}</p>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12">{{ __('Correo electrónico') }}</label>
                                <p class="col-xs-12 col-sm-12 col-lg-12">{{ __($user[0]['email']) }}</p>
                            </div>

                            {!! Form::open([ 'id' => 'form-rfc', 'method' => 'POST']) !!}
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-6 col-lg-3" style="margin-top: 5px">{{ __('RFC') }}</label>
                                <!-- <p class="col-xs-12 col-sm-12 col-lg-12">{{ __($user[0]['rfc']) }}</p> -->
                                <select class="form-control col-xs-12 col-sm-6 col-lg-6" id="rfc" name="rfc" style="margin-left: 15px; width: 200px;">
                                    @foreach($rfc as $valor) 
                                         <option value="{{ $valor->id }}">{{ $valor->rfc }}</option>
                                    @endforeach
                                </select>
                            </div>
                            {!! Form::close() !!}

                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12">{{ __('PisaPesos') }}</label>
                                <p class="col-xs-12 col-sm-12 col-lg-12">{{ __('$250.60') }}</p>
                            </div>

                            <!--<div class="alert alert-success">-->

                        </div>
                    </div>
                </div> 
            </div>



            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-body">
                             {!! Form::open([ 'id' => 'form-add', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                                <div id="errores"></div>
                                <div style="text-align: center; margin-top: 50px;" id="factura_xml"> 
                                    <label class="btn btn-primary" style="width: 30%; background: #2a91d6;">SUBIR FACTURA 
                                        <input type="file" id="factura-xml" name="factura-xml" style="display: none">
                                    </label><br><br>
                                    <span id="path"></span>
                                </div><br>
                                
                                <div style="text-align:  center;">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <!--<a href="" class="btn btn-primary" id="guardarFactura">Enviar</a>-->
                                </div>
                            {!! Form::close() !!}

                            <label class="title-table">Resumen de movimientos</label>
                            <table id="factura" class="table table-striped table-bordered table-factura" style="margin-top: 50px">
                                <thead>
                                    <tr class="tr-style">
                                        <th>Factura</th>
                                        <th>Monto de Factura</th>
                                        <th>Boletos para Participar</th>
                                        <th>Resumen de factura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($facturas as $factura)
                                    <tr id="facturaRow{{ $factura->id }}" class="factura">
                                        <td> {{ $factura->folio }} </td>
                                        <td> $ {{ $factura->total }} </td>
                                        <td> 3 </td>
                                        <td><a class="btn btn-primary" style="width: 30%; background: #2a91d6;" href="{{App::make('url')->to('/')}}/factura_info/{{ $factura->id }}">ver</a> {{ $factura->fecha }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <br><br><br>
                            <label class="title-table">Aprobados</label>
                            <table id="aprobados" class="table table-striped table-bordered table-aprobados" style="margin-top: 50px">
                                <thead>
                                    <tr class="tr-style">
                                        <th>No. identificación</th>
                                        <th>Factura</th>
                                        <th>Unidad</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <!--<th>Acción</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($productos as $producto)
                                    @if($producto->estatus == 'APROBADO')
                                        <tr id="productoRow{{ $producto->id }}" class="aprobados">
                                            <td> {{ $producto->no_identificacion }} </td>
                                            <td> {{ $producto->folio_factura }} </td>
                                            <td> {{ $producto->unidad }} </td>
                                            <td> {{ $producto->descripcion }} </td>
                                            <td> {{ $producto->cantidad }} </td>
                                            <td> $ {{ $producto->importe }} </td>
                                            <!--<td><button class="btn btn-primary" style="background: #2a91d6;" href="">Validar</button></td>-->
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                             <br><br><br>
                            <!-- Se muestran los productos que no existen dentro de la Base de Datos de PISA -->
                            <label class="title-table">Pendientes</label>
                            <table id="pendientes" class="table table-striped table-bordered table-pendientes" style="margin-top: 50px">
                                <thead>
                                    <tr class="tr-style">
                                        <th>No. identificación</th>
                                        <th>Factura</th>
                                        <th>Unidad</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <!--<th>Acción</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($productos as $producto)
                                    @if($producto->estatus == 'PENDIENTE')
                                        <tr id="productoRow{{ $producto->id }}" class="pendientes">
                                            <td> {{ $producto->no_identificacion }} </td>
                                            <td> {{ $producto->folio_factura }} </td>
                                            <td> {{ $producto->unidad }} </td>
                                            <td> {{ $producto->descripcion }} </td>
                                            <td> {{ $producto->cantidad }} </td>
                                            <td> $ {{ $producto->importe }} </td>
                                            <!--<td><button class="btn btn-primary" style="background: #2a91d6;" href="">Validar</button></td>-->
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>

                            <br><br><br>
                            <!-- Se muestran los productos que no existen dentro de la Base de Datos de PISA -->
                            <label class="title-table">No aprobados</label>
                            <table id="no_aprobados" class="table table-striped table-bordered table-no-aprobados" style="margin-top: 50px">
                                <thead>
                                    <tr class="tr-style">
                                        <th>No. identificación</th>
                                        <th>Factura</th>
                                        <th>Unidad</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($productos as $producto)
                                    @if($producto->estatus == 'NO APROBADO')
                                        <tr id="productoRow{{ $producto->id }}" class="no_aprobados">
                                            <td> {{ $producto->no_identificacion }} </td>
                                            <td> {{ $producto->folio_factura }} </td>
                                            <td> {{ $producto->unidad }} </td>
                                            <td> {{ $producto->descripcion }} </td>
                                            <td> {{ $producto->cantidad }} </td>
                                            <td> $ {{ $producto->importe }} </td>
                                            <td><a class="btn btn-primary" style="background: #2a91d6;" onclick="send_mail()">Enviar e-mail</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                            <br>

                            <a class="btn btn-primary reporte" id="reporte" data-id="" name="reporte" style="width: 130px; margin-bottom: 30px;" data-toggle="modal" data-target="#reporteModal">REPORTE</a>

                        </div>
                    </div>
                </div>




            </div>

    </div>

 @endif    


     <!-- Status Modal
        <div class="modal fade" id="estatusModal" tabindex="-1" role="dialog" aria-labelledby="estatusModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="estatusModalLabel">Acción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
                  <div class="modal-body">
                            <label>Cambiar Estatus</label>
                            <select class="form-control" id="estatus" name="estatus">
                              <option value="APROBADO">APROBADO</option>
                              <option value="PENDIENTE">PENDIENTE</option>
                              <option value="NO APROBADO">NO APROBADO</option>
                            </select>
                            <input type="hidden" name="identificador" id="identificador" value="">                  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-primary aceptar_validacion" name="aceptar_validacion" id="aceptar_validacion">Validar producto</button>
                  </div>
            </div>
          </div>
        </div>-->

          <!-- Reporte Modal -->
        <div class="modal fade" id="reporteModal" tabindex="-1" role="dialog" aria-labelledby="estatusModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="reporteModalLabel">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
           
                <form  id="imprimir_reporte" name="imprimir_reporte" method="POST" action="{{ url('imprimir_reporte') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"></input>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">Rango de Fechas</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-12 col-xs-12">
                          <input class="form-control" type="text" name="daterange" id="daterange" value="01/01/2018 - 01/15/2018" />
                      </div>
                      <div class="col-lg-6 col-md-12 col-xs-12">
                          <select class="form-control" id="estatus_reporte" name="estatus_reporte">
                              <option value="APROBADO">APROBADO</option>
                              <option value="PENDIENTE">PENDIENTE</option>
                              <option value="NO APROBADO">NO APROBADO</option>
                            </select>
                      </div>
                    </div>            
                  </div>
                  <div class="modal-footer">
                        <button type="submit" class="btn btn-primary imprimir_reporte" name="imprimir_reporte" id="imprimir_reporte">Imprimir Reporte</button>
                  </div>
                </form>  


           
            </div>
          </div>
        </div>
@endsection