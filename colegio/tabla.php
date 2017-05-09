<!DOCTYPE HTML>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<meta charset="UTF-8">
</head>	
<body>
<h1>BASE DE DATOS</h1>


<?php	
	$conn = new mysqli("localhost","root","Palomita","colegio");
	//var_dump($conn);
	mysqli_set_charset($conn, 'utf8');	

	$sql = "SELECT * FROM alumno";
	//var_dump($sql);	

	$result = $conn->query($sql);
	//var_dump($result);	

	$primeraFila = $result->fetch_assoc();
	//var_dump($primeraFila);

	$nombreColumnas = array_keys($primeraFila);
	//var_dump($nombreColumnas);

	echo "<table class='display'>";
	
	echo "<thead>";	
	echo "<tr>";
	foreach ($nombreColumnas as $nombreColumna) {
	 echo "<th>" . $nombreColumna . "</th>";
	}

	echo "</tr>";
	echo "</thead>";

	echo "<tbody>";
	echo "<tr>";
	foreach ($primeraFila as $clave => $elementosPrimeraFila) {
		if ($clave == 'fecha_nacimiento') {
		echo '<td>' . date("Y-m-d" , strtotime($elementosPrimeraFila)). '</td>';	
	} else {
	
	 echo'<td>' . $elementosPrimeraFila . '</td>';	
		}
	}
	echo "</tr>";	

	while ($fila = $result->fetch_assoc()){
	echo "<tr>";
	echo "<td>" . $fila["id"] . "</td>";
	echo "<td>" . $fila["curso_id"] . "</td>";
	echo "<td>" . $fila["dni"] . "</td>";
	echo "<td>" . $fila["nombre"] . "</td>";
	echo "<td>" . $fila["apellidos"] . "</td>";
	echo "<td>" . $fila["fecha_nacimiento"] . "</td>";
	echo "<td>" . $fila["nota"] . "</td>";
	echo "</tr>";
	}
	echo "</tbody>";
	
echo "</table>"
	
?>

<script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
<script
	src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js">
</script>
 <script src="https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"></script>

<script>
	$(document).ready(function(){
    $('table').DataTable( {
        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }
	 });
});	
</script>
</body>
</html>
