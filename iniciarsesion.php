<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); ?>
</head>


<body>
	<div class="panel">
		<form id="formulario_inicio" method="POST">
			<div class="form-group">
				<label class="inicios">Nombre de Usuario</label>
				<p>
					<input class="inicios" type="text" name="nombreu"><small class="inicios">Ingresa el nombre de usuario con el que te registraste.</small>
				</p>
			</div>
			<div class="form-group">
				<label class="inicios">Contraseña</label> 
				<p>
					<input class="inicios" type="password" name="pass"><small class="inicios">Más de 6 caracteres. Letras y al menos un número o símbolo.</small>
				</p> 
				
			</div>
			<button type="submit" class="btn btn-danger bderecha">Ingresar</button>
		</form>
	</div>
</body>
</html>