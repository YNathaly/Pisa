<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DATOS DE FACTURA</title>
       <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  </head>
  <body>
<br><br>
 <div class="container">
    <div class="panel panel-default">





        <div class="panel-heading">DATOS DE FACTURA</div>
        <div class="panel-body">
			<div class="row">
		        <div class="col-lg-12 col-md-12 col-sm-12">
		            <div class="panel">
		                <div class="panel-body">

		                    <table id="factura" class="table table-striped table-bordered table-factura" style="margin-top: 50px">
                                <thead>
                                    <tr class="table table-bordered">
                                        <th>Factura</th>
                                        <th>Monto de Factura</th>
                                        <th>Pisapesos por Factura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($facturas as $factura)
                                    <tr id="facturaRow{{ $factura['id'] }}" class="factura">
                                        <td> {{ $factura['folio'] }} </td>
                                        <td> $ {{ $factura['total'] }} </td>
                                        <td> {{ $factura['pisapesos'] }} </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

@if($accion == 1)

    					<div class="panel panel-default">
                             <div class="panel-heading">Productos Aprobados</div>
						        <div class="panel-body">
									<div class="row">
								        <div class="col-lg-12 col-md-12 col-sm-12">
								            <div class="panel">
								                <div class="panel-body">

								                     <table id="productos" class="table table-striped table-bordered table-pendientes" style="margin-top: 50px">
						                                <thead>
						                                    <tr class="tr-style">
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
						                                 @if($producto['estatus'] == 'APROBADO')
						                                        <tr id="productoRow{{ $producto['id'] }}" class="productos">
						                                            <td> {{ $producto['no_identificacion'] }} </td>
						                                            <td> {{ $producto['folio_factura'] }} </td>
						                                            <td> {{ $producto['unidad'] }} </td>
						                                            <td> {{ $producto['descripcion'] }} </td>
						                                            <td> {{ $producto['cantidad'] }} </td>
						                                            <td> $ {{ $producto['importe'] }} </td>
						                                        </tr>
						                                  @endif
						                                @endforeach
						                                </tbody>
						                            </table> 
								                </div>
								            </div>  
								        </div>            
								    </div> 
						        </div>
							 </div> 
							 <div class="panel panel-default">
                             <div class="panel-heading">Productos Pendientes</div>
						        <div class="panel-body">
									<div class="row">
								        <div class="col-lg-12 col-md-12 col-sm-12">
								            <div class="panel">
								                <div class="panel-body">

								                     <table id="productos" class="table table-striped table-bordered table-pendientes" style="margin-top: 50px">
						                                <thead>
						                                    <tr class="tr-style">
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
						                                 @if($producto['estatus'] == 'PENDIENTE')
						                                        <tr id="productoRow{{ $producto['id'] }}" class="productos">
						                                            <td> {{ $producto['no_identificacion'] }} </td>
						                                            <td> {{ $producto['folio_factura'] }} </td>
						                                            <td> {{ $producto['unidad'] }} </td>
						                                            <td> {{ $producto['descripcion'] }} </td>
						                                            <td> {{ $producto['cantidad'] }} </td>
						                                            <td> $ {{ $producto['importe'] }} </td>
						                                        </tr>
						                                  @endif
						                                @endforeach
						                                </tbody>
						                            </table> 
								                </div>
								            </div>  
								        </div>            
								    </div> 
						        </div>
							 </div>
							 <div class="panel panel-default">
                             <div class="panel-heading">Productos No Aprobados</div>
						        <div class="panel-body">
									<div class="row">
								        <div class="col-lg-12 col-md-12 col-sm-12">
								            <div class="panel">
								                <div class="panel-body">

								                     <table id="productos" class="table table-striped table-bordered table-pendientes" style="margin-top: 50px">
						                                <thead>
						                                    <tr class="tr-style">
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
						                                 @if($producto['estatus'] == 'NO APROBADO')
						                                        <tr id="productoRow{{ $producto['id'] }}" class="productos">
						                                            <td> {{ $producto['no_identificacion'] }} </td>
						                                            <td> {{ $producto['folio_factura'] }} </td>
						                                            <td> {{ $producto['unidad'] }} </td>
						                                            <td> {{ $producto['descripcion'] }} </td>
						                                            <td> {{ $producto['cantidad'] }} </td>
						                                            <td> $ {{ $producto['importe'] }} </td>
						                                        </tr>
						                                  @endif
						                                @endforeach
						                                </tbody>
						                            </table> 
								                </div>
								            </div>  
								        </div>            
								    </div> 
						        </div>
							 </div>
@endif						       






		                </div>
		            </div>  
		        </div>            
		    </div> 
        </div>








	</div>
</div>

	


  </body>
</html>




<!-- 
      <table id="productos" class="table table-striped table-bordered table-pendientes" style="margin-top: 50px">
                                <thead>
                                    <tr class="tr-style">
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
                                 @if($producto['estatus'] == 'APROBADO')
                                        <tr id="productoRow{{ $producto['id'] }}" class="productos">
                                            <td> {{ $producto['no_identificacion'] }} </td>
                                            <td> {{ $producto['folio_factura'] }} </td>
                                            <td> {{ $producto['unidad'] }} </td>
                                            <td> {{ $producto['descripcion'] }} </td>
                                            <td> {{ $producto['cantidad'] }} </td>
                                            <td> $ {{ $producto['importe'] }} </td>
                                        </tr>
                                  @endif
                                @endforeach
                                </tbody>
                            </table> -->
