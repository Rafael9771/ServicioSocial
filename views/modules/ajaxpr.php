<?php 

require_once "../../controllers/controller.php";
require_once "../../models/crud.php";

class Ajax{

	

	public function validarUsuarioAjax(){

			$datos=$_POST["validarUsuario"];

		$respuesta = MvcController::validarEmpresaController($datos);

		echo $respuesta;
	}
}

$a = new Ajax();
//$a -> validarUsuari="ho";
$a -> validarUsuarioAjax();