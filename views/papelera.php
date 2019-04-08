<?php 
	require ('../core/conexion.php');
session_start();
	date_default_timezone_set('America/Managua');
	if(!isset($_SESSION["user_id"])){
		header("Location: ../index.php");
	}
		$user_id =	$_SESSION['user_id']; 
		

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
				$sql2 = "SELECT	* FROM	documentos INNER JOIN categoria ON doc_cat = cat_id WHERE doc_numliq = '$doc_numliq' AND doc_anio = '$doc_anio' AND doc_papelera = '1'";
				$result2=$mysqli->query($sql2);
				$rows2 = $result2->num_rows;
				$row2 = $result2->fetch_assoc();

			} else {
				$sql2 = "SELECT	* FROM	documentos INNER JOIN categoria ON doc_cat = cat_id WHERE doc_numliq = '$doc_numliq' AND doc_cat = '$cat' AND doc_anio = '$doc_anio' AND doc_papelera = '1'";
				$result2=$mysqli->query($sql2);
				$rows2 = $result2->num_rows;
				$row2 = $result2->fetch_assoc();
			};
			
		} else {
			if ($cat == 0) {
				# code...
				$sql2 = "SELECT	* FROM	documentos INNER JOIN categoria ON doc_cat = cat_id WHERE doc_anio = '$doc_anio' AND doc_papelera = 1";
				$result2=$mysqli->query($sql2);
				$rows2 = $result2->num_rows;
				$row2 = $result2->fetch_assoc();
			} else {
				# code...
				$sql2 = "SELECT	* FROM	documentos INNER JOIN categoria ON doc_cat = cat_id WHERE doc_anio = '$doc_anio' AND doc_cat = '$cat' AND doc_papelera = 1";
				$result2=$mysqli->query($sql2);
				$rows2 = $result2->num_rows;
				$row2 = $result2->fetch_assoc();
			}
		};
		$sql3 =" SELECT * FROM categoria";
		$result3=$mysqli->query($sql3);
		$row3 = $result3->fetch_assoc();
		
	if ($row['user_buscar'] == 0 ) {
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
    <link rel='icon' href='../favicon.ico' type='image/x-icon'/ >
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
			<div class="cell medium-3 align-center"style="background-color: #000000; ">
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
      				<h5>Seleccione uno o mas criterios para su busqueda</h5>
				  <div class="nav-bar-result">		
  					<button>Nombre o referencia</button>
  					<input type="text" name="doc_numliqu" id="doc_numliq" placeholder="N° Liquidacion">
  					<button>AÑo de publicación</button>
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
									<button>Categoría</button>
  									<select name="cat" id="cat">
  										<option value="0"  selected>Todas las categorias</option>
  										<?php 
										foreach ($result3 as $key => $v) {
										echo "<option id=".$v['cat_id']." value ='".$v['cat_id']."'>".$v['cat_nombre']."</option>";
										};		
				  						 ?>
  									</select>
  									<div class="btn-group">
  										<p id="bus-result">Buscar </p>
  										<p class="sst"><i class="icon-search "></i></p>
  									</div>
  									
  				  </div>	
    			</div>
			</div>
		<div class="cell medium-9">
			<div class="grid-x grid-padding-x cabecera">
				<div class="cell medium-5">
					<h4> <strong>Documentos</strong> / Papelera</h4>		
				</div>
				<div class="cell medium-4">
					<p><?php if ($rows>0) {
					   	echo $row['user_monbre'].' / '.$row['user_tipo'];
					}; ?></p>
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
						<input style="border-radius: 0px 200px 200px 0px;" class="input-group-field " type="text" id="buscar_user" placeholder=" Buscar documentos">
					</div>
				</div>
			</div>
			<div class="grid-x grid-padding-x tabla">
				<div class="cell medium-12">
					<table id="mytable">
						<thead>
							<th>ID</th>
							<th>FECHA</th>
							<th>Nombre</th>
							<th>Año</th>
							<th>Categoria</th>
							<th>Acciones</th>
						</thead>
						<tbody id="user_table" style="overflow-y: scroll; height: 30rem;">
							<?php 
							if ($rows2 > 0) {
								foreach ($result2 as $key => $v) {
									$fecha = strtotime($v['doc_timestamp']);
									$fecha1 = date('d/m/y',$fecha);
									$btn =' ';
									if ($row['user_tipo'] == 'Cliente'||$row['user_tipo'] == 'Sub-usuario(cliente)') {
										$btn ='disabled';
									};
								echo "<tr>
									<td id=".$v['doc_id']." class='doc_id'>".$v['doc_id']."</td>
									<td id=".$fecha1." class='doc_timestamp'>".$fecha1."</td>
									<td id=".$v['doc_numliq']." class='doc_nombre'><i class='icon-file-pdf'></i> ".$v['doc_numliq']."</td>
									<td id=".$v['doc_anio']." class='doc_año'>".$v['doc_anio']."</td>
									<td id=".$v['doc_cat']." class='doc_cat'>".$v['cat_nombre']."</td>
									<td id=".$v['doc_ruta'].">
									<button id='ver_pdf' class='button editar small'>VER</button>
								    <button ".$btn." id='restaura' class='button editar2 small'>REST.</button>
								    <button ".$btn." id='elimina' class='button desactiva small'><i class='icon-bin'></i></button>
									</td>
									</tr>";
								}			
							}else {
								echo "<tr> <td>No se encontraron resultados... </td></tr>";	
							};
							 ?>
						</tbody>
					</table>
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
		$(document).on('click', '#ver_pdf', function(event){
			var dir = $(this).parent().attr('id');
			var url = "../"+dir;
			//alert(url);
			window.open(url,'_blank');
		});
		$(document).on('click', '#elimina', function(event){
			
			var r = confirm('Seguro desea eliminar permanentemente este documento?');
			if (r == true) {
				var cell = $(this).parent();
			var row = cell.parent();
			var cell_id = row.children('.doc_id');
			var doc_id = cell_id.attr('id');
			var operacion = 'borrar';
			//alert(doc_id+', '+operacion);
				$.ajax({
				url: '../core/documentos.php',
				type: 'POST',
				data: {
					doc_id : doc_id,
					operacion: operacion,
				},
				success: function(data){
					alert(data);
					row.remove();
				}
			});
			};
		});
		$(document).on('click', '#restaura', function(event){
			
			var r = confirm('Seguro desea restaurar este documento?');
			if (r == true) {
				var cell = $(this).parent();
			var row = cell.parent();
			var cell_id = row.children('.doc_id');
			var doc_id = cell_id.attr('id');
			var operacion = 'restaura';
			//alert(doc_id+', '+operacion);
				$.ajax({
				url: '../core/documentos.php',
				type: 'POST',
				data: {
					doc_id : doc_id,
					operacion: operacion,
				},
				success: function(data){
					alert(data);
					row.remove();
				}
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
  				td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
		});
		$(document).on('click', '#bus-result', function(event){
			var doc_nu = $('#doc_numliq').val();
      var anio = $('#anio').val();
      var cat = $('#cat').val();
      var tmp = $.trim($('#doc_numliq').val()).length
      //alert(doc_nu);
      if (doc_nu === undefined) {
        var url = 'result.php?anio='+anio+'&cat='+cat+'';
      } else {
      	if (tmp<=0) {
      		var url = 'result.php?anio='+anio+'&cat='+cat+'';
      	} else{
      		var doc_numliq = $('#doc_numliq').val().toUpperCase();
        var url = 'result.php?doc_numliq='+doc_numliq+'&anio='+anio+'&cat='+cat+'';
      	} ;
        
      };
      //alert(url);
			//alert(anio);
			window.location.assign(url);
		});

		$(document).on('click', '#file',function(event){
			$('#e_subir').foundation('open');
		});
		$(document).on('click', '#cancelar-file',function(event){
			$('#e_subir').foundation('close');
		});
	})
</script>