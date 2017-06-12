<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php 
	 	include ("promedio.php");
		include ("menuinicio.php"); 
		include ("connect.php");
		$link = conectar();
		
		if ((isset($_GET['criterio'])) && ($_GET['criterio'] != "")) 		//Pregunto si existe el parámetro $_GET
			$criterio=$_GET["criterio"];  	// Asigno el parámetro a la variable $criterio
		else 								//Si no existe el $_GET
			$criterio = "nombreD"; 			//Se agrega un criterio de orden por defecto, para cuando no existen parámetros. 
		
		if	(isset($_GET['pag'])){
			$pagina = $_GET['pag']; 
		}
		else{
			$pagina = 0;
		}

		if(isset($_GET['gen'])){
			$gen = $_GET['gen'];
		}
		else{
			$gen="";
		}
	?>
</head>
<body>
	<table class= "table table-hover">
		<tr>
			<form method="GET">
			  	<select name="criterio">
				  	<?php 
				  		if ($criterio == "nombreD"){
				  			echo '<option value="anioA">Año ↑</option>';
				  			echo '<option value="anioD">Año ↓</option>';
				  			echo '<option value="nombreA">Nombre ↑</option>';
 							echo '<option value="nombreD" selected="selected">Nombre ↓</option>'; //Opción que aparecerá marcada por defecto
				  		}
				  		if ($criterio == "anioA"){
							echo '<option selected="selected" value="anioA">Año ↑</option>'; //Opción que aparecerá marcada por defecto
 							echo '<option value="anioD">Año ↓</option>';
				  			echo '<option value="nombreA">Nombre ↑</option>';
 							echo '<option value="nombreD">Nombre ↓</option>';
 						}
 						if ($criterio == "anioD"){
							echo '<option value="anioA">Año ↑</option>'; 
 							echo '<option value="anioD" selected="selected">Año ↓</option>'; //Opción que aparecerá marcada por defecto
				  			echo '<option value="nombreA">Nombre ↑</option>';
 							echo '<option value="nombreD">Nombre ↓</option>';
 						}
 						if ($criterio == "nombreA"){
							echo '<option value="anioA">Año ↑</option>'; 
 							echo '<option value="anioD">Año ↓</option>';
 							echo '<option value="nombreA" selected="selected">Nombre ↑</option>'; //Opción que aparecerá marcada por defecto
 							echo '<option value="nombreD">Nombre ↓</option>';
 						}
				  	?>
		    	</select>
		    	<button type="submit" class="btn btn-danger search">Ordenar</button>
		    	<?php 
		    		$sqlq = "SELECT * from peliculas WHERE "; 
		  			if ((isset($_GET['poranio'])) && ($_GET['poranio'] != "")) {
		  				$anio = ($_GET['poranio']); // Guardo en $anio el parámetro ingresado para la búsqueda
		  				$sqlq = $sqlq . "anio = $anio AND "; // Agrego al query la condición de búsqueda
		  				echo "<input id='Poranio' name='poranio' value='$anio' class='field-search' placeholder='Año'>"; //Para que me muestre el parámetro buscado en el input se usa value
		  			}
		  			else{
		  				echo '<input id="Poranio" name="poranio" class="field-search" placeholder="Año">'; //Si no se ingresó el parámetro para buscar por año, no se muestra ningún año por defecto en el input 
		  				$anio="";
		  			}

		  			// Lo mismo que se realiza para la búsqueda por año se repite en la búsqueda por nombre y por género.

		  			if ((isset($_GET['pornombre'])) && ($_GET['pornombre'] != "")) {
		  				$nombre = ($_GET['pornombre']);
		  				$sqlq = $sqlq . "nombre LIKE '%$nombre%' AND ";
		  				echo "<input id='Pornombre' name='pornombre' value='$nombre' class='field-search' placeholder='Nombre'>"; //Para que me muestre el parámetro buscado en el input se usa value
		  			}
		  			else{
		  				echo '<input id="Pornombre" name="pornombre" class="field-search" placeholder="Nombre">';
		  				$nombre="";
		  			}

				?>
				<select name="gen">
					<?php 
						$resultgeneros = mysqli_query($link, "SELECT * FROM generos"); 
						$cantGeneros = mysqli_num_rows($resultgeneros);
						if($gen == ""){
							echo '<option value="todas" selected="selected">Mostrar todos los géneros</option>';
							for($k=1; $k<= $cantGeneros ; $k++ ){
								$rowGen = mysqli_fetch_array($resultgeneros);
								$generoR = $rowGen['genero'];
								echo "<option value='$generoR'>$generoR</option>";
							}
						}
						else{
							echo '<option value="todas">Mostrar todos los géneros</option>';
							for($k=1; $k<= $cantGeneros ; $k++ ){
								$rowGen = mysqli_fetch_array($resultgeneros);
								$generoR = $rowGen['genero'];
							
								if($gen == $generoR){
									$generoid = $rowGen['id'];
									echo "<option value='$generoR' selected='selected'>$generoR</option>";
									$sqlq = $sqlq . "generos_id = $generoid AND ";
								}
								else echo "<option value='$generoR'>$generoR</option>";
							}
						}
					?>
				</select>
				<?php

					switch ($criterio) {
						case 'nombreA':
							$criterioSQL = "nombre ASC";
							break;
						case 'nombreD':
							$criterioSQL = "nombre DESC";
							break;
						case 'anioA':
							$criterioSQL = "anio ASC";
							break;
						case 'anioD':
							$criterioSQL = "anio DESC";
							break;
					}

					$sqlq = $sqlq . "1 = 1 ORDER BY $criterioSQL "; // Agrego un caso siempre verdadero al principio para poder colocar un AND al final de cada concatenación. Evita problemas cuando un criterio está siendo utilizado pero no tiene ningún criterio siguiente utilizado. Además permite colocar el WHERE antes de chequear las condiciones y que el código funcione aunque no se haya consultado por ningún parámetro de búsqueda. Luego se ordenan por un criterio que siempre va a tener un valor asignado, aunque el usuario no haya elegido uno.

					$resulttotal = mysqli_query($link, $sqlq);
					$tam_pag = 5;
					$offset = $tam_pag * $pagina;
			  		$sqlq = $sqlq . "LIMIT $tam_pag OFFSET $offset";
			  		if ($resulttotal){
			  			$cantpelistotal = mysqli_num_rows($resulttotal);
			  		}
			  		else{
			  			$cantpelistotal = 0;
			  		}

					$resultp = mysqli_query($link, $sqlq);
				  	//echo "$sqlq";  //Imprimir esto para chequear lo que realiza la sqli_query
				  	if ($resultp){
			  			$cantpelis = mysqli_num_rows($resultp);
			  		}
			  		else{
			  			$cantpelis = 0;
			  		}
			  		
			  		//echo "$cantpelis";
				?>
		    	<button type="submit" class="btn btn-danger search">Buscar</button>
		    </form>
		</tr>
	<?php 
		for ($i = 1; $i <= $cantpelis ; $i++){ 
			$row = mysqli_fetch_array($resultp); //Guardo en row la fila correspondiente a los datos de la siguiente película en el arreglo.
	?>
		<tr>
			<td width="160" >
				<?php echo '<img class="imagenpeli" src="data:image/jpeg;base64,'.base64_encode($row['contenidoimagen']) .'" />'; ?>
			</td>
			<td width="400">
				<h2><?php echo $row['nombre'] ?> </h2>
				<h4>
					<?php 
						$id_gen = $row['generos_id'];
						$resultg = mysqli_query($link, "SELECT * FROM generos WHERE id = $id_gen "); //Usar siempre comillas dobles cuando se agrega una variable PHP dentro de los parametros de un query, por ejemplo $id_gen en este caso.
						$rowg = mysqli_fetch_array($resultg);
						echo $rowg['genero'];
					?> 
				</h4>
				<h4><?php echo $row['anio'] ?></h4>

				<h4>  <?php
						$id = $row['id'];
        				echo "Calificación: ";
				 		echo promedio($id,$link); ?> </h4>
			</td>
			<td width="600">
				<p align="justify"><b><?php echo $row['sinopsis']?></b></p>
			</td>
			<td>
			   <?php
			   		
			    	echo "<p><a href='detalles.php?id=$id' class='btn btn-danger'>Detalles</a></p>" ; 
			    ?>
			</td>
		</tr>
		<?php 
			} //Cierro el for de listar películas
			mysqli_close($link); //Cierro la BDD
		?>		
	</table>
	<div align="center" class="pie">
		<?php
			$sig = $pagina + 1;
			$ant = $pagina - 1;
			$num_sig = $pagina + 2;
			//echo "sig $sig ant $ant cantpelistotal $cantpelistotal ";
			//echo (round($cantpelistotal / $tam_pag, 1));
			if ($pagina >= 1){
				echo "<a href='index.php?pag=$ant&criterio=$criterio&poranio=$anio&gen=$gen&pornombre=$nombre' class='btn btn-info2'>Anterior (Pág. $pagina)</a>" ; 
			}

			if ((round($cantpelistotal / $tam_pag, 1)) > $sig){  
				echo "<a href='index.php?pag=$sig&criterio=$criterio&poranio=$anio&gen=$gen&pornombre=$nombre' class='btn btn-info2'>Siguiente (Pág. $num_sig)</a>" ; 
			}
		?>
	</div>
</body>
</html>