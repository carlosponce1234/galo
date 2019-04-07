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
		
		if ($row['user_cliente'] == 1 ) {
			if ($row['user_crear_u'] == 0) {
			$us=$row['user_id'];
			$sql2 ="SELECT * FROM usuarios INNER JOIN cliente ON user_cliente = cliente_id WHERE user_id = '$us'";
			$result2=$mysqli->query($sql2);
			$row2 = $result2->fetch_assoc();
			} else {
			$sql2 ="SELECT * FROM usuarios INNER JOIN cliente ON user_cliente = cliente_id";
			$result2=$mysqli->query($sql2);
			$row2 = $result2->fetch_assoc();	
			};
		} else {
		$cli=$row['user_cliente'];
		if ($row['user_crear_u'] == 0) {
		$us=$row['user_id'];	
		$sql2 ="SELECT * FROM usuarios INNER JOIN cliente ON user_cliente = cliente_id 
		WHERE user_cliente = '$cli' AND user_id = '$us'";
		$result2=$mysqli->query($sql2);
		$row2 = $result2->fetch_assoc();
			} else {

		$sql2 ="SELECT * FROM usuarios INNER JOIN cliente ON user_cliente = cliente_id WHERE user_cliente = '$cli'";
		$result2=$mysqli->query($sql2);
		$row2 = $result2->fetch_assoc();
			}
		};

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
    <link rel='icon' href='../favicon.ico' type='image/x-icon'/ >
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
							   <h4><strong>Configuración</strong> / lista usuarios </h4>		
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
					<div class="grid-x grid-margin-x acciones">
						<div class="cell medium-7 medium-offset-1">
							<div id="wraper" class="input-group">
						<button style="border-radius: 200px 0px 0px 200px;" class="buscar_btn input-group-button"><i class="icon-search"></i></button>
						<input style="border-radius: 0px 200px 200px 0px;" class="input-group-field " type="text" id="buscar_user" placeholder=" Buscar usuario">
					</div>
						</div>
					</div>
					<div class="grid-x grid-padding-x tabla">
						<div class="cell medium-12">
							<table id="mytable">
							<thead>
								<td>ID</td>
								<th>Nombre</th>
								<th>Correo Electrónico</th>
								<th>Empresa</th>
								<th>Tipo de usuario</th>
								<th>Estado</th>
								<th>Acciones</th>
							</thead>
							<tbody id="user_table">
								<?php 
								   		foreach ($result2 as $key => $v) {
								   			if ($v['user_estado'] =='0') {
								   				# code...
								   				$est = 'A';
								   			} else {
								   				# code...
								   				$est = 'I';
								   			};
								   			if ($row['user_crear_u'] == 0) {
								   				$at = 'disabled';
								   			} else {
								   				$at = ' ';
								   			}
								   			

										echo "<tr>
												<td id=".$v['user_id']." class='user_id'>".$v['user_id']."</td>
												<td id=".$v['user_monbre']." class='user_nombre'>".$v['user_monbre']."</td>
												<td id=".$v['user_mail']." class='user_mail'>".$v['user_mail']."</td>
												<td id=".$v['user_cliente']." class='user_cliente'>".$v['cliente_nombre']."</td>
												<td id=".$v['user_tipo']." class='user_tipo'>".$v['user_tipo']."</td>
												<td id=".$v['user_estado']." class='user_estado'>".$est."</td>
												<td>
													<button id='edit_user' class='button editar small'>
													<i class='icon-eye'></i></button>
									<button ".$at." id='desactiva' class='button desactiva small'><i class='icon-user-minus'></i></button>
												</td>
											</tr>";
										};		
								 ?>
							</tbody>
						    </table>
						</div>
					</div>
    			</div>
  </body>
  <div class="reveal" id="e_user" data-reveal data-animation-in="slidein">
  	<h5>Editar usuario</h5>
  	<hr>
  	<form action="">
  		<?php 
			if ($row['user_crear_u'] == 0) {
				$att = 'disabled';
				$diss = 'style="display: none;"';
			} else {
				$att = ' ';
				$diss = ' ';
			};
		 ?>	
		 <?php 
			if ($row['user_tipo'] == 'Cliente' ||$row['user_tipo'] == 'Sub-usuario(cliente)' ) {
				$tt = 'disabled';
				$dd = 'style="display: none;"';
			} else {
				$tt = ' ';
				$dd = ' ';
			};
			?>
			<?php 
			if ($row['user_tipo'] == 'Sub-usuario(cliente)' ) {
				$ddi = 'style="display: none;"';
			} else {
				$ddi = ' ';
			};
			?>
  		<input type="text" name="user_id" id="user_id" style="display: none;">
  		<label for="n_usuario">Nombre de usuario</label>
  		<input type="text" id="n_usuario" name="n_usuario">
  		<label for="pass">Contraseña</label>
  		<input type="password" id="pass" name="pass">
  		<label for="mail">Correo electronico</label>
  		<input type="email" id="mail" name="mail">
  		<label for="permisos">Permisos</label>
  		<div class="grid-x grid-padding-x" <?php echo $diss; ?>>
									<div class="cell medium-4">
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
									<div class="cell medium-4" <?php echo $dd; ?>>
										<span>SUBIR</span>
									   <div class="switch galo small">
  										<input class="switch-input" id="p-subir" type="checkbox" name="p-subir">
  										<label class="switch-paddle" for="p-subir">
    									<span class="show-for-sr">subir</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
									<div class="cell medium-4" <?php echo $dd; ?>>
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
									<div class="cell medium-4" <?php echo $dd; ?>>
										<span>crea clientes</span>
									   <div class="switch galo small">
  										<input class="switch-input" id="p-clientes" type="checkbox" name="p-clientes">
  										<label class="switch-paddle" for="p-clientes">
    									<span class="show-for-sr">clientes</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
									<div class="cell medium-4" <?php echo $dd; ?>>
										<span>crea cat.</span>
									   <div class="switch galo small">
  										<input  class="switch-input" id="p-categoria" type="checkbox" name="p-categoria">
  										<label class="switch-paddle" for="p-categoria">
    									<span class="show-for-sr">categoria</span>
    									<span class="switch-active" aria-hidden="true">SI</span>
    									<span class="switch-inactive" aria-hidden="true">No</span>
  										</label>
									   </div>
									</div>
								</div>
		<label <?php echo $diss; ?> for="estado">ACTIVO?</label>
		<div class="switch galo1 large" <?php echo $diss; ?>>
  				<input  class="switch-input" id="estado" type="checkbox" name="estado">
  				<label class="switch-paddle" for="estado">
    			<span class="show-for-sr">estado</span>
    			<span class="switch-active" aria-hidden="true">SI</span>
    			<span class="switch-inactive" aria-hidden="true">NO</span>
  				</label>
									   </div>						   
		<button class="guardar" id="guardar"><i class="icon-floppy-disk"></i>Guardar</button>
		<button  class="reset" id="cancelar"><i class="icon-cross"></i>Cancelar</button>	
  	</form>
  </div>
  <?php 		include 'subir.php'; ?>
   <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/jquery.form.min.js"></script>
    <script src="../js/app.js"></script>
  </body>
