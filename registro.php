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
		if(isset($_POST['save'])){
			if(isset($_POST['nombre'])){
				$newNomUsuario = $_POST['nomUsuario'];
				$CompararNombre = mysqli_query($link, "SELECT * FROM usuarios WHERE nombreusuario LIKE '$newNomUsuario'");
				$ExisteNombre =  mysqli_num_rows($CompararNombre);
				if ($ExisteNombre > 0){
					$str = '<div class="alert alert-danger">Ya existe un usuario con el nombre "';
					$str = $str . "$newNomUsuario";
					$str = $str . '" </div>';
					echo "$str";
				}
				else{
					$newNombre = $_POST['nombre'];
					$newApellido = $_POST['apellido'];
					$newPass = $_POST['pass'];
					mysqli_query($link, "INSERT INTO usuarios (nombre, apellido, nombreusuario, password) VALUES ('$newNombre', '$newApellido', '$newNomUsuario', '$newPass')");
					mysqli_close($link);
					$str = '<div class="alert alert-success">Se ha creado un nuevo usuario con el nombre "';
					$str = $str . "$newNomUsuario";
					$str = $str . '". </div>';
					echo "$str";
				}
			}
		}
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

	<script type="text/javascript">
		function valida(f) {
		  var ok = true;
		  var msg = "";
		  var msg1 = "";
		  var validaPass = "";
		  var vacios = true;
		  var validaNombre = "";
		  var validaApellido = "";
		  var validaNU = "";
		  var validaFP = "";
		  var validaLP = "";
		  var letras = /^[A-Za-z]+$/;
		  var alfanum = /^[a-zA-Z0-9]+$/;
		  var passV = /^(?=.*[0-9!@#\$%\^\&*\)\(+=._-])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9!@#\$%\^\&*\)\(+=._-])+$/;

		  if(f.nombre.value == "")
		  {
		    msg += "Campo 'Nombre'. ";
		    vacios = false;
		  }

		  if(f.apellido.value == "")
		  {
		    msg += "Campo 'Apellido'. ";
		    vacios = false;
		  }

		  if(f.nomUsuario.value == "")
		  {
		    msg += "Campo 'Usuario'. ";
		    vacios = false;
		  }

		  if(f.pass.value == "")
		  {
		    msg += "Campo 'Contraseña'. ";
		  	vacios = false;
		  }

		  if(f.passRepe.value == "")
		  {
		    msg += "Campo 'Repetir contraseña'. ";
		    vacios = false;
		  }

		  if (vacios == false){
		  	msg1 = "Debes completar los siguientes campos: ";
		  	ok = false;
		  }

		  if(!f.pass.value.match(passV)){
		  	validaFP = "La contraseña debe contener al menos un número o símbolo y letras mayúsculas y minúsculas."
		  	ok = false;
		  }

		  if((f.passRepe.value!="") && (f.pass.value!="") && (f.pass.value != f.passRepe.value)){
		  	validaPass = "Las contraseñas ingresadas deben ser iguales. ";
		  	ok = false;
		  }

		  if(f.pass.value.length < 6){
		  	validaLP = "La contraseña debe tener 6 o más caracteres. ";
		  	ok = false;
		  }

		  if ((!f.nombre.value.match(letras)) && (f.nombre.value != "")){
		  	validaNombre = "El nombre debe contener sólamente caracteres alfabéticos. ";
		  	ok = false;
		  }

		  if ((!f.apellido.value.match(letras)) && (f.apellido.value != "")){
		  	validaApellido = "El apellido debe contener sólamente caracteres alfabéticos. ";
		  	ok = false;
		  }

		  if(f.nomUsuario.value.length < 6){
		  	validaNU = "El nombre de usuario debe contener 6 o más caracteres. ";
		  	ok = false;
		  }

		  if(!f.nomUsuario.value.match(alfanum)){
		  	validaNU = "El nombre de usuario debe contener caracteres alfanuméricos. ";
		  	ok = false;
		  }

		  if(ok == false)
		    //alert(msg);
			var mensajeError = document.getElementById('insertHere');
			mensajeError.innerHTML ='<div class="alert alert-danger">' + msg1 + msg + validaPass + validaNombre + validaApellido + validaNU + validaLP + validaFP + '</div>';
		  return ok;
		}
	</script>
</body>
</html>