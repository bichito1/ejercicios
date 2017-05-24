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
	
	//$numeroPaginaActual = $_GET['pagina'];
	$numeroPaginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

	$filasPorPagina = 5;
	$offset = ($numeroPaginaActual - 1) * $filasPorPagina;

	$sql = "SELECT * FROM alumno LIMIT " . $filasPorPagina . ' OFFSET ' . $offset;

	//var_dump($sql);
	
	

	$columnaOrden = isset($_GET['columna_orden']) ? $_GET['columna_orden'] : 'nombre';
	$orden = isset($_GET['orden']) ? $_GET['orden'] : 'asc';

	$sql = "SELECT * FROM alumno
		ORDER BY " . $columnaOrden . ' ' . $orden;"
		LIMIT " .$filasPorPagina . 'OFFSET' . $offset;

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

	<table id='lista' class='display' style ='text-align: center'>
	
	<thead>	
	<tr>
<?php
        //cabecera tabla
	foreach ($nombreColumnas as $nombreColumna) { ?>
 	  <?php if (strpos($nombreColumna, "_") == true) { ?>
          <th style='text-transform: capitalize;'> 
            <?php str_replace("_"," ", $nombreColumna) ?>
          </th>
          <?php } else { ?>
	  <th style='text-transform: capitalize;'>
            <?php $nombreColumna ?>
          </th>
	  <?php } ?>
        <?php } ?>
	
	</tr>
	</thead>

	<tbody>
	<tr>
<?php
        //primera fila
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
	
<?php


	
	$sql = "SELECT COUNT(*) FROM alumno";
	$st = $db->prepare($sql);
	$st->execute();

	$totalResultados = $st->fetch(PDO::FETCH_ASSOC);

	$numeroPaginas = $totalResultados['COUNT(*)'] / $filasPorPagina;
	//var_dump(ceil($numeroPaginas));	

	for ($i=1; $i<=ceil($numeroPaginas); $i++) {
		echo '<a href="lista_alumno_sin_datatable.php?pagina=' . $i . '">' . $i . '</a>';	
	}	
?>
<script
			  src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>




</body>
</html>
