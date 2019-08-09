<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/sueldo.class.php"; 
include "libs/class/liquidacion.class.php"; 
include "libs/class/pagos.class.php"; 
include "libs/class/prestamo.class.php"; 

$desde=null; $hasta = null; $ingreso=0;$egreso=0;

$usu=$_SESSION["usu_ide"];
$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];

}

if (($perfil =='AUDITOR')OR($perfil =='ROOT')or($perfil =='RENDICION')){

	$desde=null; $hasta = null; $ingreso=0;$egreso=0;
	

	if (isset($_REQUEST['btn_ver'])){

		$desde=$_REQUEST['desde'];
		$hasta=$_REQUEST['hasta'];
		/*$recup=$_REQUEST['recup'];
		$nom=VerUsuario();*/
	}
}	

else{
	
	print '<script language="JavaScript">'; 
	print 'alert("NO ESTA HABILITADO PARA LA OPCION SOLICITADA");'; 
	print'</script>';
	print'<script type="text/javascript">
window.location="abm.php";
</script>';
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Resumen Liquidaciones</title>
	
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
		<div id="menu"><?php include "menu.php"; ?></div>
	</div>	
	<div id="contenido">
		<a href="abm.php" class="nl"><h1>RESUMEN LIQUIDACION MENSUAL</h1></a>
	<form action="" id="for_cns" action="" method="get" >
		<!--<input type="hidden" name="nom" value="<?php //echo $nom; ?>">-->
		Seleccionar Periodo 

		Desde:  <input type="date" name="desde" value="<?php echo $desde; ?>" size="8px">&nbsp;&nbsp;
        Hasta: <input type="date" name="hasta" value="<?php echo $hasta; ?>" size="8px">&nbsp;&nbsp;
		
		<input type="submit" name="btn_ver" value="Consultar">
		
		<br><br>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%">RECUPERADOR</th>
				<th widt="5%" bgcolor=#ABEBC6>INGRESOS</th>
				<th widt="5%" bgcolor='pink'>EGRESOS</th>
				<th widt="5%" bgcolor=#D5DBDB>%</th>
				<th widt="15%">PRESTAMOS</th>
				<th widt="10%">ACCIONES</th>
				<th widt="5%">CUOTAS</th>
				<th widt="5%" bgcolor=#BB8FCE>Comision 01</th>
				<th widt="5%" bgcolor=#BB8FCE>Comision 11</th>
				<th widt="5%" bgcolor=#BB8FCE>Comision 15</th>
				
				
			</thead>
			<tbody>
				<?php VerLiquidaciones($desde,$hasta); ?>
			</tbody>
	
		</table>
		
		
		<p>
			
			<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_exp" value="Exportar" onClick="JavaScript: location.href='cns-liqui-exp.php?recup=<?php echo $_GET['recup'];?>&desde=<?php echo $_GET['desde'];?>&hasta=<?php echo $_GET['hasta'];?>';" disabled>&nbsp;<input type="button" name="btn_rsm" value="Ver Recibos" onclick="location.href = 'resumen.php?desde=<?php echo $_REQUEST['desde'];?>&hasta=<?php echo $_REQUEST['hasta'];?>&btn_ver=Consultar'">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'abm.php'">
		</p>
		</form>
	</div>
	
	<div id="footer">
		<center>Werchow - Año 2018 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php

function VerBasico($recup){
	
	$ver='';
	/*$desde=$_REQUEST['desde'];
	$hasta=$_REQUEST['hasta'];*/
	$rows = Usuario::getUsuario(3,$recup);
	
	foreach ($rows as $row) {
		/*$recup=$row['usu_ide'];
		$rowsu = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);*/

		$ver= $row['usu_perfil'];
	}
	//$ver='RECUPERADOR';

	$rows = Sueldo::getSueldo(1,$ver);
	
	foreach ($rows as $row) {
	
		return $row['sld_basico'];
	}
}	
function VerComision($recup,$desde,$hasta){
	$total_rec=0;
	$subtotal=0;
	$cuo=0;
	$pcj=0;
	$total_bono=0;
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		$mesp=TraerMesPago($row['liq_socio'],$row['liq_recibo']);
		$grupo=TraerGrupo($row['liq_socio']);
		if  ($mesp<>''){$pp = explode("-",$mesp); 
		$mesp =$pp[0];
		$co9=$pp[1];}

		switch ($row['liq_accion']) {
            case 'AT1':$pcj=10;$cuo=$row['liq_cuotas'];$subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'AT2':$pcj=15; $cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'RECUPERACION':$pcj=90; $cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'REINCIDENTE':$pcj=90;$cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'TRASPASO VISA':$pcj=50;$cuo=1; $subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'VENTA':$pcj=100;$cuo=$row['liq_cuotas']; $subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'PRESTAMO':$pcj=5;$cuo=1; $subtotal=($row['liq_monto']*$pcj)/100;break;
            //case 'BLANQUEO': if ($row['liq_cuotas']>1) {$pcj=90;} else {$pcj=50;}$cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;
            case 'BLANQUEO': if ($row['liq_recibo']==0){$mesp=TraerMesPago2($row['liq_socio'],$row['liq_recibo']);
        						if  ($mesp<>''){$pp = explode("-",$mesp); 
									$mesp =$pp[0];
									$co9=$pp[1];}}
            if (($row['liq_cuotas']>1)and($co9>1) ){$pcj=90;} else {$pcj=50;}$cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;
            break;
            case 'ADELANTO': if ($row['liq_cuotas']>=4) {$pcj=5;} else {$pcj=0;}$cuo=1;$subtotal=(($row['liq_monto']*$row['liq_cuotas'])*$pcj)/100;
            break;
            default:break;
        
	}
	if (($row['liq_accion']=='RECUPERACION')or($row['liq_accion']=='REINCIDENTE')){if ($grupo==1001){$subtotal=0;}}
	$total_rec=$total_rec+$subtotal;
    
  	}
  	return $total_rec;
}
function TraerMesPago($socio,$recibo){
if (isset($_REQUEST['btn_ver'])){	
$mesp='';
$desde=$_REQUEST['desde'];
$desdef = explode("-",$desde); 
$aniod =$desdef[0];
$mesd =$desdef[1];
$cont=0;
$rows = Pagos::getpagos3(0,$socio,$recibo,$desde);
	foreach ($rows as $row) {
		if (($row['ANO']<$aniod)or(($row['ANO']==$aniod)and($row['MES']<>$mesd)))
			{ $cont=$cont+1;}
		$mesp=$row['MES'].'-'.$cont;
	}
	
	return 	$mesp;
}
}

