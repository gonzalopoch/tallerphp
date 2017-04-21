<?php

function conectar(){

$link = mysqli_connect('localhost', 'root', '', 'grupo40') 
	or die("Error" . mysqli_error($link));

return $link;

}

?>