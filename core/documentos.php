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

			case 'borrar':
				$doc_id = $_POST['doc_id'];
			if (isset($doc_id)) {
				$sql2 = "SELECT * FROM documentos  WHERE doc_id = '$doc_id' ";
				$result=$mysqli->query($sql2);
				    $rows = $result->num_rows;
				    $row = $result->fetch_assoc();
				$sql = "DELETE FROM documentos  WHERE doc_id = '$doc_id' ";
					if($mysqli->query($sql) === true){
						$rr = '../'.$row['doc_ruta'];
						unlink($rr);
    				echo "Operacion realizada con exito.";
				} else{
   				echo "ERROR: No se pudo realizar operacion. " . $mysqli->error;
					}	
			} else{
				echo "ERORR: NO SE PUEDE LERR EL ID";
			};
				# code...
				break;


				case 'restaura':
				# code...
				$doc_id = $_POST['doc_id'];
			if (isset($doc_id)) {
				$sql = "UPDATE documentos SET doc_papelera = 0 WHERE doc_id = '$doc_id' ";
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
 