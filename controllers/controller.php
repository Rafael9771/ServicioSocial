<?php 

	class MvcController{

		public function pagina(){
		
		include "views/template.php";

		}


		public function enlacesPaginaController(){

				if(isset($_GET["action"])){
					$enlace=$_GET["action"];
				}else{
					$enlace="index";
				}

				$respuesta = Paginas::enlacesPaginasModel($enlace);
				include $respuesta;

		}

		public function registroAlumnoController(){

			if(isset($_POST["nombreRegistro"])){

				$datos = array("nc" =>$_POST["ncRegistro"],
							   "nombre"=>$_POST["nombreRegistro"],
							   "apellidos"=>$_POST["apellidosRegistro"],
							   "carrera"=>$_POST["carreraRegistro"],
							   "turno"=>$_POST["turnoRegistro"],
							   "semestre"=>$_POST["semestreRegistro"],
							   "grupo"=>$_POST["grupoRegistro"],
							   "email"=>$_POST["emailRegistro"],
							   "password"=>$_POST["passwordRegistro"]);

				$respuesta = Datos::registroAlumnoModel($datos);

				if($respuesta=="success"){
							
						header("location:index.php?action=registroExitoso");
				}else{
						
						header("location:index.php?action=registroErroneo");
				}
			}

		}

		public function inicioSesionController(){
			if(isset($_POST["usuarioSesion"])){

				$datos = array("usuario" =>$_POST["usuarioSesion"],
							   "password"=>$_POST["passwordSesion"]);

				$respuesta = Datos::sesionAdminModel($datos);

				if($respuesta=="success"){
					header("location:index.php?action=interfazAdministrador");
				}else{
					$respuesta = Datos::sesionAlumnoModel($datos);
					if(isset($respuesta["noControl"]) && $respuesta["pass"]==$datos["password"]){
						session_start();
						$_SESSION["nc"]=$respuesta["noControl"];
						$_SESSION["nombre"]=$respuesta["nombre"].' '.$respuesta["apellidos"];
						$_SESSION["carrera"]=$respuesta["carrera"];
						$_SESSION["turno"]=$respuesta["turno"];
						$_SESSION["semestre"]=$respuesta["semestre"];
						$_SESSION["grupo"]=$respuesta["grupo"];
						$_SESSION["correo"]=$respuesta["correo"];
						$_SESSION["estado"]=$respuesta["status"];
						$_SESSION["p"]=$respuesta["p"];

						header("location:index.php?action=interfazAlumno");

					}else{
						echo '<script> alert("intente de nuevo")</script>';
					}
				}
				
			}
		}

		public function VerCalificacion(){
			session_start();
			if($_SESSION["p"]!="T"){
				echo '<h1>AUN NO TERMINA TU SERVICIO</h1>';
			}else{
				$datos = Datos::VerCalificacionModel($_SESSION["nc"]);
				echo '<h1>TU CALIFICACION ES '.$datos["calificacion"].'</h1>';
			}
		}

		public function opcionesAlumno(){
			session_start();
			if($_SESSION["p"]=="V"){
				

				echo '		<select name="opcionProyectoAlumno" id="opcionProyectoAlumno">
			
			<option >CREAR PROYECTO</option>
			
		</select><input type="submit" value="Escoger">'
		;
		$_POST["pAlumno"]="No";

			}elseif($_SESSION["p"]=="P"){
					echo '<h1>HAS CREADO UN PROYECTO ESPERA A QUE TE LO VALIDEN</h1>';
			}elseif($_SESSION["p"]=="A"){
					echo '<h1>TU PROYECTO</h1>';
					
					$respuesta = Datos::obtenerInformacionProyectoAlumno($_SESSION["nc"]);

					echo '<h1>'.$respuesta["nombre"].'</h1><br><h3>'.$respuesta["descaripcion"].'</h3>';
			}else{
				echo '<h1>TU PROYECTO A CONCLUIDO</h1>';
			}
		}

		public function crearSeleccionarProyectoAlumno(){

			if(isset($_POST["pAlumno"])){
				if(isset($_POST["opcionProyectoAlumno"])){
					if($_POST["opcionProyectoAlumno"]=="CREAR PROYECTO"){

						header("location:index.php?action=creacionProyectoAlumno");

					}else{

/*
						header("location:index.php?action=selecionarEmpresaAlumno");*/
						
					}
				}
			}
		}

		public function validarUsuarioController($datos){

			$respuesta = Datos::validarUsuarioModel($datos);

		if(isset($respuesta["noControl"])){

			return 0;

		}else{
			return 1;
		}
		}

		public function validarEmpresaController($datos){

			$respuesta = Datos::validarEmpresaModel($datos);

		if(isset($respuesta["nombre"])){

			return 0;

		}else{
			return 1;
		}
		}

		public function validarProyectoController($datos){

			$respuesta = Datos::validarProyectoModel($datos);

		if(isset($respuesta["nombre"])){

			return 0;

		}else{
			return 1;
		}
		}
		


		public function empresasDisponiblesController(){
			$respuesta = Datos::empresasDisponiblesModel();
			echo '<h3>Escoje una empresa</h3>';
			$cad = '<select id="opcionesEmpresa" name="opcionesEmpresa"><option></option>';

			foreach ($respuesta as $row => $item) {
				$cad = $cad.'<option>'.$item["nombre"].'</option>';
			}

			$cad = $cad.'</select>';

			echo $cad;
		}

		public function proyectosDisponiblesController(){
			$respuesta = Datos::proyectosDisponiblesModel();
			echo '<h3>Escoje un proyecto</h3>';
			$cad = '<select id="opcionesProyecto" name="opcionesProyecto"><option></option>';

			foreach ($respuesta as $row => $item) {
				$cad = $cad.'<option>'.$item["nombre"].'</option>';
			}

			$cad = $cad.'</select>';

			echo $cad;	
		}

		public function agregarProyectoAlumno(){
			if(isset($_POST["nombreEmpresaAlumno"])){
					
						
				$DatosE = array("nombreE" =>$_POST["nombreEmpresaAlumno"] ,
								"estadoE"=> $_POST["estadoEmpresaAlumno"],
									"direccionE"=>$_POST["direccionEmpresaAlumno"],
									"telefonoE"=>$_POST["telefonoEmpresaAlumno"],
									"correoE"=>$_POST["correoEmpresaAlumno"],
									"responsableE"=>$_POST["reponsableEmpresaAlumno"],
									"cargoE"=>$_POST["cargoEmpresaAlumno"] 
						    );
				$DatosP	 = array("nombreP" =>$_POST["nombreProyectoAlumno"] ,
										 "descripcionP" => $_POST["descripcionProyectoAlumno"] );

						    
				$respuestaE=Datos::agregarEmpresaModel($DatosE);
				$respuestaP = Datos::agregarProyectoAlumnoModel($DatosP);

				if($respuestaP=="success" && $respuestaE=="success"){

					$respuesta = Datos::vincularEmpresaProyecto($DatosE, $DatosP);
					if($respuesta=="success"){
						session_start();
						
						$respuesta=Datos::vincularProyectoAlumno($DatosP["nombreP"],$_SESSION["nc"]);
						if($respuesta=="success"){
							$_SESSION["p"]="P";
							header("location:index.php?action=proyectoagregado");
						}else{
							header("location:index.php?action=erroragregarproyectoAlumno");
						}

					}else{
						header("location:index.php?action=erroragregarproyecto");
					}
				}else{
					header("location:index.php?action=erroragregarproyecto");
				}
						
					
			}
		}

		public function proyectosAprovarController(){

			$respuesta = Datos::proyectosAprovarModel();

			if(isset($respuesta)){
				$_POST["existenciaAP"]="E";
				$cad='<select id="proyectoRevicionAdmin" name="proyectoRevicionAdmin">';
				foreach ($respuesta as $row => $item) {
				$cad = $cad.'<option>'.$item["nocontrol"].'</option>';
				}
				$cad=$cad.'</select> <input type="submit" value="Aprovar">';
				echo $cad;
				
			}else{
				$_POST["existenciaAP"]="N";
				echo '<h1>NO HAY PROYECTOS POR APROVAR</h1>';
			}
		}

		public function aprovarProyectoController(){

			if ($_POST["existenciaAP"]=="E") {
				if(isset($_POST["proyectoRevicionAdmin"])){
					$respuesta=Datos::validarProyecto($_POST["proyectoRevicionAdmin"]);
					if($respuesta=="success"){
						header("location:index.php?action=proyectoAprovadoAdmin");
					}else{
						header("location:index.php?action=proyectoAprovadoAdminError");
					}
				}
			}
		}

		public function verDocumentacionController(){
			session_start();

			$res = Datos::verDocumentosModel($_SESSION["nc"]);
			
				$cad='<table style="width:100%">
  					<tr>
    				<th>Fecha</th>
    				<th>Archivo</th>
  					</tr>';
				foreach ($res as $row => $item) {
					$cad=$cad.' <tr>
    				<td>'.$item["fecha"].'</td>
    				<td><a href="views/modules/descargarDocumentacion.php?id='.$item["id"].'">'.$item["nombre"].'</a></td> 
  					</tr>';
				}
				$cad=$cad.'</table>';
				echo $cad;
			
		}

		public function verInformesController(){
				session_start();

			$res = Datos::verInformesModel($_SESSION["nc"]);
			
				$cad='<table style="width:100%">
  					<tr>
    				<th>Fecha</th>
    				<th>Archivo</th>
  					</tr>';
				foreach ($res as $row => $item) {
					$cad=$cad.' <tr>
    				<td>'.$item["fecha"].'</td>
    				<td><a href="views/modules/descargarInforme.php?id='.$item["id"].'">'.$item["nombre"].'</a></td> 
  					</tr>';
				}
				$cad=$cad.'</table>';
				echo $cad;

		}

		public function verAlumnosAdmin(){

			$datos = Datos::verAlumnosAdminModel();

			$cad='<select id="alumnoIformes" name="alumnoIformes">';

			foreach ($datos as $row => $item) {
				$cad=$cad.'<option>'.$item["noControl"].'</option>';
			}
			$cad=$cad.'</select>';
			echo $cad;
		}

		public function verInfomeAlumnosAdmin(){
			if(isset($_POST["alumnoIformes"])){

				session_start();

				$_SESSION["nc"]=$_POST["alumnoIformes"];
				header("location:index.php?action=verInformesAlumnoAdmin");
			}
		}

		public function verInformesAdminController(){
				session_start();

			$res = Datos::verInformesModel($_SESSION["nc"]);
			
				$cad='<table style="width:100%">
  					<tr>
    				<th>Fecha</th>
    				<th>Archivo</th>
  					</tr>';
				foreach ($res as $row => $item) {
					$cad=$cad.' <tr>
    				<td>'.$item["fecha"].'</td>
    				<td><a href="views/modules/descargarInformeAdmin.php?id='.$item["id"].'">'.$item["nombre"].'</a></td> 
  					</tr>';
				}
				$cad=$cad.'</table>';
				echo $cad;

		}


		public function verAlumnosAdminV(){

			$datos = Datos::verAlumnosAdminModelV();

			$cad='<select id="alumnoDocumento" name="alumnoDocumento">';

			foreach ($datos as $row => $item) {
				$cad=$cad.'<option>'.$item["noControl"].'</option>';
			}
			$cad=$cad.'</select>';
			echo $cad;
		}

		public function verInfomeAlumnosAdminV(){
			if(isset($_POST["alumnoDocumento"])){

				session_start();

				$_SESSION["nc"]=$_POST["alumnoDocumento"];
				header("location:index.php?action=verDocumentosAlumnoAdmin");
			}
		}

		public function verDocumentacionAdminController(){
			session_start();

			$res = Datos::verDocumentosModel($_SESSION["nc"]);

				$cad='<table style="width:100%">
  					<tr>
    				<th>Fecha</th>
    				<th>Archivo</th>
  					</tr>';
				foreach ($res as $row => $item) {
					$cad=$cad.' <tr>
    				<td>'.$item["fecha"].'</td>
    				<td><a href="views/modules/descargarDocumentacionAdmin.php?id='.$item["id"].'">'.$item["nombre"].'</a></td> 
  					</tr>';
				}
				$cad=$cad.'</table>';
				echo $cad;
			
		}

		public function comprobarRevision(){
			$respuesta = Datos::comprobarRevisionModel();

			if(isset($respuesta["noControl"])){
				echo '<script>alert("tienes proyectos por aprovar")</script>';
			}
		}

		public function empresasSeleccionController(){

			$respuesta = Datos::empresasSeleccionModel();


		}

		public function AlumnosSinEvaluacion(){

			$datos = Datos::AlumnosSinEvaluacionModel();

			if(isset($datos)){
					$_POST["valAlum"]="N";
				$cad = '<select id="alumnoEvaluar" name="alumnoEvaluar">';
					foreach ($datos as $row => $item) {
						$cad=$cad.'<option>'.$item["noControl"].'</option>';
					}
					$cad=$cad.'</select><label for="calif">Calificacion</label>
		<input type="text" id="calif" name="calif" required><input type="submit" value="Evaluar">';
					echo $cad;
			}else{
				$_POST["valAlum"]="P";
				echo '<h1>No hay alumnos para evaluar</h1>';
			}
		}

		public function evaluarAlumnoAdmin(){

			
			if($_POST["valAlum"]=="N"){
				if(isset($_POST["alumnoEvaluar"])){
				$datos = Datos::evaluarAlumnoAdminModel($_POST["alumnoEvaluar"],$_POST["calif"]);

				if($datos=="success"){
					header("location:index.php?action=evaluacionCorrecta");
				}else{
					header("location:index.php?action=evaluacionIncorrecta");
				}}
			}
		}

	}

?>