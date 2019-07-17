<?php 	

include "views/modules/navegacionAlumno.php";
		if(isset($_GET["action"])){
			if($_GET["action"]=="documentacionE"){
				echo '<script>alert("Documento subido exitosamente")</script>';
			}
		}

?>

<section>	

<form enctype="multipart/form-data" action="views/modules/enviarDocumentacion.php" method="POST">
 <h1>Subir Documentacion</h1>
Subir Documento: <input name="archivo" type="file" />
 
<input type="submit" value="Send File" />

<label >Nota: Profavor sube tus documentos en world(docx)</label>
 
</form>

</section>