<?php



function promedio($cantcoment,$id,$link){
	$calif=0;
	if ($cantcoment==0){
		return "Esta pelicula no fue calificada";
	}
	else{
	$resultc=mysqli_query($link, "SELECT * FROM comentarios WHERE peliculas_id=$id ORDER BY fecha");
	for ($j=1; $j<=$cantcoment; $j++){
		
        $comentario=mysqli_fetch_array($resultc);                        
        $calif=$comentario['calificacion'] + $calif;
    }
	return round($calif/$cantcoment, 2); // Agrego función round que limita los decimales a el número asignado luego del paréntesis
}}


?>