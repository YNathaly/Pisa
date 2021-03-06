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
                                                         <a href="docs/ManualAdministrador.pdf" class="btn btn-primary" target="_blank">MANUAL ADMINISTRADOR</a>
                                                </div>
                                                 <div class="scrollsearch">
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
                                                            <th>Acciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $productos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $producto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr id="productoRow_<?php echo e($producto->id); ?>">
                                                            <td>
                                                                <input type="radio" class="validar-producto" data-id="<?php echo e($producto->id); ?>" id="accion_<?php echo e($producto->id); ?>" name="accion_<?php echo e($producto->id); ?>" value="APROBADO" <?php echo e($producto->estatus === 'APROBADO' ? 'checked' : ''); ?>>
                                                                <input type="radio" class="validar-producto" data-id="<?php echo e($producto->id); ?>" id="accion_<?php echo e($producto->id); ?>" name="accion_<?php echo e($producto->id); ?>" value="PENDIENTE" <?php echo e($producto->estatus === 'PENDIENTE' ? 'checked' : ''); ?>>
                                                                <input type="radio" class="validar-producto" data-id="<?php echo e($producto->id); ?>" id="accion_<?php echo e($producto->id); ?>" name="accion_<?php echo e($producto->id); ?>" value="no_aprobados" <?php echo e($producto->estatus === 'NO APROBADO' ? 'checked' : ''); ?>>
                                                            </td>
                                                            <td> <?php echo e($producto->no_identificacion); ?> </td>
                                                            <td> <?php echo e($producto->folio_factura); ?> </td>
                                                            <td> <?php echo e($producto->unidad); ?> </td>
                                                            <td> <?php echo e($producto->descripcion); ?> </td>
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
        </div>

    <?php else: ?>
  <?php echo $__env->make('partials.modal.mail', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('partials.modal.delete', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  <?php echo $__env->make('partials.modal.general', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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

                            <?php if(Session::has('rfc_maximo')): ?>
                                <div class="alert alert-danger">
                                    <?php echo e(Session::get('rfc_maximo')); ?>

                                </div>
                            <?php endif; ?>

                            <?php if($errors->any()): ?> 
                              <div class="alert alert-danger">
                                  <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              </div>
                            <?php endif; ?>

                            <?php if(Session::has('message')): ?>
                              <div class="alert alert-success">
                                  <?php echo e(Session::get('message')); ?>

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
                                <label for="name" class="col-xs-12 col-sm-4 col-lg-4"><?php echo e(__('Dirección:')); ?></label>
                                <p class="col-xs-12 col-sm-8 col-lg-8">
                                    <br><label>Domicilio: </label><?php echo e(__($user[0]['address'])); ?> 
                                    <br><label>Colonia: </label><?php echo e(__($user[0]['colonia'])); ?> 
                                    <br><label>C.P. </label> <?php echo e(__($user[0]['postal'])); ?>

                                    <br><?php echo e(__($user[0]['city'])); ?> <?php echo e(__($user[0]['state'])); ?>

                                </p>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__('Correo electrónico')); ?></label>
                                <p class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__($user[0]['email'])); ?></p>
                            </div>

                            <?php echo Form::open([ 'id' => 'form_rfc', 'method' => 'POST', 'url' => 'filtro_rfc' ]); ?>

                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-6 col-lg-3" style="margin-top: 5px"><?php echo e(__('RFC')); ?></label>
                                <!-- <p class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__($user[0]['rfc'])); ?></p> -->
                                
                                <a class="btn btn-primary" style="margin-left: 5px;" data-toggle="modal" data-target="#rfcModal">+</a>

                                <select class="form-control col-xs-12 col-sm-6 col-lg-6" id="rfc" name="rfc" style="margin-left: 15px; width: 200px;">
                                    <option value="0">Todos...</option>
                                    <?php $__currentLoopData = $rfc; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $valor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                                         <option value="<?php echo e($valor->id); ?>" <?php echo e(( isset($rfc_active) && ( $rfc_active[0]->id === $valor->id ) ) ? 'selected' : ''); ?>> <?php echo e($valor->rfc); ?> </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php echo Form::close(); ?>


                            <div class="form-group">
                                <label for="name" class="col-xs-12 col-sm-12 col-lg-12"><?php echo e(__('PisaPesos')); ?></label>
                                <?php if(isset($pisapesos) ): ?>
                                    <div class="col-xs-12 col-sm-6 col-lg-6">Total por cliente: </div>
                                    <div class="col-xs-12 col-sm-6 col-lg-6"><?php echo e($pisapesos); ?></div>
                                <?php endif; ?>
                                <div class="col-xs-12 col-sm-6 col-lg-6">Total por RFC: </div>
                                <div class="col-xs-12 col-sm-6 col-lg-6" id="pisapesos"><?php echo e(isset($pisapesos_rfc) ? $pisapesos_rfc : '0.00'); ?> </div>
                            </div>
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
                                <div id="mensajes"></div>
                                <div style="text-align: center;" id="factura_xml">
                                    <label class="btn btn-primary" style="width: 30%; background: #2a91d6;">SUBIR FACTURA 
                                        <input type="file" id="factura-xml" name="factura-xml" style="display: none">
                                    </label><br><br>
                                    <span id="path"></span>
                                </div>
                                
                                <div style="text-align:  center;">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                    <!--<a href="" class="btn btn-primary" id="guardarFactura">Enviar</a>-->
                                </div>
                            <?php echo Form::close(); ?>


                            <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-bottom: 30px;">
                                     <a class="btn btn-success" id="general_modal" data-toggle="modal" data-target="#generalModal">REPORTES</a> 
                                     <a href="docs/ManualUsuario.pdf" class="btn btn-primary" target="_blank">MANUAL USUARIO</a>
                            </div>
                            
                            <h2 class="title-table">Historial de facturas</h2>
                            <div class="scrollsearch">
                            <table id="factura" class="table table-striped table-bordered table-factura" style="margin-top: 50px">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-bottom: 20px;">
                                    <label>Busqueda por Receptor: </label>
                                    <input type="text" id="busqueda_receptor" name="busqueda_receptor" placeholder="Buscar..."/>
                                </div>
                                <thead>
                                    <tr class="tr-style">
                                        <th>Factura</th>
                                        <th>Monto de Factura</th>
                                        <th>Receptor</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $facturas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $factura): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="facturaRow<?php echo e($factura->id); ?>" class="factura">
                                        <td> <?php echo e($factura->folio); ?> </td>
                                        <td> $ <?php echo e($factura->total); ?> </td>
                                        <td> <?php echo e($factura->receptor); ?> </td>
                                        <td>
                                            <a class="btn btn-primary" style="background: #2a91d6;" href="<?php echo e(App::make('url')->to('/')); ?>/factura_info/<?php echo e($factura->id); ?>/<?php echo e(1); ?>"><span class="glyphicon glyphicon-list"></span></a>
                                            <a class="btn btn-primary" style="background: #2a91d6;" href="<?php echo e(App::make('url')->to('/')); ?>/factura_info/<?php echo e($factura->id); ?>/<?php echo e(2); ?>

                                            "><span class="glyphicon glyphicon-usd"></span></a> <?php echo e($factura->fecha); ?>

                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            </div>
                            <br><br><br>
                            <h2 class="title-table">Productos aprobados</h2>
                            <div class="scrollsearch">
                            <table id="aprobados" class="table table-striped table-bordered table-aprobados" style="margin-top: 50px">
                                 <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-bottom: 20px;">
                                    <label>Busqueda por descripción de producto: </label>
                                    <input type="text" id="busqueda_aprobados" name="busqueda_aprobados" placeholder="Buscar..."/>
                                </div>
                                <thead>
                                    <tr class="tr-style">
                                        <th>No. identificación</th>
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
                                            <td> <?php echo e($producto->folio_factura); ?> </td>
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
                            </div>
                             <br><br><br>
                            <!-- Se muestran los productos que no existen dentro de la Base de Datos de PISA -->
                            <h2 class="title-table">Productos pendientes</h2>
                            <div class="scrollsearch">
                            <table id="pendientes" class="table table-striped table-bordered table-pendientes" style="margin-top: 50px">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-bottom: 20px;">
                                    <label>Busqueda por descripción de producto: </label>
                                    <input type="text" id="busqueda_pendientes" name="busqueda_pendientes" placeholder="Buscar..."/>
                                </div>
                                <thead>
                                    <tr class="tr-style">
                                        <th>No. identificación</th>
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
                                            <td> <?php echo e($producto->folio_factura); ?> </td>
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
                            </div>
                            <br><br><br>
                            <!-- Se muestran los productos que no existen dentro de la Base de Datos de PISA -->
                            <h2 class="title-table">Productos NO aprobados</h2>
                            <div class="scrollsearch">
                            <table id="no_aprobados" class="table table-striped table-bordered table-no-aprobados" style="margin-top: 50px">
                                <div class="col-lg-12 col-md-12 col-sm-12" style="text-align: right; margin-bottom: 20px;">
                                    <label>Busqueda por descripción de producto: </label>
                                    <input type="text" id="busqueda_no_aprobados" name="busqueda_no_aprobados" placeholder="Buscar..."/>
                                </div>
                                <thead>
                                    <tr class="tr-style">
                                        <th>No. identificación</th>
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
                                    <?php if($producto->estatus == 'NO APROBADO' && $producto->estatus_cliente !== 'DESHABILITADO'): ?>
                                        <tr id="productoRow<?php echo e($producto->id); ?>" class="no_aprobados">
                                            <td> <?php echo e($producto->no_identificacion); ?> </td>
                                            <td> <?php echo e($producto->folio_factura); ?> </td>
                                            <td> <?php echo e($producto->unidad); ?> </td>
                                            <td> <?php echo e($producto->descripcion); ?> </td>
                                            <td> <?php echo e($producto->cantidad); ?> </td>
                                            <td> $ <?php echo e($producto->importe); ?> </td>
                                            <td class="acciones">
                                                <?php if($producto->validacion !== "SI"): ?>
                                                    <a class="btn btn-primary mail_modal" id="mail_modal" name="mail_modal" data-toggle="modal" data-target="#mailModal" onclick="send_mail(<?php echo e($producto->id); ?>)">SOLICITAR REVISIÓN</a>
                                                <?php elseif($producto->validacion == "SI"): ?>
                                                    <a class="btn btn-success" id="mail_button" name="mail_button" disabled>EN REVISIÓN...</a>
                                                <?php endif; ?>
                                                <a class="btn btn-danger" id="delete_modal" data-toggle="modal" data-target="#deleteModal" onclick="deshabilitar_registro(<?php echo e($producto->id); ?>)"><span class="glyphicon glyphicon-remove"></span></a>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            </div>
                            <br>

                            <a class="btn btn-primary reporte" id="reporte" data-id="" name="reporte" style="width: 130px; margin-bottom: 30px;" data-toggle="modal" data-target="#reporteModal">REPORTE</a>

                        </div>
                    </div>
                </div>

            </div>

    </div>

 <?php endif; ?>    



     <!-- Status Modal -->
        <div class="modal fade" id="rfcModal" tabindex="-1" role="dialog" aria-labelledby="rfcModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="rfcModalLabel">Agregar RFC</h5>
              </div>
                  <?php echo Form::open([ 'method' => 'POST', 'url' => 'agregar_rfc' ]); ?>

                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"></input>
                      <div class="modal-body">
                            <div class="form-group">
                                <p>RFC: </p>
                                <input class="form-control" type="text" name="rfc" id="rfc">                  
                            </div>
                      </div>
                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Agregar</button>
                      </div> 
                  <?php echo Form::close(); ?>

            </div>
          </div>
        </div>

          <!-- Reporte Modal -->
        <div class="modal fade" id="reporteModal" tabindex="-1" role="dialog" aria-labelledby="estatusModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title" id="reporteModalLabel">Reporte</h5>
              </div>
           
                <form  id="imprimir_reporte" name="imprimir_reporte" method="POST" action="<?php echo e(url('imprimir_reporte')); ?>">
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"></input>
                  <div class="modal-body">
                    <div class="row">
                      <div class="col-md-12">Rango de Fechas</div>
                    </div>
                    <div class="row">
                      <div class="col-lg-6 col-md-12 col-xs-12">
                          <input class="form-control" type="text" name="daterange" id="daterange" value="01/01/2018 - 31/01/2018" />
                      </div>
                      <div class="col-lg-6 col-md-12 col-xs-12">
                          <select class="form-control" id="estatus_reporte" name="estatus_reporte">
                              <option value="APROBADO">APROBADO</option>
                              <option value="PENDIENTE">PENDIENTE</option>
                              <option value="NO APROBADO">NO APROBADO</option>
                            </select>
                      </div>
                    </div>  <br>
                    <div class="row">
                      <div class="col-md-12">Tipo:</div>
                         <div class="col-lg-6 col-md-12 col-xs-12">
                            <select class="form-control" id="tipo" name="tipo">
                              <option value="pdf">PDF</option>>
                              <option value="excel">EXCEL</option>
                            </select>
                        </div>
                    </div>


                  </div>
                  <div class="modal-footer">
                        <button type="submit" class="btn btn-primary imprimir_reporte" name="imprimir_reporte" id="imprimir_reporte">Imprimir Reporte</button>
                  </div>
                </form>  
            </div>
          </div>
        </div>


<?php if(Auth::user()->role_id !== 1): ?>
   <!-- Productos Aprobados Modal -->
        <div class="modal fade" id="aprobadosModal" tabindex="-1" role="dialog" aria-labelledby="aprobadosModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <h3 class="modal-title" id="aprobadosModalLabel">Productos aprobados</h3>
              </div>
                  <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>"></input>
                      <div class="modal-body">
                        <div style='margin: 5px 0px 0px 260px' class='before'></div> 
                            <div class="form-group">
                                 <ul>
                                    <?php if(isset($prod_popup) and ($prod_popup != '') ): ?>
                                       <?php $__currentLoopData = $prod_popup; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                          <?php if($prod['estatus'] == 'APROBADO'): ?>
                                            <li class="producto_aprobado"><?php echo e($prod['descripcion']); ?></li>
                                          <?php endif; ?>
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php endif; ?>
                                 </ul>
                            </div>
                      </div>
                      <div class="modal-footer">
                       <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                      </div> 
              </div>
            </div>
          </div>
<?php endif; ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>