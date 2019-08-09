<?php
   set_time_limit(800);
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/maestro.class.php";
   include "libs/class/SO.class.php";
   include "libs/class/Otro.class.php";
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
	<title>Efectividad de Cobranza</title>
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
		
		<div id="doctip"><h1>EFECTIVIDAD DE COBRANZA <?php echo TraerMes(); 
		$hora= date ("h:i:s");
$fecha = date("d/m/Y",time()); ECHO '  AL '.$fecha.' '.$hora; ?> </h1></div>

		<form action="" id="formulario" action="" >
		
		<p style="font-size:0.8em;"><b>OFICINA
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="10%" bgcolor=#5DADE2>ZONA</th>
				<th widt="10%" bgcolor=#5DADE2>OFICINA</th>
				<th widt="15%" bgcolor=#5DADE2>EMITIDOS</th>
				<th widt="15%" bgcolor=#5DADE2>EMIT-COBR</th>
				<th widt="15%" bgcolor=#5DADE2>EMIT-ANU</th>
				<th widt="15%" bgcolor=#5DADE2>MAN-COBR</th>
				<th widt="15%" bgcolor=#5DADE2>COB-ADEL</th>
				<th widt="15%" bgcolor=#5DADE2>SIN COBRAR</th>
				<th widt="15%" bgcolor=#5DADE2>TOTAL COBRADO</th>
				<th widt="15%" bgcolor=#5DADE2>%</th>
				<th widt="15%" bgcolor=#5DADE2>FICHAS</th>
				<th widt="15%" bgcolor=#5DADE2>FIC-COB</th>
			</thead>
			<tbody>
				<?php  $ofi=1;VerOficina($ofi);
				$ofi=3;VerOficina($ofi);
				//$ofi=5;VerOficina($ofi);
				//$ofi=60;VerOficina($ofi);
				//VerTotales2();
				?>
			
			</tbody>
		</table>
</p>	
		<p style="font-size:0.8em;"><b>COBRADORES
		</b><br>

		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="10%" bgcolor=#BB8FCE>ZONA</th>
				<th widt="15%" bgcolor=#BB8FCE>COBRADOR</th>
				<th widt="15%" bgcolor=#BB8FCE>EMITIDOS</th>
				<th widt="15%" bgcolor=#BB8FCE>EMIT-COBR</th>
				<th widt="15%" bgcolor=#BB8FCE>EMIT-ANUL</th>
				<th widt="15%" bgcolor=#BB8FCE>SIN COBRAR</th>
				<th widt="15%" bgcolor=#BB8FCE>TOT-COB</th>
				<th widt="15%" bgcolor=#BB8FCE>%</th>
				<th widt="15%" bgcolor=#BB8FCE>FICHAS</th>
				<th widt="15%" bgcolor=#BB8FCE>FIC-COB</th>
						
			</thead>
			<tbody>
				<?php  //Ver(); ?>
			</tbody>

		</table>
	</p>
	<p style="font-size:0.8em;"><b>BANCO
	
<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="10%" bgcolor=#ABEBC6>ZONA</th>
				<th widt="10%" bgcolor=#ABEBC6>BANCO</th>
				<th widt="15%" bgcolor=#ABEBC6>EMITIDOS</th>
				<th widt="15%" bgcolor=#ABEBC6>SIN COBRAR</th>
				<!--<th widt="15%" bgcolor=#BB8FCE>ING_CUOTA</th>-->
				<th widt="15%" bgcolor=#ABEBC6>TOTAL COBRADO</th>
				<th widt="15%" bgcolor=#ABEBC6>%</th>
				<th widt="15%" bgcolor=#ABEBC6>FICHAS</th>
				<th widt="15%" bgcolor=#ABEBC6>FIC-COB</th>
				<th widt="15%" bgcolor=#ABEBC6>%</th>
			</thead>
			<tbody>
				<?php $cvnio=10666;VerBanco($cvnio);
				$cvnio=3400;VerBanco($cvnio);
				$cvnio=3600;VerBanco($cvnio);
				$cvnio=3700;VerBanco($cvnio);
				$cvnio=3800;VerBanco($cvnio);
				$cvnio=3900;VerBanco($cvnio);
				$cvnio=4000;VerBanco($cvnio); 
				VerTotales();
				?>
			</tbody>
		</table>
</p>
<p style="font-size:0.8em;"><b>OTROS
<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="10%" bgcolor=#E74C3C>ZONA</th>
				<th widt="10%" bgcolor=#E74C3C>BANCO</th>
				<th widt="15%" bgcolor=#E74C3C>EMITIDOS</th>
				<th widt="15%" bgcolor=#E74C3C>SIN COBRAR</th>
				<th widt="15%" bgcolor=#E74C3C>TOTAL COBRADO</th>
				<th widt="15%" bgcolor=#E74C3C>%</th>
				<th widt="15%" bgcolor=#E74C3C>FICHAS</th>
				<th widt="15%" bgcolor=#E74C3C>FIC-COB</th>
			</thead>
			<tbody>
				<?php VerOtro();?>
			</tbody>
		</table>
