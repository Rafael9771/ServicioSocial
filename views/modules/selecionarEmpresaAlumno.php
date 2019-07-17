<?php 	 

		include "views/modules/navegacionAlumno.php";

?>

<section>	

	<form method="post">
		
		<?php 	

			$mvc=new MvcController();
			$mvc->empresasSeleccionController();

		?>

	</form>

</section>