function VerBono($recup,$desde,$hasta){
	$total_rec=0;
	$subtotal=0;
	$cuo=0;
	$pcj=0;
	$tot_rec=0;
	$tot_blan=0;


	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		$grupo=TraerGrupo($row['liq_socio']);
		switch ($row['liq_accion']) {
           /*case 'RECUPERACION':$subtotal=$row['liq_monto']*$row['liq_cuotas'];//$tot_rec=$tot_rec+$subtotal;
            if (($grupo<>1001)){$tot_rec=$tot_rec+$subtotal;}*/
             case 'RECUPERACION':$subtotal=$row['liq_monto']*$row['liq_cuotas'];if (($grupo<>1001)){$tot_rec=$tot_rec+$subtotal;}
            break;
            case 'BLANQUEO':$subtotal=$row['liq_monto']*$row['liq_cuotas'];$tot_blan=$tot_blan+$subtotal;
            break;
            
            default:break;
        
	}
	$totalb=$tot_rec+$tot_blan;
    $total_bono=($totalb*15)/100;
  	}
  	return $total_bono.' (Blanqueo $'.$tot_blan.' - '.'Recup $'.$tot_rec.')';
}

function VerCobro($recup,$desde,$hasta){

	$total_rec=0;
	$subtotal=0;
	$tot_rec=0;
	$tot_blan=0;
	$total_bono=0;	
	$premio=0;

	$basico=VerBasico($recup);

	$premio=VerPremio($recup,$desde,$hasta);

	$comision=VerComision($recup,$desde,$hasta);
	
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		$grupo=TraerGrupo($row['liq_socio']);
		switch ($row['liq_accion']) {
            
            //case 'RECUPERACION':$subtotal=$row['liq_monto']*$row['liq_cuotas'];$tot_rec=$tot_rec+$subtotal;
            case 'RECUPERACION':$subtotal=$row['liq_monto']*$row['liq_cuotas'];if (($grupo<>1001)){$tot_rec=$tot_rec+$subtotal;}
            break;
            case 'BLANQUEO':$subtotal=$row['liq_monto']*$row['liq_cuotas'];$tot_blan=$tot_blan+$subtotal;
            break;
            
            default:break;
        
	}
	$totalb=$tot_rec+$tot_blan;
    $total_bono=($totalb*15)/100;
  	}
  	
  	$cobro=$basico + $comision + $total_bono+ $premio; 
  	//echo $recup.'-'.$basico.'+'.$comision.'+'.$total_bono.'='.$cobro."<br>";
  	return $cobro;
}

