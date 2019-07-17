<?php 	

include "views/modules/navegacionAlumno.php";
		if(isset($_GET["action"])){
			if($_GET["action"]=="informeE"){
				echo '<script>alert("Documento subido exitosamente")</script>';
			}
		}

?>

<section>	

<form enctype="multipart/form-data" action="views/modules/enviarInformes.php" method="POST">
 <h1>Subir Informe</h1>
Subir Infomr: <input name="archivo" type="file" />
 
<input type="submit" value="Send File" />

<label >Nota: Profavor sube tus informes en world(docx)</label>
 
</form>

</section>