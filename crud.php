<?php
$bus=1;
require 'libs/class/database.php';
$objData = new Database();

$sth= $objData->prepare('SELECT * FROM datos ');

$sth->execute();

$result= $sth->fetchAll();	
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
	<table border="1">
	
	<tr>
		<td colspan="4"><a href="prueba3.php">Nuevo Registro</a></td>
	</tr>	
	<tr>
		<td>Legajo</td>
		<td>DESCRIPCION</td>
		<td colspan="2">ACCIONES</td>
	</tr>
	<?php
	 	foreach ($result as $key => $value){
	?>
	<tr>
		<td><?php echo $value['nombre'];?></td>
		<td><?php echo $value['descrip'];?></td>
		<td><a href="modificar.php" id=<?php echo $value['id']; ?>>Modificar </a> </td>
		<td><a href="eliminar.php"id=<?php echo $value['id']; ?>>Eliminar</a></td>
	</tr><?php }?>
	</table>
 <!--<form name = 'crud' method= 'post' action='nuevo.php'>
 	<label>Nombre</label><br>
 	<input type='text' name='nombre'/><br>
 	<label>Descripcion</label><br>
 	<textarea name='descrip' rows='10'> </textarea><br>
    <input type='submit' value='REGISTRAR'/><br>
</form>-->
</body>
</html>
