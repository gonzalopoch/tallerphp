<?php 
require_once("connect.php");
$link=conectar();
if(isset($_POST['savepeli'])){
		$agregar = true;
	if(!empty($_POST['ingresonombre']) && !empty($_POST['ingresosinop']) && !empty( $_POST['ingresoanio']) && !empty($_POST['inputgen'] ) && ($_POST['inputgen'] <>"vacio") &&!empty($_FILES["imagen2"]["name"]) && ($_POST['ingresosinop']<>"")){

		$nombre = $_POST['ingresonombre'];
		$CompararNombre = mysqli_query($link, "SELECT * FROM peliculas WHERE nombre LIKE '$nombre'");
		$ExisteNombre =  mysqli_num_rows($CompararNombre);
		$sinop = $_POST['ingresosinop'];
		$anio= $_POST['ingresoanio'];
		$idgen= $_POST['inputgen'];

		if(strlen($nombre)>255){
				$str = '<div class="alert alert-danger"> El nombre no debe contener más de 255 caracteres. </div> "';
				echo "$str";
				$agregar = false;
			}

			if(strlen($sinop)>850){
				$str = '<div class="alert alert-danger"> La sinopsis no debe contener más de 850 caracteres. </div> "';
				echo "$str";
				$agregar = false;
			}

		//SE COMPRUEBA QUE EL NOMBRE DE USUARIO NO EXISTA EN LA BD
			if ($ExisteNombre > 0){
				$str = '<div class="alert alert-danger">Ya existe una película con el nombre: "';
				$str = $str . "$nombre";
				$str = $str . '" </div>';
				echo "$str";
				$agregar = false;
			}

		// Compruebo que el año sea un numero y sea de logitud 4
			if(!ctype_digit($anio)||strlen($anio)<>4){
				$str = '<div class="alert alert-danger">El año debe ser un número de 4 dígitos .</div> "';
				echo "$str";
				$agregar = false;
			}

		 // archivo temporal (ruta y nombre).
		$binario_nombre_temporal=$_FILES['imagen2']['tmp_name'] ;

 if ($_FILES["imagen2"]["type"]=="image/jpeg" || $_FILES["imagen2"]["type"]=="image/pjpeg" || $_FILES["imagen2"]["type"]=="image/gif" || $_FILES["imagen2"]["type"]=="image/bmp" || $_FILES["imagen2"]["type"]=="image/png"){
		// leer del archvio temporal .. el binario subido.
		$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));
			// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
		$binario_nombre=$_FILES['imagen2']['name'];
		$binario_peso=$_FILES['imagen2']['size'];
		$binario_tipo=$_FILES['imagen2']['type'];
}
else{
	 $str = '<div class="alert alert-danger">Formato de imagen no permitido. </div> "';
				echo "$str";
				$agregar=false;
}

			// Pasamos los datos para actualizarlos en la tabla. 
			if($agregar){

				$sql = "INSERT INTO peliculas (nombre,sinopsis,anio,generos_id,contenidoimagen) VALUES ('$nombre','$sinop','$anio','$idgen','$binario_contenido') ";
				mysqli_query($link,$sql);
				$str = '<div class="alert alert-success">Se ha agregado una nueva película con el nombre "';
				$str = $str . "$nombre";
				$str = $str . '". </div>';
				echo "$str";
				$agregar = true;}
	}
else{
			$str = '<div class="alert alert-danger">No puede haber campos vacíos. </div> "';
			echo "$str";
		}
		//header("location: pelismod.php");}

	}
?>
