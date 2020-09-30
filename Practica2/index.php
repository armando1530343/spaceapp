<?php
	//Invoca al controlador y modelo solicitado
	require_once "models/enlaces.php";
	require_once "models/crud.php";
	require_once "controllers/controller.php";
	
	//Se crea un nuevo controlador llamando a la plantilla que mostrará al usuario
	$mvc = new MvcController();
	$mvc-> plantilla();

?>