</html>  
<script>
	$(document).ready(function(){
		/*var table = $('#mytable');
 		var tr = table.children(tr);

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    var td = tr[i].children(td)[6];
    var btn = td.children('#desactiva');
        btn.attr('dissabled');
      }; */
	//Editar Usuarios 
		//MODAL VER USUARIOS 
		$(document).on('click','#edit_user', function(event){
			var cell = $(this).parent();
			var row = cell.parent();
			var cell_id = row.children('.user_id');
			var user_id = cell_id.attr('id');
			var operacion = 'fill';
			$.ajax({
				url: '../core/usuarios.php',
				type:'POST',
				data: {
					operacion : operacion,
					user_id : user_id,
				},
				success: function (data)
				{
					var tmp = data.split(',');
					$('#user_id').val(tmp[0]);
					$('#n_usuario').val(tmp[1]);
					$('#pass').val(tmp[3]);
					$('#mail').val(tmp[2]);
					//alert(tmp[6]);
					if (tmp[6] == '1') {
						$('#p-buscar').attr('checked','true');
					};
					if (tmp[7] == '1') {
						$('#p-subir').attr('checked','true');
					};
					if (tmp[9] == '1') {
						$('#p-usuario').attr('checked','true');
					};
					if (tmp[8] == '1') {
						$('#p-clientes').attr('checked','true');
					};
					if (tmp[10] == '1') {
						$('#p-categoria').attr('checked','true');
					};
					if (tmp[11] == '0') {
						$('#estado').attr('checked','true');
					};				
				} 
			});
			$('#e_user').foundation('open');
		});
		//CERRA MODAL VER USUARIOS 
		$(document).on('click', '#cancelar',function(event){
			$('#e_user').foundation('close');
		})
		//GUARDAR CAMBIOS
		$(document).on('click','#guardar',function(event){
			var r = confirm('Seguro desea guardar los cambios?');
			if (r == true) {
				var n_usuario = $('#n_usuario').val();
				var pass = $('#pass').val();
				var mail = $('#mail').val();
				var user_id = $('#user_id').val();
				var user_estado = $('#estado').is(':checked');
			var p_buscar = $('#p-buscar').is(':checked');
			var p_subir = $('#p-subir').is(':checked');
			var p_usuario = $('#p-usuario').is(':checked');
			var p_clientes = $('#p-clientes').is(':checked');
			var p_categoria = $('#p-categoria').is(':checked');
				var operacion = 'update';
				//alert(n_usuario+', '+pass+', '+mail+', '+permiso+', '+estado+', '+user_id+','+operacion);
				$.ajax({
					url: '../core/usuarios.php',
					type: 'POST',
					data:{
						operacion : operacion,
						n_usuario : n_usuario,
						pass : pass,
						mail : mail,
						user_estado : user_estado,
						user_id : user_id,
						p_buscar : p_buscar,
						p_subir : p_subir,
						p_categoria :p_categoria,
						p_usuario : p_usuario,
						p_clientes : p_clientes,

					},
					success: function(data){
						alert(data);
						window.location.reload();
					},
				});
				$('#e_user').foundation('close');
			};
		});
		$(document).on('click', '#desactiva', function(event){
			var r = confirm('Esta seguro que desea desactivar el usuario?');
			if (r == true) {
				var cell = $(this).parent();
				var row = cell.parent();
				var cell_estd = row.children('.user_estado');
				var estado = '1';
				var cell_id = row.children('.user_id');
				var user_id = cell_id.attr('id');
				var operacion = 'disabled';
				//alert(user_id+', '+estado);
				$.ajax({
					url: '../core/usuarios.php',
					type: 'POST',
					data:{
						user_id : user_id,
						operacion : operacion,
						estado : estado,
					},
					success: function(data){
						alert(data);
						window.location.reload();

					},
				});
			};
		});
		$(document).on('keyup' , '#buscar_user', function(event){
			var input = $('#buscar_user');
  			var filter = input.val().toUpperCase();
  			var table = $('#mytable');
  			var tr = $('#mytable tr');
  			//alertify.log(filter);
  			for (var i = 0; i< tr.length;  i++) {
  				td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
		});
		$(document).on('click', '#file',function(event){
			$('#e_subir').foundation('open');
		});
	})
</script>