<?php 	

include "views/modules/navegacionAdmin.php";

if(isset($_GET["action"])){
	if($_GET["action"]=="evaluacionCorrecta"){
			echo '<script>alert("Se evaluo al alumno correctamente")</script>';
	}else{
		if($_GET["action"]=="evaluacionIncorrecta"){
			echo '<script>alert("Error al evaluar alumno")</script>';
		}
	}
}

?>

<section>	

	<form method="post">
		
		<input type="hidden" id="valAlum" name="valAlum">

		<?php 	

			$mvc = new MvcController();
			$mvc -> AlumnosSinEvaluacion();

		?>
		

	</form>

</section>

<?php 	

	$mvc = new MvcController();
	$mvc -> evaluarAlumnoAdmin();

?>