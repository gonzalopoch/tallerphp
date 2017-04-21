<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); ?>


	</head>
	<body>
		<table border="0"> <!-- Lo cambiaremos por CSS -->
            <tr>
                <td rowspan="3" width="370"  height="550">
                	<img class="imagenpelidet" src="imagepelis/movies1.jpg" alt="imagen pelicula">
                </td>
					<td>
						<h1>Título Película </h1>
					</td>
                </tr>
            <tr>
                <td>
                	<h4>Género:</h4>
					<h4>Año:</h4>
					<h4>Calificación:</h4></td>
            </tr>
            <tr>
                <td>
                	<h5> Sinopsis: </h5>
				
                
                		Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga Esta es un sinopsis muy larga 
               	</td>
            </tr>
            <tr>
            	<td>
					<div class="star-rating">
					<h5>Calificar:
					    <a href="#">&#9733;</a>
					    <a href="#">&#9733;</a>
					    <a href="#">&#9733;</a>
					    <a href="#">&#9733;</a>
    					<a href="#">&#9733;</a>
    					</h5>
					</div>
            	</td>
            </tr>
            </table>

            <table  border= 2 px>
            <tr>
            	<td>
            		<h3 class="titulocoments"> Comentarios <h3>
            	</td>
            </tr>
             </tr>
             <?php for ($i = 1; $i <=2; $i++){ ?>
            <tr>
            	<td class="comentarios">
            		
            		<h4> Fulanito <?php echo $i; ?> <h4>

            			<p>Este es el comentario numero <?php echo $i; ?> del usuario fulanio<?php echo $i; ?> , y estoy haciendo esto para que sea mas largo y ver como queda.... asdasd asdqw eqwe qwe qw dasd asd asdas dasd assadasdasdasd
            	
            			</p>

            	</td>


            </tr>
            <?php } ?>	
        </table>
	</body>
</html>