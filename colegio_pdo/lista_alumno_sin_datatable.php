<!DOCTYPE HTML>
<html lang="en">
<head>
	<link rel="stylesheet" href="estilos.css"/>
	
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

	//$sql = "SELECT * FROM alumno";

	$filasPorPagina = 5;
	$sql = "SELECT * FROM alumno LIMIT" . $filasPorPagina;
	
	
	$sql = "SELECT COUNT(*) FROM alumno";
	$st = $db->prepare($sql);
	$st->execute();

	$totalResultados = $st->fetch(PDO::FETCH_ASSOC);

	$numeroPaginas = $totalResultados['COUNT(*)'] / $filasPorPagina;
	var_dump(ceil($numeroPaginas));		

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}
	

	$primeraFila = $st->fetch(PDO::FETCH_ASSOC);
	//var_dump($primeraFila);

	$nombreColumnas = array_keys($primeraFila);
	//var_dump($nombreColumnas);
?>

	<table id='tabla' class='display' style ='text-align: center'>
	
	<thead>	
	<tr>
<?php

	foreach ($nombreColumnas as $nombreColumna) {
	if  (strpos($nombreColumna, "_") == true) {
         echo "<th style='text-transform: capitalize;'>" . str_replace("_"," ", $nombreColumna) . "</th>";
    } else {
	
	 echo "<th style='text-transform: capitalize;'>" . $nombreColumna . "</th>";
	}
	}
?>
	</tr>
	</thead>

	<tbody>
	<tr>
<?php

	foreach ($primeraFila as $clave => $datoPrimeraFila) { 
          if ($clave == 'nota') {
            echo '<td>' . number_format($datoPrimeraFila , 2, ',', '.') . '</td>';
           } else if ($clave == 'foto') {
            echo '<td><img width="50" src="uploads/' . $datoPrimeraFila .'"></td>';
	  }else{
 ?>
		<td><?php echo $datoPrimeraFila ?></td>	
	<?php
          } 
        }
        ?>
	
	</tr>	
<?php
	while ($fila = $st->fetch(PDO::FETCH_ASSOC)) { ?>
	<tr>
	<td><?php echo $fila["id"] ?></td>
	<td><?php echo $fila["curso_id"] ?></td>
	<td><?php echo $fila["dni"] ?></td>
	<td><?php echo $fila["nombre"] ?></td>
	<td><?php echo $fila["apellidos"] ?></td>
	<td><?php echo $fila["fecha_nacimiento"] ?></td>
	<td><?php echo number_format($fila["nota"] , 2, ',', '.') ?></td>
	<td><?php echo '<img width="50" src="uploads/' . $fila["foto"].'">' ?></td>
<?php } ?>

	</tr>
	
	</tbody>
	
	</table>
	



<script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>




</body>
</html>
