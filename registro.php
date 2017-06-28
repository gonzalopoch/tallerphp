<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); ?>
</head>
<body>
	<?php
		include ("connect.php");
		$link = conectar();
		include ("nuevoUsuario.php");
	?>

	<div class="panel">
		<form method="POST" onsubmit="return valida(this)">
			<div class="form-group">
			    <label class="inicios">Nombre</label>
			    <input class="form-control" name="nombre" placeholder="Ingrese su nombre">
			</div>
			<div class="form-group">
		    	<label class="inicios">Apellido</label>
		   		<input class="form-control" name="apellido" placeholder="Ingrese su apellido">
			</div>
			<div class="form-group">
		    	<label class="inicios">Usuario</label>
		    	<input class="form-control" name="nomUsuario" placeholder="Nombre de usuario deseado. (Mínimo 6 caracteres)">
		  	</div>
		  	<div class="form-group">
		    	<label class="inicios">E-mail</label>
		    	<input class="form-control" name="email" placeholder="Correo electrónico.">
		  	</div>
			<div class="form-group">
			    <label class="inicios">Contraseña</label>
			    <input type="password" class="form-control" name="pass" placeholder="Debe contener letras mayúsculas y minúsculas y por lo menos un número o símbolo.">
			</div>
			<div class="form-group">
				<label class="inicios">Repita la contraseña</label>
			    <input type="password" class="form-control" name="passRepe" placeholder="Repita la contraseña elegida">
			</div>
			<span id="insertHere"></span>
			<button type="submit" name="save" class="btn btn-danger bderecha">Registrarse</button>
		</form>
	</div>

	<script type="text/javascript" src="chequearForm.js"></script>

</body>
</html>