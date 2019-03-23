<?php 

	require 'conexion.php';

$operacion = $_POST['operacion'];
if (isset($operacion)){

	switch ($operacion) {
		case 'insert':
			# code...
		$n_cat = $_POST['n_cat'];
		$info = $_POST['info'];
		$sql = "INSERT INTO categoria (cat_id , cat_desc, cat_nombre) VALUES (NULL, '$info','$n_cat')";
		if($mysqli->query($sql) === true){
    				echo "Categoria creada con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}
			break;
		case 'fill':
			# code...
		$cat_id = $_POST['cat_id'];
			if (isset($cat_id)) {
				$sql="SELECT * FROM categoria WHERE cat_id = '$cat_id'";
					# code...
					$result=$mysqli->query($sql);
				    $rows = $result->num_rows;
				    $row = $result->fetch_assoc();
				    echo $row['cat_id'].','.$row['cat_desc'].','.$row['cat_nombre'];
			}else{
				echo " id no seteado ";
			}
			break;
			case 'update':
				# code...
			$cat_id = $_POST['cat_id'];
			if (isset($cat_id)) {
				$cat_nombre = $_POST['cat_nombre'];
				$info = $_POST['info'];
				$sql = "UPDATE categoria SET cat_nombre = '$cat_nombre', cat_desc = '$info' WHERE cat_id = '$cat_id' ";
					if($mysqli->query($sql) === true){
    				echo "Operacion realizada con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}	
			} else{
				echo "ERORR: NO SE PUEDE LERR EL ID";
			}


				break;
		default:
			# code...
			break;
	}
 };
 ?>
