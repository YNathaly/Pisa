<?php $__env->startSection('content'); ?>
  <?php if(Auth::user()->role_id == 1): ?>
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


                                 <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="panel">
                                            <div class="panel-body">

                                                <!--<label class="title-table">Resumen de movimientos</label>-->
                                                 <table id="a_validar" class="table table-striped table-bordered" style="margin-top: 50px">
                                                    <thead>
                                                        <tr class="tr-style">
                                                            <th>No identificación</th>
                                                            <th>Factura</th>
                                                            <th>Unidad</th>
                                                            <th>Descripción</th>
                                                            <th>Cantidad</th>
                                                            <th>Importe</th>
                                                            <th>Acción</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr id="productoRow_<?php echo e($producto->id); ?>">
                                                            <td> <?php echo e($producto->no_identificacion); ?> </td>
                                                            <td> <?php echo e($producto->id_factura); ?> </td>
                                                            <td> <?php echo e($producto->unidad); ?> </td>
                                                            <td> <?php echo e($producto->descripcion); ?> </td>
                                                            <td> $ <?php echo e($producto->cantidad); ?> </td>
                                                            <td> $ <?php echo e($producto->importe); ?> </td>
                                                            <td>
                                                                 <a class="btn btn-<?php echo e($producto->estatus == 'APROBADO' ? 'primary' : ($producto->estatus == 'PENDIENTE' ? 'success' : 'danger')); ?> validar-producto" id="validar-producto" data-id="<?php echo e($producto->id); ?>" name="validar-producto" style="width: 130px" data-toggle="modal" data-target="#estatusModal"><?php echo e($producto->estatus); ?></a> 
                                                            </td>
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


    <?php else: ?>


        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">INFORMACIÓN</div>

                        <div class="panel-body">
                            <?php if(session('status')): ?>
                                <div class="alert alert-success">
                                    <?php echo e(session('status')); ?>

                                </div>
                            <?php endif; ?>

                           <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__('Nombre del negocio')); ?></label>
                                <p class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__($user[0]['business_name'])); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__('Número de celular')); ?></label>
                                <p class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__($user[0]['phone'])); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__('Dirección')); ?></label>
                                <p class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__($user[0]['address'])); ?></p>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__('Correo electrónico')); ?></label>
                                <p class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__($user[0]['email'])); ?></p>
                            </div>

                            <?php echo Form::open([ 'id' => 'form-rfc', 'method' => 'POST']); ?>

                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-6 col-lg-3" style="margin-top: 5px"><?php echo e(__('RFC')); ?></label>
                                <!-- <p class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__($user[0]['rfc'])); ?></p> -->
                                <select class="form-control col-xs-12 col-sm-6 col-lg-6" id="rfc" name="rfc" style="margin-left: 15px; width: 200px;">
                                    <?php $__currentLoopData = $rfc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                         <option value="<?php echo e($valor->id); ?>"><?php echo e($valor->rfc); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php echo Form::close(); ?>


                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__('PisaPesos')); ?></label>
                                <p class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__('$250.60')); ?></p>
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
                             <?php echo Form::open([ 'id' => 'form-add', 'method' => 'POST', 'enctype' => 'multipart/form-data']); ?>

                                <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"></input>
                                <div id="errores"></div>
                                <div style="text-align: center; margin-top: 50px;"> 
                                    <label class="btn btn-primary" style="width: 30%; background: #2a91d6;">SUBIR FACTURA 
                                        <input type="file" id="factura-xml" name="factura-xml" style="display: none">
                                    </label>
                                </div><br>
                                <div style="text-align:  center;">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <!--<a href="" class="btn btn-primary" id="guardarFactura">Enviar</a>-->

                                </div>
                            <?php echo Form::close(); ?>


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
                                <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="facturaRow<?php echo e($factura->id); ?>" class="factura">
                                        <td> <?php echo e($factura->folio); ?> </td>
                                        <td> $ <?php echo e($factura->total); ?> </td>
                                        <td> 3 </td>
                                        <td><a class="btn btn-primary" style="width: 30%; background: #2a91d6;" href="<?php echo e(App::make('url')->to('/')); ?>/factura_info/<?php echo e($factura->id); ?>">ver</a> <?php echo e($factura->fecha); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <br><br><br>
                            <label class="title-table">Aprobados</label>
                            <table id="aprobados" class="table table-striped table-bordered table-aprobados" style="margin-top: 50px">
                                <thead>
                                    <tr class="tr-style">
                                        <th>No identificación</th>
                                        <th>Factura</th>
                                        <th>Unidad</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <!--<th>Acción</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($producto->estatus == 'APROBADO'): ?>
                                        <tr id="productoRow<?php echo e($producto->id); ?>" class="aprobados">
                                            <td> <?php echo e($producto->no_identificacion); ?> </td>
                                            <td> <?php echo e($producto->id_factura); ?> </td>
                                            <td> <?php echo e($producto->unidad); ?> </td>
                                            <td> <?php echo e($producto->descripcion); ?> </td>
                                            <td> <?php echo e($producto->cantidad); ?> </td>
                                            <td> $ <?php echo e($producto->importe); ?> </td>
                                            <!--<td><button class="btn btn-primary" style="background: #2a91d6;" href="">Validar</button></td>-->
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                             <br><br><br>
                            <!-- Se muestran los productos que no existen dentro de la Base de Datos de PISA -->
                            <label class="title-table">Pendientes</label>
                            <table id="pendientes" class="table table-striped table-bordered table-pendientes" style="margin-top: 50px">
                                <thead>
                                    <tr class="tr-style">
                                        <th>No identificación</th>
                                        <th>Factura</th>
                                        <th>Unidad</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <!--<th>Acción</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($producto->estatus == 'PENDIENTE'): ?>
                                        <tr id="productoRow<?php echo e($producto->id); ?>" class="pendientes">
                                            <td> <?php echo e($producto->no_identificacion); ?> </td>
                                            <td> <?php echo e($producto->id_factura); ?> </td>
                                            <td> <?php echo e($producto->unidad); ?> </td>
                                            <td> <?php echo e($producto->descripcion); ?> </td>
                                            <td> <?php echo e($producto->cantidad); ?> </td>
                                            <td> $ <?php echo e($producto->importe); ?> </td>
                                            <!--<td><button class="btn btn-primary" style="background: #2a91d6;" href="">Validar</button></td>-->
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>

                            <br><br><br>
                            <!-- Se muestran los productos que no existen dentro de la Base de Datos de PISA -->
                            <label class="title-table">No aprobados</label>
                            <table id="no_aprobados" class="table table-striped table-bordered table-no-aprobados" style="margin-top: 50px">
                                <thead>
                                    <tr class="tr-style">
                                        <th>No identificación</th>
                                        <th>Factura</th>
                                        <th>Unidad</th>
                                        <th>Descripción</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                        <th>Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($producto->estatus == 'NO APROBADO'): ?>
                                        <tr id="productoRow<?php echo e($producto->id); ?>" class="no_aprobados">
                                            <td> <?php echo e($producto->no_identificacion); ?> </td>
                                            <td> <?php echo e($producto->id_factura); ?> </td>
                                            <td> <?php echo e($producto->unidad); ?> </td>
                                            <td> <?php echo e($producto->descripcion); ?> </td>
                                            <td> <?php echo e($producto->cantidad); ?> </td>
                                            <td> $ <?php echo e($producto->importe); ?> </td>
                                            <td><a class="btn btn-primary" style="background: #2a91d6;" onclick="send_mail()">Enviar e-mail</a></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <br><br><br>
                        </div>
                    </div>
                </div>
            </div>






    </div>

 <?php endif; ?>    


     <!-- Status Modal -->
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
                    <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                    <button type="button" class="btn btn-primary aceptar_validacion" name="aceptar_validacion" id="aceptar_validacion">Validar producto</button>
                  </div>
           
            </div>
          </div>
        </div>


  




<?php $__env->stopSection(); ?>

                           
                               




<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>