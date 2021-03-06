<!doctype html/>
<html>
<head>
	<title>FORMULARIO PROFESOR</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="estilos.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-	ui.css">
</head>
<body>
<header>
</header>
<main>
	<div>
	<h1>FORMULARIO PROFESOR</h1>
	<form action="nuevo_profesor.php" method="post" enctype="multipart/form-data">
		<label>Nombre:</label>
		<br>
		<input type="text" name="nombre">
		<br>
		<label>Apellidos:</label>
		<br>
		<input type="text" name="apellidos">
		<br>
		<label>Fecha_nacimiento:</label>
		<br>
		<input id="datepicker" type="text" name="fecha_nacimiento">
		<br>
		<label>curso:</label>
		<select name="curso_id">
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
		

		while ($fila = $st->fetch(PDO::FETCH_ASSOC)) {

			echo '<option value="' .$fila['id'].'">' . $fila["nombre"] . '</option>';
		}
		
	?>

		</select>
		<br>
		<input type="submit" value="Enviar">
	</form>
	</div>
</main>
<footer></footer>
<script
	 src="https://code.jquery.com/jquery-3.2.1.min.js"
			  integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
			  crossorigin="anonymous"></script>
        
<script
			  src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
			  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
			  crossorigin="anonymous"></script>


<script 
	src="https.//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.9.2/i18n/jquery.ui.datepicker-es.min.js">

</script>
<script>
$(function() {
 		$("#datepicker").datepicker(
			$.datepicker.regional["es"]);
	});
</script>


    
</body>
</html>
