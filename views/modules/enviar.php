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

$respuesta = Datos::enviarArchivoModel("hola", $binario_contenido);

if($respuesta=="success"){

$respuesta = Datos::verimagenModel($binario_contenido);

header("Content-type: $binario_tipo");
    header("Content-length: $binario_peso"); 
    header("Content-Disposition: inline; filename=$binario_nombre"); 
 
   echo $respuesta;

}else{
	echo "hubo un error";
}

/*$consulta_insertar = "INSERT INTO archivos (id, archivo_binario, archivo_nombre, archivo_peso, archivo_tipo) VALUES ('', '$binario_contenido', '$binario_nombre', '$binario_peso', '$binario_tipo')";
mysql_query($consulta_insertar,$conexion) or die("No se pudo insertar los datos en la base de datos.");
header("location: listar_imagenes.php");  // si ha ido todo bien*/
exit;


 ?>