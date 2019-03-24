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

		$sql3 =" SELECT * FROM categoria";
		$result3=$mysqli->query($sql3);
		$row3 = $result3->fetch_assoc();
 ?>
 <!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/foundation.css">
    <link rel="stylesheet" href="../css/app.css">
    <link rel="stylesheet" type="text/css" href="../font/flaticon.css">
    <link rel="stylesheet" href="../font/style.css">
    <!--[if lt IE 8]><!-->
    <link rel="stylesheet" href="../font/ie7/ie7.css">
    <!--<![endif]-->
  </head>
  <body style="background-color: #0000AB;">
  	<div class="grid-container fluid">
  		<div class="grid-y grid-padding-y">
  			<div class="cell medium-1">
  				<div class="grid-x grid-padding-x align-middle home">
  					<div class="cell medium-1">
  						<div>
  							<img style="height: 5rem; width: 5rem;" src="../img/user.png" alt="usuario">
  						</div>
  					</div>
  					<div class="cell medium-5 text">
  						<p>Usuario: <?php if ($rows>0) {
							   	echo $row['user_monbre'];
							   }; ?></p>
  					</div>
  					<div class="cell medium-2 medium-offset-2 bt-home" >
  						<?php if ($row['user_permiso'] == 1 || $row['user_permiso'] == 3 || $row['user_permiso'] == 4)  {
  							# code...
  							echo "<button><i class='icon-cloud-upload'> SUBIR ARCHIVO</i></button>";
  						} ?>
  						
  					</div>
  					<div class="cell medium-1 op-home">
  						<p><a href="configuracion.php"><i class="icon-cog"></i></a></p>
  					</div>
  					<div class="cell medium-1  op-home">
  						<p><a href="../core/cerrar_secion.php"><i class="icon-enter"></i></a></p>
  					</div>
  				</div>
  			</div>
  			<div class="cell medium-10">
  				<div class="grid-x grid-padding-x align-center-middle">
  					<div class="cell medium-10 form-home">
  						<h3>SELECCIONE UNO O MAS CRITERIOS PARA SU BUSQUEDA</h3>
  						<div class="grid-x grid-padding-x  ">
  							<div class="cell medium-4">
  								<div class="label-home align-center">
  									<button>NUMERO DE DECLARACIÓN</button>
  									<input type="text" name="doc_numliqu" id="doc_numliq" placeholder="N° Liquidacion">
  								</div>
  							</div>
  							<div class="cell medium-4">
  								<div class="label-home">
  									<button>AÑO DE PUBLICACIÓN</button>
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
  								</div>
  							</div>
  							<div class="cell medium-4">
  								<div class="label-home">
  									<button>CATEGORIA</button>
  									<select name="cat" id="cat">
  										<option value="" disabled selected>Elegir una categoria</option>
  										<?php 
										foreach ($result3 as $key => $v) {
										echo "<option id=".$v['cat_id']." value ='".$v['cat_id']."'>".$v['cat_nombre']."</option>";
										};		
				  						 ?>
  									</select>
  								</div>
  							</div>
  							<div class="cell medium-8 medium-offset-2 bt-home-2">
								<button id="search-home"><i class="icon-search"></i> Realizar Búsqueda</button>
							</div>
  						</div>
  					</div>
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
<script>
	$(document).ready(function(){
		$(document).on('click', '#search-home', function(event){
			var doc_numliq = $('#doc_numliq').val();
			var anio = $('#anio').val();
			var cat = $('#cat').val();
			var url = 'result.php?doc_numliq='+doc_numliq+'&anio='+anio+'&cat='+cat+'';
			alert(url);
		});
	})
</script>