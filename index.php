<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php 
		include ("menuinicio.php"); 
		include ("connect.php");
		$link = conectar();
		$resultp = mysqli_query($link, "SELECT * FROM peliculas");
		$cantpelis = mysqli_num_rows($resultp);
	?>
</head>
<body>
	<table class= "table table-hover">
	<?php 
		for ($i = 1; $i <=$cantpelis; $i++){ 
			$row = mysqli_fetch_array($resultp);
	?>
		<tr>
				<!-- RECUPERAR DATOS DE PELICULA i, INCREMENTAR i -->
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
				<h4><?php echo "Calificación" ?></h4>
			</td>
			<td width="600">
				<p><?php echo $row['sinopsis']?></p>
			</td>
			<td>
			   <?php
			   		$id = $row['id'];
			    	echo "<p><a href='detalles.php?id=$id' class='btn btn-danger'>Detalles</a></p>" ; 
			    ?>
			</td>
		</tr>
		<?php 
			}
			mysqli_close($link); 
		?>		
	</table>

</body>
</html>