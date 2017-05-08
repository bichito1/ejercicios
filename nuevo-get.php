<?php

/*echo "foobar";
 var_dump($_GET);
	var_dump($_GET["nombre"]);*/


	$conn = new mysqli("localhost", "root", "Palomita", "colegio");
        if ($conn->connect_errno !=0) {
	echo "conexión fallida";	
	}
	else{
	echo "conexión ok";
	}
	var_dump($conn);

	$sql = "INSERT INTO alumno (nombre, apellidos, fecha_nacimiento) VALUES ('" . $_GET['nombre'] . "','" .$_GET['apellidos'] . "','" . "2001-01-01" ."')";

var_dump($sql);
	$conn->query($sql);
	$conn->close();


?>
