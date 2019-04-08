<?php 
require '../core/conexion.php';
		$sql4 =" SELECT * FROM categoria";
		$result4=$mysqli->query($sql4);
		$row4 = $result4->fetch_assoc();

		$sql5 =" SELECT * FROM cliente";
		$result5=$mysqli->query($sql5);
		$row5 = $result5->fetch_assoc();

		if (!empty($_POST)) {
			# code...
		$n = mysqli_real_escape_string($mysqli,$_POST['doc_numliq_anio']);
		$d = mysqli_real_escape_string($mysqli,$_POST['doc_numliq_del']);
		$p = mysqli_real_escape_string($mysqli,$_POST['doc_numliq_n']);
		$anio = mysqli_real_escape_string($mysqli,$_POST['anio']);
		$cliente = mysqli_real_escape_string($mysqli,$_POST['cliente']);
		$cat = mysqli_real_escape_string($mysqli,$_POST['cat']);
		$user_id = mysqli_real_escape_string($mysqli,$_POST['user_id']);
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
                #echo $nombre." ".$anio." ".$cliente." ".$cat.;              
                $sql6 = "INSERT INTO `documentos` (`doc_id`, `doc_numliq`, `doc_ruta`, `doc_cat`, `doc_cliente`, `doc_usuario`, `doc_anio`, `doc_papelera`, `doc_timestamp`) VALUES (NULL, '$nombre', '$doc_ruta', '$cat', '$cliente', '$user_id', '$anio', '0', CURRENT_TIMESTAMP)";
                if($mysqli->query($sql6) === true){
                	header("Location: result.php?anio=".$anio."&cat=0");
                	$mensaje = "El archivo se ha subido correctamente";
                	echo "<script> alert(".$mensaje.") </script>";
				} else{
					$error = "ERROR: No se pudo realizar operacion. ". $mysqli->error;
					var_dump($error);
					echo "<script> alert(".$error.") </script>";
					}                
                }        
		};
 ?>
 <div class="reveal" id="e_subir" data-reveal data-animation-in="slidein">
  	<h5>Subir Archivo</h5>
  	<div id="pre-load" style="display: none;">
  		<div class="grid-container" style="background-color: #0b1f3f; color: white; text-align: center; ">
  			<div class="grid-x grid-padding-x align-center">
  				<img src="../img/gif-galo1.gif" alt="cargando....">
  			</div>
  			<p>Estamos procesando el archivo.....</p>
  		</div>
  	</div>
  	<hr>
  	<form action="../core/subir.php" method="POST" enctype="multipart/form-data" id="myform">
  		<input id="user_id" name="user_id" style="display: none;" type="text" value="<?php echo $user_id; ?>">
  		<div>
  			<div style="width: 30%; float: left; margin-right: 3%;">
  				<label for="doc_numliq">Año</label>
  				<input type="text" id="doc_numliq_anio" name="doc_numliq_anio" required>  				
  			</div>
  			<div style="width: 30%; float: left; margin-right: 3%;">
  				<label for="doc_numliq">N° Delegacion</label>
  				<input type="text" id="doc_numliq_del" name="doc_numliq_del" required>  				
  			</div>
  			<div style="width: 30%; float: left; margin-right: 3%;">
  				<label for="doc_numliq">N° de poliza</label>
  				<input type="text" id="doc_numliq_n" name="doc_numliq_n" required>  				
  			</div>
  		</div>
  		<label for="Cliente">Cliente</label>
  		<select name="cliente" id="cliente" required>
			<option  disabled selected>Elegir empresa o cliente</option>
				<?php 
					foreach ($result5 as $key => $v) {	
						echo "<option id=".$v['cliente_id']." value ='".$v['cliente_id']."'>".$v['cliente_nombre']."</option>";
					};		
				 ?>	
	   </select>
  		<label for="anio">Año de publicacion</label>
  		<select name="anio" id="anio">
										<option value="2015">2015</option>
										<option value="2016">2016</option>
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019" selected>2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
										<option value="2022">2022</option>
										<option value="2023">2023</option>
										<option value="2024">2024</option>
										<option value="2025">2025</option>
										<option value="2026">2026</option>
										<option value="2027">2027</option>
										<option value="2028">2028</option>
										<option value="2029">2029</option>
										<option value="2030">2030</option>
										<option value="2031">2031</option>
										<option value="2032">2032</option>
										<option value="2033">2033</option>
										<option value="2034">2034</option>
										<option value="2035">2035</option>
										<option value="2036">2036</option>
										<option value="2037">2037</option>
										<option value="2038">2038</option>
										<option value="2039">2039</option>
										<option value="2040">2040</option>
									</select>
  		<label for="cat">Categoria</label>
  		<select name="cat" id="cat" required>
			<option disabled selected >Elegir Categoria</option>
			<?php 
				foreach ($result4 as $key => $v) {
					echo "<option id=".$v['cat_id']." value ='".$v['cat_id']."'>".$v['cat_nombre']."</option>";
					};		
					 ?>
		</select>
		<label for="archivo">archivo</label>
		<input type="file" name="archivo" required maxlength="20480">
		<button type="submit" class="guardar" id="subir-file"><i class="icon-cloud-upload"></i> Subir</button>
		<input type="reset" class="reset" id="cancelar-file"></input>	
  	</form>
  </div>