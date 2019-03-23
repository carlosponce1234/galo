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
		
		default:
			# code...
			break;
	}
 };
 ?>
