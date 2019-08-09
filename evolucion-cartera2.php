<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/SO.class.php";
   include "libs/class/pagos.class.php";

if (isset($_REQUEST['btn_ver'])){

	switch ($_REQUEST['vista']) {
					case 1: break;
					case 2: break;
					case 3: break;
	 default : break;		}		
}	

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Evolucion Cartera</title>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<script src="libs/js/jquery-1.7.2.js"></script>
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>

</head>

<body>
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>
	<div id="menu-wrapper">
		<div id="menu"><?php TraerPerfil(); ?></div>
	</div>	
	<div id="contenido">	
		
		<div id="doctip"><h1>Evolución Cartera desde Enero 2018 </h1></div>

		<form action="" id="formulario" action="" >
		
		<!--le="font-size:0.8em;"><b>GENERAL - INICIO MES &nbsp;&nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;Seleccionar Vista:&nbsp;
			<input type="radio" name="vista" value="1" checked="checked" />$
            <input type="radio" name="vista" value="2" />%
            <input type="radio" name="vista" value="3" />Cantidad
            <input type="radio" name="vista" value="4" />Todos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           <input type="submit" name="btn_ver" value="Consultar">
		</b><br>

		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>MES AÑO ANTERIOR </th>
				<th widt="15%" bgcolor=#BB8FCE>MES ANTERIOR</th>
				<th widt="20%" bgcolor=#BB8FCE></th>
			
			</thead>
			<tbody>
				<?php   //r(); ?>
			</tbody>
		</table>
		</p>-->
		<p 	style="font-size:0.8em;"><b>CARTERA GENERAL  <?php //echo VerActivos(); ?></b><br>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE> </th>
				<th widt="15%" bgcolor=#BB8FCE>ALTAS</th>
				<th widt="15%" bgcolor=#BB8FCE>BAJAS</th>
				<th widt="15%" bgcolor=#BB8FCE>MOROSOS-1001-</th>
				<th widt="15%" bgcolor=#ABEBC6>RECUPERACION</th>
				
			
			</thead>
			
			<tbody>
				<?php $sucu='W';//VerFacturacion($sucu); ?>
			</tbody>
			<tbody>
				<?php $sucu='L';//VerFacturacion($sucu); ?>
			</tbody>
			<tbody>
				<?php $sucu='R';//VerFacturacion($sucu); ?>
			</tbody>
			<tbody>
				<?php $sucu='P';//VerFacturacion($sucu); ?>
			</tbody>
			<tbody>
				<?php //Totales(); ?>
			</tbody>
		</table>	
		<p style="font-size:0.8em;"><b>PASIVOS -  <?php //echo VerPasivos(); ?></b><br>

		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE> </th>
				<th widt="15%" bgcolor=#BB8FCE>TOTAL - %</th>
				<th widt="20%" bgcolor=#ABEBC6>PAGOS - %</th>
				<th widt="20%" bgcolor=#85C1E9>DIFERENCIA - %</th>
			
			</thead>
			<tbody>
				<?php $sucu='W';//VerInfoPasivos($sucu); ?>
			</tbody>
			<tbody>
				<?php $sucu='L';//VerInfoPasivos($sucu); ?>
			</tbody>
			<tbody>
				<?php $sucu='R';//VerInfoPasivos($sucu); ?>
			</tbody>
			<tbody>
				<?php $sucu='P';//VerInfoPasivos($sucu); ?>
			</tbody>
			<tbody>
				<?php //Totales2(); ?>
			</tbody>
		</table>
		</p>

	<p><input type="button" name="btn_salir" value="Salir" onclick="location.href = 'index.php'"></p>		
</form>
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
switch ($perfil) {
				case 'VENTAS':include ('menu_vta.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}
 ?>