<?php 	

include "views/modules/navegacionAlumno.php";
		/*if(isset($_GET["action"])){
			if($_GET["action"]=="documentacionE"){
				echo '<script>alert("Documento subido exitosamente")</script>';
			}
		}*/

?>

<section>	

<form method="post">
	
	<?php 	

		$mvc = new MvcController();
		$mvc -> verInformesController();

	?>

</form>

</section>