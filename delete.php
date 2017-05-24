<?php 
        include ("connect.php");
        include ("promedio.php");
        $link = conectar();

       
        $id = $_GET['id'];
        $accion = $_GET['action'];
        $tabla = $_GET['tabla'];
        echo " id = $idpeli accion = $accion y tabla = $tabla";

        switch ($tabla) {
            case "peliculas":
                $result=mysqli_query($link, "SELECT * FROM comentarios WHERE peliculas_id=$id"); //Elimino los comentarios de la peli a borrar
                $cantcoment = mysqli_num_rows($result);
                if ($cantcoment>"0")
                    mysqli_query($link,"DELETE  FROM comentarios WHERE peliculas_id=$id");
                mysqli_query($link, "DELETE   FROM peliculas WHERE id=$id");    

                break;
            case "generos":
                mysqli_query($link, "UPDATE generos WHERE id=$id SET  genero='sin genero' ");
                break;
            case "comentarios":
                 mysqli_query($link, "DELETE   FROM $tabla WHERE id=$id");
                break;
            }
        


        header("location: pelismod.php");
            
          
        
    ?>