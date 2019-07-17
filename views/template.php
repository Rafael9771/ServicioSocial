<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>

<style>	

nav{
			position:relative;
			margin:auto;
			width:100%;
			height:auto;
			background:black;
		}

		nav ul{
			position:relative;
			margin:auto;
			width:70%;
			text-align: center;
		}

		nav ul li{
			display:inline-block;
			width:12%;
			line-height: 50px;
			list-style: none;
		}

		nav ul li a{
			color:white;
			text-decoration: none;
		}

		section{
			position: relative;
			margin: auto;
			width:400px;
		}

		section h1{
			position: relative;
			margin: auto;
			padding:10px;
			text-align: center;
		}

		section form{
			position:relative;
			margin:auto;
			width:400px;
		}

		section form input{
			display:inline-block;
			padding:10px;
			width:100%;
			margin:5px;
		}
		section form select{
			display:inline-block;
			padding:10px;
			width:95%;
			margin:5px;
		}

		section form input#usuarioRegistro{
			text-transform: lowercase;
		}

		section form input#descripcionProyectoAlumno{
			height: 200px;
		}

		section form input[type="submit"]{
			position:relative;
			margin:20px auto;
			left:1.5%;


		}


		table{
			position:relative;
			margin:auto;
			width:100%;
			left:-10%;
		}

		table thead tr th{
			padding:10px;
		}

		table tbody tr td{
			padding:10px;
		}


</style>

<script src="views/js/jquery-3.0.0.min.js"></script>

</head>
<body>
	

	<?php 
   
		$mvc = new MvcController();
		$mvc -> enlacesPaginaController();

    ?>

    <script src="views/js/revisionnombre.js"></script>

</body>
</html>