<!DOCTYPE HTML>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<meta charset="UTF-8">
</head>	
<body>
<h1>BASE DE DATOS</h1>


<?php	

	ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM alumno";
	//var_dump($sql);	

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}
	
	//$result = $conn->query($sql);
	//var_dump($result);	

	$primeraFila = $st->fetch(PDO::FETCH_ASSOC);
	//var_dump($primeraFila);

	$nombreColumnas = array_keys($primeraFila);
	//var_dump($nombreColumnas);

	echo "<table id='tabla' class='display' style ='text-align: center'>";
	
	echo "<thead>";	
	echo "<tr>";
	foreach ($nombreColumnas as $nombreColumna) {
	if  (strpos($nombreColumna, "_") == true) {
         echo "<th style='text-transform: capitalize;'>" . str_replace("_"," ", $nombreColumna) . "</th>";
    } else {
	
	 echo "<th style='text-transform: capitalize;'>" . $nombreColumna . "</th>";
	}
	}

	echo "</tr>";
	echo "</thead>";

	echo "<tbody>";
	echo "<tr>";
	foreach ($primeraFila as $clave => $elementosPrimeraFila) {
		if ($clave == 'fecha_nacimiento') {
		echo '<td>' . date("d-m-Y" , strtotime($elementosPrimeraFila)). '</td>';	
	} else if ($clave == 'nota') {
    		echo '<td>' . number_format($elementosPrimeraFila , 2, ',', '.') . '</td>';
        }else{
	
	 echo'<td>' . $elementosPrimeraFila . '</td>';	
		}
	}
	echo "</tr>";	
//esta lina hace
	while ($fila = $st->fetch(PDO::FETCH_ASSOC)) {
	echo "<tr>";
	echo "<td>" . $fila["id"] . "</td>";
	echo "<td>" . $fila["curso_id"] . "</td>";
	echo "<td>" . $fila["dni"] . "</td>";
	echo "<td>" . $fila["nombre"] . "</td>";
	echo "<td>" . $fila["apellidos"] . "</td>";
	echo "<td>" . date("d-m-Y" , strtotime($fila["fecha_nacimiento"])) . "</td>";
	echo "<td>" . number_format($fila["nota"] , 2, ',', '.') . "</td>";
	echo "<td>" .'<img width="50" src="uploads/' . $fila['foto'] . '">' . "</td>";	
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js"></script>

<script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/datetime-moment.js"></script>

<script>

	$(document).ready(function(){

         $.fn.dataTable.moment( 'DD-MM-YYYY' );
     

    
       $('#tabla').DataTable({

        "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            }

        });

}); 

</script>


</body>
</html>
