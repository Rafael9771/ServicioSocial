<?php 

require_once "../../models/crud.php";
if(isset($_GET["id"])){

Datos::descargarDocumento($_GET["id"]);

header("location:../../index.php?action=verDocumentosAdmin");
}

?>