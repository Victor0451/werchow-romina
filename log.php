<?php
include "config.php";
include "libs/class/usuario.class.php";
//include "libs/class/oficina.class.php";


session_start();
if(isset($_SESSION["auth"]) == "yes"){session_unset();session_destroy();};
$msg="";
if(isset($_REQUEST["submit"])){
	$usr = strtoupper($_REQUEST["usuario"]);
	$usu = $_REQUEST["usuario"];
	$pass = $_REQUEST['clave'];
	
	$msg='';	
 
	$rows=Usuario::validaUsuario($usu,$pass);
	if ($rows->rowCount()!=0){
		$row = $rows->fetch();
		$_SESSION["usuario"] = $usr;
		$_SESSION["auth"] = "yes";
		$_SESSION["nom"] = $row["usu_apellido"]." ".$row["usu_nombre"];
		$_SESSION["usu_ide"] = $row["usu_ide"];
		$_SESSION["usu_perfil"] = $row["usu_perfil"];
		header('location:index.php');
		}
	else{
		$msg='Datos incorrectos';
		}
	}//fin-if
?>
<!DOCTYPE html>
<html>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="robots" content="noindex,nofollow"/>
<title>Werchow - Ingreso Sistema</title>
<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
<link href="libs/css/styles.css" rel="stylesheet" type="text/css" >
<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="libs/js/jquery-1.7.2.js"></script>
</head>

<body>
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>
	<div><br>
			<form action="" method="post" >
			<table width="20%" border="0" align="center">
				<tr><td><center>Login</center></td> </tr>
				<tr><td>Usuario  &nbsp;&nbsp;&nbsp;<input name="usuario" type="text"> </td></tr>
				<tr><td>Password <input name="clave" type="password"> </td></tr>
				<tr><td> </td></tr>
				<tr><td> </td></tr>
				<tr><td> </td></tr>
				<tr><td><center><input name="submit" type="submit" value="Ingresar"></center></td></tr>
				<tr><td></td></tr>
			</table>
		
		</form>		
		
	</div>

<p align="center" style="color:#F00;"><?php if ($msg==''){echo '&nbsp;';}else{echo $msg;};?></p>

</body>
</html>


