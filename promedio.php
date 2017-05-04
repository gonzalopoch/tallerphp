<?php

	function promedio($id,$link){
		$calif=0;
		$resultc=mysqli_query($link, "SELECT * FROM comentarios WHERE peliculas_id=$id ORDER BY fecha");
		$cantcoment = mysqli_num_rows($resultc);
		if ($cantcoment==0){
			return "Esta película no fue calificada";
		}
		else{
			for ($j=1; $j<=$cantcoment; $j++){
				$comentario=mysqli_fetch_array($resultc);                        
				$calif=$comentario['calificacion'] + $calif;
			}
			return round($calif/$cantcoment, 2); // Agrego función round que limita los decimales a el número asignado luego del paréntesis
		}
	}
?>