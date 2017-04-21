<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); ?>
</head>
<body>
	<table class= "table table-hover">
	<?php for ($i = 1; $i <=3; $i++){ ?>
		<tr>
				<!-- RECUPERAR DATOS DE PELICULA i, INCREMENTAR i -->
			<td width="160">
				<img class="imagenpeli" src="imagepelis/movies1.jpg" alt="imagen pelicula">
			</td>
			<td width="400">
				<h1>Título Película <?php echo $i ?> </h1>
				<h4>Género</h4>
				<h4>Año</h4>
				<h4>Calificación</h4>
			</td>
			<td width="600">
				<p>SinopsisSinopsisSinopsisSinopsisSinopsisSinopsisSinopsisSinopsis SinopsisSinopsisSinopsisSinopsisSinopsisSinopsis SinopsisSinopsisSinopsisSinopsis SinopsisSinopsisSinopsisSinopsisSinopsisSinopsis SinopsisSinopsisSinopsisSinopsisSinopsis SinopsisSinopsisSinopsis SinopsisSinopsisSinopsisSinopsisS inopsisSinopsisSinopsisSinopsisSinopsis SinopsisSinopsisSinopsisSinopsis SinopsisSinopsisSinopsisSinopsis SinopsisSinopsisSinopsisSinopsisSinopsisSinopsisSinopsisSinopsis</p>
			</td>
			<td>
			    <p><a href="detalles.php" class="btn btn-primary" role="button">Detalles</a></p>
			</td>
		</tr>
		<?php } ?>		
	</table>

</body>
</html>