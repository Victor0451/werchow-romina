<?php 
include "info.php"; 
include "config.php";  
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/sueldo.class.php"; 
include "libs/class/campana.class.php"; 
include "libs/class/liquidacion.class.php"; 
include "libs/class/pagos.class.php"; 




	$desde=$_GET['desde'];
	$hasta=$_GET['hasta'];
	$recup=$_GET['recup'];
	$nom=VerUsuario();

/*else{

	if (isset($_REQUEST['btn_limpiar'])){
		
	$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
		
	}
else{
	if (isset($_REQUEST['op'])){

		switch ($_REQUEST['op']) {
			case 'md': //modificar
				$rows = Liquidacion::getLiquidacion(0,$_REQUEST['liq_id'],0);
				$row = $rows->fetch();
				$socio = $row['liq_socio'];
				$nombre = $row['liq_nombre']; 
				$monto = $row['liq_monto'];
				$plan = $row['liq_plan'];
				$fpago = $row['liq_fpago'];
				$recibo = $row['liq_recibo'];
				$cuotas = $row['liq_cuotas'];
				$accion = $row['liq_accion'];
				$liq_id=$row['liq_id'];
				
				break;
			case 'br': //borrar
				$rows = Liquidacion::deleteLiquidacion($_REQUEST['liq_id']);
				break;
		}
	}
	else{
		$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
	}
	}
}
*/
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Consulta Liquidaciones</title>
	
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	
	<script src="libs/js/jquery-1.7.2.js"></script>
	
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>


</head>

<body>
	
<?php //include('header1.php'); 
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=liquidacion-exp.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>
	<!--<div id="menu-wrapper">
		<div id="menu"><?php include "menu.php"; ?></div>
	</div>-->	
	<div id="contenido">
		<a href="abm.php" class="nl"><h1>CONSULTA LIQUIDACION </h1></a>
	<form action="" id="for_cns" action="" method="get" >
		<!--<input type="hidden" name="nom" value="<?php //echo $nom; ?>">-->
		Recuperador: <?php echo VerUsuario($recup);?>&nbsp;&nbsp;&nbsp;&nbsp;	
		Desde:  <?php echo $desde; ?>&nbsp;&nbsp;
        Hasta: <?php echo $hasta; ?>&nbsp;&nbsp;
		
		
		
		<br><br>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%">Nº</th>
				<th widt="5%">Fecha</th>
				<th widt="5%">Socio</th>
				<th widt="5%">Recibo</th>
				<th widt="15%">Afiliado Titular</th>
				<th widt="10%">Monto</th>
				<th widt="5%">PROV</th>
				<th widt="5%">NOA</th>
				<th widt="5%">NAC</th>
				<th widt="5%">AB</th>
				<th widt="5%">NOV</th>
				<th widt="5%">DEB</th>
				<th widt="5%">TARJ</th>
				<th widt="5%">PART</th>
				<th widt="5%">Cuotas</th>
				<th widt="10%">Total</th>
				<th widt="5%">Accion</th>
				<th widt="5%">%</th>
				<th widt="5%">CT</th>
				<th widt="5%">LIQ $</th>

				
			</thead>
			<tbody>
				<?php VerLiquidaciones($desde,$hasta,$recup); ?>
			</tbody>
	
		</table>
		<h2>RESUMEN</h2>
		Basico&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=<?php echo ' $ '.VerBasico($recup); ?><br>
		Comision&nbsp;&nbsp;&nbsp;=<?php echo ' $ '.VerComision($recup,$desde,$hasta); ?><br>
		Bono 15%&nbsp;=<?php echo ' $ '.VerBono($recup,$desde,$hasta);?><br>
		<b>TOTAL A COBRAR =<?php  echo ' $ '.VerCobro($recup,$desde,$hasta);?>	</b>
		
		
		</form>
	</div>
	
	<div id="footer">
		<center>Werchow - Año 2018 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php


