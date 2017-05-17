<h1>Profe</h1>
<?php
	

	ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$nombreArchivo = md5(uniqid());

	var_dump($_POST);

	$sql = "INSERT INTO profesor (nombre, apellidos, fecha_nacimiento) VALUES (" .
           $_POST['nombre']. "', '" .
           $_POST['apellidos']. "', '" .
           date("Y-m-d", strtotime($_POST["fecha_nacimiento"])) . "', '" . 

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}

      /*move_uploaded_file($_FILES["foto"]["tmp_name"], "uploads/" .  $nombreArchivo);
	var_dump($_FILES);*/

	//$conn->query($sql);

	

