<!DOCTYPE html>
<html lang="en">
  <head>
    <title>DATOS DE FACTURA</title>
       <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
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
                                <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="facturaRow<?php echo e($factura['id']); ?>" class="factura">
                                        <td> <?php echo e($factura['folio']); ?> </td>
                                        <td> $ <?php echo e($factura['total']); ?> </td>
                                        <td> <?php echo e($factura['pisapesos']); ?> </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

<?php if($accion == 1): ?>

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
						                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                                 <?php if($producto['estatus'] == 'APROBADO'): ?>
						                                        <tr id="productoRow<?php echo e($producto['id']); ?>" class="productos">
						                                            <td> <?php echo e($producto['no_identificacion']); ?> </td>
						                                            <td> <?php echo e($producto['folio_factura']); ?> </td>
						                                            <td> <?php echo e($producto['unidad']); ?> </td>
						                                            <td> <?php echo e($producto['descripcion']); ?> </td>
						                                            <td> <?php echo e($producto['cantidad']); ?> </td>
						                                            <td> $ <?php echo e($producto['importe']); ?> </td>
						                                        </tr>
						                                  <?php endif; ?>
						                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
						                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                                 <?php if($producto['estatus'] == 'PENDIENTE'): ?>
						                                        <tr id="productoRow<?php echo e($producto['id']); ?>" class="productos">
						                                            <td> <?php echo e($producto['no_identificacion']); ?> </td>
						                                            <td> <?php echo e($producto['folio_factura']); ?> </td>
						                                            <td> <?php echo e($producto['unidad']); ?> </td>
						                                            <td> <?php echo e($producto['descripcion']); ?> </td>
						                                            <td> <?php echo e($producto['cantidad']); ?> </td>
						                                            <td> $ <?php echo e($producto['importe']); ?> </td>
						                                        </tr>
						                                  <?php endif; ?>
						                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
						                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						                                 <?php if($producto['estatus'] == 'NO APROBADO'): ?>
						                                        <tr id="productoRow<?php echo e($producto['id']); ?>" class="productos">
						                                            <td> <?php echo e($producto['no_identificacion']); ?> </td>
						                                            <td> <?php echo e($producto['folio_factura']); ?> </td>
						                                            <td> <?php echo e($producto['unidad']); ?> </td>
						                                            <td> <?php echo e($producto['descripcion']); ?> </td>
						                                            <td> <?php echo e($producto['cantidad']); ?> </td>
						                                            <td> $ <?php echo e($producto['importe']); ?> </td>
						                                        </tr>
						                                  <?php endif; ?>
						                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                                </tbody>
						                            </table> 
								                </div>
								            </div>  
								        </div>            
								    </div> 
						        </div>
							 </div>
<?php endif; ?>						       






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
                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                 <?php if($producto['estatus'] == 'APROBADO'): ?>
                                        <tr id="productoRow<?php echo e($producto['id']); ?>" class="productos">
                                            <td> <?php echo e($producto['no_identificacion']); ?> </td>
                                            <td> <?php echo e($producto['folio_factura']); ?> </td>
                                            <td> <?php echo e($producto['unidad']); ?> </td>
                                            <td> <?php echo e($producto['descripcion']); ?> </td>
                                            <td> <?php echo e($producto['cantidad']); ?> </td>
                                            <td> $ <?php echo e($producto['importe']); ?> </td>
                                        </tr>
                                  <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table> -->
