<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/Maestro.class.php";
   include "libs/class/pagos.class.php";
   include "libs/class/Grupo.class.php";
   include "libs/class/Cuo_Fija.class.php";
   include "libs/class/Otro.class.php";

$fecha = date("d/m/Y",time());
$recup=0;
$nom=VerUsuario($recup);
$mes=null;
$hasta=null;
$anio=null;
$vista=null;

if ((isset($_REQUEST['btn_consultar'])or(isset($_REQUEST['btn_ver'])))){

   		$mes=$_REQUEST['mes'];
   	    $anio=$_REQUEST['anio'];
   		$recup=$_REQUEST['recup'];
   		//$vista=$_REQUEST['vista'];
  		
   }

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Consultar Mora del Periodo</title>
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
		<a href="asesores.php" class="nl"><h1>INFORME DE MORA POR CAMPAÑAS ASIGNADAS AL <?php echo $fecha; ?></h1></a>
		<div id="doctip">
	<form action="" id="formulario" action="" >
		Ingrese &nbsp; MES:&nbsp;
		<select name="mes" id="mes" >
				<option value= "<?php echo $mes; ?>" selected="selected"><?php echo Traer($mes); ?></option>
				<option value='01'>ENERO</option>
				<option value='02'>FEBRERO</option>
				<option value='03'>MARZO</option>
				<option value='04'>ABRIL</option>
				<option value='05'>MAYO</option>
				<option value='06'>JUNIO</option>
				<option value='07'>JULIO</option>
				<option value='08'>AGOSTO</option>
				<option value='09'>SEPTIEMBRE</option>
				<option value='10'>OCTUBRE</option>
				<option value='11'>NOVIEMBRE</option>
				<option value='12'>DICIEMBRE</option>
			</select>
		
		&nbsp;&nbsp;&nbsp;
		AÑO:&nbsp;<input type="text" name="anio" value="<?php echo $anio; ?>" onkeyUp="return ValNumero(this);" size="5px" >
		 &nbsp;&nbsp;&nbsp;	<input type="submit" name="btn_consultar" value="Consultar"><br><br>

		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
	    <thead>
				
				<th widt="50%" bgcolor=#85C1E9>OPERADOR</th>
				<th widt="25%" bgcolor=#ABEBC6>CANTIDAD</th>
				<th widt="25%" bgcolor=#ABEBC6>IMPORTE</th>
				<th widt="25%" ></th>
				<th widt="25%" bgcolor=violet>CANT.COBR</th>
				<th widt="25%" bgcolor=violet>IMPO.COBR</th>
				
							
			</thead>
		
			<tbody>
				<?php VerMoraTotal(); ?>
			</tbody>
			 <!--<thead>
				
				<th widt="100%" bgcolor=BLACK><font color=white><b>TOTALES</b></th>
							<?php //VerTotales(); ?>			
			</thead>-->
			<tbody>
				<?php //VerMoraDetalle(); ?>
			</tbody>
	
		</table><BR>
	
		Ingrese  &nbsp;OPERADOR: <select name="recup" id="recup"><option value=0><?php echo VerUsuario($recup); ?></option><?php echo VerRecuperador();?></select>
			&nbsp;&nbsp;&nbsp;<input type="submit" name="btn_ver" value="Ver">
		
			<!--<font color=blue><b>DETALLE DE MORA ASIGNADA</b></font><BR>-->
			<h1>DETALLE</h1>
			<table width="30%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%" bgcolor=#ABEBC6>MORA ASIGNADA</th>
				<th widt="5%" bgcolor=violet>MORA COBRADA</th>
				<th widt="5%" bgcolor=orange>DIFERENCIA/FALTANTE</th>
			</thead>
		</table><br>

		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				
				<th widt="10%" bgcolor=#85C1E9>CAMPAÑA</th>
				<th widt="5%" bgcolor=#ABEBC6>CANT</th>
				<th widt="5%" bgcolor=#ABEBC6>IMPORTE</th>
				
				<th widt="10%" ></th>
				<th widt="5%" bgcolor=violet>CANT</th>
				<th widt="5%" bgcolor=violet>IMPORTE</th>
				
				<th widt="10%" ></th>
				<th widt="5%" bgcolor=orange>CANT</th>
				<th widt="5%" bgcolor=orange>IMPORTE</th>
							 
			</thead>
		
			<tbody>
				<?php VerMora($recup); ?>
			</tbody>
	
		</table>
