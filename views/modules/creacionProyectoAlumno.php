
<?php 	

		include "views/modules/navegacionAlumno.php";
		if(isset($_GET["action"])){
			if($_GET["action"]=="erroragregarproyecto"){
				echo '<script>alert("No se pudo agregar")</script>';
			}elseif ($_GET["action"]=="erroragregarproyectoAlumno") {
				echo '<script>alert("No se pudo agregar error alumno")</script>';
			}
		}

 ?>

<section>
	
	<form method="post" onsubmit="return validarEmpresaProyecto(this);">
		
		<h1>DATOS EMPRESA</h1>

		<?php 	 
/*
			$mvc = new MvcController();
			$mvc -> empresasDisponiblesController();*/

		?>

		<label for="nombreEmpresaAlumno">Nombre <span></span> </label>
		<input type="text" placeholder="Empresa" id="nombreEmpresaAlumno" name="nombreEmpresaAlumno" required>

		
		<label for="direccionEmpresaAlumno">Direccion</label>
		<input type="text" placeholder="Direccion" id="direccionEmpresaAlumno" name="direccionEmpresaAlumno" required>
		
		<label for="estadoEmpresaAlumno">Estado</label>
		<input type="text" placeholder="Estado" id="estadoEmpresaAlumno" name="estadoEmpresaAlumno" required>
		
		<label for="telefonoEmpresaAlumno">Telefono</label>
		<input type="text" placeholder="Telefono" id="telefonoEmpresaAlumno" name="telefonoEmpresaAlumno" required>
		
		<label for="correoEmpresaAlumno">Email</label>
		<input type="text" placeholder="Correo" id="correoEmpresaAlumno" name="correoEmpresaAlumno" required>
		
		<label for="reponsableEmpresaAlumno">Reponsable</label>
		<input type="text" placeholder="Reponsable" id="reponsableEmpresaAlumno" name="reponsableEmpresaAlumno" required>
		
		<label for="cargoEmpresaAlumno">Cargo del Responsable</label>
		<input type="text" placeholder="Cargo" id="cargoEmpresaAlumno" name="cargoEmpresaAlumno" required>

		<h1>DATOS PROYECTO</h1>

		<?php 	
/*
			$mvc = new MvcController();
			$mvc->proyectosDisponiblesController();*/

		?>

		<label for="nombreProyectoAlumno">Nombre <span></span> </label>
		<input type="text" placeholder="Proyecto" id="nombreProyectoAlumno" name="nombreProyectoAlumno" required>

		
		<label for="descripcionProyectoAlumno">Descripcion</label>
		<input type="text" placeholder="Descripcion" id="descripcionProyectoAlumno" name="descripcionProyectoAlumno" required>

		<input type="submit" value="Crear">
		
		
	</form>


</section>

<?php 	

		$mvc = new MvcController();
		$mvc->agregarProyectoAlumno();

?>