<?php 
		include "views/modules/navegacion.php";
		if(isset($_GET["action"])){
			if($_GET["action"]=="registroErroneo"){
				echo '<script> alert("Error al registrar intente de nuevo")</script>';
			}
		}
?>


<section>	

	<form method="post" onsubmit="return validarNoControl(this);">
		<h1>REGISTRO</h1>	
		<label for="ncRegistro">Numero de Control <span></span> </label>
		<input type="text" placeholder="Maximo 8 numeros" id="ncRegistro" name="ncRegistro" maxlength="8" required>
		
		<label for="nombreRegistro">Nombre</label>
		<input type="text" placeholder="Nombre" name="nombreRegistro" id="nombreRegistro" required>

		<label for="apellidosRegistro">Nombre</label>
		<input type="text" placeholder="Apellidos" name="apellidosRegistro" id="apellidosRegistro" required>

		<label for="carreraRegistro">Carrera</label>
		
		<select name="carreraRegistro" id="carreraRegistro">
			<option>ISC</option>
			<option>ITIC</option>
			<option>Electrónica</option>
			<option>Gestión Empresarial</option>
			<option>Alimentarias</option>
			<option>Industrial</option>
			<option>Contaduría</option>
		</select>

		<label for="turnoRegistro">Turno</label>
		<select name="turnoRegistro" id="turnoRegistro">
			<option>MATUTINO</option>
			<option>VESPERTINO</option>
		</select>

		<label for="semestreRegistro">Semestre</label>
		<input type="number" placeholder="Semestre" name="semestreRegistro" id="semestreRegistro" required>

		<label for="grupoRegistro">Grupo</label>
		<input type="text" placeholder="Grupo" name="grupoRegistro" id="grupoRegistro" required>

		<label for="emailRegistro">Correo electrónico</label>
		<input type="email" placeholder="Escriba su correo electrónico correctamente" name="emailRegistro" id="emailRegistro" required>

		<label for="passwordRegistro">Contraseña</label>
		<input type="password" placeholder="Mínimo 6 caracteres, incluir número(s) y una mayúscula" name="passwordRegistro" id="passwordRegistro" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" required>	

		<input type="submit" value="Registrarse">

	</form>

</section>

<?php 	

	$mvc = new MvcController();
	$mvc -> registroAlumnoController();

?>