<!--<h2>EVOLUCION COBRANZA MORA</h2>		
<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
	<thead>
				
				<th widt="50%" bgcolor=#85C1E9></th>
				<th widt="25%" bgcolor=#ABEBC6>TOTAL</th>
				<th widt="25%" bgcolor=#ABEBC6>Oficina</th>
				<th widt="25%" bgcolor=#ABEBC6>Cobrador</th>
				<th widt="25%" bgcolor=#ABEBC6>Tarjeta</th>
				<th widt="25%" bgcolor=#ABEBC6>Banco</th>
				<th widt="25%" bgcolor=#ABEBC6>Policia</th>

			
			</thead>
		
			<tbody>
				<?php //VerMoraActu($recup); ?>
			</tbody>
	
		</table>-->
	<p><input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_salir" value="SALIR" onclick="location.href = 'abm.php'">

	</p>		
</form>
	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php

function VerMoraTotal(){
if ((isset($_REQUEST['btn_consultar'])or(isset($_REQUEST['btn_ver'])))){	

	$anio=$_REQUEST['anio'];
	$mes=$_REQUEST['mes'];
	//$vista=$_REQUEST['vista'];
	$total_asig=0;
	$total_act=0;
	$total_can1=0;
	$total_can2=0;
	
	//$archivo='mora_'.strtolower($mes);

	$archivo='mora'.$mes.$anio;
	

	$rowsu = Usuario::getUsuario(11,0);
	//if($rowsu->rowCount()!=0){	
	foreach ($rowsu as $rowu) {
		$rec=$rowu['usu_ide'];
		$nombre=$rowu['usu_nombre'].' '.$rowu['usu_apellido'];

		$cant=0;
		$imp=0;
		$imp_act=0;
		$cant_act=0;
		$rows = Otro::getOtro(8,$archivo,$rec);
		if($rows->rowCount()!=0){	
			foreach ($rows as $row) {
				$cant=$cant+1;
				$imp=$imp+$row['DEUDA'];
			if ($row['ESTADO']==1){
				$cant_act=$cant_act+1;
				$imp_act=$imp_act+$row['IMP_PAGO'];
			}	
			}	

			echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><font size=2><b>".$nombre."</font></b></td>	
			  		<td style='text-align:center;' ><font size=2><b> ".$cant."</font></b></td>
			  		<td style='text-align:center;' ><font size=2><b>$ ".$imp." </font></b></td>
			  		<td style='text-align:center;' ><font size=2><b> ".''." </font></b></td>
			  		<td style='text-align:center;' ><font size=2><b> ".$cant_act."</font></b></td>
			  		<td style='text-align:center;' ><font size=2><b>$ ".$imp_act." </font></b></td>
	  	</tr>";
		}
		$total_asig=$total_asig+$imp;
		$total_act=$total_act+$imp_act;	
		$total_can1=$total_can1+$cant;
		$total_can2=$total_can2+$cant_act;	
		}	
		echo"<tr>
		<td style='text-align:center;' bgcolor=BLACK><font size=2 color=white><b>TOTALES</b></td>
		<td style='text-align:center;' bgcolor=BLACK><font size=2 color=white><b> ".$total_can1."</font></b></td>
		<td style='text-align:center;' bgcolor=BLACK><font size=2 color=white><b>$ ".$total_asig." </font></b></td>
		<td style='text-align:center;' ><font size=2><b> ".''." </font></b></td>
		<td style='text-align:center;' bgcolor=BLACK><font size=2 color=white><b> ".$total_can2."</font></b></td>
		<td style='text-align:center;' bgcolor=BLACK><font size=2 color=white><b>$ ".$total_act." </font></b></td>
		</tr>";
			
		
}
}

