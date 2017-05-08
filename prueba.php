<?php
	echo "hola mundo";
	

	$conn = new mysqli("localhost","root","Palomita","colegio");
	$sql = "SELECT * FROM alumno";
	$result = $conn->query($sql);
	/*var_dump($result->fetch_assoc());
	var_dump($result->fetch_assoc());
	var_dump($result->fetch_assoc());
	var_dump($result->fetch_assoc());*/	
	
	
	/*for($i=0; $i<4; $i++) {
		var_dump($result->fetch_assoc());
	}*/

	while ($fila = $result->fetch_assoc()){
	var_dump($fila);
	}
	$conn->close();
?>

