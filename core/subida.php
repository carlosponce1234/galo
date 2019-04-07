<?php
require 'conexion.php';
	if (!empty($_POST)) {
			# code...
		$n = mysqli_real_escape_string($mysqli,$_POST['doc_numliq_anio']);
		$d = mysqli_real_escape_string($mysqli,$_POST['doc_numliq_del']);
		$p = mysqli_real_escape_string($mysqli,$_POST['doc_numliq_n']);
		$error = '';
		$nombre = $n.'-'.$d.'-'.$p;
		$mensaje = '';
		 $temp=$_FILES['archivo']['tmp_name'];
		 $ty = $_FILES['archivo']['name'];
		 $extension = explode(".",$ty);
		$num = count($extension)-1; 
		$type = $extension[$num];   
                $directorio = "../UPLOADS";  
                $nombre_nomina = $_FILES['archivo']['name'];   
                $url=$directorio . "/" . $nombre.'.'.$type;
                $doc_ruta = "UPLOADS/".  $nombre.'.'.$type;
         if (move_uploaded_file($temp,$url))  
                {         
              echo "ok";               
                }else{
                	echo "error";
                }        
		};