<?php
   set_time_limit(800);
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/maestro.class.php";
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
	<title>Evolución Cartera de Afiliados</title>
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
		
		<div id="doctip"><h1>Evolución Cartera de Afiliados desde Enero 2018 </h1></div>

		<form action="" id="formulario" action="" >
		
		<p style="font-size:0.8em;"><b>CARTERA GENERAL - INICIO MES 
		</b><br>

		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="10%" bgcolor=#BB8FCE>MES</th>
				<th widt="15%" bgcolor=#BB8FCE>TITULARES</th>
				<th widt="15%" bgcolor=#BB8FCE>ADHERENTES</th>
				<th widt="15%" bgcolor=#BB8FCE>ING_CUOTA</th>
						
			</thead>
			<tbody>
				<?php  Ver(); ?>
			</tbody>
		</table>
	</p>
	<p>
<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="10%" bgcolor=#ABEBC6>MES</th>
				<th widt="15%" bgcolor=#ABEBC6>ALTAS</th>
				<th widt="15%" bgcolor=#ABEBC6>RECUP</th>
				<!--<th widt="15%" bgcolor=#BB8FCE>ING_CUOTA</th>-->
				<th widt="15%" bgcolor=#ABEBC6>BAJAS</th>
				<th widt="15%" bgcolor=#ABEBC6>1001</th>
				<th widt="15%" bgcolor=#ABEBC6>ALTAS NETAS(alt+rec)-(baj+1001)</th>
						
			</thead>
			<tbody>
				<?php Ver2(); ?>
			</tbody>
		</table>
</p>
	
		<!--<p 	style="font-size:0.8em;"><b>ACTIVOS - <?php // echo VerActivos(); ?></b><br>	
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="15%" bgcolor=#BB8FCE> </th>
				<th widt="15%" bgcolor=#BB8FCE>TOTAL</th>
				<th widt="15%" bgcolor=#BB8FCE>MES ACTUAL CANCELADO</th>
				<th widt="15%" bgcolor=#BB8FCE>AL DIA</th>
				<th widt="15%" bgcolor=#ABEBC6>PAGOS AL DIA</th>
				<th widt="15%" bgcolor=#85C1E9>DIFERENCIA</th>
				<th widt="20%" bgcolor=#BB8FCE>ATRASADOS</th>
				<th widt="15%" bgcolor=#ABEBC6>PAGOS ATRASADOS</th>
				<th widt="15%" bgcolor=#85C1E9>DIFERENCIA</th>
			
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
		</p>-->

	<p><input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'index.php'"></p>		
</form>
	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php
function VerPerfil(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_perfil']);
	}
    
}
function VerActivos(){
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$anio=$fch[2];
	$tot=null;
	$totpesos=0;
	$archivo='SO'.$fch[1].$fch[2];
	$rows = SO::getSO(8,$archivo,0);
	
	//$tot=$rows->rowCount();
	foreach ($rows as $row) {
	$tot=$tot+1;
	$totpesos=$totpesos + ($row['CUOTA']*$row['DEUDA']);
	}

	return $tot.' Afiliados -  $'.$totpesos;
    
}

