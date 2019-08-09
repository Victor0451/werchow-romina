<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/Maestro.class.php";
   include "libs/class/pagos.class.php";
   include "libs/class/Grupo.class.php";
   include "libs/class/Cuo_Fija.class.php";
   include "libs/class/produccion.class.php";

$prod_usu=$_REQUEST['usu_ide'];
$mes=$_REQUEST['mes'];
$anio=$_REQUEST['anio'];
/*$estado=$_REQUEST['estado'];
$asesor=$_REQUEST['asesor'];*/

   if (isset($_REQUEST['btn_guardar'])){
   		$esta=$_REQUEST['estado2'];
   		$semana=$_REQUEST['semana'];
   		$prod_ide=$_REQUEST['prod_ide'];
   		$obs=$_REQUEST['obs'];

   		$rows = Produccion::updateProduccion1(1,$prod_ide, $esta, $obs);

		print'<script type="text/javascript">
		window.location="cns-produccion.php?asesor='.$asesor.'&mes='.$mes.'&anio='.$anio.'&estado='.$estado.'&btn_ver=Consultar";
		</script>';
   		
   		
   }
   	

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Consultar Ventas del Periodo</title>
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
		
		<div id="doctip"><h1>VENTAS DEL PERIODO:&nbsp;<?php $nombre=VerUsuario($_REQUEST["usu_ide"]);echo  $_REQUEST["mes"].' '. $_REQUEST["anio"].' - '.$nombre; ?></h1></div>

		<form action="" id="formulario" action="" >

		<input type="hidden" name="prod_ide" value="<?php echo $usu_ide; ?>">	
		<input type="hidden" name="mes" value="<?php echo $mes; ?>">
		<input type="hidden" name="anio" value="<?php echo $anio; ?>">
		
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%" bgcolor=#D5DBDB>Nº</th>
				<th widt="15%" bgcolor=#D5DBDB>Contrato</th>
				<th widt="15%" bgcolor=#D5DBDB>Afiliado</th>
				<th widt="15%" bgcolor=#D5DBDB>Telefono</th>
				<th widt="15%" bgcolor=#85C1E9>Alta</th>
				<th widt="15%" bgcolor=#85C1E9>Plan</th>
				<th widt="10%" bgcolor=#85C1E9>Cuota</th>
				<th widt="10%" bgcolor=#ABEBC6>Grupo</th>
				<th widt="5%" bgcolor=#D5DBDB>Pago 2ª Cuota</th>
				
				
						
			</thead>
			<tbody>
				<?php VerVentas(); ?>
			</tbody>
	
		</table>
		
		

	<p><input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_volver" value="Volver" onclick="location.href = 'premios.php?mes=<?php echo $_REQUEST['mes'];?>&anio=<?php echo $_REQUEST['anio'];?>&btn_ver=Consultar'">

	</p>		
</form>
	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php

function VerUsuario($usuario){
	$rows = Usuario::getUsuario(3,$usuario);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
	}
    
}


/*function TraerPago(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_pago']);
	}
    
}*/
function TraerAfi($afiliado){
	
$nom='';	
	$rows = Maestro::getMaestro(7,$afiliado);
	
	foreach ($rows as $row) {
	
		$nom=$row['NOMBRES'].' '.$row['APELLIDOS'];
	}
    if ($nom==''){
    $rows = Maestro::getMaestro(11,$afiliado);
	
	foreach ($rows as $row) {
	
		$nom=$row['NOMBRES'].' '.$row['APELLIDOS'];
	}	
    }
   return($nom);
}
function TraerAlta($afiliado){
$alta='';	
	$rows = Maestro::getMaestro(7,$afiliado);
	
	foreach ($rows as $row) {
	
		$alta=$row['ALTA'];
	}
	if ($alta==''){$rows = Maestro::getMaestro(11,$afiliado);
	
	foreach ($rows as $row) {
	
		$alta=$row['ALTA'];
	}

	}
   return($alta);
}
function TraerZona($afiliado){
	
	$rows = Maestro::getMaestro(7,$afiliado);
	
	foreach ($rows as $row) {
	
		return ($row['ZONA']);
	}
    
}
function TraerCuota($afiliado){
$cuo=0;	
	$rows = Cuo_Fija::getCuo_Fija(0,$afiliado);
	
	foreach ($rows as $row) {
	
		$cuo=$row['IMPORTE'];
	}
	if ($cuo==0){$rows = Cuo_Fija::getCuo_Fija(1,$afiliado);
	
	foreach ($rows as $row) {
	
		$cuo=$row['IMPORTE'];
	}

	}
    return($cuo);
}

