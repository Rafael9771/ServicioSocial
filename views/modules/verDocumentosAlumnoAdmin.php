<?php 	

	include "views/modules/navegacionAdmin.php";
	


?>

<section>	

<form method="post">
	
	<?php 	

		$mvc = new MvcController();
		$mvc -> verDocumentacionAdminController();

	?>

</form>

</section>