<!DOCTYPE html>
<html lang="en">
  <head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
    <title>Reporte General PISA </title>
     <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
     <link href="{{ asset('css/pdfs.css') }}" rel="stylesheet">
  </head>
  <body>


 <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Reporte general PISA</div>




        <div class="panel-body">
			<div class="row">
		        <div class="col-lg-12 col-md-12 col-sm-12">
		            <div class="panel">
		                <div class="panel-body">

		                     <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
		                        <thead>
		                            <tr class="table_style">
		                                <th class="upper">Folio</th>
		                                <th class="upper">Subtotal</th>
		                                <th class="upper">Total</th>
		                                <th class="upper">Descuento</th>
		                                <th class="upper">Moneda</th>
		                                <th class="upper">Fecha</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        @foreach($facturas as $factura)
		                            <tr id="facturaRow_{{ $factura['id'] }}">
		                                <td> {{ $factura['folio'] }} </td>
		                                <td> {{ $factura['subtotal'] }} </td>
		                                <td> {{ $factura['total'] }} </td>
		                                <td> {{ $factura['descuento'] }} </td>
		                                <td> $ {{ $factura['moneda'] }} </td>
		                                <td> {{ $factura['fecha'] }} </td>
		                            </tr>
		                        @endforeach
		                        </tbody>
		                    </table>

							<div class="panel-body">
								<div class="row">
							        <div class="col-lg-12 col-md-12 col-sm-12">
							            <div class="panel">
							                <div class="panel-body">

							                     <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
							                        <thead>
							                            <tr class="table_style">
							                                <th>Clave</th>
							                                <th>Factura</th>
							                                <th>Descripción</th>
							                                <th>Cantidad</th>
							                                <th>Descuento</th>
							                                <th>Importe</th>
							                                <th style="font-size: 10px">Valor Unitario</th>
							                            </tr>
							                        </thead>
							                        <tbody>
							                        @foreach($infoFormato as $producto)
							                            <tr id="productoRow_{{ $producto['id'] }}">
							                                <td> {{ $producto['no_identificacion'] }} </td>
							                                <td> {{ $producto['folio'] }} </td>
							                                <td> {{ $producto['descripcion'] }} </td>
							                                <td> {{ $producto['cantidad'] }} </td>
							                                <td> $ {{ $producto['descuento'] }} </td>
							                                <td> $ {{ $producto['importe'] }} </td>
							                                <td> $ {{ $producto['valor_unitario'] }} </td>
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
        </div>






	</div>
</div>

	


  </body>
</html>



