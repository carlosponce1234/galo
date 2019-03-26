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

		if ($row['user_permiso'] == 3 ||$row['user_permiso'] == 5 ) {
			# code...
			header("Location: home.php");
		};
 ?>
 <!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categorias</title>
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
		<div  class="grid-x grid-padding-x">
			<div class="cell medium-3"style="background-color: #0000AB;  height: 45rem;">
      				<div class="barra_lat">	
      				<?php 
						 if ($row['user_permiso'] == 1 || $row['user_permiso'] == 3 || $row['user_permiso'] == 4)  {
  							# code...
  							echo "<button id='file' class='btn'><span><i class='icon-cloud-upload'></i></span>SUBIR ARCHIVOS</button>";
  						}; 
				  	?>	
      				<ul class="nav-bar">	
						<li><a href="home.php"><button><span>
							<img src="../img/home-06.png" alt="control"></span> Home </button></a></li>
						<li><a href="configuracion.php"><button><span>
							<img src="../img/add-users-06.png" alt="control"></span> Agregar Usuarios </button></a></li>
						<li><a href="clientes.php"><button><span>
							<img src="../img/add-clientes-06.png" alt="control"></span> Agregar Clientes </button></a></li>
						<li><a href="categorias.php"><button style="color: yellow;"><span>
							<img src="../img/settings.png" alt="control"></span> Categorias </button></a></li>	
      				</ul>	
      				</div>
    			</div>
    			<div class="cell medium-9">
    				<div class="grid-x grid-padding-x cabecera">
							<div class="cell medium-5">
							   <h4>CREAR  CATEGORIA</h4>		
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
							<div style="margin-top: 1.5rem;">
								<a  class="guardar" href="ver_categorias.php"><i class="icon-eye"></i> Ver todos</a>
							</div>
						</div>
					</div>
					<div class="grid-x grid-padding-x etiqueta">
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>Categoria</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <input id="n_cat" type="text" name="n_cat" placeholder="Categoria">	
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>descripcion</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <textarea name="descripcion" id="info" cols="30" rows="10" placeholder="Escriba aqui informacion extra..."></textarea>	
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-4 ">
							<div class="input">
								<button class="guardar" id="guardar"> Guardar  </button>	   	
						    </div>
						</div>
						<div class="cell medium-3 ">
							<div class="input">
								<button class="reset" id="reset"> Limpiar </button>		   	
						    </div>
						</div>
					</div>
    			</div>
		</div>
	</div>
</body>
<?php 
		include 'subir.php';
		 ?>
<script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
</html>
<script>
	$(document).ready(function(){
		$(document).on('click', '#guardar', function(event){
			var operacion = 'insert';
			var n_cat = $('#n_cat').val();
			var info = $('#info').val();
			//alert(operacion+', '+n_cat+', '+info);
			$.ajax({
				url: '../core/categorias.php',
				type: 'POST',
				data: {
					operacion : operacion,
					n_cat : n_cat,
					info : info,
				},
				success: function(data){
					alert(data);
					$('#n_cat').val('')
					$('#info').val('');
				},
			});
		});
		$(document).on('click', '#reset', function(event){
			$('#n_cat').val('')
					$('#info').val('');
		});
		$(document).on('click', '#file',function(event){
			$('#e_subir').foundation('open');
		});
	})
</script>