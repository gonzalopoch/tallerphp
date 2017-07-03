<?php 
// Incluimos la conexión. 
		require_once("connect.php");
$link=conectar();
// Pasamos los datos del formulario. 
// Recibo los datos de la imagen
if(isset($_POST['suboimage'])){
		$agregar= true;
if(!empty($_FILES["imagen"]["name"])) {

	if ($_FILES["imagen"]["type"]=="image/jpeg" || $_FILES["imagen"]["type"]=="image/pjpeg" || $_FILES["imagen"]["type"]=="image/gif" || $_FILES["imagen"]["type"]=="image/bmp" || $_FILES["imagen"]["type"]=="image/png"){

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
						}
			else{
				$str = '<div class="alert alert-danger"> Formato de la imagen incorrecto. .</div> "';
				echo "$str";
			}
		}else {$str = '<div class="alert alert-danger"> Debe seleccionar una imagen. .</div> "';
				echo "$str";}

			}

?>