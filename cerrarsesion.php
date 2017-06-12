<?php
	require_once 'usuario.class.php';
	$_SESSION['estado'] = "cerrada";
	$usuario = new usuario();
	$usuario->cerrarSesion();
?>