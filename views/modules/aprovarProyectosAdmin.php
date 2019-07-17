<?php 	

	include "views/modules/navegacionAdmin.php";
	if(isset($_GET["action"])){
		if($_GET["action"]=="proyectoAprovadoAdmin"){
			echo '<script>alert("Se aprovo el proyecto con exito")</script>';
		}elseif ($_GET["action"]=="proyectoAprovadoAdminError") {
			echo '<script>alert("Hubo un error al aprovar el proyecto")</script>';
		}
	}

?>

<section>	

	<form method="post">
		
		<input type="hidden" id="existenciaAP" name="existenciaAP">

		<?php 	

			$mvc = new MvcController();
			$mvc->proyectosAprovarController();

		?>

	</form>

</section>

<?php 	 

	$mvc = new MvcController();
	$mvc->aprovarProyectoController();

?>