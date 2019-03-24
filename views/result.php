<?php 
	require ('../core/conexion.php');
session_start();
	
	if(!isset($_SESSION["user_id"])){
		header("Location: ../index.php");
	}
		$user_id =	$_SESSION['user_id']; 
		$user_tipo = $_SESSION['user_tipo']; 
		$user_name = $_SESSION['user_name'] ;
		$user_permiso =	$_SESSION['user_permisp'];

		$sql="SELECT * FROM usuarios Where user_id='$user_id'";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		$row = $result->fetch_assoc();

		
		$doc_anio = $_GET['anio'];
		$cat = $_GET['cat'];

		if (isset($_GET['doc_numliq'])) {
			# code...
			$doc_numliq = $_GET['doc_numliq'];
			if ($cat == 0) {
				# code...
				$sql2 = "SELECT	* FROM	documentos WHERE doc_nunliq = '$doc_numliq' AND doc_anio = '$doc_anio' AND doc_papelera = '0'";
				$result2=$mysqli->query($sql2);
				$rows2 = $result2->num_rows;
				$row2 = $result2->fetch_assoc();

			} else {
				$sql2 = "SELECT	* FROM	documentos WHERE doc_nunliq = '$doc_numliq' AND doc_cat = '$cat' AND doc_anio = '$doc_anio' AND doc_papelera = '0'";
				$result2=$mysqli->query($sql2);
				$rows2 = $result2->num_rows;
				$row2 = $result2->fetch_assoc();
			};
			
		} else {
			if ($cat == 0) {
				# code...
				$sql2 = "SELECT	* FROM	documentos WHERE doc_anio = '$doc_anio' AND doc_papelera = 0";
				$result2=$mysqli->query($sql2);
				$rows2 = $result2->num_rows;
				$row2 = $result2->fetch_assoc();
			} else {
				# code...
				$sql2 = "SELECT	* FROM	documentos WHERE doc_anio = '$doc_anio' AND doc_cat = '$cat' AND doc_papelera = 0";
				$result2=$mysqli->query($sql2);
				$rows2 = $result2->num_rows;
				$row2 = $result2->fetch_assoc();
			}
		};

		
 ?>
  <!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" type="text/css" href="../font/flaticon.css">
    <link rel="stylesheet" href="../font/style.css">
    <!--[if lt IE 8]><!-->
    <link rel="stylesheet" href="../font/ie7/ie7.css">
    <!--<![endif]-->
</head>
<body>
	<div class="grid-container fluid">
		<div class="grid-x grid-padding-x">
			<div class="cell medium-3 align-center"style="background-color: #0000AB; height: 50rem;">
      			<div class="barra_lat">
      				<?php 
						 if ($row['user_permiso'] == 1 || $row['user_permiso'] == 3 || $row['user_permiso'] == 4)  {
  							# code...
  							echo "<button class='btn'><span><i class='icon-cloud-upload'></i></span>SUBIR ARCHIVOS</button>";
  						}; 
				  	?>
				  <div class="nav-bar-result">		
  					<button>NUMERO DE DECLARACIÓN</button>
  						<input type="text" name="doc_numliqu" id="doc_numliq" placeholder="N° Liquidacion">
  				  </div>	
    			</div>
			</div>
		<div class="cell medium-9">
			<div class="grid-x grid-padding-x cabecera">
				<div class="cell medium-5">
					<h4>RESULTADOS DE BUSQUEDA</h4>		
				</div>
				<div class="cell medium-4">
					<p>Usuario: <?php if ($rows>0) {
					   	echo $row['user_monbre'];
					}; ?></p>
				</div>
				<div class="cell medium-2">
					<img src="../img/user.png" alt="usuario">	
				</div>
				<div class="cell medium-1 ">
					<div class="cerrar_secion">
						<a href="../core/cerrar_secion.php">
    					<i class="icon-enter"></i> </a>	    		
					</div>		    	
				</div> 	   
			</div>
			<div class="grid-x grid-padding-x">
				<div class="cell medium-3 medium-offset-9" >
					<div style="margin-top: 1rem;">
						<a  class="guardar" href="papelera.php"><i class="icon-bin"> ver papelera</i></a>
					</div>
				</div>
			</div>
			<div class="grid-x grid-margin-x acciones">
				<div class="cell medium-7 medium-offset-1">
					<div id="wraper">
						<input type="text" id="buscar_user" placeholder=" Buscar usuario">
						<button class="buscar_btn"><i class="icon-search"></i></button>
					</div>
				</div>
			</div>
			<div class="grid-x grid-padding-x tabla">
				<div class="cell medium-12">
					<table id="mytable">
						<thead>
							<td>ID</td>
							<th>Nombre</th>
							<th>Año</th>
							<th>Categoria</th>
							<th>Acciones</th>
						</thead>
						<tbody id="user_table">
							<?php 
							if ($rows2 > 0) {
								foreach ($result2 as $key => $v) {
								echo "<tr>
									<td id=".$v['doc_id']." class='doc_id'>".$v['doc_id']."</td>
									<td id=".$v['doc_numliq']." class='doc_nombre'><i class='icon-file-pdf'></i> ".$v['doc_numliq']."</td>
									<td id=".$v['doc_anio']." class='doc_año'>".$v['doc_anio']."</td>
									<td id=".$v['doc_cat']." class='doc_cat'>".$v['doc_cat']."</td>
									<td id=".$v['doc_ruta'].">
									<button id='ver_pdf' class='button editar small'>
									<i class='icon-cloud-download'></i></button>
								    <button id='elimina' class='button desactiva small'><i class='icon-bin'></i></button>
									</td>
									</tr>";
								}			
							}else {
								echo "<tr> No se encontraron resultados... </tr>";	
							};
							 ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</body>
  <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
</html>  