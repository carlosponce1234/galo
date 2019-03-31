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
		$estadotmp = $_POST['user_estado'];
		$p_buscartmp = $_POST['p_buscar'];
		$p_usuariotmp = $_POST['p_usuario'];
		$p_subirtmp = $_POST['p_subir'];
		$p_clientestmp = $_POST['p_clientes'];
		$p_categoriatmp = $_POST['p_categoria'];
		if ($p_buscartmp == 'false') {$p_buscar = '0';} else { $p_buscar = '1';};
		if ($p_usuariotmp == 'false') {$p_usuario = '0';} else { $p_usuario = '1';};
		if ($p_subirtmp == 'false') {$p_subir = '0';} else { $p_subir = '1';};
		if ($p_clientestmp == 'false') {$p_clientes = '0';} else { $p_clientes = '1';};
		if ($p_categoriatmp == 'false') {$p_categoria = '0';} else { $p_categoria = '1';};
		if ($estadotmp == 'false') {$estado = '1';} else { $estado = '0';};

		if ($nombre == ' ' || $mail == ''|| $pass == ' ' || $cliente == ' ' || $tipo== ' ' || $permiso==' ' || $estado ==' ' ) {
			echo "ERROR: No se pudo realizar operacion.  Hay campos vacios en el formulario";
		} else {
			$sql = "INSERT INTO `usuarios` (`user_id`, `user_monbre`, `user_mail`, `user_pass`, `user_tipo`, `user_cliente`, `user_permiso`, `user_buscar`, `user_subir`, `user_crear_u`, `user_crear_c`, `user_crear_ct`,`user_estado`, `user_timestamp`) VALUES (NULL, '$nombre', '$mail', '$pass', '$tipo', '$cliente', '$permiso', '$p_buscar', '$p_subir', '$p_usuario', '$p_clientes', '$p_categoria', '$estado', CURRENT_TIMESTAMP)";
			if($mysqli->query($sql) === true){
    				echo "Usuario creado con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					};
						}; 
			break;
		case 'fill':
			# code...
		$user_id = $_POST['user_id'];
			if (isset($user_id)) {
				$sql="SELECT * FROM usuarios  WHERE user_id = '$user_id'";
					# code...
					$result=$mysqli->query($sql);
				    $rows = $result->num_rows;
				    $row = $result->fetch_assoc();
				    echo $row['user_id'].','.$row['user_monbre'].','.$row['user_mail'].','.$row['user_pass'].','.$row['user_tipo'].','.$row['user_cliente'].','.$row['user_buscar'].','.$row['user_subir'].','.$row['user_crear_c'].','.$row['user_crear_u'].','.$row['user_crear_ct'].','.$row['user_estado'];
			}else{
				echo " id no seteado ";
			}
			break;
			case 'update':
				# code...
			$user_id = $_POST['user_id'];
			if (isset($user_id)) {
				$n_user = $_POST['n_usuario'];
				$pass = $_POST['pass'];
				$mail = $_POST['mail'];
				$estadotmp = $_POST['user_estado'];
				$p_buscartmp = $_POST['p_buscar'];
				$p_usuariotmp = $_POST['p_usuario'];
				$p_subirtmp = $_POST['p_subir'];
				$p_clientestmp = $_POST['p_clientes'];
				$p_categoriatmp = $_POST['p_categoria'];
				if ($p_buscartmp == 'false') {$p_buscar = '0';} else { $p_buscar = '1';};
				if ($p_usuariotmp == 'false') {$p_usuario = '0';} else { $p_usuario = '1';};
				if ($p_subirtmp == 'false') {$p_subir = '0';} else { $p_subir = '1';};
				if ($p_clientestmp == 'false') {$p_clientes = '0';} else { $p_clientes = '1';};
				if ($p_categoriatmp == 'false') {$p_categoria = '0';} else { $p_categoria = '1';};
				if ($estadotmp == 'false') {$estado = '1';} else { $estado = '0';};

				$sql = "UPDATE usuarios SET user_monbre = '$n_user', user_pass ='$pass' , user_mail = '$mail'  , user_buscar = '$p_buscar' , user_subir = '$p_subir' , user_crear_u = '$p_usuario' , user_crear_c = '$p_clientes' , user_crear_ct = '$p_categoria' ,  user_estado = '$estado' WHERE user_id = '$user_id' ";
					if($mysqli->query($sql) === true){
    				echo "Operacion realizada con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}	
			} else{
				echo "ERORR: NO SE PUEDE LERR EL ID";
			}


				break;
			case 'disabled':
					$user_id = $_POST['user_id'];
			if (isset($user_id)){
				$estado = $_POST['estado'];
				$sql = "UPDATE usuarios SET  user_estado = '$estado' WHERE user_id = '$user_id' ";
					if($mysqli->query($sql) === true){
    				echo "Operacion realizada con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
			}else{
				echo "ERORR: NO SE PUEDE LERR EL ID";
			}
					break;	
		default:
			# code...
			break;
	}
}

 ?>