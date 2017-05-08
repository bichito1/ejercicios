<!DOCTYPE HTML>
<html>
<head>
	<title>FORMULARIO ALUMNOS</title>
	<meta charset="utf-8">
</head>
<body>
<header>
</header>
<main>
	<form action="nuevo.php" method="post">
		<label>Provincia</label>
<?php

	$conn = new mysqli("localhost", "root", "Palomita", colegio);
	$sql = "SELECT * FROM provincia";
	$result = $conn->query($sql);
	
	echo '<select name="provincia">';
	

	while ($fila = $result->fetch_assoc()) {

		echo '<option value="' .$fila['id'].'">' . $fila["nombre"] . '</option>';

		echo $fila["nombre"];
	}
	echo '</select>';
	$conn->close();
?>
<input type="submit" value="Enviar">
	</form>
</main>
<footer></footer>
</body>
</html>
</html>
