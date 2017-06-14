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
<?php
	ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

		$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
	$sql = "SELECT * FROM alumno  WHERE id =" . $_GET['id'];
	
		try{
		$st = $db->prepare($sql);
		$st->execute();	
		} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
		}
	
	$fila = $st->fetch(PDO::FETCH_ASSOC);
	var_dump($fila)
?>
	<div>
	<h1>FORMULARIO ALUMNO</h1>
	<form action="modificar_alumno.php" method="post" enctype="multipart/form-data">
	   <table>
	      <tr>
		<td><label>DNI: *</label></td>
		<td><input type="text" name="dni" value="<?php echo $fila['dni']?>" required></td>
	      </tr>
	      <tr>
		<td><label>Nombre:</label></td>
		<td><input type="text" name="nombre" value="<?php echo $fila['nombre']?>"></td>
	      </tr>
	      <tr>
		<td><label>Apellidos:</label></td>
		<td><input type="text" name="apellidos" value="<?php echo $fila['apellidos'] ?>"></td>
	      </tr>
	      <tr>
		<td><label>Fecha_nacimiento:</label></td>
		<td><input id="datepicker" type="text" name="fecha_nacimiento" value="<?php echo $fila['fecha_nacimiento']?>"></td>
	      </tr>
	      <tr>
		<td><label>curso:</label></td>
		<td>
		   <select name="curso_id">
	<?php
               
		$sql = "SELECT * FROM curso";
	
		try{
		$st = $db->prepare($sql);
		$st->execute();	
		} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
		}

		while ($curso = $st->fetch(PDO::FETCH_ASSOC)) {
			if ($fila['curso_id'] == $curso['id']) {
			echo '<option value="' . $curso['id'] .'" selected>' . $curso["nombre"] . '</option>';	
			}else{

			echo '<option value="' . $curso['id'] .'">' . $curso["nombre"] . '</option>';
			}		
		};
		
	?>
		   </select>
		</td>
	      </tr>
	      <tr>
		<td><label>Actividades Extraescolares:</label></td>
		
	<?php
		$sql = "SELECT * FROM actividad_extra";

		try{
		$st = $db->prepare($sql);
		$st->execute();	
		} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
		}
		
		$actividadesExtra = $st->fetchAll(PDO::FETCH_ASSOC);
			var_dump($actividadesExtra);

		$sql = "SELECT actividad_extra_id
			   FROM alumno_actividad_extra
			   WHERE alumno_id=?
			  ";
		 try{
		 $st = $db->prepare($sql);
		 $st->execute(array($_GET['id']));	
		 } catch (PDOException $e) {
		 echo $e->getMessage();
		 return false;		   	
		 }

		  $actividadesExtraAlumno = $st->fetchAll(PDO::FETCH_COLUMN);

		   foreach ($actividadesExtra as $actividadExtra) {?>

			<tr>
                          <td class="extra"><label><?php echo $actividadExtra['nombre'] ?></label></td>
			<?php
			   $estadoCheckbox = '';
			  if (in_array($actividadExtra['id'], $actividadesExtraAlumno)) {
			     $estadoCheckbox = 'checked';
			  } ?>
			  <td>
			     <input type="checkbox" value="<?php echo $actividadExtra['id'] ?>" name="actividad_extra[]"
			     <?php echo $estadoCheckbox ?> >
			  </td>
			</tr>
		<?php }?>	
		</tr>

	      <tr>
		<td><label>Nota:</label></td>
		<td><input type="text" name="nota" value="nota"/></td>
	      </tr>
	      <tr>
		<td><input type="file" name="foto"/></td>
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


