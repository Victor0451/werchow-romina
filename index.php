<? include "info.php" ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Sistema  - Werchow - </title>
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="libs/js/jquery-1.7.2.js"></script>
</head>
<?php
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
?>

<body>
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>
	<div id="menu-wrapper">

		<div id="menu">
			<?php
			$usu= TraerPerfil();

			switch ($usu) {
				case 'VENTAS':include ('menu_vta.php'); break;
				case 'ASESOR':include ('menu_vta.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'RECUPERADOR':include ('menu_rec.php'); break;
				case 'ENCARGADO':include ('menu_enc.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				case 'RENDICION':include ('menu.php'); break;
				default:break;
			}

			
			
			?>
			
		</div>
	</div>
	<br><br><br><br>
	<div id="contenido">
		<center><!--<img src="libs/img/images.jpg">--></center><br>
		
	</div>
	<div id="footer">
		<center>WERCHOW - Año 2018 - </center>
		
	</div>
	
</body>
</html>
<?php
function TraerPerfil(){
$usu=$_SESSION["usu_ide"];

$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];

	}
return($perfil);
}
	
?>