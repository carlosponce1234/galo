<?php 
	require ('core/conexion.php');

	session_start();
	
	if(isset($_SESSION["user_id"])){
		header("Location: views/home.php");
	}
	
	if(!empty($_POST))
	{
		$usuario = mysqli_real_escape_string($mysqli,$_POST['usuario']);
		$password = mysqli_real_escape_string($mysqli,$_POST['password']);
		$error = '';
		
		//$sha1_pass = sha1($password);
		
		$sql =  "SELECT * FROM `usuarios` WHERE `user_monbre`= '$usuario' AND `user_pass`= '$password' And user_estado = 0 ";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		
		if($rows > 0) {
			$row = $result->fetch_assoc();
			$_SESSION['user_id'] = $row['user_id'];
			$_SESSION['user_tipo'] = $row['user_tipo'];
			$_SESSION['user_name'] = $row['user_monbre'];
			$_SESSION['user_permisp'] = $row['user_permiso'];
			
			header("location: views/home.php");
			} else {
			$error = "El nombre o contraseña son incorrectos o el usuario se encuentra inactivo";
		}
	}

 ?>
 <!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/foundation.css">
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" type="text/css" href="font/flaticon.css">
     <link rel="stylesheet" href="font/style.css">
    <!--[if lt IE 8]><!-->
    <link rel="stylesheet" href="font/ie7/ie7.css">
    <!--<![endif]-->
  </head>
  <body style="background-image: url(img/fondo-home-06.png); background-position: top; background-repeat: no-repeat; background-size: cover;" >
  <div class="grid-container" id="login">
  	<div class="grid-x grid-padding-x align-center">
  		<div class="cell medium-6 ">
  			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
  				<div class="form-icons">
    				<h4><img src="img/logo-08.png" alt="usuario"></h4>
            <h5>"BIENVENIDO AL PORTAL DE DOCUMENTOS DE GALO Y ASOCIADOS"</h5>
            <h4>Control de usuarios</h4>
    			<div class="input-group">
     				<span class="input-group-label">
       					 <i class="flaticon-login"></i>
      				</span>
     		 		<input class="input-group-field" type="text" placeholder="Nombre de usuario" name="usuario">
   				</div>

    			<div class="input-group">
    		 		 <span class="input-group-label">
   		     			<i class="flaticon-lock"></i>
    		  		</span>
    		 		 <input class="input-group-field" type="password" placeholder="Contraseña" name="password">
    			</div>
 				 </div>

				<input style="background-color: #FF4E00"  type="submit" class= "button expanded logbtn" value= "INGRESAR">
  			</form>
        <div><a style="color: white;" href="views/soporte.php"> <i class="icon-lock"></i>  Recuperar Contraseña</a></div>
  		</div>
  	</div>
  </div>

<script src="js/vendor/jquery.js"></script>
    <script src="js/vendor/what-input.js"></script>
    <script src="js/vendor/foundation.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>  