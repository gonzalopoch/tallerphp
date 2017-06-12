<?php 
	if($_POST){
		if((isset($_POST['nombreu'])) && (isset($_POST['pass']))){
			require_once 'usuario.class.php';
			$usuario = new usuario();
			try { 
				$usuario->iniciarSesion();
				header('Location: index.php');
			} catch (Exception $e) {
				header('Location: iniciarSesion.php');	
			} 
		}
	}
?>