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

        $resultc=mysqli_query($link, "SELECT * FROM comentarios WHERE peliculas_id=$id ORDER BY fecha");
        $cantcoment=mysqli_num_rows($resultc);
    ?>


	</head>
	<body>
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
                                    $prom=promedio($cantcoment,$id,$link);
                                    echo $prom;
                                ?>
                            </h4> 
                        </p>
                             
                        <form id="calif" method="POST">
                            <p class="clasificacion">
                                <button type="submit" class="btn btn-danger">Calificar</button>
                               
                                <input id="radio6" type="radio" name="estrellas" value="5"><!--
                                --><label for="radio6">★</label><!--
                                --><input id="radio7" type="radio" name="estrellas" value="4"><!--
                                --><label for="radio7">★</label><!--
                                --><input id="radio8" type="radio" name="estrellas" value="3"><!--
                                --><label for="radio8">★</label><!--
                                --><input id="radio9" type="radio" name="estrellas" value="2"><!--
                                --><label for="radio9">★</label><!--
                                --><input id="radio10" type="radio" name="estrellas" value="1"><!--
                                --><label for="radio10">★</label>
                            </p>
                        </form>
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

                    <?php for ($i = 1; $i <=$cantcoment; $i++){
                        $comentario=mysqli_fetch_array($resultc);
                        $userid=$comentario['usuarios_id'];
                        $resultu=mysqli_query($link, "SELECT * FROM usuarios WHERE id=$userid");
                        $usuario=mysqli_fetch_array($resultu);
                    ?>
                    <tr>
                    	<td class="comentarios" >
                            <h4 class="comentarios3">  <?php echo $usuario['nombreusuario']; ?> <small> <?php echo $comentario['fecha']; ?> </small> </h4>

                            <p class="comentarios2"> 
                                <?php echo $comentario['comentario'];?>
                            </p>
                    	</td>
                    </tr>
                    <?php } ?>	
                </table>
        </div>
	</body>
</html>