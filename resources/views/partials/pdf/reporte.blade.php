<!DOCTYPE html>
<html lang="en">
  <head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
    <title>Reporte PISA UNO</title>
  </head>
  <body>


 <div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">Reporte PISA</div>

        <div class="panel-body">
			<div class="row">
		        <div class="col-lg-12 col-md-12 col-sm-12">
		            <div class="panel">
		                <div class="panel-body">

		                     <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
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
		                        @foreach($infoFormato as $producto)
		                            <tr id="productoRow_{{ $producto['id'] }}">
		                                <td> {{ $producto['no_identificacion'] }} </td>
		                                <td> {{ $producto['folio'] }} </td>
		                                <td> {{ $producto['unidad'] }} </td>
		                                <td> {{ $producto['descripcion'] }} </td>
		                                <td> $ {{ $producto['cantidad'] }} </td>
		                                <td> $ {{ $producto['importe'] }} </td>
		                            </tr>
		                        @endforeach
		                        </tbody>
		                    </table>

		                     <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
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
		                        @foreach($infoFormato as $producto)
		                            <tr id="productoRow_{{ $producto['id'] }}">
		                                <td> {{ $producto['no_identificacion'] }} </td>
		                                <td> {{ $producto['folio'] }} </td>
		                                <td> {{ $producto['unidad'] }} </td>
		                                <td> {{ $producto['descripcion'] }} </td>
		                                <td> $ {{ $producto['cantidad'] }} </td>
		                                <td> $ {{ $producto['importe'] }} </td>
		                            </tr>
		                        @endforeach
		                        </tbody>
		                    </table>

		                     <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
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
		                        @foreach($infoFormato as $producto)
		                            <tr id="productoRow_{{ $producto['id'] }}">
		                                <td> {{ $producto['no_identificacion'] }} </td>
		                                <td> {{ $producto['folio'] }} </td>
		                                <td> {{ $producto['unidad'] }} </td>
		                                <td> {{ $producto['descripcion'] }} </td>
		                                <td> $ {{ $producto['cantidad'] }} </td>
		                                <td> $ {{ $producto['importe'] }} </td>
		                            </tr>
		                        @endforeach
		                        </tbody>
		                    </table>

		                     <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
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
		                        @foreach($infoFormato as $producto)
		                            <tr id="productoRow_{{ $producto['id'] }}">
		                                <td> {{ $producto['no_identificacion'] }} </td>
		                                <td> {{ $producto['folio'] }} </td>
		                                <td> {{ $producto['unidad'] }} </td>
		                                <td> {{ $producto['descripcion'] }} </td>
		                                <td> $ {{ $producto['cantidad'] }} </td>
		                                <td> $ {{ $producto['importe'] }} </td>
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

	


  </body>
</html>