function VerIngresos($recup,$desde,$hasta){
	
	$subcuotas=0;
	$total2=0;
	//$ban=0;
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
	//	$ban=1;
		if ($row['liq_accion']=='PRESTAMO') {$total2=0;}
		else{if ((($row['liq_accion']=='BLANQUEO')or($row['liq_accion']=='REINCIDENTE'))AND($row['liq_recibo']==0)){$total2=0;}
			else{
			$total2= $row['liq_monto'] * $row['liq_cuotas'];}}
		
	
		$subcuotas=$subcuotas + $total2;
    
  	}
  //	if ($ban==0){$subcuotas=1;}
  	return $subcuotas;
}

function VerPrestamos($recup,$desde,$hasta){
	
	$total2=0;

	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		
		if ($row['liq_accion']=='PRESTAMO')  {$total2=$total2+1;}
		
	    
  	}
  	return $total2;
}

function VerAcciones($recup,$desde,$hasta){
	
	$total2=0;

	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		
		$total2=$total2+1;
		
	    
  	}
  	return $total2;
}




function VerLiquidaciones($desde,$hasta){
if (isset($_REQUEST['btn_ver'])){		
	$total_ing=0;
	$total_egre=0;
	$total_por=0;
	$total_pres=0;
	$total_acc=0;
	$total_cuo=0;
	$total_caja1=0;
	$total_caja11=0;
	$total_caja15=0;
	//$porcentaje=0;
	$dif=0;


	$rowsr = Usuario::getUsuario(11,0);
	foreach ($rowsr as $rowr) {
	 $porcentaje=0;
	 $caja1=0;
	 $caja11=0;
	 $caja15=0;
	 $recup=$rowr['usu_ide'];
	 $operador=$rowr['usu_nombre']." ".$rowr['usu_apellido'];
	 $vacio="";

	 $basico=VerBasico($recup);

	 $total_bono=0;
	 $egresos=VerCobro($recup,$desde,$hasta);
	 if ($egresos==$basico){$egresos=0;}
	 $ingresos=VerIngresos($recup,$desde,$hasta);
	 if ($ingresos>0){$porcentaje=($egresos*100)/$ingresos;
	 $porcentaje=round($porcentaje,2);}
	 
	 $prestamos=VerPrestamos($recup,$desde,$hasta);
	 $acciones=VerAcciones($recup,$desde,$hasta);
	 $cuotas=VerCuotas($recup,$desde,$hasta);

	 $caja1=VerCaja1($recup,$desde,$hasta);
	 $caja11=VerCaja11($recup,$desde,$hasta);
	 $caja15=VerCaja15($recup,$desde,$hasta);

	$total_ing=$total_ing+$ingresos;
	$total_egre=$total_egre+$egresos;
	$total_pres=$total_pres+$prestamos;
	$total_acc=$total_acc+$acciones;
	$total_cuo=$total_cuo+$cuotas;
	$total_caja1=$total_caja1+$caja1;
	$total_caja11=$total_caja11+$caja11;
	$total_caja15=$total_caja15+$caja15;

	if (($caja1>0)OR($caja11>0)OR($caja15>0)){

	 echo "<tr>
			  <td>".$operador."</td>	
			  <td bgcolor=#ABEBC6>".'$ '.$ingresos."</td>
			  <td bgcolor='pink'>".'$ '.$egresos."</td>
			  <td bgcolor=#D5DBDB>".$porcentaje."</td>
			  <td style='text-align:center;'>".$prestamos."</td>
			  <td style='text-align:center;'>".$acciones."</td>
			  <td style='text-align:center;'>".$cuotas."</td>
			  <td style='text-align:center;'>$ ".$caja1."</td>
			  <td style='text-align:center;'>$ ".$caja11."</td>
			  <td style='text-align:center;'>$ ".$caja15."</td>
		   </tr>";
		  } 
	}
	if ($total_ing>0){
	$total_por=($total_egre*100)/$total_ing;
	$total_por=round($total_por,2);
}
	echo "<tr>
			  <td><b>TOTALES</b></td>	
			  <td bgcolor=#ABEBC6><b>".'$ '.$total_ing."</b></td>
			  <td bgcolor='pink'><b>".'$ '.$total_egre."</b></td>
			  <td bgcolor=#D5DBDB><b>".$total_por."</b></td>
			  <td bgcolor='yellow' style='text-align:center;'><b>".$total_pres."</b></td>
			  <td bgcolor='yellow'style='text-align:center;'><b>".$total_acc."</b></td>
			  <td bgcolor='yellow'style='text-align:center;'><b>".$total_cuo."</b></td>
			  <td bgcolor=#BB8FCE style='text-align:center;'><b>$ ".$total_caja1."</b></td>
			  <td bgcolor=#BB8FCE style='text-align:center;'><b>$ ".$total_caja11."</b></td>
			  <td bgcolor=#BB8FCE style='text-align:center;'><b>$ ".$total_caja15."</b></td>
		     </tr>"; 
	$dif=$total_ing-$total_egre;	     
   	echo "<tr>
			  <td bgcolor='yellow'><b>DIFERENCIA</b></td>	
			  <td><b>".$vacio."</b></td>
			  <td bgcolor='yellow'><b>".'$ '.$dif."</b></td>
			  
		     </tr>";    
	     
}
}

