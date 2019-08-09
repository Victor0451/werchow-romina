<?php
//conexion DB
/*$objData = new Database();
*/
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CRUD</title>

	<link type="image/x-icon" href="libs/img/logo1.jpg" rel="shortcut icon"/>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="libs/js/jquery-1.7.2.js"></script>
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>
</head>

<body>
 <form name = 'crud' method= 'post' action='nuevo.php'>
 	<label>Nombre</label><br>
 	<input type='text' name='nombre'/><br>
 	<label>Descripcion</label><br>
 	<textarea name='descrip' rows='10'> </textarea><br>
    <input type='submit' value='REGISTRAR'/><br>
</form>
	
</body>
</html>
