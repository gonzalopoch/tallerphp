<?php    
    if(isset($_POST['save'])){
        if(isset($_POST['estrellas'])){
            $newCalificacion = $_POST['estrellas'];
        }
        if(isset($_POST['addComentario'])){
            $newComentario = $_POST['addComentario'];
        }
        if(isset($_POST['idU'])){
            $idU = $_POST['idU'];
        }
        mysqli_query($link, "INSERT INTO comentarios (comentario,calificacion,peliculas_id,usuarios_id,fecha) VALUES ('$newComentario','$newCalificacion','$id','$idU',CURRENT_DATE)");
    }
?>