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
            edito.style.display='block';

            }

            function eliminar(id) {
                if (window.confirm("Aviso:\n Desea eliminar el registro seleccionado?")) {
                    window.location = "delete.php?action=del&tabla=peliculas&id="+id;  
                }
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
                
                    
                    
                <td>  <?php echo $i; ?> 

                </td>

                <td width="30"> 
                                     <?php 
                    
                    echo "<div>";
                    echo '<img class="imagenpeli" src="data:image/jpeg;base64,'.base64_encode($row['contenidoimagen']) .'" />';
                    echo "</div>"; ?>
                    <form action="cambiarimagen.php" enctype="multipart/form-data" method="post">
                      <input class="imagen1234" id="imagen" name="imagen" size="30" type="file" />
                    <?php  echo "<input type='hidden'  value='".$row['id']."' name='idpeli2'>";  ?>
                      <input type="submit" value="Subir imagen" />

                    </form>
                </td>
          <form method="POST" action="edit.php">    
                <td width="100"> 

                <?php 
                    echo "<div id='editablenom".$i."'>";
                    echo $row['nombre'];
                    echo "</div>"; //
                    echo"
                     <input type='text'class='intext' style='display:none' id='nombre".$i."' value='".$row['nombre']."' name='nombrenuevo'> ";
                    $idpeli=$row['id'];
                    echo "<input type='hidden'  value='".$row['id']."' name='idpeli'>"; //para mandar la id a editar.
                     
                 
?>
                </td>
                <td ><?php   $sinop=$row['sinopsis'];

                    echo "<div align='justify' id='divsinopsis".$i."'>"   ;      
                    echo "<div id='puntoCorto".$i."'>";
                    echo truncar($sinop, 200)." <a href='#' id='puntoEnlace".$i."' onclick='MostrarOcultar(".'"'.$i.'"'.");'  border='0' /> Ver mas</a>";
                    echo "</div>";
                    echo "<div id='punto".$i."' style='display:none'>";
                    echo $sinop."<br /><a href='#' id='puntoEnlace".$i."' onclick='MostrarOcultar(".'"'.$i.'"'.");' style='cursor:pointer' >Ver menos </a>";
                    
                    echo "</div>";
                    echo "</div>";
                    echo"<textarea style='display:none' id='sinopsis".$i."' name='sinopsisnueva' class='inputsinop' requitred> ".$row['sinopsis']." </textarea> ";
                    
                            
                            ?>
                </td>
                <td width="100"><?php  echo "<div id='divanio".$i."'>"; 
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
                   

                   <?php echo "<button style='display:none' id='okboton".$i."' type='submit' class='btn btn-danger search' onclick='editno2(".'"'.$i.'"'.")' >Guardar cambios</button>";
                    ?>
                   
                    </form>
                     <button type="button" class="btn btn-danger search" onclick="eliminar(<?php echo $idpeli; ?>)">Eliminar</button>
                    
                </td>


                
            </tr>
        <?php }
        ?>
  
            <form class="form-inline" method="POST" enctype="multipart/form-data" action="add.php">
            <tr>
                <td>
                </td>
                <td width="30">
                    <input class="imagen1234" id="imagen" name="imagen2" size="30" type="file" required>
                </td>
                <td width="200">
                    <input type="text" class="form-control" id="Inputnombre" name="ingresonombre" placeholder="Nombre pelicula" required>
                </td>
                <td >
                    <textarea name='ingresosinop' placeholder="Sinopsis pelicula" class='inputsinop' required> </textarea>
                </td>
                <td width="100">
                    <input type="text" class="form-control" id="Inputanio" name="ingresoanio"  placeholder="Año" required>
                </td>
                <td>
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
                </td>
                <td>
                    <button  type="submit" class="btn btn-danger">Agregar pelicula</button>
                    </form>
                </td>
            </tr>
        
        </table>
              
	</body>
</html>