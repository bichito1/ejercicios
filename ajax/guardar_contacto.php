<?php

	ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "INSERT INTO contacto
		(nombre, apellidos, email)	
		VALUES
		(?, ?, ?)	
		";
	try {
	    $st = $db->prepare($sql);
	    $st ->execute(array($_POST['nombre'], $_POST['apellidos'], $_POST['email']));
	} catch(Exception $e) { 
	    echo $e->getMessage();
	    return false;
	}

?>
