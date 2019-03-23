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
		case 'fill':
			# code...
		$user_id = $_POST['user_id'];
			if (isset($user_id)) {
				$sql="SELECT * FROM usuarios WHERE user_id = '$user_id'";
				if ($mysqli->query($sql) === true) {
					# code...
					$result=$mysqli->query($sql);
				    $rows = $result->num_rows;
				    $row = $result->fetch_assoc();
				    echo $row['user_id'].','.$row['user_monbre'].','.$row['user_mail'].','.$row['user_pass'].','.$row['user_tipo'].','.$row['user_cliente'].','.$row['user_permiso'].','.$row['user_estado'];
				} else {
					# code...
					echo " , , , , , , , ";
				}
				
				
			}else{
				echo " , , , , , , , ";
			}
			break;
		default:
			# code...
			break;
	}
}

 ?>