<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	
</head>


<body>
	<?php 
		include("menuinicio.php"); 
		if(isset($_SESSION['error'])){
			echo'<div class="alert alert-danger">Usuario o contraseña incorrecta</div>';
		}
		if(isset($_SESSION['usuario']) && !empty($_SESSION['usuario'])){
			$nomusuario = $_SESSION['usuario'];
			echo'<div class="alert alert-warning">Ya se ha iniciado una sesión. Usuario: ';
			echo $nomusuario;
			echo '</div>';
		}else{?>
			<div class="panel">
			<span id="insertHere"></span>
			<form id="formulario_inicio" method="POST" action="actionIS.php" onsubmit="return validaInicio(this)">
				<div class="form-group">
					<label class="inicios">Nombre de Usuario</label>
					<p>
						<input class="inicios" type="text" name="nombreu" pattern="^[A-Za-z0-9_]{6,}$" required title="6 caracteres como mínimo. Solo caracteres alfanuméricos."><small class="inicios">Ingresa el nombre de usuario con el que te registraste.</small>
					</p>
				</div>
				<div class="form-group">
					<label class="inicios">Contraseña</label> 
					<p>
						<input class="inicios" type="password" name="pass" pattern=".{6,}" required title="6 caracteres como mínimo"><small class="inicios">Más de 6 caracteres. Letras y al menos un número o símbolo.</small>
					</p> 
					
				</div>
				<button type="submit" class="btn btn-danger bderecha">Ingresar</button>
			</form>
			</div>
		<?php } ?>
</body>
</html>