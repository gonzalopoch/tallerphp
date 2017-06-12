<?php

include 'connect.php';

class Usuario{
	var $nombreUsuario;

	public function iniciarSesion (){
		session_start();
		$link = conectar();
		$this->nombreUsuario = $_POST['nombreu'];
		$pass = $_POST['pass'];
		if(($this->nombreUsuario != null)&&($pass != null)){
			$resultu = mysqli_query($link, "SELECT * FROM usuarios WHERE nombreusuario = '$this->nombreUsuario'");
			if(mysqli_num_rows($resultu) == 1) {
				$usuarioBD = mysqli_fetch_array($resultu);
				$passBD = $usuarioBD['password']; 
				$tipoUsuario = $usuarioBD['administrador'];
				if($passBD == $pass){
					$_SESSION['estado'] = "iniciada";
					$_SESSION['usuario'] = $this->nombreUsuario;
					if($tipoUsuario == 1){
						$_SESSION['tipoUsuario'] = "admin";
					}
					else{
						$_SESSION['tipoUsuario'] = "user";
					}
					header('Location: index.php');  
				}
				else{
					$_SESSION['error'] = '1'; //Junto las consultas
					throw new Exception();
				}
			}
			else{
				$_SESSION['error'] = '1'; //Junto las consultas
				throw new Exception();
			}
		}
	}	

	public function cerrarSesion (){
		session_destroy();
		session_write_close();
		setcookie(session_name(),'',0,'/');
		session_regenerate_id(true);
		header('Location: iniciarSesion.php');
	}
}
?>