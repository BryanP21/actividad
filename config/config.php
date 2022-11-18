<?php
	session_start();
	function conectarse(){
	$servidor="localhost"; 
	$usuario="root"; 
	$passwd="";
	$database ="pasteleriam";
	// Create connection
	$link = new mysqli($servidor, $usuario, $passwd,$database);
	// Check connection
	if ($link->connect_error) {
		die("Connection failed: " . $link->connect_error);
	}
	/* $link -> set_charset("latin1"); */
	return $link ;
	}

?>


