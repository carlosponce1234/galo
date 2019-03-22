<?php 
require 'conexion.php';

$operacion = $_POST['operacion'];

if (isset($operacion)) {
	switch ($operacion) {
		case 'insert':
		$nombre = $_POST['user_name'];
		$mail = $_POST['user_mail'];
		$pass = $_POST['user_pass1'];
		$cliente = $_POST['user_cliente'];
		$tipo = $_POST['user_tipo'];
		$permiso = $_POST['user_permiso'];
		$estado = $_POST['user_estado'];

			$sql = "INSERT INTO `usuarios` (`user_id`, `user_monbre`, `user_mail`, `user_pass`, `user_tipo`, `user_cliente`, `user_permiso`, `user_estado`, `user_timestamp`) VALUES (NULL, '$nombre', '$mail', '$pass', '$tipo', '$cliente', '$permiso', '$estado', CURRENT_TIMESTAMP)";
			if($mysqli->query($sql) === true){
    				echo "Usuario creado con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
			break;
		
		default:
			# code...
			break;
	}
}

 ?>