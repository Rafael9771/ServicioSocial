<?php 	

	include "views/modules/navegacionAdmin.php";
	


?>

<section>	

	<form method="post">
		

		<?php 	

			$mvc = new MvcController();
			$mvc->verAlumnosAdmin();

		?>
		<input type="submit" value="Ver informes">

	</form>

</section>

<?php 	 

	$mvc = new MvcController();
	$mvc->verInfomeAlumnosAdmin();

?>

