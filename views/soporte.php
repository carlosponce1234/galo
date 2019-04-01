<?php 
	require ('../core/conexion.php');

if (!empty($_POST)) {
  # code...
    $mail = mysqli_real_escape_string($mysqli,$_POST['usuario']);

    $sql="SELECT * FROM usuarios WHERE user_mail = '$mail'";
    $result=$mysqli->query($sql);
    $rows = $result->num_rows;
    $row = $result->fetch_assoc();
    if ($rows>0) {
       $idpc = $_SERVER['REMOTE_ADDR'];
       $destino =  $row['user_mail'];
        $to = $destino.", not-reply@documentosgaloyasociados.com";
$subject = "Credenciales inicio de sesion  de ".$row['user_monbre'];

$message = "
<html>
<head>
<title>credenciales de inicio de secion</title>
</head>
<body>
<p>Hemos recibido tu solicitud de credenciañes desde la pc:".$idpc."</br>
si no has sido tu ponte en contacto con los administradores de la aplicacion y solicita un cambio de contraseña </p>
<table>
<tr>
<th>Nombre de usuario</th>
<th>Contraseña</th>
</tr>
<tr>
<td>".$row['user_monbre']."</td>
<td>".$row['user_monbre']."</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <not-reply@documentosgaloyasociados.com>' . "\r\n";
//$headers .= 'Cc: myboss@example.com' . "\r\n";

      mail($to,$subject,$message,$headers);
      echo "<script> alert('henos enviado un mensaje con tus datos de inicio de secion. SI NO LO RECIBES PONTE EN CONTACTO CON EL ADMINISTRADOR') </script>";
    }else{
      
      echo "<script> alert('No se ha encontrado un usuario con este correo') </script>";
    };
};

 ?>
<!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="apple-touch-icon" sizes="180x180" href="/galo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/galo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/galo/favicon-16x16.png">
<link rel="manifest" href="/galo/site.webmanifest">
    <title>Login</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" type="text/css" href="../font/flaticon.css">
    <link rel="stylesheet" href="../font/style.css">
    <!--[if lt IE 8]><!-->
    <link rel="stylesheet" href="../font/ie7/ie7.css">
    <!--<![endif]-->
  </head>
  <body style="background-image: url(../img/fondo-home-06.png); background-position: top; background-repeat: no-repeat; background-size: cover;">
  <div class="grid-container" id="login">
  	<div class="grid-x grid-padding-x">
  		<div class="cell medium-6 medium-offset-3">
  			<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
          <h4><img src="../img/logo-08.png" alt="usuario"></h4>
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
<script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>  