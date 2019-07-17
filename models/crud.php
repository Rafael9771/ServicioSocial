<?php 	

		require_once "conexion.php";
		require_once "n.php";

		class Datos{

			public function enviarArchivoModel($nc,$nombre, $doc,$tipo,$peso){
				$hoy = getdate();
				$dat = $hoy["mday"].'-'.$hoy["mon"].'-'.$hoy["year"];
				$sql = Conexion::conectar()->prepare("INSERT INTO documentacion( noCOntrol, nombre, doc, fechaEntrega, tipo, peso) VALUES (:nc,'$nombre', '$doc', :dat, :tipo, :peso)");
				$sql->bindParam(":nc", $nc, PDO::PARAM_INT);
				$sql->bindParam(":dat", $dat, PDO::PARAM_STR);
				$sql->bindParam(":tipo", $tipo, PDO::PARAM_STR);
				$sql->bindParam(":peso", $peso, PDO::PARAM_STR);
				//$sql->bindParam(":doc", $doc, PDO::PARAM_BLOB);
				

				if($sql->execute()){
					return "success";
				}else{
					return "fallo";
				}

				$sql->close();
			}

			public function verimagenModel($data){

				$stmt = Conexion::conectar()->prepare("SELECT doc FROM docs WHERE iddocs=3");
				$stmt->execute();
					$contenido = $stmt->fetch();
				
 
				header("Content-type: image/jpeg");
				header("Content-Disposition: attachment; filename= holi.jpeg");
 
 				echo $contenido["doc"];
				$stmt->close();



			}

			public function registroAlumnoModel($datos){

					$stmt = Conexion::conectar()->prepare("INSERT INTO alumnos(noControl, nombre, apellidos, carrera, turno, semestre, grupo, correo, estado, pass, p) VALUES (:nc, :nombre, :apellidos, :carrera, :turno, :semestre, :grupo, :correo, 'A', :pass, 'V')");
					$stmt->bindParam(":nc",$datos["nc"],PDO::PARAM_INT);
		            $stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		            $stmt->bindParam(":apellidos",$datos["apellidos"],PDO::PARAM_STR);
		            $stmt->bindParam(":carrera",$datos["carrera"],PDO::PARAM_STR);
		            $stmt->bindParam(":turno",$datos["turno"],PDO::PARAM_STR);
		            $stmt->bindParam(":semestre",$datos["semestre"],PDO::PARAM_STR);
		            $stmt->bindParam(":grupo",$datos["grupo"],PDO::PARAM_STR);
		            $stmt->bindParam(":correo",$datos["email"],PDO::PARAM_STR);
		            $stmt->bindParam(":pass",$datos["password"],PDO::PARAM_STR);

		            if($stmt->execute()){
		            	return "success";
		            }else{
		            	return "error";
		            }

		            $stmt->close();

			}

			public function sesionAdminModel($datos){
				$stmt = Conexion::conectar()->prepare("SELECT usuario, password FROM admin WHERE usuario=:usuario");
				$stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);

				$stmt->execute();
				$res=$stmt->fetch();
				if($res["usuario"]==$datos["usuario"] && $res["password"]== $datos["password"]){
					return "success";
				}else{
					return "error";
				}
				$stmt->close();
			}

			public function sesionAlumnoModel($datos){

				
				$stmt = Conexion::conectar()->prepare("SELECT noControl,nombre, apellidos, carrera, turno, semestre, grupo, correo, estado, pass, p FROM alumnos WHERE nocontrol=:nc");
				$stmt->bindParam(":nc",$datos["usuario"],PDO::PARAM_INT);

				$stmt->execute();
				
				return $stmt->fetch();
				


				$stmt->close();
			}

			public function empresasDisponiblesModel(){
				$stmt = Conexion::conectar()->prepare("SELECT nombre FROM empresa");
				$stmt->execute();
				return $stmt->fetchAll();
				$stmt->close();
			}

			public function proyectosDisponiblesModel(){
				$stmt = Conexion::conectar()->prepare("SELECT nombre FROM proyecto WHERE estatus='A'");
				$stmt->execute();
				return $stmt->fetchAll();
				$stmt->close();
			}

			public function agregarEmpresaModel($datos){
				$stmt = Conexion::conectar()->prepare("INSERT INTO empresa(nombre, direccion, estado, telefono, correo, responsable, cargoResponsable) VALUES (:nombre, :direccion, :estado, :telefono, :correo, :responsable, :cargo)");
				$stmt->bindParam(":nombre", $datos["nombreE"], PDO::PARAM_STR);
				$stmt->bindParam(":direccion", $datos["direccionE"], PDO::PARAM_STR);
				$stmt->bindParam(":estado", $datos["estadoE"], PDO::PARAM_STR);
				$stmt->bindParam(":telefono", $datos["telefonoE"], PDO::PARAM_STR);
				$stmt->bindParam(":correo", $datos["correoE"], PDO::PARAM_STR);
				$stmt->bindParam(":responsable", $datos["responsableE"], PDO::PARAM_STR);
				$stmt->bindParam(":cargo", $datos["cargoE"], PDO::PARAM_STR);

					if($stmt->execute()){
						return "success";
					}else{
						return "error";
					}
				$stmt->close();
	
			}

			

			public function vincularEmpresaProyecto($nombreE, $nombreP){

				$stmt=Conexion::conectar()->prepare("SELECT idEmpresa FROM empresa WHERE nombre=:nombreE");
				$stmt->bindParam(":nombreE",$nombreE["nombreE"],PDO::PARAM_STR);
				$stmt->execute();
				$idE=$stmt->fetch();

				$stmt=Conexion::conectar()->prepare("SELECT idProyecto FROM proyecto WHERE nombre=:nombreP");
				$stmt->bindParam(":nombreP",$nombreP["nombreP"],PDO::PARAM_STR);
				$stmt->execute();
				$idP=$stmt->fetch();


				$stmt=Conexion::conectar()->prepare("INSERT INTO empresa_proyecto(idEmpresa, idProyecto) VALUES (:idE,:idP)");
				$stmt->bindParam(":idE",$idE["idEmpresa"], PDO::PARAM_INT);
				$stmt->bindParam(":idP",$idP["idProyecto"], PDO::PARAM_INT);

				if($stmt->execute()){
					return "success";
				}else{
					return "error";
				}
				$stmt->close();


			}

			public function vincularProyectoAlumno($nombreP,$nc){
				$stmt=Conexion::conectar()->prepare("SELECT idProyecto FROM proyecto WHERE nombre=:nombreP");
				$stmt->bindParam(":nombreP",$nombreP,PDO::PARAM_STR);
				$stmt->execute();
				$idP=$stmt->fetch();

				$stmt=Conexion::conectar()->prepare("INSERT INTO alumnos_proyecto(noControl, idProyecto) VALUES (:nc,:idP)");
				$stmt->bindParam(":nc",$nc, PDO::PARAM_INT);
				$stmt->bindParam(":idP",$idP["idProyecto"], PDO::PARAM_INT);

				if ($stmt->execute()) {
					$stmt=Conexion::conectar()->prepare("UPDATE alumnos SET p='P' WHERE noControl=:nc");
					$stmt->bindParam(":nc",$nc,PDO::PARAM_INT);
					if($stmt->execute()){
						return "success";
					}else{
						return "error";
					}
				}else{
					return "error";
				}
				$stmt->close();

			}

			public function agregarProyectoAlumnoModel($datos){
				$stmt = Conexion::conectar()->prepare("INSERT INTO proyecto (nombre, descaripcion, estatus) VALUES (:nombre, :descripcion, 'A')");
				$stmt->bindParam(":nombre", $datos["nombreP"], PDO::PARAM_STR);
				$stmt->bindParam(":descripcion", $datos["descripcionP"], PDO::PARAM_STR);

				if($stmt->execute()){
					return "success";
				}else{
					return "error";
				}

				$stmt->close();
			}

			public function proyectosAprovarModel(){
				$stmt = Conexion::conectar()->prepare("SELECT a.nocontrol FROM alumnos_proyecto ap INNER JOIN alumnos a on a.noControl=ap.noControl INNER JOIN proyecto p on p.idProyecto=ap.idProyecto WHERE a.p='P'");
				$stmt->execute();
				return $stmt->fetchAll();

				$stmt->close();

			}

			public function validarProyecto($nombreP){
				$stmt = Conexion::conectar()->prepare("UPDATE alumnos SET p='A' WHERE nocontrol=:nc");
				$stmt->bindParam(":nc",$nombreP,PDO::PARAM_INT);
				if($stmt->execute()){
					return "success";
				}else{
					return "error";
				}
				$stmt->close();
			}	

			public function obtenerInformacionProyectoAlumno($nc){
				$stmt = Conexion::conectar()->prepare("SELECT p.nombre, p.descaripcion FROM alumnos a INNER JOIN alumnos_proyecto ap on ap.noControl=a.noControl INNER JOIN proyecto p on p.idProyecto=ap.idProyecto WHERE a.noControl=:nc");
				$stmt->bindParam(":nc",$nc,PDO::PARAM_INT);

				$stmt->execute();
				return $stmt->fetch();
				$stmt->close();

			}

			public function validarUsuarioModel($nc){
				$stmt = Conexion::conectar()->prepare("SELECT noControl FROM alumnos WHERE noControl=:nc");
				$stmt->bindParam(":nc",$nc,PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetch();
				$stmt->close();
			}

			public function validarEmpresaModel($datos){
				$stmt = Conexion::conectar()->prepare("SELECT nombre FROM empresa WHERE nombre=:nombre");
				$stmt->bindParam(":nombre",$datos,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
				$stmt->close();
			}

			public function validarProyectoModel($datos){
				$stmt = Conexion::conectar()->prepare("SELECT nombre FROM proyecto WHERE nombre=:nombre");
				$stmt->bindParam(":nombre",$datos,PDO::PARAM_STR);
				$stmt->execute();
				return $stmt->fetch();
				$stmt->close();
			}

			public function empresasSeleccionModel(){
				$stmt = Conexion::conectar()->prepare("SELECT nombre FROM empresa");
				$stmt->execute();
				return $stmt->fetchAll();
				$stmt->close();

			}

			public function AlumnosSinEvaluacionModel(){
				$stmt = Conexion::conectar()->prepare("SELECT noControl FROM alumnos WHERE p='A'");
				$stmt->execute();
				return $stmt->fetchAll();
				$stmt->close();
			}

			public function evaluarAlumnoAdminModel($nc,$calif){
				$hoy = getdate();
				$dat = $hoy["mday"].'-'.$hoy["mon"].'-'.$hoy["year"];
				$stmt=Conexion::conectar()->prepare("INSERT INTO evaluacion(fecha, calificacion ) VALUES (:fecha,:calif)");
				$stmt->bindParam(":fecha",$dat,PDO::PARAM_STR);
				$stmt->bindParam(":calif",$calif,PDO::PARAM_STR);
				if($stmt->execute()){
						$stmt=Conexion::conectar()->prepare("SELECT t.idEvaluacion FROM evaluacion t WHERE t.idEvaluacion = ( SELECT MAX( idEvaluacion ) FROM evaluacion)");
						$stmt->execute();
						$id=$stmt->fetch();

						$stmt=Conexion::conectar()->prepare("UPDATE alumnos SET p='T',idEvaluacion=:idE WHERE noControl=:nc");
						$stmt->bindParam(":idE",$id["idEvaluacion"],PDO::PARAM_INT);
						$stmt->bindParam(":nc",$nc,PDO::PARAM_INT);
						if($stmt->execute()){
							return "success";
						}else{
							return "error";
						}
				}else{
					return "error";
				}
				$stmt->close();
			}

			public function VerCalificacionModel($nc){
				$stmt = Conexion::conectar()->prepare("SELECT e.calificacion FROM evaluacion e INNER JOIN alumnos a ON a.idEvaluacion=e.idEvaluacion WHERE a.noControl=:nc");
				$stmt->bindParam(":nc",$nc,PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetch();
				$stmt->close();
			}

			public function comprobarRevisionModel(){
				$stmt = Conexion::conectar()->prepare("SELECT noControl FROM alumnos WHERE p='P'");

				$stmt->execute();
				return $stmt->fetch();
				$stmt->close();
			}

			public function verDocumentosModel($nc){
				$stmt = Conexion::conectar()->prepare("SELECT idDocumentacion as id,  nombre, doc, fechaEntrega as fecha FROM documentacion WHERE noCOntrol=:nc");
				$stmt->bindParam(":nc",$nc,PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll();
				$stmt->close();
			}	

			public function verInformesModel($nc){
				$stmt = Conexion::conectar()->prepare("SELECT idInformes as id, informe, fechaEntrega as fecha,  nombre FROM informes WHERE nocontrol=:nc");
				$stmt->bindParam(":nc",$nc,PDO::PARAM_INT);
				$stmt->execute();
				return $stmt->fetchAll();
				$stmt->close();
			}

			public function descargarDocumento($id){
				$stmt = Conexion::conectar()->prepare("SELECT nombre, doc, tipo, peso FROM documentacion WHERE idDocumentacion=:id");
				$stmt->bindParam(":id",$id,PDO::PARAM_INT);
				$stmt->execute();
					$contenido = $stmt->fetch();
				
 
				header("Content-Type: ".$contenido["tipo"]);
				header('Content-length: '.$contenido["peso"]);
				header('Content-Disposition: attachment; filename= '.$contenido["nombre"]);
				
 
 				echo $contenido["doc"];
				$stmt->close();

			}

			public function descargarInforme($id){
				$stmt = Conexion::conectar()->prepare("SELECT informe, peso, tipo, nombre FROM informes WHERE idInformes=:id");
				$stmt->bindParam(":id",$id,PDO::PARAM_INT);
				$stmt->execute();
					$contenido = $stmt->fetch();

				header("Content-Type: ".$contenido["tipo"]);
				header('Content-length: '.$contenido["peso"]);
				header('Content-Disposition: attachment; filename= '.$contenido["nombre"]);
				
 
 				echo $contenido["informe"];
				$stmt->close();


			}

			public function enviarInformeModel($nc,$nombre, $doc,$tipo,$peso){
				$hoy = getdate();
				$dat = $hoy["mday"].'-'.$hoy["mon"].'-'.$hoy["year"];

				$stmt = Conexion::conectar()->prepare("INSERT INTO informes(idConvocatoria, informe, fechaEntrega, noControl, peso, tipo, nombre) VALUES (1,'$doc', :fecha, :nc, :peso, :tipo,'$nombre')");
				$stmt->bindParam(":nc", $nc, PDO::PARAM_INT);
				$stmt->bindParam(":fecha", $dat, PDO::PARAM_STR);
				$stmt->bindParam(":tipo", $tipo, PDO::PARAM_STR);
				$stmt->bindParam(":peso", $peso, PDO::PARAM_STR);

				if($stmt->execute()){
					return "success";
				}else{
					return "fallo";
				}

				$sql->close();


			}

			public function verAlumnosAdminModel(){
				$stmt = Conexion::conectar()->prepare("SELECT noControl FROM alumnos WHERE p='A'");
				$stmt->execute();
				return $stmt->fetchAll();

				$stmt->close();


			}

			public function verAlumnosAdminModelV(){
				$stmt = Conexion::conectar()->prepare("SELECT noControl FROM alumnos WHERE p!='V'");
				$stmt->execute();
				return $stmt->fetchAll();

				$stmt->close();


			}

			 

		}

?>