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

		$sql2 ="SELECT * FROM usuarios";
		$result2=$mysqli->query($sql2);
		$row2 = $result2->fetch_assoc();

		$sql3 =" SELECT * FROM permisos";
		$result3=$mysqli->query($sql3);
		$row3 = $result3->fetch_assoc();

		include 'subir.php';
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
    			<div class="cell medium-3"style="background-color: #0000AB; height: 50rem;">
    				<div class="barra_lat">	
      				<?php 
						 if ($row['user_permiso'] == 1 || $row['user_permiso'] == 3 || $row['user_permiso'] == 4)  {
  							# code...
  							echo "<button class='btn'><span><i class='icon-cloud-upload'></i></span>SUBIR ARCHIVOS</button>";
  						}; 
				  	?>	
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
										echo "<tr>
												<td id=".$v['user_id']." class='user_id'>".$v['user_id']."</td>
												<td id=".$v['user_monbre']." class='user_nombre'>".$v['user_monbre']."</td>
												<td id=".$v['user_mail']." class='user_mail'>".$v['user_mail']."</td>
												<td id=".$v['user_cliente']." class='user_cliente'>".$v['user_cliente']."</td>
												<td id=".$v['user_tipo']." class='user_tipo'>".$v['user_tipo']."</td>
												<td id=".$v['user_estado']." class='user_estado'>".$est."</td>
												<td>
													<button id='edit_user' class='button editar small'>
													<i class='icon-eye'></i></button>
									<button id='desactiva' class='button desactiva small'><i class='icon-user-minus'></i></button>
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
  		<input type="text" name="user_id" id="user_id" style="display: none;">
  		<label for="n_usuario">Nombre de usuario</label>
  		<input type="text" id="n_usuario" name="n_usuario">
  		<label for="pass">Contraseña</label>
  		<input type="password" id="pass" name="pass">
  		<label for="mail">Correo electronico</label>
  		<input type="email" id="mail" name="mail">
  		<label for="permisos">Permisos</label>
  		<select name="permisos" id="permisos">
			<option  selected id="permiso"></option>
			<?php 
			foreach ($result3 as $key => $v) {
				echo "<option id=".$v['permisos_id']." value ='".$v['permisos_id']."'>".$v['permisos_desc']."</option>";
				};		
				  	 ?>
		</select>
		<label for="estado">Estado</label>
		<select name="estado" id="estado">
			 	<option value="0" selected>Activo</option>
			 	<option value="1">Inactivo</option>
		</select>
		<button class="guardar" id="guardar"><i class="icon-floppy-disk"></i>Guardar</button>
		<button  class="reset" id="cancelar"><i class="icon-cross"></i>Cancelar</button>	
  	</form>
  </div>
   <script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
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
					$('#permiso').val(tmp[6]);
					$('#permiso').html(tmp[7]);
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
				var permiso = $('#permisos').val();
				var estado = $('#estado').val();
				var user_id = $('#user_id').val();
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
						permiso : permiso,
						estado : estado,
						user_id : user_id,
					},
					success: function(data){
						alert(data);
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
		})
	})
</script>