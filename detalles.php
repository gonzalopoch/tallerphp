<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); 
        include ("connect.php");
        include ("promedio.php");
        $id=$_GET['id'];
        $link = conectar();
        $resultp = mysqli_query($link, "SELECT * FROM peliculas WHERE id=$id");
        $pelicula= mysqli_fetch_array($resultp);
    ?>


	</head>
	<body>
        <?php
        if(isset($_POST['save'])){
            if(isset($_POST['estrellas'])){
                $newCalificacion = $_POST['estrellas'];
            }
            if(isset($_POST['addComentario'])){
                $newComentario = $_POST['addComentario'];
            }
            mysqli_query($link, "INSERT INTO comentarios (comentario,calificacion,peliculas_id,usuarios_id,fecha) VALUES ('$newComentario','$newCalificacion','$id','1',CURRENT_DATE)");
        }
        ?>
        <div class="panelcomen">
    		<table> <!-- Lo cambiaremos por CSS -->
                <tr>
                    <td class="imagenpelicelda" rowspan="1" >
                    	<?php echo'<img class="imagenpelidet" src="data:image/jpeg;base64,'.base64_encode($pelicula['contenidoimagen']) .'" />'; ?>
                    </td>
    				<td class="celdatitulodet">
                        <h1 class="titulodetalle"> 
                            <?php
                                echo $pelicula['nombre'];
                            ?> 
                        </h1>
                    	
                        <p class="descripciondet">

                           <h4>
                                <?php 
                                    $id_gen = $pelicula['generos_id'];
                                    $resultg = mysqli_query($link, "SELECT * FROM generos WHERE id = $id_gen "); //Usar siempre comillas dobles cuando se agrega una variable PHP dentro de los parametros de un query, por ejemplo $id_gen en este caso.
                                    $genero = mysqli_fetch_array($resultg);
                                    echo $genero['genero'];
                                ?> 
                            </h4>
                            <h4><?php echo $pelicula['anio']; ?></h4>
                            <h4>
                                Calificación:
                                <?php 
                                    echo promedio($id,$link);
                                ?>
                            </h4> 
                        </p>
                             
                    </td>
                </tr>
                <tr>
                    <td  class="celdasinop" colspan="2">
                    	<h5 class="sinopsisdet"> Sinopsis: </h5>
    				        <p class="sinopsisdet1" align="justify">
                                <?php echo $pelicula['sinopsis']; ?>
                            </p>		
                   	</td>
                </tr>
                <table class="table table-condensed" >
                    <tr>
                    	<td>     
                    		<h3 class="titulocoments"> Comentarios <h3>
                    	</td>
                    </tr>

                    <?php 
                        $resultc=mysqli_query($link, "SELECT * FROM comentarios WHERE peliculas_id=$id ORDER BY fecha");
                        $cantcoment = mysqli_num_rows($resultc);
                        for ($i = 1; $i <=$cantcoment; $i++){
                            $comentario=mysqli_fetch_array($resultc);
                            $userid=$comentario['usuarios_id'];
                            $resultu=mysqli_query($link, "SELECT * FROM usuarios WHERE id=$userid");
                            $usuario=mysqli_fetch_array($resultu);
                    ?>
                    <tr>
                    	<td class="comentarios" >
                            <p><h4 class="comentarios3">  <?php echo $usuario['nombreusuario']; ?> <small>| <?php echo $comentario['fecha']; ?> | Calificación: <?php echo $comentario['calificacion']; ?></small></h4></p>

                            <p class="comentarios2"> 
                                <?php echo $comentario['comentario'];?>
                            </p>
                    	</td>
                    </tr>
                    <?php } ?>	
                    <tr>
                        <td>
                            <h4 class="comentarios">Agregar un comentario</h4>
                            <form id="calif" method="POST">
                                <textarea id="addComentario" name="addComentario" class="comentInput" required></textarea>
                                <button type="submit" name="save" class="btn btn-danger bderecha2">Comentar y calificar</button>
                                <p class="clasificacion">                               
                                    <input id="radio6" type="radio" name="estrellas" value="5">
                                    <label for="radio6">★</label>
                                    <input id="radio7" type="radio" name="estrellas" value="4">
                                    <label for="radio7">★</label>
                                    <input id="radio8" type="radio" name="estrellas" value="3">
                                    <label for="radio8">★</label>
                                    <input id="radio9" type="radio" name="estrellas" value="2">
                                    <label for="radio9">★</label>
                                    <input id="radio10" type="radio" name="estrellas" value="1" required>
                                    <label for="radio10">★</label>
                                </p>
                               
                            </form>
                        </td>
                    </tr>
                </table>
        </div>
	</body>
</html>