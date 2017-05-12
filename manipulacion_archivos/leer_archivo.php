<?php
	ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);

	$miArchivo = fopen("mi_archivo.txt", "r");
	$contenido = fread($miArchivo, filesize("mi_archivo.txt"));
	echo $contenido;


	$miArchivo = fopen("mi_archivo.txt", "r");
	$primeraLinea = fgets($miArchivo);
	echo $primeraLinea;

	$miArchivo = fopen("mi_archivo_vacio.txt", "w");
	fputs($miArchivo, "Hola Pablo");	
	
?>
