<?php 
// Incluimos la conexión. 
		include ("connect.php");
		$link = conectar();
// Pasamos los datos del formulario. 
$nombre = $_POST['ingresonombre'];
$sinop = $_POST['ingresosinop'];
$gen= $_POST['gennue'];
echo $nombre;
echo $sinop;
$idold = $_POST['idpeli'];
//$genero = $_POST['generonuevo']; 
//$sinopsis = $_POST['sinopsisnueva']; 
//INSERT INTO `peliculas` (`id`, `nombre`, `sinopsis`, `anio`, `generos_id`, `contenidoimagen`, `tipoimagen`)
//$anio = $_POST['anionuevo']; 
// Pasamos los datos para actualizarlos en la tabla. 
//$ssql = "UPDATE 'pelicula' SET 'genero'='$genero','sinopsis'='$sinopsis','anio'='$anio','nombre'='$nombre', WHERE 'nombre'='$nombre'"; 
$sql = "UPDATE peliculas SET nombre='$nombre' WHERE id='$idold' ";

mysqli_query($link,$sql);
?>
