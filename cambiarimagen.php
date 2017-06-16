<?php 
// Incluimos la conexión. 
		include ("connect.php");
		$link = conectar();
// Pasamos los datos del formulario. 
// Recibo los datos de la imagen

$idnue=$_POST['idpeli2'];
 // archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['imagen']['tmp_name'] ;

// leer del archvio temporal .. el binario subido.
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
$binario_nombre=$_FILES['imagen']['name'];
$binario_peso=$_FILES['imagen']['size'];
$binario_tipo=$_FILES['imagen']['type'];


$sql = "UPDATE peliculas SET contenidoimagen = '$binario_contenido' WHERE id='$idnue' ";

mysqli_query($link,$sql);
header("location: pelismod.php");
?>