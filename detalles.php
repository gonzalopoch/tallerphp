<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); 
        include ("connect.php");
        $id=$_GET['id'];
        $link = conectar();
        $resultp = mysqli_query($link, "SELECT * FROM peliculas WHERE id=$id");
        $pelicula= mysqli_fetch_array($resultp);
    ?>


	</head>
	<body>
        <div class="panelcomen">
    		<table> <!-- Lo cambiaremos por CSS -->
                <tr>
                    <td class="imagenpelicelda" rowspan="1" >
                    	<img class="imagenpelidet" src="imagepelis/movies1.jpg" alt="imagen pelicula">
                    </td>
    				<td class="celdatitulodet">
                        <h1 class="titulodetalle"> <?php
                        
                         echo $pelicula['nombre'] ;?> </h1>
                    	
                        <p class="descripciondet">
                           <h4>Género:</h4>
                           <h4>Año de estreno:</h4>
                           <h4>Calificación:</h4> 
                         </p>
                             
                        <form id="calif">
                            <p class="clasificacion">
                                <button type="submit" class="btn btn-danger">Calificar</button>
                                   <input id="radio1" type="radio" name="estrellas" value="10"><!--
                                --><label for="radio1">★</label><!--
                                --><input id="radio2" type="radio" name="estrellas" value="9"><!--
                                --><label for="radio2">★</label><!--
                                --><input id="radio3" type="radio" name="estrellas" value="8"><!--
                                --><label for="radio3">★</label><!--
                                --><input id="radio4" type="radio" name="estrellas" value="7"><!--
                                --><label for="radio4">★</label><!--
                                --><input id="radio5" type="radio" name="estrellas" value="6"><!--
                                --><label for="radio5">★</label><!--
                                --><input id="radio6" type="radio" name="estrellas" value="5"><!--
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
    				
                            <p class="sinopsisdet1">
                                Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga.  
                            </p>
                    		
                   	</td>
                </tr>
                </table>
                <table class="table table-condensed" >
                    <tr>
                    	<td>
                    		<h3 class="titulocoments"> Comentarios <h3>
                    	</td>
                    </tr>
                     </tr>
                     <?php for ($i = 1; $i <=2; $i++){ ?>
                    <tr >
                    	<td class="comentarios" >
                    		<h4 class="comentarios3"> Fulanito <?php echo $i; ?> </h4>
                    			<p class="comentarios2">Este es el comentario numero <?php echo $i; ?> del usuario fulanio<?php echo $i; ?> , y estoy haciendo esto para que sea mas largo y ver como queda.... asdasd asdqw eqwe qwe qw dasd asd asdas dasd assadasdasdasd
                    			</p>
                    	</td>
                    </tr>
                    <?php } ?>	
                </table>
        </div>
	</body>
</html>