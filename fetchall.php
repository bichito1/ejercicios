<?php
	

	ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM curso";

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}	

	//$st -> fetchAll(PDO::FETCH_ASSOC);


	var_dump($st -> fetchAll(PDO::FETCH_ASSOC));

	$sql = "SELECT nombre FROM curso";

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}	

	var_dump($st -> fetchAll(PDO::FETCH_COLUMN));

$sql = "SELECT id FROM curso";

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}	

	var_dump($st -> fetchAll(PDO::FETCH_COLUMN));

?>	
