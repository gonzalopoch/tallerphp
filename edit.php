

<?php 
// Incluimos la conexión. 
		include ("connect.php");
		$link = conectar();
// Pasamos los datos del formulario. 
$nombre = $_POST['nombrenuevo'];
$sinop = $_POST['sinopsisnueva'];
$gen= $_POST['gennue'];
echo $nombre;
echo $sinop;
$idold = $_POST['idpeli'];
//$genero = $_POST['generonuevo']; 
//$sinopsis = $_POST['sinopsisnueva']; 
//$anio = $_POST['anionuevo']; 
// Pasamos los datos para actualizarlos en la tabla. 
//$ssql = "UPDATE 'pelicula' SET 'genero'='$genero','sinopsis'='$sinopsis','anio'='$anio','nombre'='$nombre', WHERE 'nombre'='$nombre'"; 
$sql = "UPDATE peliculas SET nombre='$nombre' WHERE id='$idold' ";

mysqli_query($link,$sql);
//mysqli_query($link, $ssql);
// Mostramos los datos. 
//echo 'id: ' . $_POST['id'] . ', Nombre: ' . $_POST['name'] . ', E-mail: ' . $_POST['email'] . ', Nick: ' . $_POST['nickname'] . ', Password: ' . $_POST['password'] . ', Salt: ' . $_POST['salt'] . '<br /><br />'; 
//echo '<a href="editar.php" target="_self">Atras</a> <a href="update-con-seleccion.php" target="_self">Inicio</a>'; 
// Cerramos la conexion con el servidor. 
//header("location: pelismod.php");
?>

