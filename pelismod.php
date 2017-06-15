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
          function editno2(i){
            var ok = document.getElementById("okboton" + i);
            var edito = document.getElementById("editarboton" + i);
            ok.style.display='none';
            edito.style.display='block'

            }

        function editar(i){
            var ok = document.getElementById("okboton" + i);
            var edito = document.getElementById("editarboton" + i);
            var nombinp = document.getElementById("nombre"+i);
            var sinoinp = document.getElementById("sinopsis"+i);
            var anioinp= document.getElementById('anio'+i);
            var geninp= document.getElementById('genero'+i);
            geninp.style.display='block';
            anioinp.style.display='block';
            sinoinp.style.display='block';
            nombinp.style.display='block';
            ok.style.display='block';
            edito.style.display='none';
            document.getElementById('divgen'+i).style.display='none';
            document.getElementById('divanio'+i).style.display='none';
            document.getElementById('editablenom'+i).style.display='none';
            document.getElementById('divsinopsis'+i).style.display='none';
            
        }


        function MostrarOcultar(id){
            var puntoContraible = document.getElementById("punto"+id);
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
                <td>Imagen </td>
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
                <form method="POST" action="edit.php">
                    
                    
                <td>  <?php echo $i; ?> 

                </td>

                <td> 
                                     <?php 
                    echo "<input type='hidden'  value='".$row['id']."' name='idpeli'>"; //para mandar la id a editar.
                    echo "<div>";
                    echo '<img class="imagenpeli" src="data:image/jpeg;base64,'.base64_encode($row['contenidoimagen']) .'" />';
                    echo "</div>"; ?>
                </td>
                <td> 

                <?php 
                    echo "<div id='editablenom".$i."'>";
                    echo $row['nombre'];
                    echo "</div>"; //
                    echo"
                     <input type='text'class='intext' style='display:none' id='nombre".$i."' value='".$row['nombre']."' name='nombrenuevo'> "

                     ;
                 
?>
                </td>
                <td><?php   $sinop=$row['sinopsis'];

                    echo "<div id='divsinopsis".$i."'>"   ;      
                    echo "<div id='puntoCorto".$i."'>";
                    echo truncar($sinop, 150)." <a href='#' id='puntoEnlace".$i."' onclick='MostrarOcultar(".'"'.$i.'"'.");'  border='0' /> Ver mas</a>";
                    echo "</div>";
                    echo "<div id='punto".$i."' style='display:none'>";
                    echo $sinop."<br /><a href='#' id='puntoEnlace".$i."' onclick='MostrarOcultar(".'"'.$i.'"'.");' style='cursor:pointer' >Ver menos </a>";
                    
                    echo "</div>";
                    echo "</div>";
                    echo"<textarea style='display:none' id='sinopsis".$i."' name='sinopsisnueva' class='inputsinop' requitred> ".$row['sinopsis']." </textarea> ";
                    
                            
                            ?>
                </td>
                <td><?php  echo "<div id='divanio".$i."'>"; 
                        echo $row['anio'];
                        echo "</div>";
                        echo"<input class='intextanio' type='text' style='display:none' id='anio".$i."' value='".$row['anio']."' name='anionuevo'> ";
                     ?>
                </td>
                <td><?php 
                        $id_gen = $row['generos_id'];
                        $resultg = mysqli_query($link, "SELECT * FROM generos WHERE id = $id_gen "); //Usar siempre comillas dobles cuando se agrega una variable PHP dentro de los parametros de un query, por ejemplo $id_gen en este caso.
                        $genero = mysqli_fetch_array($resultg);
                        echo "<div id='divgen".$i."'>"; 
                        echo $genero['genero'];
                        echo "</div>";

    
                        echo  "<select name='gennue' id='genero".$i."' style='display:none'>";
            
                        $resultgeneros = mysqli_query($link, "SELECT * FROM generos"); 
                        $cantGeneros = mysqli_num_rows($resultgeneros);
                        
                       
                            echo "<option value='".$genero['genero']."' >".$genero['genero']."(actual)</option>";
                            for($k=1; $k<= $cantGeneros ; $k++ ){
                                $rowGen = mysqli_fetch_array($resultgeneros);
                                $generoR = $rowGen['genero'];
                                $generoid =$rowGen['id'];
                                echo "<option value='$generoid'>$generoR</option>";
                            }
                    ?>
                </select>
                </td>
                <td>
                    <?php echo "<button type='button' id='editarboton".$i."' class='btn btn-danger search' onclick='editar(".'"'.$i.'"'.")' >Editar</button>";
                    ?>
                    <button type='button' class="btn btn-danger search" onclick="eliminarpeli(<?php echo $idpeli; ?>)">Eliminar</button>
                   <?php echo "<button style='display:none' id='okboton".$i."' type='submit' class='btn btn-danger search' onclick='editno2(".'"'.$i.'"'.")' >Guardar cambios</button>";
                    ?>
                   
                    

                    
                </td>

                </form>
            </tr>
        <?php }
        ?>
  


        
        </table>
        <script type="text/javascript">
            function eliminarpeli(id) {
                if (window.confirm("Aviso:\nDesea eliminar el registro seleccionado?")) {
                    window.location = "delete.php?action=del&tabla=peliculas&id="+id;  
                }
            }
        </script>

            <form class="form-inline" method="POST" action="agregar.php">
            <div class="form-group">
                <label >Nombre</label>
                <input type="text" class="form-control" id="Inputnombre" name="ingresonombre" placeholder="Nombre pelicula">
            </div>
            <div class="form-group">
                <label >Año</label>
                <input type="text" class="form-control" id="Inputanio" name="ingresoanio"  placeholder="Año pelicula">
            </div>
             <div class="form-group">
                <label >Sinopsis</label>
                <input type="text" class="form-control" id="Inputanio" name="ingreso"  placeholder="Sinopsis pelicula">
            </div>
            <div class="form-group">
                <label> Genero </label>

            <?php

            echo  "<select name='inputgen' id='inputgena' >";
            
                        $resultgeneros = mysqli_query($link, "SELECT * FROM generos"); 
                        $cantGeneros = mysqli_num_rows($resultgeneros);
                         
                            echo "<option value='todas' >Generos</option>";
                            for($k=1; $k<= $cantGeneros ; $k++ ){
                                $rowGen = mysqli_fetch_array($resultgeneros);
                                $generoR = $rowGen['genero'];
                                $generoid =$rowGen['id'];
                                echo "<option value='$generoid'>$generoR</option>";
                            }
                        echo "</div>";

                            

             ?>
             </select>
             <button  type="submit" class="btn btn-danger">Agregar pelicula</button>
                  
        </form>


        </div>
              
	</body>
</html>