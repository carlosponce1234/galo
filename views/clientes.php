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
		
 ?>
  <!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='icon' href='../favicon.ico' type='image/x-icon'/ >
    <title>Clientes</title>
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
    			<div class="cell medium-3"style="background-color: #000000;">
    				<div class="cell medium-12 op-home2">
      					<p style="text-align: left; padding-top: 1rem;">
							<a  href="configuracion.php"><i class="icon-cog"></i></a>
      						 <a href="home.php"><i class="icon-home"></i></a>
							<?php 
								 if ($row['user_subir'] == 1)  {
  							# code...
  							echo "<button id='file' class='btn'>Subir Archivo</button>";
  						}; 	 ?>
      						</p>
      				</div> 
      				<div class="barra_lat">	
      				<ul class="nav-bar">	
						<li><a href="home.php"><button>
							<i class="icon-home"></i>&nbsp;&nbsp;&nbsp; Home</button></a></li>
						<li><a href="configuracion.php"><button><i class="icon-users"></i>&nbsp;&nbsp;&nbsp; Agregar Usuarios </button></a></li>
							<?php if ($row['user_tipo']=='Administrador' || $row['user_tipo']=='Colaborador') {
								echo( "<li><a href='clientes.php'><button style='color: #ffa900;'><i class='icon-user-tie'></i>&nbsp;&nbsp;&nbsp; Agregar Clientes </button></a></li>
						<li><a href='categorias.php'><button><i class='icon-folder-open'></i>&nbsp;&nbsp;&nbsp; Categorias </button></a></li>");
							} ?>
      				</ul>	
      				</div>
    			</div>
    			<div class="cell medium-9">
    				<div class="grid-x grid-padding-x cabecera">
							<div class="cell medium-5">
							   <h4><strong>Configuración</strong> / Crear cliente </h4>		
						    </div>
						    <div class="cell medium-4">
						    	<p> <strong> <?php if ($rows>0) {
							   	echo $row['user_monbre'].' / '.$row['user_tipo'];
							   }; ?></strong></p>
						    </div>
						    <div class="cell medium-2">
						    		<img src="../img/icono-galo-barco-09.png" alt="usuario">	
						    </div>
						    <div class="cell medium-1 ">
						    	<div class="cerrar_secion">
						    			<a href="../core/cerrar_secion.php">
    					<i class="icon-enter"></i> </a>
						    		
						    	</div>
						    	
						    </div> 	   
					</div>
					<?php if ($row['user_crear_u'] == 0) {	$att = 'style="display: none;"';
					echo "<div style = 'height:30rem; margin-top:3rem;' class='callout warning'>
  					<h5>PARECE QUE NO TIENES LOS PERMISOS NECESARIOS </h5>
  					<p>No cuentas con los permisos para crear nuevos usuarios, ponte en contacto con el administrador del sitio para solicitar permiso</p>
					</div>";
				} else {	
						$att = ' ';
						}; ?>
					<div class="grid-x grid-padding-x" <?php echo $att ?>>
						<div class="cell medium-3 medium-offset-9" >
							<div style="margin-top: 1.5rem;">
								<a  class="guardar1" href="ver_clientes.php"> Ver todos</a>
							</div>
						</div>
					</div>
					<div class="grid-x grid-padding-x etiqueta">
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>Nombre o razón social</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <input id="n_cliente" type="text" name="n_usuario" placeholder="Nombres y Apellidos">	
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>Correo Electrócico</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <input id="mail" type="email" name="mail" placeholder="E-mail">	
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>informacion</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <textarea name="informacion" id="info" cols="30" rows="10" placeholder="Escriba aqui informacion extra..."></textarea>	
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
</body>
<?php include 'subir.php'; ?>
<script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/jquery.form.min.js"></script>
    <script src="../js/app.js"></script>
</html>
<script>
	$(document).ready(function(){

		$(document).on('click', '#guardar', function(event){
			var operacion = 'insert';
			var n_cliente = $('#n_cliente').val();
			var mail = $('#mail').val();
			var info = $('#info').val();
			//alert(operacion+', '+n_cliente+', '+mail+', '+info);
			$.ajax({
				url: '../core/clientes.php',
				type: 'POST',
				data: {
					operacion : operacion,
					n_cliente : n_cliente,
					mail : mail,
					info : info,
				},
				success: function(data){
					alert(data);
					$('#n_cliente').val('')
					$('#mail').val('');
					$('#info').val('');
				},
			});
		});
		$(document).on('click', '#reset', function(event){
			$('#n_cliente').val('')
					$('#mail').val('');
					$('#info').val('');
		});

		$(document).on('click', '#file',function(event){
			$('#e_subir').foundation('open');
		});

	})
</script>