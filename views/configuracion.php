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

		$sql="SELECT * FROM usuarios INNER JOIN cliente ON user_cliente = cliente_id Where user_id='$user_id'";
		$result=$mysqli->query($sql);
		$rows = $result->num_rows;
		$row = $result->fetch_assoc();

		if ($row['user_permiso'] == 3 || $row['user_permiso'] == 5 ) {
			# code...
			header("Location: home.php");
		};

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
            <link rel="apple-touch-icon" sizes="180x180" href="/galo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/galo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/galo/favicon-16x16.png">
<link rel="manifest" href="/galo/site.webmanifest">
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
    			<div class="cell medium-3 "style="background-color: #000000;" >
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
						<li><a href="configuracion.php"><button style="color: #ffa900;"><i class="icon-users"></i>&nbsp;&nbsp;&nbsp; Agregar Usuarios </button></a></li>
							<?php if ($row['user_tipo']=='Administrador' || $row['user_tipo']=='Colaborador') {
								echo( "<li><a href='clientes.php'><button><i class='icon-user-tie'></i>&nbsp;&nbsp;&nbsp; Agregar Clientes </button></a></li>
						<li><a href='categorias.php'><button><i class='icon-folder-open'></i>&nbsp;&nbsp;&nbsp; Categorias </button></a></li>");
							} ?>
      				</ul>	
      				</div>
    			</div>
				<div class="cell medium-9">
						<div class="grid-x grid-padding-x cabecera">
							<div class="cell medium-5">
							   <h4> <strong>Configuración</strong> / Crear usuario </h4>		
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
					<div class="grid-x grid-padding-x">
						<div class="cell medium-3 medium-offset-9" >
							<div style="margin-top: 1.5rem;">
								<a  class="guardar1" href="usuarios.php">Ver todos</a>
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

					<div <?php echo $att ?> class="grid-x grid-padding-x etiqueta">
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
								   	if ($row['user_tipo'] == 'Cliente' ||$row['user_tipo'] == 'Sub-usuario(cliente)') {
								   		echo "<option id=".$row['user_cliente']." value ='".$row['user_cliente']."'>".$row['cliente_nombre']."</option>";
								   	} else {
								   		foreach ($result2 as $key => $v) {
			
											echo "<option id=".$v['cliente_id']." value ='".$v['cliente_id']."'>".$v['cliente_nombre']."</option>";
										};	
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
								   	<?php 
								   		if ($row['user_tipo'] == 'Cliente' ||$row['user_tipo'] == 'Sub-usuario(cliente)' ) {
								   			$tt = 'disabled';
								   			$dd = 'style="display: none;"';
								   		} else {
								   			$tt = ' ';
								   			$dd = ' ';
								   		};
								   		
								   	 ?>
								   	<option value="0" disabled selected>Eligir tipo de usuario</option>
								   	<option <?php echo $tt ?> value="Administrador">Administrador</option>
								   	<option <?php echo $tt ?> value="Colaborador">Colaborador</option>
								   	<option <?php echo $tt ?> value="Cliente">Cliente</option>
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
								<div class="grid-x grid-padding-x">
									<div class="cell medium-4" <?php echo $dd ?>>
										<span>TODOS</span>
									   <div class="switch galo small" >
  										<input <?php echo $tt ?> class="switch-input" id="p-todo" type="checkbox" name="p-todo">
  										<label class="switch-paddle" for="p-todo">
    									<span class="show-for-sr">todo</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
									<div class="cell medium-4" >
										<span>BUSCAR</span>
									   <div class="switch galo small">
  										<input class="switch-input" id="p-buscar" type="checkbox" name="p-buscar">
  										<label class="switch-paddle" for="p-buscar">
    									<span class="show-for-sr">buscar</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
									<div class="cell medium-4" <?php echo $dd ?>>
										<span>SUBIR</span>
									   <div class="switch galo small">
  										<input <?php echo $tt ?> class="switch-input" id="p-subir" type="checkbox" name="p-subir">
  										<label class="switch-paddle" for="p-subir">
    									<span class="show-for-sr">subir</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
									<div class="cell medium-4">
										<span>crea usuarios</span>
									   <div class="switch galo small">
  										<input class="switch-input" id="p-usuario" type="checkbox" name="p-usuario">
  										<label class="switch-paddle" for="p-usuario">
    									<span class="show-for-sr">usuario</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
									<div class="cell medium-4" <?php echo $dd ?>>
										<span>crea clientes</span>
									   <div class="switch galo small">
  										<input <?php echo $tt ?> class="switch-input" id="p-clientes" type="checkbox" name="p-clientes">
  										<label class="switch-paddle" for="p-clientes">
    									<span class="show-for-sr">clientes</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
									<div class="cell medium-4" <?php echo $dd ?>>
										<span>crea cat.</span>
									   <div class="switch galo small">
  										<input <?php echo $tt ?>  class="switch-input" id="p-categoria" type="checkbox" name="p-categoria">
  										<label class="switch-paddle" for="p-categoria">
    									<span class="show-for-sr">categoria</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
								</div>
						    </div>
						</div>
						<div class="cell medium-3 medium-offset-1">
							<div class="label1">
						    	<p>Activo?</p>	
						    	</div>
						</div>
						<div class="cell medium-5">
							<div >
								<div class="switch galo1 large">
  										<input  class="switch-input" id="estado" type="checkbox" name="estado" checked>
  										<label class="switch-paddle" for="estado">
    									<span class="show-for-sr">estado</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">NO</span>
  										</label>
									   </div>
						    	</div>
						</div>
						<div class="cell medium-3 medium-offset-4 ">
							<div>								
							<button  class="guardar" id="guardar"> Guardar Usuario </button>   	
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
<?php 		include 'subir.php'; ?>
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
			var user_permiso = '4';
			var user_estado = $('#estado').is(':checked');
			var p_buscar = $('#p-buscar').is(':checked');
			var p_subir = $('#p-subir').is(':checked');
			var p_usuario = $('#p-usuario').is(':checked');
			var p_clientes = $('#p-clientes').is(':checked');
			var p_categoria = $('#p-categoria').is(':checked');
			 //alert(test);
			//alert(operacion+'/ '+user_name+'/ '+user_mail+'/ '+user_pass1+'/ '+user_cliente+'/ '+user_tipo+'/ '+user_permiso+'/ '+user_estado+'/ '+p_buscar);	
			if (user_pass2=user_pass1) {
				$.ajax({
					url:'../core/usuarios.php',
					type:'POST',
					data:{
						operacion:operacion,user_name:user_name,user_mail:user_mail,user_pass1:user_pass1,user_cliente:user_cliente,user_tipo:user_tipo,user_permiso:user_permiso,user_estado:user_estado,p_buscar:p_buscar,p_categoria:p_categoria,p_clientes:p_clientes,p_usuario:p_usuario,p_subir:p_subir
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

		$(document).on('click', '#file',function(event){
			$('#e_subir').foundation('open');
		});
		$('#p-todo' ).click(function () {
        $( '.input input[type="checkbox"]').prop('checked', this.checked)
});

	})
</script>