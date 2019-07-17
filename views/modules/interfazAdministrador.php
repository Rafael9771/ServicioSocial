<?php 	

	include "views/modules/navegacionAdmin.php";
	$mvc = new MvcController();
	$mvc -> comprobarRevision();
	echo '<h1>Bienvenido Administrador</h1>';


?>