</p>
<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="10%" bgcolor=yellow></th>
				<th widt="10%" bgcolor=yellow></th>
				<th widt="15%" bgcolor=yellow></th>
				<th widt="15%" bgcolor=yellow></th>
				<th widt="15%" bgcolor=yellow></th>
				<th widt="15%" bgcolor=yellow></th>
				<th widt="15%" bgcolor=yellow></th>
				<th widt="15%" bgcolor=yellow></th>
			</thead>
			<tbody>
				<?php //Ver2(); ?>
			</tbody>
		</table>
			

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
function TraerMes(){
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	switch ($fch[1]) {
				case 1:$mesac='ENERO'; break;
				case 2:$mesac='FEBRERO'; break;
				case 3:$mesac='MARZO'; break;
				case 4:$mesac='ABRIL'; break;
				case 5:$mesac='MAYO'; break;
				case 6:$mesac='JUNIO'; break;
				case 7:$mesac='JULIO'; break;
				case 8:$mesac='AGOSTO'; break;
				case 9:$mesac='SEPTIEMBRE'; break;
				case 10:$mesac='OCTUBRE'; break;
				case 11:$mesac='NOVIEMBRE'; break;
				case 12:$mesac='DICIEMBRE'; break;
				default:break;
	}
	return $mesac.' - '.$fch[2];
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
function VerBanco($cvnio){
	//$cvnio=null;
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];

	switch ($cvnio) {
				case 10666:$nom='BANCO'; break;
				case 3400:$nom='CREDICASH'; break;
				case 3600:$nom='CREDIMAS'; break;
				case 3700:$nom='NARANJA'; break;
				case 3800:$nom='NEVADA'; break;
				case 3900:$nom='SUCREDITO'; break;
				case 4000:$nom='VISA'; break;

				default:break;
			}


	if ($fch[1]<=9){$archivo='banco'.$fch[1].$fch[2];}
	else{$archivo='banco'.$fch[1].$fch[2];}
		
	$rows = Otro::getOtro(0,$archivo,$cvnio);
	$can_bco=$rows->rowCount();	
	
	$rows = Otro::getOtro(1,$archivo,$cvnio);
	$row = $rows->fetch();
	$total_bco=$row["total"];

	$archivo='deb_peso'.$fch[1].$fch[2];
	$rows = Otro::getOtro(0,$archivo,$cvnio);
	$can_bco_efec=$rows->rowCount();	

	$rows = Otro::getOtro(1,$archivo,$cvnio);
	$row = $rows->fetch();
	$total_bco_efec=$row["total"];

	$por_ficha=($can_bco_efec*100)/$can_bco;
	$por_ficha=round($por_ficha,2);

	$sincobrar=$total_bco-$total_bco_efec;
	$por_pesos=($total_bco_efec*100)/$total_bco;
	$por_pesos=round($por_pesos,2);

	echo "<tr>
			  <td ><b>".$cvnio."</b></td>
			  <td ><b>".$nom."</b></td>
			  <td ><b>$ ".$total_bco."</b></td>
			  <td ><b>$ ".$sincobrar."</b></td>
			  <td ><b>$ ".$total_bco_efec."</b></td>
			  <td style='text-align:center;'><b>".$por_pesos."</b></td>
			  <td style='text-align:center;'><b>".$can_bco."</b></td>
			  <td style='text-align:center;'><b>".$can_bco_efec."</b></td>
			  <td style='text-align:center;'><b>".$por_ficha."</b></td>
	</tr>";

	
}

