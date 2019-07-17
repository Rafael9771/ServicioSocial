<?php 	

		require_once "../../models/crud.php";


if (empty($_FILES['archivo']['name'])){
header("location: index.php?action=index"); //o como se llame el formulario ..
exit;
}



// archivo temporal (ruta y nombre).
$binario_nombre_temporal=$_FILES['archivo']['tmp_name'] ;

// leer del archvio temporal .. el binario subido.
// "rb" para Windows .. Linux parece q con "r" sobra ...
$binario_contenido = addslashes(fread(fopen($binario_nombre_temporal, "rb"), filesize($binario_nombre_temporal)));

// Obtener del array FILES (superglobal) los datos del binario .. nombre, tabamo y tipo.
$binario_nombre=$_FILES['archivo']['name'];
$binario_peso=$_FILES['archivo']['size'];
$binario_tipo=$_FILES['archivo']['type'];

//insertamos los datos en la BD.
session_start();
$respuesta = Datos::enviarArchivoModel($_SESSION["nc"],$binario_nombre, $binario_contenido,$binario_tipo,$binario_peso);

if($respuesta=="success"){
		header("location:../../index.php?action=documentacionE");

}else{
	echo '<script>alert("Ups hubo un error")</script>';
}


?>