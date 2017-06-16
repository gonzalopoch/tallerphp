<?php 
// Incluimos la conexión. 
		include ("connect.php");
		$link = conectar();
// Pasamos los datos del formulario. 
$nombre = $_POST['ingresonombre'];
$sinop = $_POST['ingresosinop'];
$anio= $_POST['ingresoanio'];
$idgen= $_POST['inputgen'];


 // archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['imagen2']['tmp_name'] ;

// leer del archvio temporal .. el binario subido.
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
$binario_nombre=$_FILES['imagen2']['name'];
$binario_peso=$_FILES['imagen2']['size'];
$binario_tipo=$_FILES['imagen2']['type'];

//$genero = $_POST['generonuevo']; 
//$sinopsis = $_POST['sinopsisnueva']; 
//INSERT INTO `peliculas` (`id`, `nombre`, `sinopsis`, `anio`, `generos_id`, `contenidoimagen`, `tipoimagen`)
//$anio = $_POST['anionuevo']; 
// Pasamos los datos para actualizarlos en la tabla. 
//$ssql = "UPDATE 'pelicula' SET 'genero'='$genero','sinopsis'='$sinopsis','anio'='$anio','nombre'='$nombre', WHERE 'nombre'='$nombre'"; 
$sql = "INSERT INTO peliculas (nombre,sinopsis,anio,generos_id,contenidoimagen) VALUES ('$nombre','$sinop','$anio','$idgen','$binario_contenido') ";
mysqli_query($link,$sql);
header("location: pelismod.php");
?>
