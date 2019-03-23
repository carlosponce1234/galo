<?php 
	require 'conexion.php';

$operacion = $_POST['operacion'];
if (isset($operacion)) {
	# code...
	switch ($operacion) {
		case 'insert':
			# code...
		$n_cliente = $_POST['n_cliente'];
		$mail = $_POST['mail'];
		$info = $_POST['info'];
		$sql = "INSERT INTO cliente (cliente_id , cliente_nombre , cliente_mail , cliente_info) VALUES (NULL, '$n_cliente','$mail','$info')";
		if($mysqli->query($sql) === true){
    				echo "Cliente creado con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
			break;
		case 'fill':
			# code...
		$cliente_id = $_POST['cliente_id'];
			if (isset($cliente_id)) {
				$sql="SELECT * FROM cliente WHERE cliente_id = '$cliente_id'";
					# code...
					$result=$mysqli->query($sql);
				    $rows = $result->num_rows;
				    $row = $result->fetch_assoc();
				    echo $row['cliente_id'].','.$row['cliente_nombre'].','.$row['cliente_mail'].','.$row['cliente_info'];
			}else{
				echo " id no seteado ";
			}
			break;
			case 'update':
				# code...
			$cliente_id = $_POST['cliente_id'];
			if (isset($cliente_id)) {
				$n_cliente = $_POST['n_cliente'];
				$mail = $_POST['mail'];
				$info = $_POST['info'];
				$sql = "UPDATE cliente SET cliente_nombre = '$n_cliente', cliente_mail = '$mail' ,
						cliente_info = '$info' WHERE cliente_id = '$cliente_id' ";
					if($mysqli->query($sql) === true){
    				echo "Operacion realizada con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}	
			} else{
				echo "ERORR: NO SE PUEDE LERR EL ID";
			}


				break;
				case 'delite':
					$cliente_id = $_POST['cliente_id'];
			if (isset($cliente_id)){
				$sql = "DELETE FROM `cliente` WHERE `cliente_id` = '$cliente_id'";
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