<?php
	session_start();
	session_destroy();
?>

<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Logout</title>

	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="../../resources/css/style.css" />

</head>

<body>

	<div id="notfound">
		<div class="notfound">
			<div class="notfound-404"></div>
			<h1>Su sesión ha expirado</h1>
			<h2>Por favor vuelva ha iniciar sesión</h2>
			
			<a href="index.php">Volver al Login</a>
		</div>
	</div>

</body>

</html>