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

		$sql2 ="SELECT * FROM cliente";
		$result2=$mysqli->query($sql2);
		$row2 = $result2->fetch_assoc();

	if ($row['user_crear_ct'] == 0 ) {
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
            <link rel="apple-touch-icon" sizes="180x180" href="/galo/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="/galo/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="/galo/favicon-16x16.png">
<link rel="manifest" href="/galo/site.webmanifest">
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
								 if ($row['user_permiso'] == 1 || $row['user_permiso'] == 3 || $row['user_permiso'] == 4)  {
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
							   <h4><strong>Configuración</strong> / Lista clientes </h4>		
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
								<th>info</th>
								<th>Acciones</th>
							</thead>
							<tbody id="user_table">
								<?php 
								   		foreach ($result2 as $key => $v) {
								   			if ($v['cliente_id'] == 1) {
								   				$hh = 'disabled';
								   			} else {
								   				$hh = ' ';
								   			};
										echo "<tr>
												<td id=".$v['cliente_id']." class='cliente_id'>".$v['cliente_id']."</td>
												<td id=".$v['cliente_nombre']." class='cliente_nombre'>".$v['cliente_nombre']."</td>
												<td id=".$v['cliente_mail']." class='cliente_mail'>".$v['cliente_mail']."</td>
												<td id=".$v['cliente_info']." class='cliente_info'>".$v['cliente_info']."</td>
												<td>
													<button id='edit_cliente' class='button editar small'>
													<i class='icon-eye'></i></button>
									<button ".$hh." id='elimina' class='button desactiva small'><i class='icon-bin'></i></button>
												</td>
											</tr>";
										};		
								 ?>
							</tbody>
						    </table>
						</div>
					</div>
    			</div>
		</div>
	</div>
</body>
<div class="reveal" id="e_cliente" data-reveal data-animation-in="slidein">
  	<h5>Editar cliente</h5>
  	<hr>
  	<form action="">
  		<input type="text" name="cliente_id" id="cliente_id" style="display: none;">
  		<label for="n_cliente">Nombre de usuario</label>
  		<input type="text" id="n_cliente" name="n_cliente">
  		<label for="mail">Correo electronico</label>
  		<input type="email" id="mail" name="mail">
  		<label for="info">Informacion</label>
  		<textarea name="info" id="info" cols="30" rows="6"></textarea>
		<button class="guardar" id="guardar"><i class="icon-floppy-disk"></i>Guardar</button>
		<button  class="reset" id="cancelar"><i class="icon-cross"></i>Cancelar</button>	
  	</form>
  </div>
  <?php 		include 'subir.php'; ?>
	<script src="../js/vendor/jquery.js"></script>
    <script src="../js/vendor/what-input.js"></script>
    <script src="../js/vendor/foundation.js"></script>
    <script src="../js/app.js"></script>
</html>
<script>
	$(document).ready(function(){
		$(document).on('click','#edit_cliente', function(event){
			var cell = $(this).parent();
			var row = cell.parent();
			var cell_id = row.children('.cliente_id');
			var cliente_id = cell_id.attr('id');
			var operacion = 'fill';
			$.ajax({
				url: '../core/clientes.php',
				type:'POST',
				data: {
					operacion : operacion,
					cliente_id : cliente_id,
				},
				success: function (data)
				{
					var tmp = data.split(',');
					$('#cliente_id').val(tmp[0]);
					$('#n_cliente').val(tmp[1]);
					$('#mail').val(tmp[2]);
					$('#info').val(tmp[3]);
				} 
			});
			$('#e_cliente').foundation('open');
		});
		//CERRA MODAL VER USUARIOS 
		$(document).on('click', '#cancelar',function(event){
			$('#e_cliente').foundation('close');
		});
		$(document).on('click','#guardar',function(event){
			var r = confirm('Seguro desea guardar los cambios?');
			if (r == true) {
				var n_cliente = $('#n_cliente').val();
				var mail = $('#mail').val();
				var info = $('#info').val();
				var cliente_id = $('#cliente_id').val();
				var operacion = 'update';
				//alert(n_cliente+', '+mail+', '+info+', '+cliente_id+','+operacion);
				$.ajax({
					url: '../core/clientes.php',
					type: 'POST',
					data:{
						operacion : operacion,
						n_cliente : n_cliente,
						mail : mail,
						info : info,
						cliente_id : cliente_id,
					},
					success: function(data){
						alert(data);
					},
				});
				$('#e_cliente').foundation('close');
			};
		});
		$(document).on('click', '#elimina', function(event){
			var r = confirm('Esta seguro que desea eliminar cliente?');
			if (r == true) {
				var cell = $(this).parent();
			var row = cell.parent();
			var cell_id = row.children('.cliente_id');
			var cliente_id = cell_id.attr('id');
				var operacion = 'delite';
				alert(cliente_id+', '+operacion);
				$.ajax({
					url: '../core/clientes.php',
					type: 'POST',
					data:{
						cliente_id : cliente_id,
						operacion : operacion,
					},
					success: function(data){
						alert(data);
						row.remove();
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