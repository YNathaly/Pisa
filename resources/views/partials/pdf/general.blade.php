<!DOCTYPE html>
<html lang="en">
  <head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
    <title>Reporte General PISA </title>
     <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
     <link href="{{ asset('css/pdfs.css') }}" rel="stylesheet">
  </head>
  <body>

	<div class="content">                       		
	    <div class="panel panel-default">

		@foreach($user as $usuario)    	
        	<div class="panel panel-default">
		        <div class="panel-heading">INFORMACIÓN DE CLIENTE </div>
			        <div class="col-lg-12 col-md-12 col-sm-12"> 
			          <div><b>Nombre de cliente: </b> {{ $usuario['name'] }}</div>
			          <div><b>Dirección:</b> {{ $usuario['address'] }} <b>Colonia:</b> {{ $usuario['colonia'] }} <b>C.P.</b> {{ $usuario['postal'] }} {{ $usuario['city'] }} {{ $usuario['state'] }}</div>
					  <div><b>Número de celular:</b> {{ $usuario['phone'] }}</div>
					  <div><b>Correo electrónico:</b> {{ $usuario['email'] }}</div>
					  <div><b>RFC:</b> {{ $usuario['rfc'] }} </div>	
		    		</div> 
			</div>


	        <div class="panel-heading">FACTURAS</div>
	        <div class="panel-body">
				<div class="row">
			        <div class="col-lg-12 col-md-12 col-sm-12">
			            <div class="panel">
			                <div class="panel-body">

							
			                    <table id="a_validar" class="table table-striped table-bordered a_validar">
									@foreach($facturas as $factura)
										@if( $factura['id_user'] == $usuario['id'])
					                       	<tr class="table_style">
				                                <th>Folio</th>
				                                <th>Subtotal</th>
				                                <th>Total</th>
				                                <th>Descuento</th>
				                                <th>Moneda</th>
				                                <th>Fecha</th>
				                                <th></th>
				                            </tr>
				                        
				                            <tr id="facturaRow_{{ $factura['id'] }}">
				                                <td> {{ $factura['folio'] }}  </td>
				                                <td> {{ $factura['subtotal'] }} </td>
				                                <td> {{ $factura['total'] }} </td>
				                                <td> {{ $factura['descuento'] }} </td>
				                                <td> $ {{ $factura['moneda'] }} </td>
				                                <td> {{ $factura['fecha'] }} </td>
				                                <td></td>
				                            </tr>
				                            <tr class="table_style">
				                                <th>Clave</th>
				                                <th>Descripción</th>
				                                <th>Cantidad</th>
				                                <th>Descuento</th>
				                                <th>Importe</th>
				                                <th>Valor Unitario</th>
				                                <th>Estatus</th>
				                            </tr>
					                            @foreach($infoFormato as $producto)          
					                            	@if($factura['folio'] == $producto['folio'])
							                            <tr id="productoRow_{{ $producto['id'] }}">
							                                <td> {{ $producto['no_identificacion'] }} </td>
							                                <td> {{ $producto['descripcion'] }} </td>
							                                <td> {{ $producto['cantidad'] }} </td>
							                                <td> $ {{ $producto['descuento'] }} </td>
							                                <td> $ {{ $producto['importe'] }} </td>
							                                <td> $ {{ $producto['valor_unitario'] }} </td>
							                                <td> {{ $producto['estatus'] }} </td>
							                            </tr>
							                    	@endif
							                  	@endforeach
						                @endif
			                        @endforeach
			                     
			                    </table>

				
			               

			                </div>
			            </div>  
			        </div>            
			    </div> 
	        </div>
		@endforeach

		</div>
	</div>

  </body>
</html>

