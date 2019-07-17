<?php 	

	class Paginas{

		static public function enlacesPaginasModel($enlace){

			if($enlace=="archivo" || $enlace=="registro" || $enlace=="interfazAlumno" || $enlace=="proyectoAlumno" || $enlace == "creacionProyectoAlumno" || $enlace == "interfazAdministrador" || $enlace=="aprovarProyectosAdmin" || $enlace=="documentacion" || $enlace=="documentacionVer" || $enlace=="informe" || $enlace=="informeVer" || $enlace=="verInformesAdmin" || $enlace=="verInformesAlumnoAdmin" || $enlace=="verDocumentosAdmin" || $enlace=="verDocumentosAlumnoAdmin" || $enlace=="selecionarEmpresaAlumno" || $enlace=="evaluarAlumno" || $enlace=="verCalificacion"){
				$module = "views/modules/".$enlace.".php";
			}elseif($enlace=="registroExitoso"){
				$module="views/modules/inicio.php";

			}elseif($enlace=="evaluacionCorrecta"){
				$module="views/modules/evaluarAlumno.php";

			}elseif($enlace=="evaluacionIncorrecta"){
				$module="views/modules/evaluarAlumno.php";

			}elseif($enlace=="proyectoAprovadoAdmin"){
				$module="views/modules/aprovarProyectosAdmin.php";

			}elseif($enlace=="informeE"){
				$module="views/modules/informe.php";

			}elseif($enlace=="proyectoAprovadoAdminError"){
				$module="views/modules/aprovarProyectosAdmin.php";

			}elseif($enlace=="erroragregarproyecto"){
				$module="views/modules/creacionProyectoAlumno.php";

			}elseif($enlace=="erroragregarproyectoAlumno"){
				$module="views/modules/creacionProyectoAlumno.php";

			}elseif($enlace=="registroErroneo"){
				$module="views/modules/registro.php";

			}elseif($enlace=="proyectoagregado"){
				$module="views/modules/interfazAlumno.php";

			}elseif($enlace=="cerrarSesion"){
				$module="views/modules/inicio.php";

			}elseif($enlace=="ErrorSesion"){
					$module = "views/modules/inicio.php";
			}elseif($enlace=="documentacionE"){
				$module="views/modules/documentacion.php";

			}else{
				$module = "views/modules/inicio.php";
			}

			return $module;
		}

	}

 ?>