function VerCuotas($recup,$desde,$hasta){
		
	$total_cuotas=0;

	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
	
		$total_cuotas=$total_cuotas + $row['liq_cuotas'];
	 
  	}
  	return $total_cuotas;
}

function VerCaja1($recup,$desde,$hasta){
		
	$caja1=0;
	$ape=TraerApellido($recup);
	$ver=01;
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		
		if ($row['liq_caja']==$ver){
			if ((($row['liq_accion']=='BLANQUEO')or($row['liq_accion']=='REINCIDENTE'))and ($row['liq_recibo']==0)){}
		else{$caja1=$caja1+($row['liq_cuotas']*$row['liq_monto']);}}
		
	 
  	}
  	return $caja1;
}
function VerCaja11($recup,$desde,$hasta){
		
	$caja11=0;
	$ape=TraerApellido($recup);
	$ver=11;
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		
		if ($row['liq_caja']==$ver){
			if (($row['liq_accion']=='BLANQUEO')and ($row['liq_recibo']==0)){}
			else{$caja11=$caja11+($row['liq_cuotas']*$row['liq_monto']);}

		}
	 
  	}
  	return $caja11;
}
function VerCaja15($recup,$desde,$hasta){
		
	$caja15=0;
	$ape=TraerApellido($recup);
	$ver=15;
	
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		
		if ($row['liq_caja']==$ver){
		$caja15=$caja15+($row['liq_cuotas']*$row['liq_monto']);}
	 
  	}
  	return $caja15;
}

function TraerApellido($recup){
	$rows = Usuario::getUsuario(3,$recup);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_apellido']);
	}
    
} 
function TraerGrupo($socio){
$grupo=0;

$rows = Maestro::getMaestro(7,$socio);
	foreach ($rows as $row) {
		
		$grupo=$row['GRUPO'];

	}
	
	return 	$grupo;
}

function VerPremio($recup,$desde,$hasta){
	
	$cant=0;
	$total_premio=0;
	
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		if ($row['liq_accion']=='PRESTAMO'){
			$ver=VerPrestamo($row['liq_socio'],$row['liq_monto']);	
			if ($ver==1){$cant=$cant+1;}
		}
		
  	}
  	     
  	if (($cant>=5)and($cant<10)){$total_premio=500;}
  		else{ if($cant<5){$total_premio=0;}
  				else{if(($cant>5)and($cant<=10)){$total_premio=1000;}

  			}
  			/*	else{(($cant>=10)and($cant<15)){$total_premio=1000;}}*/
  		}

  	return $total_premio;
}	  
function VerPrestamo($socio,$monto){
$bus=0;
$hasta=$_REQUEST['hasta'];
$desde=$_REQUEST['desde'];

$rows = Prestamo::getPrestamo(6,$socio,0);
	foreach ($rows as $row) {
		
		if ((($row['ptm_estado']=='ACTIVO')OR($row['ptm_estado']=='APROBADO'))and(($row['ptm_fechasol']>=$desde)and($row['ptm_fechasol']<=$hasta))and($row['ptm_prestamo']==$monto))
			{ $bus=1;}
	}
	
	return 	$bus;
}
function TraerMesPago2($socio,$recibo){
$mesp='';
$desde=$_REQUEST['desde'];
$desdef = explode("-",$desde); 
$aniod =$desdef[0];
$mesd =$desdef[1];
$cont=0;
$rows = Pagos::getpagos3(2,$socio,$recibo,$desde);
	foreach ($rows as $row) {
		if (($row['ANO']<$aniod)or(($row['ANO']==$aniod)and($row['MES']<>$mesd)))
			{ $cont=$cont+1;}
		$mesp=$row['MES'].'-'.$cont;
	}
	
	return 	$mesp;
}		
?>