<?php $__env->startSection('content'); ?>
  <?php if(Auth::user()->role_id == 1): ?>
   <?php echo $__env->make('partials.modal.editar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   <?php echo $__env->make('partials.modal.general', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
          <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">Pendientes por aprobar</div>

                        <div class="panel-body">
                             <div id="mensaje"></div>
                            <?php if(session('status')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
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
                                                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr id="productoRow_<?php echo e($producto->id); ?>">
                                                            <td>
                                                                <input type="radio" class="validar-producto" data-id="<?php echo e($producto->id); ?>" id="accion_<?php echo e($producto->id); ?>" name="accion_<?php echo e($producto->id); ?>" value="aprobado" <?php echo e($producto->estatus === 'APROBADO' ? 'checked' : ''); ?>>
                                                                <input type="radio" class="validar-producto" data-id="<?php echo e($producto->id); ?>" id="accion_<?php echo e($producto->id); ?>" name="accion_<?php echo e($producto->id); ?>" value="pendiente" <?php echo e($producto->estatus === 'PENDIENTE' ? 'checked' : ''); ?>>
                                                                <input type="radio" class="validar-producto" data-id="<?php echo e($producto->id); ?>" id="accion_<?php echo e($producto->id); ?>" name="accion_<?php echo e($producto->id); ?>" value="no_aprobados" <?php echo e($producto->estatus === 'NO APROBADO' ? 'checked' : ''); ?>>
                                                            </td>
                                                            <td> <?php echo e($producto->no_identificacion); ?> </td>
                                                            <td> <?php echo e($producto->id_factura); ?> </td>
                                                            <td> <?php echo e($producto->unidad); ?> </td>
                                                            <td> <?php echo e($producto->descripcion); ?> </td>
                                                            <td> $ <?php echo e($producto->cantidad); ?> </td>
                                                            <td> $ <?php echo e($producto->importe); ?> </td>
                                                            <td> 
                                                                <a class="btn btn-success" id="edit_modal" data-toggle="modal" data-target="#editModal" onclick="editar_registro( '<?php echo e($producto->id); ?>','<?php echo e($producto->descripcion); ?>' )"><span class="glyphicon glyphicon-edit"></span></a> 
                                                            </td>
                                                            <!--<td>
                                                                 <a class="btn btn-<?php echo e($producto->estatus == 'APROBADO' ? 'primary' : ($producto->estatus == 'PENDIENTE' ? 'success' : 'danger')); ?> validar-producto" id="validar-producto" data-id="<?php echo e($producto->id); ?>" name="validar-producto" style="width: 130px" data-toggle="modal" data-target="#estatusModal"><?php echo e($producto->estatus); ?></a> 
                                                            </td>-->
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

<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>