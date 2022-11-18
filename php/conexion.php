<?php
	$host = "localhost";
	//Permisos root
	$dbuser = "root";
	$dbpass = "";
	//Busca nuestra base de datos creada
	$db = "pasteleriam";
	$link= mysqli_connect($host,$dbuser,$dbpass,$db);
	//print_r($link);
	//Si no se conecta nos manda el mensaje de error
	if(mysqli_connect_error()){
		echo "<script>alert('No se pudo conectar con la Base de datos.');</script>";
	}//se conecta o no se puede abrir
	mysqli_select_db($link, 'pasteleriam') or die('No se puede abrir la estructura de DB'.mysqli_connect_error());
?>