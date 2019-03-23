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

		$sql2="SELECT * FROM cliente";
		$result2=$mysqli->query($sql2);
		$row2 = $result2->fetch_assoc();

		$sql3 =" SELECT * FROM permisos";
		$result3=$mysqli->query($sql3);
		$row3 = $result3->fetch_assoc();


 ?>
 <!doctype html>
<html class="no-js" lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion</title>
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
    			<div class="cell medium-3"style="background-color: #0000AB;">
      				<div class="barra_lat">	
      				<button class="btn"><span><i class="flaticon-login"></i></span>SUBIR ARCHIVOS</button>
      				<ul class="nav-bar">	
						<li><a href="home.php"><button><span>
							<img src="../img/home-06.png" alt="control"></span> Home </button></a></li>
						<li><a href="configuracion.php"><button><span>
							<img src="../img/add-users-06.png" alt="control"></span> Agregar Usuarios </button></a></li>
						<li><a href="clientes.php"><button><span>
							<img src="../img/add-clientes-06.png" alt="control"></span> Agregar Clientes </button></a></li>
						<li><a href="categorias.php"><button><span>
							<img src="../img/settings.png" alt="control"></span> Categorias </button></a></li>	
      				</ul>	
      				</div>
    			</div>
				<div class="cell medium-9">
						<div class="grid-x grid-padding-x cabecera">
							<div class="cell medium-5">
							   <h4>CREAR NUEVO USUARIO</h4>		
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
								<a  class="guardar" href="usuarios.php"><i class="icon-eye"></i> Ver todos</a>
							</div>
						</div>
					</div>
					<div class="grid-x grid-padding-x etiqueta">
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>Nombre de usuario</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <input id="n_usuario" type="text" name="n_usuario" placeholder="Nombres y Apellidos">	
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
						    	<p>Contraseña</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <input id="pass" type="password" name="pass" placeholder="Escriba su contraseña">	
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p> Confirmar Contraseña</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <input id="pass1" type="password" name="pass1" placeholder="Escriba su contraseña">	
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>Institucion</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <select name="cliente" id="cliente">
								   	<option value="0" disabled selected>Elegir empresa o cliente</option>
								   	<?php 
								   		foreach ($result2 as $key => $v) {
			
											echo "<option id=".$v['cliente_id']." value ='".$v['cliente_id']."'>".$v['cliente_nombre']."</option>";
										};		
								   	 ?>
								   </select>	
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p> Tipo de Usuario</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <select name="tipo_usuario" id="tipo_usuario">
								   	<option value="0" disabled selected>Eligir tipo de usuario</option>
								   	<option value="Administrador">Administrador</option>
								   	<option value="Colaborador">Colaborador</option>
								   	<option value="Cliente">Cliente</option>
								   	<option value="Sub-usuario(cliente)">Sub-usuario(cliente)</option>
								   </select>	
						    	</div>
							
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>Definir permisos</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <select name="permisos" id="permisos">
								   	<option value="0" disabled selected>Asignar permisos</option>
								   	<?php 
								   		foreach ($result3 as $key => $v) {
			
											echo "<option id=".$v['permisos_id']." value ='".$v['permisos_id']."'>".$v['permisos_desc']."</option>";
										};		
								   	 ?>
								   </select>	
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>Estado</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div class="input">
								   <select name="estado" id="estado">
								   	<option value="0" selected>Activo</option>
								   	<option value="1">Inactivo</option>
								   </select>	
						    	</div>
							
						</div>
						<div class="cell medium-3 medium-offset-4 ">
							<div class="input">
								<button class="guardar" id="guardar"> Guardar Usuario </button>	   	
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
	</body>

  <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
</html>  
<script>
	$(document).ready(function(){

		$(document).on('click', '#guardar', function(event){
			var operacion = 'insert';
			var user_name = $('#n_usuario').val();
			var user_mail = $('#mail').val();
			var user_pass1 =$('#pass').val();
			var user_pass2 =$('#pass1').val();
			var user_cliente= $('#cliente').val();
			var user_tipo = $('#tipo_usuario').val();
			var user_permiso = $('#permisos').val();
			var user_estado = $('#estado').val();
			if (user_pass2=user_pass1) {
				$.ajax({
					url:'../core/usuarios.php',
					type:'POST',
					data:{
						operacion:operacion,user_name:user_name,user_mail:user_mail,user_pass1:user_pass1,user_cliente:user_cliente,user_tipo:user_tipo,user_permiso:user_permiso,user_estado:user_estado
					},
					success: function(data){
						alert(data);
						$('#n_usuario').val('');
						$('#mail').val('');
						$('#pass').val('');
						$('#pass1').val('');
					}
				});
			};
		});	
		$(document).on('click', '#reset', function(event){
			$('#n_usuario').val('');
			$('#mail').val('');
			$('#pass').val('');
			$('#pass1').val('');
		});

	})
</script>