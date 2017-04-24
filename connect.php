<?php

function conectar(){

$server="localhost";
$user = "root";
$pass = "";
$dbname = "grupo40";

$link = mysqli_connect($server, $user, $pass, $dbname)
	or die( . mysqli_error($link));

return $link;

}

?>