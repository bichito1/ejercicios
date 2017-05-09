<?php
	$conn = new mysqli("localhost", "root", "Palomita", "colegio");
        if ($conn->connect_errno !=0) {
	echo "conexión fallida";	
	}
	else{
	echo "conexión ok";
	

	//var_dump($conn);


	//$sql = "INSERT INTO alumno (curso_id, dni, nombre, apellidos, fecha_nacimiento) VALUES ('" . $_POST['nombre'].");
	$sql = "INSERT INTO alumno (curso_id, dni, nombre, apellidos, fecha_nacimiento) VALUES (" . $_POST['curso_id']. ", '" . $_POST['dni']. "', '" . $_POST['nombre']. "', '" . $_POST['apellidos']. "', '" . date("Y-m-d", strtotime($_POST["fecha_nacimiento"])) . "')";


        var_dump($sql);

	$conn->query($sql);

	$conn->close();

/*
	var_dump($_FILES);
	move_uploaded_file($_FILES["foto"]["tmp_name"], "/tmp/foto_alumno.jpg");
var_dump($_POST);
var_dump($_POST["provincia"]);*/

}

?>