function VerVentas(){
	
	$mes=$_REQUEST['mes'];
	$anio=$_REQUEST['anio'];
	$asesor=$_REQUEST['usu_ide'];
	$estado='CARGADO';
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$mes_act=$fch[1];
	$total_efec=0;
	$total_premio=0;
	$ventas=0;
	$ventas_efec=0;
	$vtas_caidas=0;
	$envio=null;
	//echo $asesor;
	$mesp=TraerMes($mes);
	if ($mesp==1){$panio=$anio+1;}else{$panio=$anio;}
	$rowsP=Produccion::getProduccion2(5,$asesor,$mes,$anio,$estado);		
		if($rowsP->rowCount()!=0){	
			foreach ($rowsP as $rowP) {
				
				$ventas=$ventas+1;
				$plan=$rowP['prod_plan'];
				$empre=$rowP['prod_empre'];
				$afiliado=$rowP['prod_afiliado'];
				
				$tel=TraerTel($afiliado,$empre);
				$grupo=TraerGrupo($afiliado,$empre);
								
				
				if ($plan!='NOVELL'){
					
					if ($grupo!=''){
					$zona=TraerZona($afiliado);
					$nom_grupo=TraerNomGrupo($grupo,$zona);
					$nom_afi=TraerAfi($afiliado);
					$alta=TraerAlta($afiliado);
					$cuota=TraerCuota($afiliado);
					$envio=Traerpago($afiliado, $mesp, $panio, $grupo, $empre);
						if ($envio=='SI'){$ventas_efec=$ventas_efec+1;}
						else{$vtas_caidas=$vtas_caidas+1;$envio='NO';} 
				}
				else{$vtas_caidas=$vtas_caidas+1;
					$zona='';
					$nom_grupo='';
					$nom_afi='<B>BAJA</B>';
					$alta='';
					$cuota='';
					$envio='NO';
				}


						
				}
				else{
						$nom_afi=TraerAfi($afiliado);
						$alta=TraerAlta($afiliado);
						$cuota=0;
						$nom_grupo='';
						$ventas_efec=$ventas_efec+1;$envio='SI';
					}					
					//$total_efec=$total_efec+$ventas_efec;
					//$total_premio=$total_premio+$premio;
				echo "<tr>
			  		<td style='text-align:center;'>".$ventas."</td>	
			  		<td  >".$afiliado."</td>
			  		<td  >".$nom_afi."</td>
			  		<td  >".$tel."</td>
			  		<td  >".$alta."</td>
			  		<td  >".$plan."</td>
			  		<td  >$ ".$cuota."</td>
			  		<td style='text-align:center;' >".$nom_grupo."</td>
			  		<td style='text-align:center;' ><b>".$envio."</b></td>
			  		
			  		</tr>";	
			}	

		}	
		echo "<tr>
			  		<td style='text-align:center;'></td>	
			  		<td  ></td>
			  		<td bgcolor=yellow><font size=2><B>TOTAL VENTAS PERIODO</B></font></td>
			  		<td style='text-align:center;' bgcolor=yellow><font size=2><b>".$ventas."</b></font></td>
			  		</tr>";	
		echo "<tr>
			  		<td style='text-align:center;'></td>	
			  		<td></td>
			  		<td bgcolor=yellow><font size=2><B>TOTAL VENTAS EFECTIVAS</B></font></td>
			  		<td style='text-align:center;' bgcolor=yellow><font size=2><b>".$ventas_efec."</b></font></td>
			  		</tr>";	
		echo "<tr> 
			  		<td style='text-align:center;'></td>	
			  		<td  ></td>
			  		<td bgcolor=yellow><font size=2><B>TOTAL VENTAS SIN PAGO</B></font></td>
			  		<td style='text-align:center;' bgcolor=yellow><font size=2><b>".$vtas_caidas."</b></font></td>
			  		</font></tr>";		

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
function TraerNomGrupo ($grupo,$zona){
$nom=null;
if ($grupo==1000){
	switch ($zona) {
		case 1:$nom='OFICINA'; break;
		case 3:$nom='OFICINA'; break;
		case 5:$nom='OFICINA';break;
		case 60:$nom='OFICINA'; break;
		case 99:$nom='OFICINA'; break;
		default:$nom='COBRADOR';break;
	}
}
else{
		$rows = Grupo::getGrupo(0,$grupo);
		foreach ($rows as $row) {
			$nom=$row['DESCRIP'];
		}
}
return($nom);
}

function TraerGrupo ($afiliado,$empre){
$grupo='';
if ($empre=='W'){
	$rows = Maestro::getMaestro(7,$afiliado);
	foreach ($rows as $row) {
	$grupo=$row['GRUPO'];
	}
}	
    
else{
		$rows = Maestro::getMaestro(11,$afiliado);
		foreach ($rows as $row) {
			$grupo=$row['GRUPO'];
		}	
	}
    return($grupo);
}
function TraerTel ($afiliado,$empre){
$tel='';
if ($empre=='W'){
	$rows = Maestro::getMaestro(7,$afiliado);
	foreach ($rows as $row) {
	$tel=$row['TELEFONO'].'-'.$row['MOVIL'];
	}
 }   
	else{
		$rows = Maestro::getMaestro(11,$afiliado);
		foreach ($rows as $row) {
		$tel=$row['TELEFONO'].'-'.$row['MOVIL'];
	}	
	}
    return($tel);
}

function Traerpago($afiliado,$mes,$panio,$grupo,$empre){
	$envio='NO';
	$total=0;
	
	//if (($plan=='PROVINCIAL')or($plan=='NOA')){
	if ($empre=='M'){
		if ($grupo==1000){ $rows = Pagos::getPagos2(3,$afiliado,$mes,$panio);
				$total=$rows->rowCount();
			}
		else{$rows = Pagos::getPagos2(2,$afiliado,$mes,$panio);
			$total=$rows->rowCount();
			if ($total==0){$rows = Pagos::getPagos2(3,$afiliado,$mes,$panio);
			$total=$rows->rowCount();}
		}
	}
	//if ($total==0){
	else{
		if ($grupo==1000){$rows = Pagos::getPagos2(1,$afiliado,$mes,$panio);	}
		else{$rows = Pagos::getPagos2(0,$afiliado,$mes,$panio);
			$total=$rows->rowCount();
			if ($total==0){$rows = Pagos::getPagos2(1,$afiliado,$mes,$panio);}
	    }
	}
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {
			$envio='SI';
		}
	}
	
	return ($envio);
	
}

function TraerMes ($mes){


	switch ($mes) {
		case 'ENERO':$mes=2; break;
		case 'FEBRERO':$mes=3;break;
		case 'MARZO':$mes=4; break;
		case 'ABRIL':$mes=5; break;
		case 'MAYO':$mes=6; break;
		case 'JUNIO':$mes=7; break;
		case 'JULIO':$mes=8; break;
		case 'AGOSTO':$mes=9; break;
		case 'SEPTIEMBRE':$mes=10; break;
		case 'OCTUBRE':$mes=11; break;
		case 'NOVIEMBRE':$mes=12; break;
		case 'DICIEMBRE':$mes=1; break;
		
	}

return($mes);
}
?>
