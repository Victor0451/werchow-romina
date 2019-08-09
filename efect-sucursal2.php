<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/SO.class.php";
   include "libs/class/pagos.class.php";

/*   if (isset($_REQUEST['btn_guardar'])){

   		$rows = Usuario::updateUsuario1($_SESSION["usu_ide"], strtolower($_REQUEST['pass']));
   		
   		print '<script language="JavaScript">'; 
		print 'alert("SE HA CAMBIADO LA CLAVE CORRECTAMENTE");'; 
		print'</script>';
   }*/
   	

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Efectividad Sucursales</title>
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
		
		<div id="doctip"><h1>Evolución Tareas Sucursales</h1></div>

		<form action="" id="formulario" action="" >
		<p style="font-size:0.8em;"><b>SAN SALVADOR DE JUJUY - OFICINA</b><br>
		
			
			<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="50%" bgcolor=#ABEBC6>INDICES INICIO MES DE <?php echo VerMes();?></th>
				</thead>
			</table>	
			<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>AL DIA</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#BB8FCE>1001</th>
			</thead>
			<tbody>
				<?php  $zona=28;VerFacturacion($zona); ?>
			</tbody>
		</table>
		<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="50%" bgcolor=#ABEBC6>INDICES AL <?php echo $fec=date("d/m/Y",time());?></th>
				</thead>
		</table>
	<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>PAGO MES</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#BB8FCE>1001</th>
			</thead>	
			<tbody>
				<?php  $zona=28;VerActualizacion($zona); ?>
			</tbody>
	</table>		
		</p>
		<p style="font-size:0.8em;"><b>SAN PEDRO - OFICINA</b><br>
				<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="50%" bgcolor=#ABEBC6>INDICES INICIO MES DE <?php echo VerMes();?></th>
				</thead>
			</table>	
			<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>AL DIA</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#BB8FCE>1001</th>
			</thead>
			<tbody>
				<?php $zona=4;//VerFacturacion($zona); ?>
			</tbody>
		</table>
		<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="50%" bgcolor=#ABEBC6>INDICES AL <?php echo $fec=date("d/m/Y",time());?></th>
				</thead>
		</table>
	<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>PAGO MES</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#BB8FCE>1001</th>
			</thead>	
			<tbody>
				<?php $zona=60; //VerActualizacion($zona); ?>
			</tbody>
	</table>		
			
		<p style="font-size:0.8em;"><b>PERICO - OFICINA</b><br>
				<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="50%" bgcolor=#ABEBC6>INDICES INICIO MES DE <?php echo VerMes();?></th>
				</thead>
			</table>	
			<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>AL DIA</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#BB8FCE>1001</th>
			</thead>
			<tbody>
				<?php $zona=5;//VerFacturacion($zona); ?>
			</tbody>
		</table>
		<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="50%" bgcolor=#ABEBC6>INDICES AL <?php echo $fec=date("d/m/Y",time());?></th>
				</thead>
		</table>
	<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>PAGO MES</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#BB8FCE>1001</th>
			</thead>	
			<tbody>
				<?php $zona=5;//VerActualizacion($zona); ?>
			</tbody>
	</table>		
			
		</p>
		<p style="font-size:0.8em;"><b>PALPALA - OFICINA</b><br>
				<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="50%" bgcolor=#ABEBC6>INDICES INICIO MES DE <?php echo VerMes();?></th>
				</thead>
			</table>	
			<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>AL DIA</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#BB8FCE>1001</th>
			</thead>
			<tbody>
				<?php $zona=3;//VerFacturacion($zona); ?>
			</tbody>
		</table>
		<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="50%" bgcolor=#ABEBC6>INDICES AL <?php echo $fec=date("d/m/Y",time());?></th>
				</thead>
		</table>
	<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE>PAGO MES</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#BB8FCE>1001</th>
			</thead>	
			<tbody>
				<?php $zona=3;//VerActualizacion($zona); ?>
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

function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
	}
    
}

function VerPerfil(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_perfil']);
	}
    
}


