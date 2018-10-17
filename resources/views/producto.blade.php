@extends('layouts.app')
@section('content')
  @if(Auth::user()->role_id == 1)
   @include('partials.modal.editar')
   @include('partials.modal.general')
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
        @if ($errors->any())
            <div class="alert alert-danger">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </div>
        @endif
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="panel">
                                            <div class="panel-body">
                                                <!--<label class="title-table">Resumen de movimientos</label>-->
                                                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-bottom: 30px;">
                                                         <a class="btn btn-success" id="general_modal" data-toggle="modal" data-target="#generalModal">REPORTES</a> 
                                                 </div>
                                                 <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
                                                    <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-bottom: 20px;"></div>
                                                     <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-bottom: 20px;">
                                                       <label>Busqueda por producto: </label>
                                                        <input type="text" id="busqueda" name="busqueda" placeholder="Buscar..."/>
                                                     </div>
                                                    <thead>
                                                        <tr class="tr-style">
                                                            <th>A. P. N/A</th>
                                                            <th>No. identificación</th>
                                                            <th>Factura</th>
                                                            <th>Unidad</th>
                                                            <th>Descripción</th>
                                                            <th>Cantidad</th>
                                                            <th>Importe</th>
                                                            <th>Acciones</th>
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
                                                            <td> 
                                                                <a class="btn btn-success" id="edit_modal" data-toggle="modal" data-target="#editModal" onclick="editar_registro( '{{ $producto->id }}','{{$producto->descripcion}}' )"><span class="glyphicon glyphicon-edit"></span></a> 
                                                            </td>
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

@endif
@endsection
