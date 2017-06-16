

<?php 
// Incluimos la conexión. 
		include ("connect.php");
		$link = conectar();
// Pasamos los datos del formulario. 
$nombre = $_POST['nombrenuevo'];
$sinop = $_POST['sinopsisnueva'];
$genid= $_POST['gennue'];
$anio=$_POST['anionuevo'];
$idold = $_POST['idpeli'];
//$genero = $_POST['generonuevo']; 
//$sinopsis = $_POST['sinopsisnueva']; 
//$anio = $_POST['anionuevo']; 
// Pasamos los datos para actualizarlos en la tabla. 
//$ssql = "UPDATE 'pelicula' SET 'genero'='$genero','sinopsis'='$sinopsis','anio'='$anio','nombre'='$nombre', WHERE 'nombre'='$nombre'"; 
$sql = "UPDATE peliculas SET nombre='$nombre', sinopsis='$sinop',anio='$anio', generos_id='$genid'  WHERE id='$idold' ";
mysqli_query($link,$sql);
header("location: pelismod.php");
?>

