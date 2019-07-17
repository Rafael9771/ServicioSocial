<?php 	
		include "views/modules/navegacionAlumno.php";

?>	

<section>	

	<form method="post">
		
		<h1>BIENVENIDO <?php session_start();
		echo '<h1>BIENVENIDO '.$_SESSION["nombre"].'</h1>';
		?></h1>

	</form>

</section>