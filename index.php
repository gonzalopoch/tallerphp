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
		
		if (isset($_GET['criterio'])) 		//Pregunto si existe el parámetro $_GET
			$criterio=$_GET["criterio"];  	// Asigno el parámetro a la variable $criterio
		else 								//Si no existe el $_GET
			$criterio = "nombre"; 			//Se agrega un criterio de orden por defecto, para cuando no existen parámetros. 
		
	?>
</head>
<body>
	<table class= "table table-hover">
		<tr>
			<form method="GET">
			  	<select name="criterio">
				  	<?php 
				  		if (isset($_GET['criterio'])){ //En este if compruebo cuál fue el último parámetro selccionado (si lo hubo) y lo asigno por defecto. 
				  			if ($criterio == "nombre"){
				  				echo '<option value="anio">Año</option>';
 								echo '<option value="nombre" selected="selected">Nombre</option>'; //Opción marcada por defecto
				  			}
				  			else{
								echo '<option selected="selected" value="anio">Año</option>'; //Opción marcada por defecto
 								echo '<option value="nombre">Nombre</option>';
 							}
 						}
 						else{
 							echo '<option value="anio">Año</option>'; //No se seleccionó ningún parámetro anteriormente, se muestran en un orden predeterminado. 
 							echo '<option value="nombre">Nombre</option>';
 						} 
				  	?>
		    	</select>
		    	<button type="submit" class="btn btn-danger navbar-btn">Ordenar</button>
		    	<?php 
		    			echo '<select name="busqueda">';
				  		if (isset($_GET['busqueda']) && isset($_GET['inputb']) && ($_GET["inputb"]!="")){ 
				  			$busqueda = $_GET["busqueda"];
				  			$inputb =  $_GET["inputb"];
				  			switch ($busqueda) {
					  			case 'poranio':
					  				$resultp = mysqli_query($link, "SELECT * FROM peliculas WHERE anio = $inputb ORDER BY $criterio ASC");
					  				echo '<option value="poranio" selected="selected">Buscar por Año</option>'; //Opción marcada por defecto
	 								echo '<option value="pornombre">Buscar por Nombre</option>'; 
					  				echo '<option value="porgenero">Buscar por Género</option>';
					  				break;
					  			case 'pornombre':
					  				$resultp = mysqli_query($link, "SELECT * FROM peliculas WHERE nombre LIKE '%$inputb%' ORDER BY $criterio ASC");
					  				echo '<option value="poranio">Buscar por Año</option>';
	 								echo '<option value="pornombre" selected="selected">Buscar por Nombre</option>'; //Opción marcada por defecto
					  				echo '<option value="porgenero">Buscar por Género</option>';
					  				break;
					  			case 'porgenero':
					  				$resultgb = mysqli_query($link, "SELECT * FROM generos WHERE genero LIKE '$inputb'");
					  				$rowgb = mysqli_fetch_array($resultgb);
									$generob = $rowgb['id'];
					  				$resultp = mysqli_query($link, "SELECT * FROM peliculas WHERE generos_id LIKE '$generob' ORDER BY $criterio ASC");
					  				echo '<option value="poranio">Buscar por Año</option>';
	 								echo '<option value="pornombre">Buscar por Nombre</option>'; 
					  				echo '<option value="porgenero" selected="selected">Buscar por Género</option>'; //Opción marcada por defecto
					  				break;
//					  			default:
//					  				$resultp = mysqli_query($link, "SELECT * FROM peliculas ORDER BY $criterio ASC");
//					  				echo '<option value="poranio">Buscar por Año</option>';
//	 								echo '<option value="pornombre">Buscar por Nombre</option>'; 
//					  				echo '<option value="porgenero">Buscar por Género</option>';
//					  				break;
					  		}
				  		}
				  		else{
				  			$resultp = mysqli_query($link, "SELECT * FROM peliculas ORDER BY $criterio ASC");
				  			echo '<option value="poranio">Buscar por Año</option>';
 							echo '<option value="pornombre">Buscar por Nombre</option>'; 
				  			echo '<option value="porgenero">Buscar por Género</option>';
				  		}
					  	echo '</select>';
					  	if ($resultp){
				  			$cantpelis = mysqli_num_rows($resultp);
				  		}
				  		else{
				  			$cantpelis = 0;
				  		}
				?>
		    	<input id="Inputb" name="inputb" class="field-search" placeholder="Buscar...">
		    	<button type="submit" class="btn btn-danger navbar-btn">Buscar</button>
		    </form>
		</tr>
	<?php 
		for ($i = 1; $i <=$cantpelis; $i++){ 
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
						 $resultc=mysqli_query($link, "SELECT * FROM comentarios WHERE peliculas_id=$id ORDER BY fecha");
        				$cantcoment=mysqli_num_rows($resultc);
        				if($cantcoment<>0)
        				{
        					echo "Calificacion: ";
        				}
        				$prom=promedio($cantcoment,$id,$link);

				 		echo $prom; ?> </h4>
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

</body>
</html>