<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); 
        include ("connect.php");
        include ("promedio.php");
        $link = conectar();

        $resultp = mysqli_query($link, "SELECT * FROM peliculas");
        $cantpelis = mysqli_num_rows($resultp);

        function truncar($texto, $limite, $terminacion = '...') {
        $subcadena = substr($texto, 0, $limite);
        $indiceUltimoEspacio = strrpos($subcadena, " ");
        return substr($texto, 0, $indiceUltimoEspacio).$terminacion;
        }
    ?>
    <script type="text/javascript">
      
        function MostrarOcultar(id){
            var puntoContraible = document.getElementById(id);
            var puntoCorto = document.getElementById("puntoCorto" + id);
            if (puntoContraible.style.display == 'none'){ 
                puntoContraible.style.display = 'block'; 
                puntoCorto.style.display = 'none'; 
            }else{ 
                puntoContraible.style.display = 'none'; 
                puntoCorto.style.display = 'block'; 
            } 
            }
        </script>


	</head>
	<body>
        <div class="panelcomen">
        <h1 class="titulo1">
            Peliculas
        </h1>
        <table class="table table-hover">
            <tr class="titulo1">
                <td>#</td>
                <td>Nombre </td>
                <td>Sinopsis</td>
                <td>Año</td>
                <td>Género</td>
                <td>Opciones</td>
            </tr>

        <?php for ($i=1; $i<=$cantpelis; $i++ ){
            $row = mysqli_fetch_array($resultp);
        ?>
            <tr class="texto">
                <td>  <?php echo $i; ?> 
                </td>
                <td> <?php echo $row['nombre']; ?>
                </td>
                <td><?php   $sinop=$row['sinopsis'];
                            
                    echo "<div id='puntoCorto".$i."'>";
                    echo truncar($sinop, 150)." <a href='#' id='puntoEnlace".$i."' onclick='MostrarOcultar(".'"'.$i.'"'.");'  border='0' /> Ver mas</a>";
                    echo "</div>";
                    echo "<div id='".$i."' style='display:none'>";
                    echo $sinop."<br /><a href='#' id='puntoEnlace".$i."' onclick='MostrarOcultar(".'"'.$i.'"'.");' style='cursor:pointer' >Ver menos </a>";
                    echo "</div>";
                            
                            ?>
                </td>
                <td><?php echo $row['anio']; ?>
                </td>
                <td><?php 
                        $id_gen = $row['generos_id'];
                        $resultg = mysqli_query($link, "SELECT * FROM generos WHERE id = $id_gen "); //Usar siempre comillas dobles cuando se agrega una variable PHP dentro de los parametros de un query, por ejemplo $id_gen en este caso.
                        $genero = mysqli_fetch_array($resultg);
                        echo $genero['genero'];
                        ?> 
                </td>
                <td><button type="submit" class="btn btn-danger search">Editar</button>
                    <button type="submit" class="btn btn-danger search" onclick="eliminarpeli(<?php $row['id'] ?>)">Eliminar</button>
                </td>
            </tr>
        <?php }
        ?>
        
        </table>
        <script type="text/javascript">
            function eliminarpeli(id) {
                if (window.confirm("Aviso:\nDesea eliminar el registro seleccionado?")) {
                    window.location = "delete.php?action=del&id="+id;  
                }
            }
        </script>
        </div>
	</body>
</html>