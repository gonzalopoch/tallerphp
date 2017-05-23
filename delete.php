<?php 
        include ("connect.php");
        include ("promedio.php");
        $link = conectar();

       
        $idpeli = $_GET['id'];
        $accion = $_GET['action'];
        if ($accion == "del" and $idpeli<>"0") {
            
            mysqli_query($link, "DELETE   FROM peliculas WHERE id=$idpeli");

            header("location: pelismod.php");
            
            }
        
    ?>