<html>
<head>
	<title>PHP</title>
		
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link type="text/css" rel="stylesheet" href="style.css">
	<?php include ("menuinicio.php"); 
       

        function truncar($texto, $limite, $terminacion = '...') {
        $subcadena = substr($texto, 0, $limite);
        $indiceUltimoEspacio = strrpos($subcadena, " ");
        return substr($texto, 0, $indiceUltimoEspacio).$terminacion;
        }
    ?>
  <script type="text/javascript" src="FuncionesJavaScript.js"></script>
	</head>

<?php 





if(isset($_SESSION['tipoUsuario']) && ($_SESSION['tipoUsuario'] == 'admin'))
    { ?>
	<body>

<?php 
 include ("promedio.php");
        include ("connect.php");
        $link = conectar();

        include ("add.php");
        include("edit.php");
        include("cambiarimagen.php");
        $resultp = mysqli_query($link, "SELECT * FROM peliculas");
        $cantpelis = mysqli_num_rows($resultp);


?>


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
                    <form name=formimagen1 onsubmit ="return validoimage()" enctype="multipart/form-data" method="post">
                      <input class="imagen1234" id="imagen" name="imagen" size="30" type="file" />
                    <?php  echo "<input type='hidden'  value='".$row['id']."' name='idpeli2'>";  ?>
                      
                        <button  type="submit" name="suboimage" class="btn btn-danger">Subir imagen</button>
                    </form>
                </td>
          <form method="POST" onsubmit="return validar33(this)">    
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
                        
                       
                            echo "<option value='".$genero['id']."' >".$genero['genero']."(actual)</option>";
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
                   

                   <?php echo "<button style='display:none' name= 'editopeli' id='okboton".$i."' type='submit' class='btn btn-danger search' onclick='editno2(".'"'.$i.'"'.")' >Guardar</button>";
                    ?>
                   
                    </form>
                     <button type="button" class="btn btn-danger search" onclick="eliminar(<?php echo $idpeli; ?>)">Eliminar</button>
                    
                </td>


                
            </tr>
        <?php }
        ?>

            <form id="formagrego" class="form-inline" method="POST" enctype="multipart/form-data"  onsubmit="return validar22(this)">
            
            <tr>
                <td>
                </td>
                <td width="30">
                    <input class="imagen1234" id="imagen" name="imagen2" size="30" type="file" required>
                     <input type="text" class="form-control" id="Inputnombre" name="ingresonombre" placeholder="Nombre pelicula" required>
                </td>
                <td>
                   
                </td>
                <td >
                    <textarea name='ingresosinop' placeholder="Sinopsis pelicula" class='inputsinop'></textarea>
                </td>
                <td>
                    
                </td>
                <td>
                    <input type="text" class="form-control" id="Inputanio" name="ingresoanio"  placeholder="Año" required>
                     <?php

                        echo  "<select name='inputgen'  id='inputgena' >";
                        
                                    $resultgeneros = mysqli_query($link, "SELECT * FROM generos"); 
                                    $cantGeneros = mysqli_num_rows($resultgeneros);
                                     
                                        echo "<option value='vacio' >Generos</option>";
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
                    <button  type="submit" name="savepeli" class="btn btn-danger">Agregar pelicula</button>
                    <span id="insertHere2"></span>
                    </form>
                </td>
            </tr>
        
        </table>
              
	</body>
    <?php } 
    else 
        echo " <h1> DEBE SER ADMIN PARA ADMINISTRAR LAS PELICULAS </h1>" ?>
</html>