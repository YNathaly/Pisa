<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> 
    <!-- Scripts 
    <script src="<?php echo e(asset('js/app.js')); ?>" defer></script>-->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('css/global.css')); ?>" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="<?php echo e(asset('css/bootstrap.min.css')); ?>" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="<?php echo e(asset('css/bootstrap-theme.min.css')); ?>" rel="stylesheet">
</head>
<body>
    <div id="app">
    	<main class="py-4">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
    </div>

    <footer>
      <p class="footer-p">&copy; 2017 PISA Agropecuaria. Una empresa de Grupo PISA. Todos los derechos reservados | Avisos de Privacidad.</p>
    </footer>