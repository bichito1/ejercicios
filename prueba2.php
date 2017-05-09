<?php
	
	$dias = array('Lunes','Martes','Miercoles');
	$dias[] = 'jueves';
	$dias[]	= 'viernes';
		foreach ($dias as $clave => $dia) {
			echo $clave . ' ';
			echo $dia. '<br>';
	var_dump ($dia);
}
	
	$dias = array('Lunes','Martes','Miercoles');
	array_push($dias, 'jueves','Viernes','Sábado','Domingo');
		foreach ($dias as $clave => $dia) {
			echo $clave . ' ';
			echo $dia. '<br>';
}
	

	$edades = array('Juan' => 34, 'María' => 28);
	$edades['Elena'] = 50;
	$edades['Pablo'] = 30;
		foreach ($edades as $clave => $edad) {
			echo $clave . ' ';
			echo $edad. '<br>';
	var_dump ($edad['Elena']);

}
?>
