<?php 
	if (!empty($_POST)) {
			# code...
				$n = $_POST['doc_numliq_anio'];
				$d = $_POST['doc_numliq_del'];
				$p = $_POST['doc_numliq_n'];
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
         if (move_uploaded_file($temp,$url))   { 

        		require 'conexion.php';
		        $anio = mysqli_real_escape_string($mysqli,$_POST['anio']);
				$cliente = mysqli_real_escape_string($mysqli,$_POST['cliente']);
				$cat = mysqli_real_escape_string($mysqli,$_POST['cat']);
				$user_id = mysqli_real_escape_string($mysqli,$_POST['user_id']);
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
                #echo $nombre." ".$anio." ".$cliente." ".$cat.;              
                $sql6 = "INSERT INTO `documentos` (`doc_id`, `doc_numliq`, `doc_ruta`, `doc_cat`, `doc_cliente`, `doc_usuario`, `doc_anio`, `doc_papelera`, `doc_timestamp`) VALUES (NULL, '$nombre', '$doc_ruta', '$cat', '$cliente', '$user_id', '$anio', '0', CURRENT_TIMESTAMP)";
                if($mysqli->query($sql6) === true){
                	header("Location: ../views/result.php?anio=".$anio."&cat=0&estd=ok");
                
				} else{
					header("Location: ../views/result.php?anio=".$anio."&cat=-1&estd=err-bd");
					}                
                }else{

					header("Location: ../views/result.php?anio=".$anio."&cat=0&estd=err-fl");               	
                }        
		};

 ?>