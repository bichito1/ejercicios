<!DOCTYPE HTML>
<html lang="en">
<head>
	<link rel="stylesheet" href="estilos.css"/>
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
	<meta charset="UTF-8">
</head>	
<body>
<h1>DATOS ALUMNO</h1>

<?php	

	ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

	$db = new PDO("mysql:host=localhost;dbname=colegio;charset=utf8","root", "Palomita");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$sql = "SELECT * FROM alumno  WHERE ID=40";
	//var_dump($sql);	

	try{
		$st = $db->prepare($sql);
		$st->execute();	
	} catch (PDOException $e) {
		echo $e->getMessage();
		return false;	
	}
	$datosAlumno = $st->fetch(PDO::FETCH_ASSOC);
	//var_dump($datosAlumno);

	/*$nombreColumnas = array_keys($primeraFila);
	var_dump($nombreColumnas);*/

	echo "<table id='tabla' class='display'>";
	
	foreach ($datosAlumno as $clave => $datoAlumno) {
	    echo "<tr>";
	    if (strpos($clave, "_") == true) {
         	echo "<td style='text-transform: capitalize;'>" . str_replace("_"," ", $clave) . "</td>";
    	    } else {
	
	    echo "<td style='text-transform: capitalize;'>" . $clave . "</td>";
	    }	
	
            if ($clave == 'fecha_nacimiento') {
		echo '<td>' . date("d-m-Y" , strtotime($datoAlumno)). '</td>';	
	    } else if ($clave == 'nota') {
    		echo '<td>' . number_format($datoAlumno , 2, ',', '.') . '</td>';
	    } else if ($clave == 'foto') {
		echo "<td>" . '<img  width="50" src="uploads/' . $datoAlumno . '">' . "</td>";	
            } else {
	        echo'<td>' . $datoAlumno . '</td>';	
            }

	    echo "</tr>";	
	}

	
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


