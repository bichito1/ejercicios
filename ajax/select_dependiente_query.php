<?php

	ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

	

	

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "SELECT id, nombre FROM ciudad
		WHERE provincia_id = ?
		"
	try {
	    $st = $db->prepare($sql);
	    $st ->execute(array($_POST['id'], $_POST['nombre']));
	} catch(Exception $e) { 
	    echo $e->getMessage();
	    return false;
	}



	$ciudades = $st->fetchAll(PDO::FETCH_KEY_PAIR);
	
	$respuestaHtml= '';
	
	foreach ($ciudades as $ciudad => $nombreCiudad) {
	   $respuestaHtml .=
	      '<option value="' . $ciudad .'">' . $nombreCiudad . '</option>'
	}
	echo $repuestaHtml;
?>
