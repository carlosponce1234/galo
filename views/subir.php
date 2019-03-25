<?php 
		$sql4 =" SELECT * FROM categoria";
		$result4=$mysqli->query($sql4);
		$row4 = $result4->fetch_assoc();

		$sql5 =" SELECT * FROM cliente";
		$result5=$mysqli->query($sql5);
		$row5 = $result5->fetch_assoc();
 ?>
 <div class="reveal" id="e_subir" data-reveal data-animation-in="slidein">
  	<h5>Subir Archivo</h5>
  	<hr>
  	<form action="" method="POST" enctype="multipart/form-data">
  		<input style="display: none;" type="text" value="<?php echo $user_id; ?>">
  		<label for="doc_numliq">Nombre del archivo</label>
  		<input type="text" id="doc_numliq" name="doc_numliq">
  		<label for="Cliente">Cliente</label>
  		<select name="cliente" id="cliente">
			<option  disabled selected>Elegir empresa o cliente</option>
				<?php 
					foreach ($result5 as $key => $v) {	
						echo "<option id=".$v['cliente_id']." value ='".$v['cliente_id']."'>".$v['cliente_nombre']."</option>";
					};		
				 ?>	
	   </select>
  		<label for="anio">Año de publicacion</label>
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
  		<label for="cat">Categoria</label>
  		<select name="cat" id="cat">
			<option disabled selected >Elegir Categoria</option>
			<?php 
				foreach ($result3 as $key => $v) {
					echo "<option id=".$v['cat_id']." value ='".$v['cat_id']."'>".$v['cat_nombre']."</option>";
					};		
					 ?>
		</select>
		<label for="archivo">archivo</label>
		<input type="file" name="archivo">
		<button class="guardar" id="subir-file"><i class="icon-cloud-upload"></i> Subir</button>
		<button  class="reset" id="cancelar-file"><i class="icon-cross"></i>Cancelar</button>	
  	</form>
  </div>