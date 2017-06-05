<?php

include 'connect.php';

class Usuario{
	var $nombreUsuario;

	public function iniciarSesion (){
		//session_start();
		$link = conectar();
		$this->nombreUsuario = $_POST['nombreu'];
		$pass = $_POST['pass'];
		if(($this->nombreUsuario != null)&&($pass != null)){
			$resultu = mysqli_query($link, "SELECT * FROM usuarios WHERE nombreusuario = '$this->nombreUsuario'");
			echo $this->nombreUsuario;
			if($resultu){
				$usuarioBD = mysqli_fetch_array($resultu);
				$passBD = $usuarioBD['password']; 
				if($passBD == $pass){
					$_SESSION['estado'] = "iniciada";
					$_SESSION['usuario'] = $nombreUsuario;
					header('Location: index.php');  
				}
				else{
					return "Contraseña incorrecta.";
				}
			}
			else{
				return "Nombre de usuario incorrecto.";
			}
		}
		else{
			return false;
		}
	}	


}
?>