function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_REQUEST["recup"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
	}
    
}
function VerBasico($recup){
	
	$ver='';
	$rows = Usuario::getUsuario(3,$recup);
	
	foreach ($rows as $row) {
	
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
	$desdef = explode("-",$hasta); 
	$mesd =$desdef[1];
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {
		$mesp=TraerMesPago($row['liq_socio'],$row['liq_recibo']);
		switch ($row['liq_accion']) {
            case 'AT1':$pcj=10;$cuo=$row['liq_cuotas'];$subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'AT2':$pcj=15; $cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'RECUPERACION':$pcj=90; $cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'REINCIDENTE':$pcj=90;$cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'TRASPASO VISA':$pcj=50;$cuo=1; $subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'VENTA':$pcj=100;$cuo=$row['liq_cuotas']; $subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'PRESTAMO':$pcj=5;$cuo=1; $subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'BLANQUEO': if (($row['liq_cuotas']>1)and($mesp<>$mesd)) {$pcj=90;} else {$pcj=50;}$cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;
            break;
            default:break;
        
	}
	$total_rec=$total_rec+$subtotal;
    
  	}
  	return $total_rec;
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
		switch ($row['liq_accion']) {
            
            case 'RECUPERACION':$subtotal=$row['liq_monto']*$row['liq_cuotas'];$tot_rec=$tot_rec+$subtotal;
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

	$basico=VerBasico($recup);
	$comision=VerComision($recup,$desde,$hasta);
	
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);
	
	foreach ($rows as $row) {

		switch ($row['liq_accion']) {
            
            case 'RECUPERACION':$subtotal=$row['liq_monto']*$row['liq_cuotas'];$tot_rec=$tot_rec+$subtotal;
            break;
            case 'BLANQUEO':$subtotal=$row['liq_monto']*$row['liq_cuotas'];$tot_blan=$tot_blan+$subtotal;
            break;
            
            default:break;
        
	}
	$totalb=$tot_rec+$tot_blan;
    $total_bono=($totalb*15)/100;
  	}

  	$cobro=$basico + $comision + $total_bono; 
  	return $cobro;
}

function VerLiquidaciones($desde,$hasta,$recup){
	//$desde=$_REQUEST['desde'];
	//$hasta=$_REQUEST['hasta'];
	//$recup=$_REQUEST['recup'];
	$total_prom=0;
	$cont=0;
	$pcj=0;
	$subtotal=0;
	$submonto=0;
	$cuo=0;
	$vacio="";
	$totrec=0;
	$totbla=0;
	$subcuotas=0;
	$total_rec=0;
	$total_cuotas=0;
	$tot_noa=0;
	$tot_prov=0;
	$tot_nac=0;
	$tot_aba=0;
	$tot_nov=0;
	$tot_deb=0;
	$tot_par=0;
	$tot_tjt=0;
	$prom=0;
	$prov="";$noa="";$nac="";$aba="";$nov="";
	$par="";$deb="";$tar="";
	$desdef = explode("-",$hasta); 
	$mesd =$desdef[1];
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$recup);

		
	foreach ($rows as $row) {
		if ($row['liq_accion']=='PRESTAMO')  {$total2=0;}
		else{$total2= $row['liq_monto'] * $row['liq_cuotas'];}
		
		$cont=$cont+1;
		
		$subcuotas=$subcuotas + $total2;

		$total_cuotas=$total_cuotas + $row['liq_cuotas'];
		$mesp=TraerMesPago($row['liq_socio'],$row['liq_recibo']);
				
		switch ($row['liq_plan']) {
            case 'PROVINCIA':$prov="X";$noa="";$nac="";$aba="";$nov="";$tot_prov=$tot_prov+1;break;
            case 'NOA':$prov="";$noa="X";$nac="";$aba="";$nov="";$tot_noa=$tot_noa+1;break;
            case 'NACIONAL':$prov="";$noa="";$nac="X";$aba="";$nov="";$tot_nac=$tot_nac+1;break;
            case 'ABARCAR':$prov="";$noa="";$nac="";$aba="X";$nov="";$tot_aba=$tot_aba+1;break;
            case 'NOVELL':$prov="";$noa="";$nac="";$aba="";$nov="X";$tot_nov=$tot_nov+1;break;
            default:break;
        }
        switch ($row['liq_fpago']) {
            case 'PARTICULAR':$par="X";$deb="";$tar="";$tot_par=$tot_par+1;break;
            case 'DEBITO':$par="";$deb="X";$tar="";$tot_deb=$tot_deb+1;break;
            case 'TARJETA':$par="";$deb="";$tar="X";$tot_tjt=$tot_tjt+1;break;
            default:break;
        }
        $accion=$row['liq_accion'];
         switch ($row['liq_accion']) {
            case 'AT1':$pcj=10;$cuo=$row['liq_cuotas'];$subtotal=($row['liq_monto']*$pcj)/100;$submonto=$submonto + $row['liq_monto'];$prom=$prom +1;break;
            case 'AT2':$pcj=15; $cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;$submonto=$submonto + $row['liq_monto'];$prom=$prom +1;break;
            case 'RECUPERACION':$pcj=90; $cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;$submonto=$submonto + $row['liq_monto'];$prom=$prom+1;break;
            case 'REINCIDENTE':$pcj=90;$cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;$submonto=$submonto + $row['liq_monto'];$prom=$prom +1;break;
            case 'TRASPASO VISA':$pcj=50;$cuo=1; $subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'VENTA':$pcj=100;$cuo=$row['liq_cuotas']; $subtotal=($row['liq_monto']*$pcj)/100; $submonto=$submonto + $row['liq_monto'];$prom=$prom +1;break;
            case 'PRESTAMO':$pcj=5;$cuo=1; $subtotal=($row['liq_monto']*$pcj)/100;break;
            case 'BLANQUEO': if (($row['liq_cuotas']>1) and ($mesp<>$mesd)){$pcj=90;} else {$pcj=50;}$cuo=1;$subtotal=($row['liq_monto']*$pcj)/100;$submonto=$submonto + $row['liq_monto'];$prom=$prom +1;
            break;
            default:break;
        }
        $total_rec=$total_rec+$subtotal;

		echo "<tr>
			  <td>".$cont."</td>	
			  <td>".$row['liq_fecha']."</td>
			  <td>".$row['liq_socio']."</td>
			  <td>".$row['liq_recibo']."</td>
			  <td>".$row['liq_nombre']."</td>
			  <td>".'$ '.$row['liq_monto']."</td>
			  <td>".$prov."</td>
			  <td>".$noa."</td>
			  <td>".$nac."</td>
			  <td>".$aba."</td>
			  <td>".$nov."</td>
			  <td>".$deb."</td>
			  <td>".$tar."</td>
			  <td>".$par."</td>
			  <td>".$row['liq_cuotas']."</td>
			  <td>".'$ '.$total2."</td>
			  <td>".$row['liq_accion']."</td>
			  <td>".$pcj."</td>
			  <td>".$cuo."</td>
		      <td>".'$ '.$subtotal."</td>
		     </tr>";

	    }
	     $total_prom=$submonto/$prom;
	echo "<tr>
			  <td>".$vacio."</td>	
			  <td>".$vacio."</td>
			  <td>".$vacio."</td>
			  <td>".$vacio."</td>
			  <td>".$vacio."</td>
			  <td bgcolor='yellow'><b>".'$ '.$submonto."</b></td>
			  <td><b>".$tot_prov."</b></td>
			  <td><b>".$tot_noa."</b></td>
			  <td><b>".$tot_nac."</b></td>
			  <td><b>".$tot_aba."</b></td>
			  <td><b>".$tot_nov."</b></td>
			  <td><b>".$tot_deb."</b></td>
			  <td><b>".$tot_tjt."</b></td>
			  <td><b>".$tot_par."</b></td>
			  <td><b>".$total_cuotas."</b></td>
			  <td bgcolor='yellow'><b>".'$ '.$subcuotas."</b></td>
			  <td>".$vacio."</td>
			  <td>".$vacio."</td>
			  <td>".$vacio."</td>
		      <td bgcolor=#AED6F1><b>".'$ '.$total_rec."</b></td>
		       
		     </tr>";  
	echo "<tr>
			  <td>".$vacio."</td>	
			  <td>".$vacio."</td>
			  <td>".$vacio."</td>
			  <td>".$vacio."</td>
			  <td> <b>CUOTA PROMEDIO</b></td>
			  <td bgcolor='yellow'><b>".'$ '.$total_prom."</b></td>
		     </tr>";    



	}
function TraerMesPago($socio,$recibo){
$mesp=0;
$desde=$_REQUEST['desde'];
$rows = Pagos::getpagos3(0,$socio,$recibo,$desde);
	foreach ($rows as $row) {
		$mesp=$row['MES'];
	}
	
	return 	$mesp;
}	    
?>