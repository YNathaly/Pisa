<!DOCTYPE html>
<html lang="en">
  <head>
    <!--<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>-->
    <title>Reporte General PISA </title>
     <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
     <link href="<?php echo e(asset('css/pdfs.css')); ?>" rel="stylesheet">
  </head>
  <body>

	<div class="content">                       		
	    <div class="panel panel-default">

		<?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>    	
        	<div class="panel panel-default">
		        <div class="panel-heading">INFORMACIÓN DE CLIENTE </div>
			        <div class="col-lg-12 col-md-12 col-sm-12"> 
			          <div><b>Nombre de cliente: </b> <?php echo e($usuario['name']); ?></div>
			          <div><b>Dirección:</b> <?php echo e($usuario['address']); ?> <b>Colonia:</b> <?php echo e($usuario['colonia']); ?> <b>C.P.</b> <?php echo e($usuario['postal']); ?> <?php echo e($usuario['city']); ?> <?php echo e($usuario['state']); ?></div>
					  <div><b>Número de celular:</b> <?php echo e($usuario['phone']); ?></div>
					  <div><b>Correo electrónico:</b> <?php echo e($usuario['email']); ?></div>
					  <div><b>RFC:</b> <?php echo e($usuario['rfc']); ?> </div>	
		    		</div> 
			</div>


	        <div class="panel-heading">FACTURAS</div>
	        <div class="panel-body">
				<div class="row">
			        <div class="col-lg-12 col-md-12 col-sm-12">
			            <div class="panel">
			                <div class="panel-body">

							
			                    <table id="a_validar" class="table table-striped table-bordered a_validar">
									<?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php if( $factura['id_user'] == $usuario['id']): ?>
					                       	<tr class="table_style">
				                                <th class="upper">Folio</th>
				                                <th class="upper">Subtotal</th>
				                                <th class="upper">Total</th>
				                                <th class="upper">Descuento</th>
				                                <th class="upper">Moneda</th>
				                                <th class="upper">Fecha</th>
				                                <th class="upper">Pisa puntos</th>
				                            </tr>
				                        
				                            <tr id="facturaRow_<?php echo e($factura['id']); ?>">
				                                <td> <?php echo e($factura['folio']); ?>  </td>
				                                <td> <?php echo e($factura['subtotal']); ?> </td>
				                                <td> <?php echo e($factura['total']); ?> </td>
				                                <td> <?php echo e($factura['descuento']); ?> </td>
				                                <td> $ <?php echo e($factura['moneda']); ?> </td>
				                                <td> <?php echo e($factura['fecha']); ?> </td>
				                                <td>

												<?php			                                	
													$pisa_pesos = 0;
												?>		                                	
													<?php $__currentLoopData = $infoFormato; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>          
					                            		<?php if($factura['folio'] == $producto['folio'] && $producto['estatus'] == 'APROBADO' ): ?>
							                           		<?php
																
																$pisa_pesos += $producto['importe'] ;
							                           		?>
									                	<?php endif; ?>
									                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									                	<?php echo e($pisa_pesos); ?>


				                                </td>
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
					                            <?php $__currentLoopData = $infoFormato; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>          
					                            	<?php if($factura['folio'] == $producto['folio']): ?>
							                            <tr id="productoRow_<?php echo e($producto['id']); ?>">
							                                <td> <?php echo e($producto['no_identificacion']); ?> </td>
							                                <td> <?php echo e($producto['descripcion']); ?> </td>
							                                <td> <?php echo e($producto['cantidad']); ?> </td>
							                                <td> $ <?php echo e($producto['descuento']); ?> </td>
							                                <td> $ <?php echo e($producto['importe']); ?> </td>
							                                <td> $ <?php echo e($producto['valor_unitario']); ?> </td>
							                                <td> <?php echo e($producto['estatus']); ?> </td>
							                            </tr>
							                    	<?php endif; ?>
							                  	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						                <?php endif; ?>
			                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
			                     
			                    </table>

				
			               

			                </div>
			            </div>  
			        </div>            
			    </div> 
	        </div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</div>
	</div>

  </body>
</html>

