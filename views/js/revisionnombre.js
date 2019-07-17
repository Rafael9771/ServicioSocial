var ncExiste=false;
var empresaExiste=false;
var proyectoExiste=false;

$("#ncRegistro").change(function(){

	var usuario = $("#ncRegistro").val();

	console.log(usuario);

	var datos = new FormData();
	datos.append("validarUsuario", usuario);
	
	$.ajax({
		url:"views/modules/ajaxnc.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){
			


			if(respuesta == 0){

				$("label[for='ncRegistro'] span").html('<p> Este usuario ya existe en la base de dtos</p>');

				ncExiste=true;

			}else{

			$("label[for='ncRegistro'] span").html("");
			
				ncExiste=false;
			}
		}
	});
});

$("#nombreEmpresaAlumno").change(function(){

	var usuario = $("#nombreEmpresaAlumno").val();

	console.log(usuario);

	var datos = new FormData();
	datos.append("validarUsuario", usuario);
	
	$.ajax({
		url:"views/modules/ajaxpr.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){
			


			if(respuesta == 0){

				$("label[for='nombreEmpresaAlumno'] span").html('<p> Esta empresa ya existe</p>');

				empresaExiste=true;

			}else{

			$("label[for='nombreEmpresaAlumno'] span").html("");
			
				empresaExiste=false;
			}
		}
	});
});

$("#nombreProyectoAlumno").change(function(){

	var usuario = $("#nombreProyectoAlumno").val();

	console.log(usuario);

	var datos = new FormData();
	datos.append("validarUsuario", usuario);
	
	$.ajax({
		url:"views/modules/ajaxem.php",
		method:"POST",
		data: datos,
		cache: false,
		contentType: false,
		processData: false,
		success:function(respuesta){
			


			if(respuesta == 0){

				$("label[for='nombreProyectoAlumno'] span").html('<p> Este proyecto ya existe</p>');

				proyectoExiste=true;

			}else{

			$("label[for='nombreProyectoAlumno'] span").html("");
			
				proyectoExiste=false;
			}
		}
	});
});


function validarNoControl(f){
	if(ncExiste==true){
		alert("Este Numero de Control ya exite prueba con otro");
		return (false);
	}else{
		return (true);
	}

}

function validarEmpresaProyecto(f){
	if(empresaExiste==true){
		alert("Esta empresa ya existe te invito a seleccionar uno de sus proyectos");
	return (false);	
	}else{ 	if(proyectoExiste==true){
					alert("Este proyecto ya existe puedes escogerlo en la ventana anterior");
					return (false);

			}else{	
				return (true);
			}
	}
}