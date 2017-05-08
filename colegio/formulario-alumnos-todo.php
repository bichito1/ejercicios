<!doctype html/>
<html>
<head>
	<title>FORMULARIO ALUMNOS</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="estilos.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-	ui.css">
</head>
<body>
<header>
</header>
<main>
	<form action="nuevo.php" method="post" enctype="multipart/form-data">
		<label>DNI</label>
		<input type="text" name="dni">
		<br>
		<label>Nombre</label>
		<input type="text" name="nombre">
		<br>
		<label>Apellidos</label>
		<input type="text" name="apellidos">
		<br>
		<label>Fecha_nacimiento</label>
		<input id="fecha" type="text" name="fecha_nacimieto">
		<br>
		<label>curso</label>
		<select name="curso">
		<option value="id"></option>
		</select>
		<input type="file" name="foto"/>
		<br>
		<input type="submit" value="Enviar">
	</form>
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
<script>
$(function() {
 		$("#fecha").datepicker();
	})
</script>


    
</body>
</html>
