<?php 
	require ('../core/conexion.php');
 ?>
<!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" type="text/css" href="../font/flaticon.css">
    <link rel="stylesheet" href="../font/style.css">
    <!--[if lt IE 8]><!-->
    <link rel="stylesheet" href="../font/ie7/ie7.css">
    <!--<![endif]-->
  </head>
  <body style="background-color: #4300FF;">
  <div class="grid-container" id="login">
  	<div class="grid-x grid-padding-x">
  		<div class="cell medium-6 medium-offset-3">
  			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  				<h4 style="color: white;">Recuperar contraseña</h4>
  				<p style="color: white;"> Digite el correo registrado y le enviaremos un mensaje con sus datos de inicio de seción</p>
  				<div class="form-icons">
    			<div class="input-group">
     				<span class="input-group-label">
       					 <i class="flaticon-login"></i>
      				</span>
     		 		<input class="input-group-field" type="email" placeholder="correo electronico" name="usuario">
   				</div>
 				 </div>
				<input style="background-color: #FF4E00"  type="submit" class= "button expanded logbtn" value= "enviar correo">
  			</form>
        <div><a style="color: white;" href="../index.php"> <i class="icon-user-tie"></i>  volver al login</a></div>
  		</div>
  	</div>
  </div>
<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>  