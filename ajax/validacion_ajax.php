<?php

	 ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		 $sql = "SELECT * FROM contacto";

	$errorNombre = $errorApellidos = $errorEmail = $errorSitioWeb = '';
	$errores = array();


	  function saneado($valor) {
	   $nuevoValor = trim($valor);
	   $nuevoValor = htmlspecialchars($nuevoValor);
	   return $nuevoValor;
	  }

	   if (empty($_POST['nombre'])) {
	      $errores['nombre'] = 'El nombre es obligatorio';
	   } else {
	      $nombre = saneado($_POST['nombre']);
	   }

	   if (empty($_POST['apellidos'])) {
	      $errores['Apellidos'] = 'Los apellidos son obligatorios';
	   } else {
	      $apellidos = saneado($_POST['apellidos']);
	   }

	   if (empty($_POST['email'])) {
	      $errores['email'] = 'El email es obligatorio';
	   } else {
	      $email = saneado($_POST['email']);
	      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errores['email'] = 'Formato de email no váildo.';
	      }
	   }

	   if (empty($_POST['sitio_web'])) {
	      $errores['sitio_web']= 'sitio web es obligatorio';
	   } else {
	      $sitio_web = saneado($_POST['sitio_web']);
	      if (!filter_var($sitio_web, FILTER_VALIDATE_URL)) {
		$errorSitioWeb = 'Formato sitio_web no váildo.';
	      }
           }

	if (empty($errores)) {

	   try{

	       $sql = "INSERT INTO contacto (nombre, apellidos, email, sitio_web) VALUES (?, ?, ?, ?)";
	       $st = $db->prepare($sql);
	       $st->execute(array(
		$nombre,
             	$apellidos,
		$email,
		$sitio_web
		));

           
	   } catch (PDOException $e) {

		echo $e->getMessage();
		return false;

	   }
	} else {
	   header('Content-Type: application/json');
	   echo json_encode($errores);	
	}	

?>

