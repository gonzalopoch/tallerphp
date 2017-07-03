

<?php 
// Incluimos la conexión. 
require_once("connect.php");
$link=conectar();
if(isset($_POST['editopeli'])){
		$agregar = true;
	if( (!empty($_POST['nombrenuevo'])) && (!empty($_POST['sinopsisnueva'])) && (!empty($_POST['anionuevo'])) && (!empty($_POST['gennue'])) && (!empty($_POST['idpeli']))) {

		$nombre = $_POST['nombrenuevo'];
		$sinop = $_POST['sinopsisnueva'];
		$genid= $_POST['gennue'];
		$anio=$_POST['anionuevo'];
		$idold = $_POST['idpeli'];


			if(strlen($nombre)>255){
						$str = '<div class="alert alert-danger"> El nombre no debe contener mas de 255 caracteres. .</div> "';
						echo "$str";
						$agregar = false;
					}

			if(strlen($sinop)>255){
				$str = '<div class="alert alert-danger"> La sinopsis no debe contener mas de 255 caracteres. .</div> "';
				echo "$str";
				$agregar = false;
			}


		// Compruebo que el año sea un numero y sea de logitud 4
			if(!ctype_digit($anio)||strlen($anio)<>4){
				$str = '<div class="alert alert-danger">El anio debe ser un numero de 4 digitos .</div> "';
				echo "$str";
				$agregar = false;
			}

			if($agregar){

				$sql = "UPDATE peliculas SET nombre='$nombre', sinopsis='$sinop',anio='$anio', generos_id='$genid'  WHERE id='$idold' ";
				mysqli_query($link,$sql);
				$str = '<div class="alert alert-success">Se ha agregado una nueva pelicula con el nombre "';
				$str = $str . "$nombre";
				$str = $str . '". </div>';
				echo "$str";
				$agregar = true;}
	}

else{
			$str = '<div class="alert alert-danger">No puede haber campos vacíos al editar. </div> "';
			echo "$str";
		}
	}
//$genero = $_POST['generonuevo']; 
//$sinopsis = $_POST['sinopsisnueva']; 
//$anio = $_POST['anionuevo']; 
//$ssql = "UPDATE 'pelicula' SET 'genero'='$genero','sinopsis'='$sinopsis','anio'='$anio','nombre'='$nombre', WHERE 'nombre'='$nombre'"; 

//
		//header("location: pelismod.php");
?>

