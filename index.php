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
			$criterio = "nombre"; 			//Se agrega un criterio de orden por defecto, para cuando no existen parámetros. 
		
	?>
</head>
<body>
	<table class= "table table-hover">
		<tr>
			<form method="GET">
			  	<select name="criterio">
				  	<?php 
				  		if ($criterio == "nombre"){
				  			echo '<option value="anio">Año</option>';
 							echo '<option value="nombre" selected="selected">Nombre</option>'; //Opción que aparecerá marcada por defecto
				  		}
				  		else{
							echo '<option selected="selected" value="anio">Año</option>'; //Opción que aparecerá marcada por defecto
 							echo '<option value="nombre">Nombre</option>';
 						}
				  	?>
		    	</select>
		    	<button type="submit" class="btn btn-danger navbar-btn">Ordenar</button>
		    	<?php 
		    		$sqlq = "SELECT * from peliculas WHERE "; 
		  			if ((isset($_GET['poranio'])) && ($_GET['poranio'] != "")) {
		  				$anio = ($_GET['poranio']); // Guardo en $anio el parámetro ingresado para la búsqueda
		  				$sqlq = $sqlq . "anio = $anio AND "; // Agrego al query la condición de búsqueda
		  				echo "<input id='Poranio' name='poranio' value='$anio' class='field-search' placeholder='Año'>"; //Para que me muestre el parámetro buscado en el input se usa value
		  			}
		  			else{
		  				echo '<input id="Poranio" name="poranio" class="field-search" placeholder="Año">'; //Si no se ingresó el parámetro para buscar por año, no se muestra ningún año por defecto en el input 
		  			}

		  			// Lo mismo que se realiza para la búsqueda por año se repite en la búsqueda por nombre y por género.

		  			if ((isset($_GET['pornombre'])) && ($_GET['pornombre'] != "")) {
		  				$nombre = ($_GET['pornombre']);
		  				$sqlq = $sqlq . "nombre LIKE '%$nombre%' AND ";
		  				echo "<input id='Pornombre' name='pornombre' value='$nombre' class='field-search' placeholder='Nombre'>"; //Para que me muestre el parámetro buscado en el input se usa value
		  			}
		  			else{
		  				echo '<input id="Pornombre" name="pornombre" class="field-search" placeholder="Nombre">';
		  			}

		  			if ((isset($_GET['porgenero'])) && ($_GET['porgenero'] != "")) {
		  				$genero = ($_GET['porgenero']);
		  				$resultgb = mysqli_query($link, "SELECT * FROM generos WHERE genero LIKE '$genero'"); // Obtengo el género correspondiente al ingresado en la tabla de géneros.
		  				$rowgb = mysqli_fetch_array($resultgb);
						$generoid = $rowgb['id']; // Obtengo el id del género para buscar las películas del mismo, ya que tienen asociadas el número y no la palabra. 
		  				$sqlq = $sqlq . "generos_id = $generoid AND ";
						echo "<input id='Porgenero' name='porgenero' value='$genero' class='field-search' placeholder='Género'>"; //Para que me muestre el parámetro buscado en el input se usa value
					}
					else{
						echo '<input id="Porgenero"" name="porgenero" class="field-search" placeholder="Género">';
					}

					$sqlq = $sqlq . "1 = 1 ORDER BY $criterio "; // Agrego un caso siempre verdadero al principio para poder colocar un AND al final de cada concatenación. Evita problemas cuando un criterio está siendo utilizado pero no tiene ningún criterio siguiente utilizado. Además permite colocar el WHERE antes de chequear las condiciones y que el código funcione aunque no se haya consultado por ningún parámetro de búsqueda. Luego se ordenan por un criterio que siempre va a tener un valor asignado, aunque el usuario no haya elegido uno.
					$resultp = mysqli_query($link, $sqlq);
				  	//echo "$sqlq";  Imprimir esto para chequear lo que realiza la sqli_query
				  	if ($resultp){
			  			$cantpelis = mysqli_num_rows($resultp);
			  		}
			  		else{
			  			$cantpelis = 0;
			  		}
				?>
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