Function VerTotales(){
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	
	$archivo='banco'.$fch[1].$fch[2];

	$rows = Otro::getOtro(2,$archivo,0);
	$row = $rows->fetch();
	$total_bco=$row["total"];	

	$rows = Otro::getOtro(3,$archivo,0);
	$can_bco=$rows->rowCount();

	$archivo='deb_peso'.$fch[1].$fch[2];	
	$rows = Otro::getOtro(3,$archivo,0);
	$can_bco_efec=$rows->rowCount();	

	$rows = Otro::getOtro(2,$archivo,0);
	$row = $rows->fetch();
	$total_bco_efec=$row["total"];

	$sincobrar=$total_bco-$total_bco_efec;
	$por_pesos=($total_bco_efec*100)/$total_bco;
	$por_pesos=round($por_pesos,2);

	echo "<tr>
			  <td ><b></b></td>
			  <td style='text-align:center;'bgcolor=#ABEBC6><font color=red size=2><b></b>TOTALES</td>
			  <td bgcolor=#ABEBC6><font color=red size=2><b>$ ".$total_bco."</b></font></td>
			  <td bgcolor=#ABEBC6><font color=red size=2><b>$ ".$sincobrar."</b></font></td>
			  <td bgcolor=#ABEBC6><font color=red size=2><b>$ ".$total_bco_efec."</b></font></td>
			  <td style='text-align:center;'bgcolor=#ABEBC6><font color=red size=2><b>".$por_pesos."</b></font></td>
			  <td style='text-align:center;'bgcolor=#ABEBC6><font color=red size=2><b>".$can_bco."</b></font></td>
			  <td style='text-align:center;'bgcolor=#ABEBC6><font color=red size=2><b>".$can_bco_efec."</b></font></td>
			  
	</tr>";

}
function VerOficina($ofi){
	//$cvnio=null;
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$con=0;
	$tot_gral=0;
	$tot_p=0;
	$con_p=0;

	$archivo='SO'.$fch[1].$fch[2];
	
	switch ($ofi) {
				case 1:$nom='CASA CENTRAL'; break;
				case 3:$nom='PALPALA'; break;
				case 5:$nom='PERICO'; break;
				case 60:$nom='SANPEDRO'; break;
				default:break;
			}	

	/*if ($fch[1]<=9){$archivo='banco'.$fch[1].$fch[2];}
	else{$archivo='banco'.$fch[1].$fch[2];}*/
		
	$rows = SO::getSO(21,$archivo,$ofi);
	foreach ($rows as $row) {
		//$c=$c+1;
		$ban=0;
		 $tot=$row['CUOTA']*$row['DEUDA'];
		 $cuo=$row['CUOTA'];
		 $interes=($cuo*10)/100;
		 $cuo2=$cuo+round($interes);

		 $con=$con+1;
		 $mes=null;
		 $tot_gral=$tot_gral+$tot;
		 $afi=$row['CONTRATO'];
		 $rowsp = Pagos::getPagos(6,$afi);
		 	foreach ($rowsp as $rowp) {
		 		if (($rowp['IMPORTE']==$cuo)or($rowp['IMPORTE']==$cuo2)){
		 			$con_p=$con_p+1;
		 			$ban=1;
		 			$tot_p=$tot_p+$rowp['IMPORTE'];
		 			$mes=$rowp['MES'];
		 		}
		 	}
		if ($ofi<>1){
			$arch='pagos_'.strtolower($nom);
			$rowssp = Pagos::getPagos4(0,$arch,$afi);
		
		 	foreach ($rowssp as $rowsp) {
		 		if ((($rowsp['IMPORTE']==$cuo)or($rowsp['IMPORTE']==$cuo2))and($rowsp['MES']<>$mes)){
		 			if ($ban==0){$con_p=$con_p+1;}
		 			$tot_p=$tot_p+$rowsp['IMPORTE'];
		 		}
		 	}
		 
		}
	}	 
	$sincobrar=$tot_gral-$tot_p;

	/*$por_ficha=($can_bco_efec*100)/$can_bco;
	$por_ficha=round($por_ficha,2);*/

	$por_pesos=($tot_p*100)/$tot_gral;
	$por_pesos=round($por_pesos,2);

	echo "<tr>
			  <td ><b>".$ofi."</b></td>
			  <td ><b>".$nom."</b></td>
			  <td ><b>$ ".$tot_gral."</b></td>
			  <td ><b></b></td>
			  <td ><b></b></td>
			  <td ><b></b></td>
			  <td ><b></b></td>
			  <td ><b>$ ".$sincobrar."</b></td>
			  <td ><b>$ ".$tot_p."</b></td>
			  <td style='text-align:center;'><b>".$por_pesos."</b></td>
			  <td style='text-align:center;'><b>".$con."</b></td>
			  <td style='text-align:center;'><b>".$con_p."</b></td>
			  
	</tr>";

	
}
Function VerTotales2(){
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	
	$con=0;
	$tot_p=0;
	$con_p=0;
	$mes=null;
	$total=0;

	$archivo='SO'.$fch[1].$fch[2];
	
	$rows = SO::getSO(22,$archivo,0);
	foreach ($rows as $row) {
		$con_p=$con_p+1;
		$tot=$row['CUOTA']*$row['DEUDA'];
		$cuo=$row['CUOTA'];
		$tot_p=$tot_p+$tot;
		$afi=$row['CONTRATO'];
		$ban=0;
		$ofi=$row['ZONA'];
		switch ($ofi) {
				case 1:$nom='CASA CENTRAL'; break;
				case 3:$nom='PALPALA'; break;
				case 5:$nom='PERICO'; break;
				case 60:$nom='SANPEDRO'; break;
				default:break;
			}

		$rowsp = Pagos::getPagos(6,$afi);
		 	foreach ($rowsp as $rowp) {
		 		if ($rowp['IMPORTE']==$cuo){
		 			$con=$con+1;
		 			$ban=1;
		 			$total=$total+$rowp['IMPORTE'];
		 			$mes=$rowp['MES'];
		 		}
		 	}
		if ($ofi<>1){
			$arch='pagos_'.strtolower($nom);
			$rowssp = Pagos::getPagos4(0,$arch,$afi);
		
		 	foreach ($rowssp as $rowsp) {
		 		if (($rowsp['IMPORTE']==$cuo)and($rowsp['MES']<>$mes)){
		 			if ($ban==0){$con=$con+1;}
		 			$total=$total+$rowsp['IMPORTE'];
		 		}
		 	}
		 
		}

	}
	
	

	/*$row = $rows->fetch();
	$total_bco=$row["total"];	

	$rows = Otro::getOtro(3,$archivo,0);
	$can_bco=$rows->rowCount();

	$archivo='deb_peso'.$fch[1].$fch[2];	
	$rows = Otro::getOtro(3,$archivo,0);
	$can_bco_efec=$rows->rowCount();	

	$rows = Otro::getOtro(2,$archivo,0);
	$row = $rows->fetch();
	$total_bco_efec=$row["total"];*/

	$sincobrar=$tot_p-$total;
	$por_pesos=($total*100)/$tot_p;
	$por_pesos=round($por_pesos,2);

	echo "<tr>
			  <td ><b></b></td>
			  <td style='text-align:center;'bgcolor=#5DADE2><font color=red size=2><b>TOTALES</b></td>
			  <td bgcolor=#5DADE2><font color=red size=2><b>$ ".$tot_p."</b></font></td>
			  <td ><b></b></td>
			  <td ><b></b></td>
			  <td ><b></b></td>
			  <td ><b></b></td>
			  <td bgcolor=#5DADE2><font color=red size=2><b>$ ".$sincobrar."</b></font></td>
			  <td bgcolor=#5DADE2><font color=red size=2><b>$ ".$total."</b></font></td>
			  <td bgcolor=#5DADE2><font color=red size=2><b>".$por_pesos."</b></font></td>
			  <td style='text-align:center;'bgcolor=#5DADE2><font color=red size=2><b>".$con_p."</b></font></td>
			  <td style='text-align:center;'bgcolor=#5DADE2><font color=red size=2><b>".$con."</b></font></td>
			  
			  
	</tr>";
}
function VerOtro(){
	//$cvnio=null;
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];

	$archivo='de_pol'.$fch[1].$fch[2];
	//echo $archivo;
	$con=0;$tot=0;$tot_gral=0;
	/*if ($fch[1]<=9){$archivo='banco'.$fch[1].$fch[2];}
	else{$archivo='banco'.$fch[1].$fch[2];}*/
		
	$ofi=6;$nom='POLICIA';

	$rows = SO::getSO(7,$archivo,$ofi);
	$con=$rows->rowCount();	


	$rows = SO::getSO(25,$archivo,$ofi);
	$row = $rows->fetch();
	$tot_gral=$row["total"];
	/*foreach ($rows as $row) {
	
		$ban=0;
		 $tot=$row['CUOTA']*$row['DEUDA'];
		 $con=$con+1;
		 $tot_gral=$tot_gral+$tot;
	}*/	 

	$archivo='deb_peso'.$fch[1].$fch[2];
	$rows = Otro::getOtro(0,$archivo,$ofi);
	$can_pol_cob=$rows->rowCount();	

	$rows = Otro::getOtro(1,$archivo,$ofi);
	$row = $rows->fetch();
	$total_pol_cob=$row["total"];

	/*$por_ficha=($can_bco_efec*100)/$can_bco;
	$por_ficha=round($por_ficha,2);*/

	$sincobrar=$tot_gral-$total_pol_cob;
	$por_pesos=($total_pol_cob*100)/$tot_gral;
	$por_pesos=round($por_pesos,2);


	echo "<tr>
			  <td ><b>".$ofi."</b></td>
			  <td ><b>".$nom."</b></td>
			  <td ><b>$ ".$tot_gral."</b></td>
			  <td ><b>$ ".$sincobrar."</b></td>
			  <td ><b>$ ".$total_pol_cob."</b></td>
			  <td style='text-align:center;'><b>".$por_pesos."</b></td>
			  <td style='text-align:center;'><b>".$con."</b></td>
			  <td style='text-align:center;'><b>".$can_pol_cob."</b></td>
			  
	</tr>";

	
}
?>