function VerMora($recup){
//echo 'romina';*
if (isset($_REQUEST['btn_ver'])){	
	
	$anio=$_REQUEST['anio'];
	//$mes=$_R['mes'];
	$mes=$_REQUEST['mes'];
	
	$nombre=null;
	
	$can_gral=0;
	$tot_gral=0;
	$tot1=0;
	$tot2=0;
	$tot3=0;
	$tot4=0;
	$tot5=0;
	$tot6=0;

	//$archivo='mora1118';
	$archivo='mora'.$mes.$anio;
	$rows = Otro::getOtro(16,$archivo,$recup);
	foreach ($rows as $row) {
		$tot_cam=0;
		$tot_cam2=0;
		$tot_pag=0;
		$can_pag=0;
		$campa=$row['ID_CAMPANIA'];
		$nombre=$row['CAMPANIA'];

		$rowsc = Otro::getOtro(17,$archivo,$campa);
		foreach ($rowsc as $rowc) {
			$tot_cam2=+$tot_cam2+$rowc['DEUDA'];
			$tot_cam=$tot_cam+1;
			if ($rowc['ESTADO']==1){
				$tot_pag=$tot_pag+$rowc['IMP_PAGO'];
				$can_pag=$can_pag+1;
			}
		}	
			$tot5=$tot_cam-$can_pag;
			$tot6=$tot_cam2-$tot_pag;	
			echo "<tr>
			  		<td style='text-align:center;'bgcolor=#85C1E><b>".$nombre."</b></td>	
			  		<td style='text-align:center;'> ".$tot_cam."</td>
			  		<td style='text-align:center;'>$ ".$tot_cam2."</td>
			  		<td > </td>
			  		<td style='text-align:center;'> ".$can_pag."</td>
			  		<td style='text-align:center;'>$ ".$tot_pag."</td>
			  		<td > </td>
			  		<td style='text-align:center;'> ".$tot5."</td>
			  		<td style='text-align:center;'>$ ".$tot6."</td>";
			$can_gral=$can_gral+$tot_cam;
			$tot_gral=$tot_gral+$tot_cam2;
			$tot1=$tot1+$can_pag;
			$tot2=$tot2+$tot_pag;	
			$tot3=$can_gral-$tot1;
			$tot4=$tot_gral-$tot2;	
	}
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=BLACK><font color=white><b>TOTALES</font></b></td>	
			  		<td style='text-align:center;'bgcolor=BLACK><font color=white><b>".$can_gral."</b></font></td>
			  		<td style='text-align:center;'bgcolor=BLACK><font color=white><b>$ ".$tot_gral."</b></font></td>
			  		<td > </td>
			  		<td style='text-align:center;'bgcolor=BLACK><font color=white><b>".$tot1."</b></td>
			  		<td style='text-align:center;'bgcolor=BLACK><font color=white><b>$".$tot2."</b></td>		
			  		<td > </td>
			  		<td style='text-align:center;'bgcolor=BLACK><font color=white><b>".$tot3."</b></td>
			  		<td style='text-align:center;'bgcolor=BLACK><font color=white><b>$".$tot4."</b></td>";		
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
				case 'ASESOR':include ('menu_vta.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}


function Traer ($mes){


	switch ($mes) {
		case 1:$mes='ENERO'; break;
		case 2:$mes='FEBRERO';break;
		case 3:$mes='MARZO'; break;
		case 4:$mes='ABRIL'; break;
		case 5:$mes='MAYO'; break;
		case 6:$mes='JUNIO'; break;
		case 7:$mes='JULIO'; break;
		case 8:$mes='AGOSTO'; break;
		case 9:$mes='SEPTIEMBRE'; break;
		case 10:$mes='OCTUBRE'; break;
		case 11:$mes='NOVIEMBRE'; break;
		case 12:$mes='DICIEMBRE'; break;
		
	}

return($mes);
}
function VerRecuperador(){

	$usu=$_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3,$usu);
		foreach ($rows as $row) {
		$perfil=$row['usu_perfil'];
		$estado=$row['usu_estado'];
		$nombre=$row['usu_apellido']." ".$row['usu_nombre'];
    }
    
   
    if (($perfil=='RECUPERADOR')  ){
    	
		echo "<option value='".$usu."'>".$nombre."</option>";
    }
    else{
    		$rows = Usuario::getUsuario(11,0);
			//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
			//echo "<option value='TODAS'>TODAS</option>";
			foreach ($rows as $row) {
			
			echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
			}
    }
  /*  echo "<option value='L'>PALPALA</option>";
    echo "<option value='R'>PERICO</option>";
    echo "<option value='P'>SAN PEDRO</option>";*/
    
}
function VerUsuario($recup){
	
	switch ($recup) {
				/*case 'L':$recup='PALPALA';return $recup; break;
				case 'P':$recup='SAN PEDRO';return $recup;break;
				case 'R':$recup='PERICO';return $recup; break;*/
				case 'TODAS':return $recup; break;
				default: $rows = Usuario::getUsuario(3,$recup);
						foreach ($rows as $row) {
							return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
						} break;
			}


	/*if ($recup=='TODAS')or{return $recup;}
	else{	
			$rows = Usuario::getUsuario(3,$recup);
			foreach ($rows as $row) {
			return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
			}
		}	*/
}
?>