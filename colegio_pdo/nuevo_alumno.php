<h1>Hola</h1>
<?php
	

	ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$nombreArchivo = md5(uniqid());

	var_dump($_POST);

	$sql = "INSERT INTO alumno (curso_id, dni, nombre, apellidos, fecha_nacimiento, nota, foto) VALUES (" .
           $_POST['curso_id']. ", '" .
           $_POST['dni']. "', '" . 
           $_POST['nombre']. "', '" .
           $_POST['apellidos']. "', '" .
           date("Y-m-d", strtotime($_POST["fecha_nacimiento"])) . "', '" . 
	   $_POST['nota']. "', '" .
           $nombreArchivo.
        "')";

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}

      move_uploaded_file($_FILES["foto"]["tmp_name"], "uploads/" .  $nombreArchivo);
	var_dump($_FILES);

	//$conn->query($sql);

	

/*
	move_uploaded_file($_FILES["foto"]["tmp_name"], "/tmp/foto_alumno.jpg");
var_dump($_POST);
var_dump($_POST["provincia"]);*/



?>