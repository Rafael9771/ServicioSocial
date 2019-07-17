
<?php
		include "views/modules/navegacion.php";
		if(isset($_GET["action"])){
			if($_GET["action"]=="registroExitoso"){
				echo '<script> alert("Registro Exitoso")</script>';
			}if($_GET["action"]=="ErrorSesion"){
				echo '<script>alert("Este usuario no existe")</script>';
			}if($_GET["action"]=="cerrarSesion"){
				session_start();
				session_destroy();
				echo '<script>alert("Se cerro la sesion con exito")</script>';

			}
		}
?>

<section>	

	<form method="post">
		<label for="usuasioSesion">Usuario</label>
		<input type="text" placeholder="Usuario" id="usuarioSesion" name="usuarioSesion" required>
		<label for="passwordSesion">Contraseña</label>
		<input type="password" placeholder="Contraseña" id="passwordSesion" name="passwordSesion" required>

		<input type="submit" value="Iniciar Sesion">

	</form>
</section>

<?php 	

	$mvc = new MvcController();
	$mvc->inicioSesionController();

?>