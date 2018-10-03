<!DOCTYPE html>
<html lang="en">
  <head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
    <title>Reporte General PISA </title>
     <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
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
		                            <tr class="table table-bordered">
		                                <th>Folio</th>
		                                <th>Subtotal</th>
		                                <th>Total</th>
		                                <th>Descuento</th>
		                                <th>Moneda</th>
		                                <th>Fecha</th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                        <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		                            <tr id="facturaRow_<?php echo e($factura['id']); ?>">
		                                <td> <?php echo e($factura['folio']); ?> </td>
		                                <td> <?php echo e($factura['subtotal']); ?> </td>
		                                <td> <?php echo e($factura['total']); ?> </td>
		                                <td> <?php echo e($factura['descuento']); ?> </td>
		                                <td> $ <?php echo e($factura['moneda']); ?> </td>
		                                <td> <?php echo e($factura['fecha']); ?> </td>
		                            </tr>
		                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		                        </tbody>
		                    </table>

							<div class="panel-body">
								<div class="row">
							        <div class="col-lg-12 col-md-12 col-sm-12">
							            <div class="panel">
							                <div class="panel-body">

							                     <table id="a_validar" class="table table-striped table-bordered a_validar" style="margin-top: 50px">
							                        <thead>
							                            <tr class="table table-bordered" style="font-size: 10px">
							                                <th>Identificación</th>
							                                <th>Factura</th>
							                                <th>Descripción</th>
							                                <th>Cantidad</th>
							                                <th>Descuento</th>
							                                <th>Importe</th>
							                                <th>Valor Unitario</th>
							                            </tr>
							                        </thead>
							                        <tbody>
							                        <?php $__currentLoopData = $infoFormato; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							                            <tr id="productoRow_<?php echo e($producto['id']); ?>" style="font-size: 10px">
							                                <td> <?php echo e($producto['no_identificacion']); ?> </td>
							                                <td> <?php echo e($producto['folio']); ?> </td>
							                                <td> <?php echo e($producto['descripcion']); ?> </td>
							                                <td> <?php echo e($producto['cantidad']); ?> </td>
							                                <td> $ <?php echo e($producto['descuento']); ?> </td>
							                                <td> $ <?php echo e($producto['importe']); ?> </td>
							                                <td> $ <?php echo e($producto['valor_unitario']); ?> </td>
							                            </tr>
							                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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



