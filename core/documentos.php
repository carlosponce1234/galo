<?php 
	require 'conexion.php';

	$operacion = $_POST['operacion'];

	if (isset($operacion)) {
		# code...
		switch ($operacion) {
			case 'papelera':
				# code...
				$doc_id = $_POST['doc_id'];
			if (isset($doc_id)) {
				$sql = "UPDATE documentos SET doc_papelera = 1 WHERE doc_id = '$doc_id' ";
					if($mysqli->query($sql) === true){
    				echo "Operacion realizada con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}	
			} else{
				echo "ERORR: NO SE PUEDE LERR EL ID";
			};
				break;
			
			default:
				# code...
				break;
		}
	}

 ?>
 