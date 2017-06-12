<!doctype html/>
<html>
<head>
	<title>FORMULARIO VALIDACION</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="estilos.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-	ui.css">
</head>
<body>
<header>
</header>
<main>

<?php

	 ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		 $sql = "SELECT * FROM contacto";

	$errorNombre = $errorApellidos = $errorEmail = $errorSitioWeb = '';
	$errores = false;

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

	  function saneado($valor) {
	   $nuevoValor = trim($valor);
	   $nuevoValor = htmlspecialchars($nuevoValor);
	   return $nuevoValor;
	  }

	   if (empty($_POST['nombre'])) {
	      $errorNombre = 'El nombre es obligatorio';
              $errores = true;
	   } else {
	      $nombre = saneado($_POST['nombre']);
	   }

	   if (empty($_POST['apellidos'])) {
	      $errorApellidos = 'Los apellidos son obligatorios';
	      $errores = true;
	   } else {
	      $apellidos = saneado($_POST['apellidos']);
	   }

	   if (empty($_POST['email'])) {
	      $errorEmail = 'El email es obligatorio';
	      $errores = true;
	   } else {
	      $email = saneado($_POST['email']);
	      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$errorEmail = 'Formato de email no váildo.';
	      }
	   }

	   if (empty($_POST['sitio_web'])) {
	      $errorSitioWeb = 'sitio web es obligatorio';
	      $errores = true;
	   } else {
	      $sitio_web = saneado($_POST['sitio_web']);
	      if (!filter_var($sitio_web, FILTER_VALIDATE_URL)) {
		$errorSitioWeb = 'Formato sitio_web no váildo.';
	      }
	   }


	

	if ($errores == false) {
	   try{
	   $sql = "INSERT INTO contacto (nombre, apellidos, email, sitio_web) VALUES (?, ?, ?, ?)";
	   $st = $db->prepare($sql);
	   $st->execute(array(
		$nombre,
             	$apellidos,
		$email,
		$sitio_web
		));

             $mensajeOk = "Datos guardados.";
	   } catch (PDOException $e) {
		echo $e->getMessage();
		return false;
	   }
	}	
}
?>

	<h1>FORMULARIO VALIDACION</h1>
       
        <?php echo isset($mensajeOk) ? $mensajeOk : '' ?>
	<form method="post">
	<table id="validacion">
		<tr>
		<td><label>Nombre:</label></td>
		<td><input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : '' ?>"></td>
		<td><span><?php echo $errorNombre ?></span></td>
		</tr>
	
		<tr>
		<td><label>Apellidos:</label></td>
		<td><input type="text" name="apellidos" value="<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : '' ?>"></td>
		<td><span><?php echo $errorApellidos ?></span></td>
		</tr>

		<tr>
		<td><label>Email:</label></td>
		<td><input type="text" name="email" value ="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>"></td>
		<td><span><?php echo $errorEmail ?></span></td>
		</tr>
		
		<tr>
		<td><label>Sitio Web:</label></td>
	   	<td><input type="text" name="sitio_web" value="<?php echo isset($_POST['sitio_web']) ? $_POST['sitio_web'] : '' ?>"></td>
		<td><span><?php echo $errorSitioWeb ?></span></td>
		</tr>
		
		<tr>
		<td><input type="submit" value="Enviar"></td>
		</tr>
	</table>
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


</body>
</html>
