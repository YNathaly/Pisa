<?php $__env->startSection('content'); ?>
<div id="main_logo">
    <img src="<?php echo e(asset('/img/logo.png')); ?>">
</div>
<div class="container">
    <div class="row justify-content-left">
        <!--<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2"></div>-->
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="panel panel-default" style="margin-top: 50px;">
                <div class="panel-heading">ACCEDE A TU CUENTA</div>

                <?php if(isset($message)): ?>
                <div class="alert alert-success">
                     <span class="help-block">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                </div>
                <?php endif; ?>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="<?php echo e(route('login')); ?>">
                        <?php echo e(csrf_field()); ?>

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?>">
                            <label for="email" class="col-md-12">Usuario</label>

                            <div class="col-md-12">
                                <input id="email" type="email" class="form-control" name="email" value="<?php echo e(old('email')); ?>" required autofocus>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?>">
                            <label for="password" class="col-md-12">Contraseña</label>

                            <div class="col-md-12">
                                <input id="password" type="password" class="form-control" name="password"     required>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong>password</strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12">

                                <a class="btn btn-link" href="<?php echo e(route('password.request')); ?>" style="margin-left:-10px;">
                                   ¿Olvidaste tu contraseña?
                                </a>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <!-- <div class="col-md-12 col-md-offset-4"> -->
                            <div class="col-xs-6 col-sm-6 col-lg-6">
                                <button type="submit" class="btn btn-primary" style="width: 130px; border-radius:0px;">
                                    <?php echo e(__('INICIAR SESIÓN')); ?>

                                </button>
                            </div>


                            <div class="col-xs-6 col-sm-6 col-lg-6" style="text-align: right;">
                               <a class="btn btn-primary" style="width: 130px;  border-radius:0px; color:white;" href="<?php echo e(route('register')); ?>"><?php echo e(__('REGÍSTRATE')); ?></a>
                                <!--<a class="btn btn-link" href="<?php echo e(route('password.request')); ?>">
                                   <?php echo e(__('¿Olvidaste tu contraseña?')); ?>

                                </a>-->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

       <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <img src="<?php echo e(asset('/img/logo.jpg')); ?>" class="logo">
        </div>
       
       
            
        
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.principal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>