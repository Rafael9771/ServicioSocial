<?php 

	include "views/modules/navegacionAlumno.php";

?>

<section>
	
	<form method="post">
		


		<input type="hidden" id="pAlumno" name="pAlumno">

		<?php 

			$mvc = new MvcController();
			$mvc->opcionesAlumno();

		?>
		



	</form>
</section>

<?php 

	$mvc = new MvcController();
	$mvc -> crearSeleccionarProyectoAlumno();

?>