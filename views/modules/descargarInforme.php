<?php 

require_once "../../models/crud.php";
if(isset($_GET["id"])){

Datos::descargarInforme($_GET["id"]);

header("location:../../index.php?action=informeVer");
}

?>