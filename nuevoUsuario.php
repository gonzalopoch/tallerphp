<?php
	if(isset($_POST['save'])){
		$agregar = true;
		if(!empty($_POST['nombre']) && !empty($_POST['nomUsuario']) && !empty($_POST['email'])&& !empty($_POST['apellido'])&& !empty($_POST['pass'])&& !empty($_POST['passRepe'])){
			$newNomUsuario = $_POST['nomUsuario'];
			$CompararNombre = mysqli_query($link, "SELECT * FROM usuarios WHERE nombreusuario LIKE '$newNomUsuario'");
			$ExisteNombre =  mysqli_num_rows($CompararNombre);
			$newNombre = $_POST['nombre'];
			$newApellido = $_POST['apellido'];
			$newPass = $_POST['pass'];
			$newPassRepe = $_POST['passRepe'];
			$newEmail = $_POST['email'];
			$compararEmail = mysqli_query($link, "SELECT * FROM usuarios WHERE email LIKE '$newEmail'");
			$existeMail = mysqli_num_rows($compararEmail);
			
			//SE COMPRUEBA QUE EL NOMBRE DE USUARIO NO EXISTA EN LA BD
			
			if ($ExisteNombre > 0){
				$str = '<div class="alert alert-danger">Ya existe un usuario con el nombre: "';
				$str = $str . "$newNomUsuario";
				$str = $str . '" </div>';
				echo "$str";
				$agregar = false;
			}
			
			//SI EL NOMBRE DE USUARIO ES VÁLIDO (NO EXISTE), SE COMPRUEBA SI EL MAIL YA EXISTE.

			if($existeMail>0){
				$str = '<div class="alert alert-danger">Ya existe un usuario con el mail: "';
				$str = $str . "$newEmail";
				$str = $str . '" </div>';
				echo "$str";
				$agregar = false;
			}

			//SI EL NOMBRE Y EL MAIL SON VÁLIDOS, SE COMPRUEBA QUE LAS CONTRASEÑAS SEAN IGUALES

			if($newPass != $newPassRepe){
				$str = '<div class="alert alert-danger">Las contraseñas ingresadas deben coincidir.</div> "';
				echo "$str";
				$agregar = false;
			}

			//SE COMPRUEBA QUE EL NOMBRE DE USUARIO SEA ALFANUMÉRICO Y TENGA MÁS DE 6 CARACTERES

			if ((!ctype_alnum($newNomUsuario)) || (strlen($newNomUsuario)<6) ){
				$str = '<div class="alert alert-danger">El nombre de usuario debe ser alfanumérico y mayor a 6 caracteres.</div> "';
				echo "$str";
				$agregar = false;
			}

			//SE COMPRUEBA EL FORMATO DE LA CONTRASEÑA INGRESADA

			if ((strlen($newPass)<6) || (!preg_match('/^(?=.*[0-9!@#\$%\^\&*\)\(+=._-])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9!@#\$%\^\&*\)\(+=._-])+$/', $newPass))){
				$str = '<div class="alert alert-danger">La contraseña debe contener al menos un número o símbolo y letras mayúsculas y minúsculas. (+6 caracteres) </div> "';
				echo "$str";
				$agregar = false;

			}

			//SE AGREGA EL NUEVO USUARIO EN EL CASO DE QUE LO INGRESADO SEA VÁLIDO

			if($agregar){
				mysqli_query($link, "INSERT INTO usuarios (nombre, apellido, nombreusuario, email, password) VALUES ('$newNombre', '$newApellido', '$newNomUsuario', '$newEmail', '$newPass')");
				mysqli_close($link);
				$str = '<div class="alert alert-success">Se ha creado un nuevo usuario con el nombre "';
				$str = $str . "$newNomUsuario";
				$str = $str . '". </div>';
				echo "$str";
				$agregar = true;
			}
		}
		else{
			$str = '<div class="alert alert-danger">No puede haber campos vacíos. </div> "';
			echo "$str";
		}
	}
?>