function VerPasivos(){
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$anio=$fch[2];
	$tot=null;
	$totpesos=0;
	$archivo='SO'.$fch[1].$fch[2];
	$rows = SO::getSO(6,$archivo,0);
	
	foreach ($rows as $row) {
	$tot=$tot+1;
	$totpesos=$totpesos + ($row['CUOTA']*$row['DEUDA']);
	}

	return $tot.' Afiliados -  $'.$totpesos;
    
}
function VerInfoPasivos($sucu){
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$anio=$fch[2];
	$tot=null;
	$sucu1='';
	$totpesos=0;
	$actual=0;
	$pesosactual=0;
	$poractual=0;
	$dif=0;
    $difpesos=0;
    $difpor=0;
	$archivo='SO'.$fch[1].$fch[2];


	$rows = SO::getSO(6,$archivo,0);
	$generalp=$rows->rowCount();
	
	$rows = SO::getSO(16,$archivo,$sucu);
	
	foreach ($rows as $row) {
	$tot=$tot+1;
	$totpesos=$totpesos + ($row['CUOTA']*$row['DEUDA']);
	$contrato=$row['CONTRATO'];
	$grupo=$row['GRUPO'];
	//if ($grupo==1000){
	$rowp = Pagos::getPagos(6,$contrato);
	if($rowp->rowCount()!=0){
	/*	}
	else{$rowp = Pagos::getPagos(7,$contrato);}	*/
		foreach ($rowp as $ro) {
			$actual=$actual+1;
			$pesosactual=$pesosactual + $ro['IMPORTE'];
		}
	}	
	
	/*$rowb = Pagos::getPagos(10,$contrato);
	if($rowb->rowCount()!=0){
		foreach ($rowb as $rob) {
			$actual=$actual+1;
			$pesosactual=$pesosactual + $rob['IMPORTE'];
			ECHO $contrato;
		}
	}*/	

	$poractual=($actual*100)/$generalp;
	$poractual=round($poractual,2);
	}

	$porcentaje=($tot*100)/$generalp;
    $porcentaje=round($porcentaje,2);

    $dif=$tot-$actual;
    $difpesos=$totpesos-$pesosactual;
    $difpor=$porcentaje-$poractual;

    switch ($sucu) {
				case 'W':$sucu1='JUJUY'; break;
				case 'L':$sucu1='PALPALA'; break;
				case 'R':$sucu1='PERICO'; break;
				case 'P':$sucu1='SAN PEDRO'; break;
				default:break;
			}

	if (isset($_REQUEST['btn_ver'])){
		switch ($_REQUEST['vista']) {
			case 1: echo "<tr>
	<td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>
	<td style='text-align:center;' ><b>$ ".$totpesos."</b></td>
	<td style='text-align:center;' ><b>$ ".$pesosactual."</b></td>
	<td style='text-align:center;' ><b>$ ".$difpesos."</b></td>	
	
</tr>";break;
			case 2: echo "<tr>
	<td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>
	<td style='text-align:center;' ><b>".$porcentaje." %</b></td>
	<td style='text-align:center;' ><b>".$poractual." %</b></td>
	<td style='text-align:center;' ><b>".$difpor." %</b></td>	
	
</tr>";break;
			case 3: echo "<tr>
	<td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>
	<td style='text-align:center;' ><b>".$tot."</b></td>
	<td style='text-align:center;' ><b>".$actual."</b></td>
	<td style='text-align:center;' ><b>".$dif."</b></td>	
	
</tr>";break;
			case 4: echo "<tr>
	<td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>
	<td style='text-align:center;' ><b>".$tot.' - $'.$totpesos.' - '.$porcentaje." %</b></td>
	<td style='text-align:center;' ><b>".$actual.' - $'.$pesosactual.' - '.$poractual." %</b></td>
	<td style='text-align:center;' ><b>".$dif.' - $'.$difpesos.' - '.$difpor." %</b></td>	
	
</tr>";break;
			default: break;
		}	
	}		
	else{				

    echo "<tr>
	<td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>
	<td style='text-align:center;' ><b>".$tot.' - $'.$totpesos.' - '.$porcentaje." %</b></td>
	<td style='text-align:center;' ><b>".$actual.' - $'.$pesosactual.' - '.$poractual." %</b></td>
	<td style='text-align:center;' ><b>".$dif.' - $'.$difpesos.' - '.$difpor." %</b></td>	
	
</tr>";	}
}

function Totales2(){
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$anio=$fch[2];
	$archivo='SO'.$fch[1].$fch[2];
	$dif=0;
    $difpesos=0;
    $difpor=0;
    $pagos=0;
	$totalpago=0;
	$porcenpago=0;
	$cantidad=0;
	$total=0;
	$porcentaje=0;

	$rows = SO::getSO(6,$archivo,0);
	$general=$rows->rowCount();

	$rows = SO::getSO(6,$archivo,0);
	foreach ($rows as $row) {
		$cantidad=$cantidad+1;
		$total=$total+($row['CUOTA']*$row['DEUDA']);
		$contrato=$row['CONTRATO'];
		$rowp = Pagos::getPagos(6,$contrato);
		foreach ($rowp as $ro) {
			$pagos=$pagos+1;
			$totalpago=$totalpago + $ro['IMPORTE'];
		}	
		$porcenpago=($pagos*100)/$general;
		$porcenpago=round($porcenpago,2);
	}
		$porcentaje=($cantidad*100)/$general;
		$porcentaje=round($porcentaje,2);

	   	$dif=$cantidad-$pagos;
    	$difpesos=$total-$totalpago;
    	$difpor=$porcentaje-$porcenpago;
    if (isset($_REQUEST['btn_ver'])){
		switch ($_REQUEST['vista']) {
			case 1:echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>$ ".$totalpago."</b></td>	
			  <td style='text-align:center;' bgcolor=#85C1E9><b>$ ".$difpesos."</b></td>	
	</tr>";break;
			case 2:echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$porcenpago." %</b></td>	
			  <td style='text-align:center;' bgcolor=#85C1E9><b>". $difpor." %</b></td>	
	</tr>";break;
			case 3:echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$pagos."</b></td>	
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$dif."</b></td>	
	</tr>";break;
			case 4: echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$pagos.' - $'.$totalpago.' - '.$porcenpago."%</b></td>	
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$dif.' - $'.$difpesos.' - '.$difpor."%</b></td>	
	</tr>";break;
			defaul: break;
		}	
	}
	else{		
	echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$pagos.' - $'.$totalpago.' - '.$porcenpago."%</b></td>	
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$dif.' - $'.$difpesos.' - '.$difpor."%</b></td>	
	</tr>";}
}

function Totales(){
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$anio=$fch[2];
	$archivo='SO'.$fch[1].$fch[2];
	$tot=null;
	$totpesos=0;
	$cancelado=0;
	$deuda=0;
	$dia=0;
	$totdia=0;
	$totdeuda=0;
	$totcancel=0;
	$porcentaje=0;
	$pordia=0;
	$pordeuda=0;
	$actdeuda=0;
	$pesosactdeuda=0;
	$actdia=0;
	$pesosactdia=0;
	$poractdeuda=0;
	$poractdia=0;
	$difdia=0;
	$difdeuda=0;
	$tot1=0;
	$tot2=0;
	$tot3=0;
	$tot4=0;

	$rows = SO::getSO(8,$archivo,0);
	$general=$rows->rowCount();

	$rows = SO::getSO(13,$archivo,0);
	foreach ($rows as $row) {
	$cancelado=$cancelado+1;
	$totcancel=$totcancel + $row['CUOTA'];
	}
	$porcentaje=($cancelado*100)/$general;
	$porcentaje=round($porcentaje,2);

	$rows = SO::getSO(14,$archivo,0);
	foreach ($rows as $row) {
	$dia=$dia+1;
	$totdia=$totdia + $row['CUOTA'];
	$contrato=$row['CONTRATO'];
	$grupo=$row['GRUPO'];
	if ($grupo==1000){$rowp = Pagos::getPagos(6,$contrato);}
	else{$rowp = Pagos::getPagos(7,$contrato);}	
	foreach ($rowp as $ro) {
		$actdia=$actdia+1;
		$pesosactdia=$pesosactdia + $ro['IMPORTE'];
	}	
	$poractdia=($actdia*100)/$general;
	$poractdia=round($poractdia,2);
	}
	$pordia=($dia*100)/$general;
	$pordia=round($pordia,2);
	
	$rows = SO::getSO(15,$archivo,0);
	foreach ($rows as $row) {
	$deuda=$deuda+1;
	$totdeuda=$totdeuda + $row['CUOTA'];
	$contrato=$row['CONTRATO'];
	$grupo=$row['GRUPO'];
	if ($grupo==1000){$rowp = Pagos::getPagos(6,$contrato);}
	else{$rowp = Pagos::getPagos(7,$contrato);}	
	foreach ($rowp as $ro) {
		$actdeuda=$actdeuda+1;
		$pesosactdeuda=$pesosactdeuda + $ro['IMPORTE'];
	}	
	$poractdeuda=($actdeuda*100)/$general;
	$poractdeuda=round($poractdeuda,2);
	}
	$pordeuda=($deuda*100)/$general;
	$pordeuda=round($pordeuda,2);

	$difdia=$dia-$actdia;
	$difdeuda=$deuda-$actdeuda;
	$tot1=$totdia-$pesosactdia;
	$tot2=$totdeuda-$pesosactdeuda;
	$tot3=$pordia-$poractdia;
	$tot4=$pordeuda-$poractdeuda;
	if (isset($_REQUEST['btn_ver'])){
		switch ($_REQUEST['vista']) {
			case 1:
			echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>$ ".$totcancel."</b></td>		
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>$ ".$totdia."</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>$ ".$pesosactdia."</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>$ ".$tot1."</b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>$ ".$totdeuda."</b></td>
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>$ ".$pesosactdeuda."</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>$ ".$tot2."</b></td>
			 </tr>";break;
			 case 2:
			 echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$porcentaje." %</b></td>		
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$pordia." %</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$poractdia." %</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$tot3."</b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$pordeuda."</b></td>
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$poractdeuda." %</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$tot4." %</b></td>
			 </tr>";break;
			 case 3:
			 echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$cancelado."</b></td>		
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$dia."</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$actdia."</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$difdia."</b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$deuda."</b></td>
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$actdeuda."</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$difdeuda."</b></td>
			 </tr>";break;
			 case 4:
			 echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$cancelado.' - $'.$totcancel.' - '.$porcentaje."%</b></td>		
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$dia.' - $'.$totdia.' - '.$pordia."%</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$actdia.' - $'.$pesosactdia.' - '.$poractdia."%</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$difdia.' - $'.$tot1.' - '.$tot3."%</b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$deuda.' - $'.$totdeuda.' - '.$pordeuda."%</b></td>
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$actdeuda.' - $'.$pesosactdeuda.' - '.$poractdeuda."%</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$difdeuda.' - $'.$tot2.' - '.$tot4."%</b></td>
			 </tr>";break;
			 default: break;


		}
	}
	else{	
		echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b></b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>TOTALES</b></td>	
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$cancelado.' - $'.$totcancel.' - '.$porcentaje."%</b></td>		
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$dia.' - $'.$totdia.' - '.$pordia."%</b></td>	
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$actdia.' - $'.$pesosactdia.' - '.$poractdia."%</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$difdia.' - $'.$tot1.' - '.$tot3."%</b></td>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$deuda.' - $'.$totdeuda.' - '.$pordeuda."%</b></td>
			  <td style='text-align:center;' bgcolor=#ABEBC6><b>".$actdeuda.' - $'.$pesosactdeuda.' - '.$poractdeuda."%</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$difdeuda.' - $'.$tot2.' - '.$tot4."%</b></td>
			 </tr>";
	}	     
}	

function VerFacturacion($sucu){

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$archivo='SO'.$fch[1].$fch[2];
//$mes=VerMes();
$aldia=0;
$atrasado=0;
$cancelado=0;
$total=0;
$pesostotal=0;
$pesoscancel=0;
$pesosaldia=0;
$pesosatra=0;
$sucu1=null;
$porcancel=null;
$poraldia=null;
$poratra=null;
$poraldia2=null;
$poratra2=null;
$general=0;
$porcentaje=0;
$actatra=0;
$pesosactatra=0;
$actaldia=0;
$pesosactaldia=0;
$dif1=0;
$dif2=0;
$pesos1=0;
$pesos2=0;
$por1=0;
$por2=0;
//echo $archivo;
$rows = SO::getSO(8,$archivo,0);
$general=$rows->rowCount();

	$rows = SO::getSO(9,$archivo,$sucu);//total

	foreach ($rows as $row) {
	$total=$total+1;
		if ($row['DEUDA']>0){$pesostotal=$pesostotal + ($row['CUOTA']*$row['DEUDA']);}
		else{$pesostotal=$pesostotal + $row['CUOTA'];}

	}
	$porcentaje=($total*100)/$general;
	$porcentaje=round($porcentaje,2);
	//echo $sucu;
	$rows = SO::getSO(10,$archivo,$sucu);//mes cancelado

	foreach ($rows as $row) {
	$cancelado=$cancelado+1;
	$pesoscancel=$pesoscancel + $row['CUOTA'];
	}
	$porcancel=($cancelado*100)/$general;
	$porcancel=round($porcancel,2);

	$rows = SO::getSO(11,$archivo,$sucu);//al dia

	foreach ($rows as $row) {
		$aldia=$aldia+1;
		$pesosaldia=$pesosaldia + ($row['CUOTA']*$row['DEUDA']);
		$grupo=$row['GRUPO'];
		$contrato=$row['CONTRATO'];
		if ($grupo==1000){$rowp = Pagos::getPagos(6,$contrato);}
		else{
			$rowp = Pagos::getPagos(7,$contrato);}
			foreach ($rowp as $ro) {
				$actaldia=$actaldia+1;
				$pesosactaldia=$pesosactaldia + $ro['IMPORTE'];
			}
	}
	$poraldia=($aldia*100)/$general;
	$poraldia=round($poraldia,2);
	$poraldia2=($actaldia*100)/$general;
	$poraldia2=round($poraldia2,2);

	$rows = SO::getSO(12,$archivo,$sucu);//atrasado

	foreach ($rows as $row) {
		$atrasado=$atrasado+1;
		$pesosatra=$pesosatra + ($row['CUOTA']*$row['DEUDA']);
		$grupo=$row['GRUPO'];
		$contrato=$row['CONTRATO'];
		if ($grupo==1000){$rowp = Pagos::getPagos(6,$contrato);}
		else{
			$rowp = Pagos::getPagos(7,$contrato);}
			foreach ($rowp as $ro) {
				$actatra=$actatra+1;
				$pesosactatra=$pesosactatra + $ro['IMPORTE'];
			}
	}
	$poratra=($atrasado*100)/$general;
	$poratra=round($poratra,2);
	$poratra2=($actatra*100)/$general;
	$poratra2=round($poratra2,2);
	$dif1=$aldia-$actaldia;
	$dif2=$atrasado-$actatra;
	$pesos1=$pesosaldia-$pesosactaldia;
	$pesos2=$pesosatra-$pesosactatra;
	$por1=$poraldia-$poraldia2;
	$por2=$poratra-$poratra2;

	switch ($sucu) {
				case 'W':$sucu1='JUJUY'; break;
				case 'L':$sucu1='PALPALA'; break;
				case 'R':$sucu1='PERICO'; break;
				case 'P':$sucu1='SAN PEDRO'; break;
				default:break;
			}
	
//$porpas=round($porpas,2);
if (isset($_REQUEST['btn_ver'])){
	switch ($_REQUEST['vista']) {
	case 1:
	echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>	
			  <td style='text-align:center;'><b>$ ".$pesostotal."</b></td>		
			  <td style='text-align:center;'><b>$ ".$pesoscancel."</b></td>	
			  <td style='text-align:center;'><b>$ ".$pesosaldia."</b></td>
			  <td style='text-align:center;'><b>$ ".$pesosactaldia."</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>$ ".$pesos1."</b></td>
			  <td style='text-align:center;'><b>$ ".$pesosatra."</b></td>
			  <td style='text-align:center;'><b>$ ".$pesosactatra."</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>$ ".$pesos2."</b></td>
			 
		     </tr>";break;
	case 2:	     
	echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>	
			  <td style='text-align:center;'><b>".$porcentaje." %</b></td>		
			  <td style='text-align:center;'><b>".$porcancel." %</b></td>	
			  <td style='text-align:center;'><b>".$poraldia." %</b></td>
			  <td style='text-align:center;'><b>".$poraldia2." %</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$por1." %</b></td>
			  <td style='text-align:center;'><b>".$poratra." %</b></td>
			  <td style='text-align:center;'><b>".$poratra2." %</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b>".$por2." %</b></td>
			 
		     </tr>";break;	     
	case 3:	 
	echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>	
			  <td style='text-align:center;'><b>".$total."</b></td>		
			  <td style='text-align:center;'><b>".$cancelado."</b></td>	
			  <td style='text-align:center;'><b>".$aldia."</b></td>
			  <td style='text-align:center;'><b>".$actaldia."</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b> ".$dif1."</b></td>
			  <td style='text-align:center;'><b>".$atrasado."</b></td>
			  <td style='text-align:center;'><b> ".$actatra."</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b> ".$dif2."</b></td>
			 		     </tr>";break;  
	case 4:  
	echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>	
			  <td style='text-align:center;'><b>".$total.' - $'.$pesostotal.' - '.$porcentaje."%</b></td>		
			  <td style='text-align:center;'><b>".$cancelado.' - $'.$pesoscancel.' - '.$porcancel."%</b></td>	
			  <td style='text-align:center;'><b>".$aldia.' - $'.$pesosaldia.' - '.$poraldia."%</b></td>
			  <td style='text-align:center;'><b>".$actaldia.' - $'.$pesosactaldia.' - '.$poraldia2."%</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b> ".$dif1.' - $'.$pesos1.' - '.$por1."%</b></td>
			  <td style='text-align:center;'><b>".$atrasado.' - $'.$pesosatra.' - '.$poratra."%</b></td>
			  <td style='text-align:center;'><b> ".$actatra.' - $'.$pesosactatra.' - '.$poratra2."%</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b> ".$dif2.' - $'.$pesos2.' - '.$por2."%</b></td>
			 		     </tr>";break;
	default: break;
	}	     
}
else{
	echo "<tr>
			  <td style='text-align:center;' bgcolor=#BB8FCE><b>".$sucu1."</b></td>	
			  <td style='text-align:center;'><b>".$total.' - $'.$pesostotal.' - '.$porcentaje."%</b></td>		
			  <td style='text-align:center;'><b>".$cancelado.' - $'.$pesoscancel.' - '.$porcancel."%</b></td>	
			  <td style='text-align:center;'><b>".$aldia.' - $'.$pesosaldia.' - '.$poraldia."%</b></td>
			  <td style='text-align:center;'><b>".$actaldia.' - $'.$pesosactaldia.' - '.$poraldia2."%</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b> ".$dif1.' - $'.$pesos1.' - '.$por1."%</b></td>
			  <td style='text-align:center;'><b>".$atrasado.' - $'.$pesosatra.' - '.$poratra."%</b></td>
			  <td style='text-align:center;'><b> ".$actatra.' - $'.$pesosactatra.' - '.$poratra2."%</b></td>
			  <td style='text-align:center;' bgcolor=#85C1E9><b> ".$dif2.' - $'.$pesos2.' - '.$por2."%</b></td>
			 		     </tr>";
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
function VerMes($mes){
	
	/*$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];*/
	//echo $fch[1];
	switch ($mes) {
				case '01':$mes='ENERO';break;
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


Function Ver(){

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$inicio=1;
$general=null;

while($inicio<=$fch[1]){

	$general=0;
	$total_pesos=0;
	$total_adh=0;

	if ($inicio<=9){$archivo='so0'.$inicio.$fch[2];}
	else{$archivo='so'.$inicio.$fch[2];}	
	
	$rows = SO::getSO(8,$archivo,0);
	$general=$rows->rowCount();
	
	//$rows = SO::getSO(8,$archivo,0);
	/*$contador = $rows->fetch();
	/*$row = $rows->fetch();*/
	//echo $contador;*/
	/**llllforeach ($rows as $row) {
		$total_pesos=$total_pesos+$row['CUOTA'];
	}**/
	$rows = SO::getSO(19,$archivo,0);
	$row = $rows->fetch();
	//$total_adh=$rows->rowCount();
	//$row = mysql_fetch_array($result, MYSQL_ASSOC);
     $total_adh=$row["total"];


	$rows = SO::getSO(20,$archivo,0);
	$row = $rows->fetch();
	//$total_adh=$rows->rowCount();
	//$row = mysql_fetch_array($result, MYSQL_ASSOC);3
     $total_pesos=$row["totalp"];
      $total_pesos=round($total_pesos,2);
	/*foreach ($rows as $row) {
		$total_adh=$total_adh+1;
	}*/

	$mes=VerMes($inicio);
	$mes=$mes.'-'.$anio;
	
	echo "<tr>
			  <td bgcolor=#BB8FCE><b>".$mes."</b></td>
			  <td style='text-align:center;'><b>".$general."</b></td>
			  <td style='text-align:center;'><b>".$total_adh."</b></td>
			  			  <td '><b>$ ".$total_pesos."</b></td>
	</tr>";
	
	$inicio=$inicio+1;
}


}

Function Ver2(){

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$inicio=1;
$general=null;
$total_1001=null;
$neto_vta=null;

while($inicio<=$fch[1]){

	$general=null;
	$total_bajas=0;
	$total_alta=0;
	$total_adh=null;
	if ($inicio<=9){$desde='2018-0'.$inicio.'-01';$hasta='2018-0'.$inicio.'-31';
	}
	else{$desde='2018-'.$inicio.'-01';$hasta='2018-'.$inicio.'-31';}
	$rows = Maestro::getMaestro2(6,$desde,$hasta);
	$total_alta=$rows->rowCount();
	$rows = Maestro::getMaestro2(5,$desde,$hasta);
	$total_bajas=$rows->rowCount();
	$rows = Maestro::getMaestro2(5,$desde,$hasta);
	$total_bajas=$rows->rowCount();

	/*$rows = Maestro::getMaestro2(2,$desde,$hasta);
	$general=$rows->rowCount();
	
	/*$rows = SO::getSO(8,$archivo,0);
	/*$contador = $rows->fetch();
	/*$row = $rows->fetch();*/
	//echo $contador;*/
	/*foreach ($rows as $row) {
		$total_pesos=$total_pesos+$row['CUOTA'];
	}
	$rows = SO::getSO(18,$archivo,0);
	
	foreach ($rows as $row) {
		$total_adh=$total_adh+1;
	}
*/
	$mes=VerMes($inicio);
	$mes=$mes.'-'.$anio;
	//$neto_vta=$tot1-$tot2;
	echo "<tr>
			  <td bgcolor=#ABEBC6><b>".$mes."</b></td>
			  <td style='text-align:center;'><b>".$total_alta."</b></td>
			  <td style='text-align:center;'><b>".$total_adh."</b></td>
			  <td style='text-align:center;'><b>".$total_bajas."</b></td>
			  <td style='text-align:center;'><b>".$total_1001."</b></td>
			  <td style='text-align:center;'><b>".$neto_vta."</b></td>
	</tr>";
	
	$inicio=$inicio+1;
}


}

?>
