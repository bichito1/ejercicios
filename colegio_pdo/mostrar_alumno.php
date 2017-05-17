<?php	

	ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM  WHERE ID=40";
	//var_dump($sql);	

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}
$datosAlumno = $st->fetch(PDO::FETCH_ASSOC);
	var_dump($datosAlumno);

	//$nombreColumnas = array_keys($primeraFila);
	//var_dump($nombreColumnas);