function VerFacturacion($zona){

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$archivo='SO'.$fch[1].$fch[2];
//$mes=VerMes();

$aldia=0;
$atrasado=0;
$moroso=0;
	$rows = SO::getSO(0,$archivo,$zona);

	
	foreach ($rows as $row) {
	
		$aldia=$aldia+1;
	}
	$rows = SO::getSO(1,$archivo, $zona);
	
	foreach ($rows as $row) {
	
		$atrasado=$atrasado+1;
	}
	switch ($zona) {
				case 1:$sucu='W'; break;
				case 3:$sucu='L';; break;
				case 5:$sucu='R';; break;
				case 60:$sucu='P';; break;
				default:break;
			}
	/*$rows = SO::getSO(2,$archivo, $sucu);
	
	foreach ($rows as $row) {
	
		$moroso=$moroso+1;
	}*/
	
	echo "<tr>
			  <td style='text-align:center;'><b>".$aldia."  - 100%</b></td>	
			  <td style='text-align:center;'><b>".$atrasado." - 100%</b></td>
			  <td style='text-align:center;'><b>".$moroso." - 100%</b></td>
			 
		     </tr>";
	    
}
function VerActualizacion($zona){

	$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$archivo='SO'.$fch[1].$fch[2];
//$mes=VerMes();

$aldia=0;
$atrasado=0;
$moroso=0;
$actdia=0;
$actatra=0;
$actmoro=0;
$cont_dia=0;
$cont_atra=0;
$cont_moro=0;
$dif_dia=0;
$dif_atra=0;
$dif_moro=0;

	$rows = SO::getSO(0,$archivo, $zona);

	foreach ($rows as $row) {
		
		$cont_dia=$cont_dia+1;
		$rows = Pagos::getPagos(6,$row['CONTRATO']);

		if($rows->rowCount()!=0){
		$actdia=$actdia+1;}
		else{echo $row['CONTRATO'].'-'.$row['CUOTA'].'<BR>';}
	}
	$rows = SO::getSO(1,$archivo,$zona);
		echo "<br>";
	foreach ($rows as $row) {
		$cont_atra=$cont_atra+1;
		$rows = Pagos::getPagos(6,$row['CONTRATO']);

		if($rows->rowCount()!=0){
		$actatra=$actatra+1;}
		else{echo $row['CONTRATO'].'-'.$row['CUOTA'].'<BR>';}
	}
	
	switch ($zona) {
				case 1:$sucu='W'; break;
				case 3:$sucu='L';; break;
				case 5:$sucu='R';; break;
				case 60:$sucu='P';; break;
				default:break;
			}

	/*$rows = SO::getSO(2,$archivo, $sucu);
		
	foreach ($rows as $row) {
		$cont_moro=$cont_moro+1;
		$rows = Pagos::getPagos(6,$row['CONTRATO']);

		if($rows->rowCount()!=0){
		$actmoro=$actmoro+1;}
	 }*/
	
	
	echo "<tr>
			  <td style='text-align:center;'><b>".$actdia."</b></td>	
			  <td style='text-align:center;'><b>".$actatra."</b></td>
			  <td style='text-align:center;'><b>".$actmoro."</b></td>
			 
		     </tr>";
	$dif_dia=$cont_dia-$actdia;
	$dif_atra=$cont_atra-$actatra;
	$dif_moro=$cont_moro-$actmoro;
	echo "<tr>
			  <td style='text-align:center;' bgcolor=#EC7063><b>Faltante: ".$dif_dia."</b></td>	
			  <td style='text-align:center;' bgcolor=#EC7063><b>Faltante: ".$dif_atra."</b></td>
			  <td style='text-align:center;' bgcolor=#EC7063><b>Faltante: ".$dif_moro."</b></td>
			 
		     </tr>";	     
	    
}

function VerPass(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return $row['usu_clave'];
	}
    
}

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
function VerMes(){
	
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	//echo $fch[1];
	switch ($fch[1]) {
				case '01':$mesl='ENERO';break;
				case '02':$mes='FEBRERO';break;
				case '03':$mes='MARZO';break;
				case '04':$mes='ABRIL';break;
				case '05':$mes='MAYO';break;
				case '06':$mes='JUNIO';break;
				case '07':$mes='JULIO';break;
				case '08':$mes='AGOSTO';break;
				case '09':$mes='SEPTIEMBRE';break;
				case '10':$mes='OCTUBRE';break;
				case '11':$mes='NOVIEMBRE';break;
				case '12':$mes='DICIEMBRE';break;
            	default:break;
       	}
    return $mes;
	
}

?>
