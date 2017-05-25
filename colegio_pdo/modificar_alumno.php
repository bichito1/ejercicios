<h1>Hola</h1>
<?php
	

	ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$nombreArchivo = md5(uniqid());


	//var_dump($_POST);

	$sql = "UPDATE alumno SET (curso_id, dni, nombre, apellidos, fecha_nacimiento, nota, foto) VALUES (" .
           $_POST['curso_id']. ", '" .
           $_POST['dni']. "', '" . 
           $_POST['nombre']. "', '" .
           $_POST['apellidos']. "', '" .
           date("Y-m-d", strtotime($_POST["fecha_nacimiento"])) . "', '" . 
	   str_replace(",",".", $_POST['nota']) .  "', '" .
           $nombreArchivo.
        "')";

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}
	
	if ($_FILES['foto']['error'] == 4){
	   $cadenaColumnaFoto = ' ';
	} else {
	   $nombreArchivo = md5(unique());
      	   move_uploaded_file($_FILES["foto"]["tmp_name"], "uploads/" .  $nombreArchivo);
	   $cadenaColumnaFoto =", foto='" . $nombreArchivo . "'";
	var_dump($_FILES);
	}


	


?>
