<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/Maestro.class.php";
   include "libs/class/pagos.class.php";
   include "libs/class/Grupo.class.php";
   include "libs/class/Cuo_Fija.class.php";
   include "libs/class/produccion.class.php";

//$prod_usu=$/_REQUEST['usu_ide'];
//$mes=$_REQUEST['mes'];
//$anio=$_REQUEST['anio'];
$desde=null;
$hasta=null;
$anio=null;
$asesor=0;
/*$estado=$_REQUEST['estado'];
$asesor=$_REQUEST['asesor'];*/

if (isset($_REQUEST['btn_consultar'])){

   		$desde=$_REQUEST['desde'];
   		$hasta=$_REQUEST['hasta'];
   		$anio=$_REQUEST['anio'];
   		$asesor=$_REQUEST['asesor'];
	//ECHO $desde.'-'.$hasta.'-'.$anio.'-'.$asesor;   		
  		
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
		<a href="asesores.php" class="nl"><h1>INFORME DE VENTAS EFECTIVAS</h1></a>
		<div id="doctip">

				<form action="" id="formulario" action="" >

	
		MES:&nbsp;
		<select name="desde" id="desde" >
				<option value= "<?php echo $desde; ?>" selected="selected"><?php echo Traer($desde); ?></option>
				<option value=1>ENERO</option>
				<option value=2>FEBRERO</option>
				<option value=3>MARZO</option>
				<option value=4>ABRIL</option>
				<option value=5>MAYO</option>
				<option value=6>JUNIO</option>
				<option value=7>JULIO</option>
				<option value=8>AGOSTO</option>
				<option value=9>SEPTIEMBRE</option>
				<option value=10>OCTUBRE</option>
				<option value=11>NOVIEMBRE</option>
				<option value=12>DICIEMBRE</option>
			</select>
		&nbsp;&nbsp;&nbsp; A &nbsp;&nbsp;&nbsp;
		<select name="hasta" id="hasta" >
				<option value= "<?php echo $hasta; ?>" selected="selected"><?php echo Traer($hasta); ?></option>
				<option value=1>ENERO</option>
				<option value=2>FEBRERO</option>
				<option value=3>MARZO</option>
				<option value=4>ABRIL</option>
				<option value=5>MAYO</option>
				<option value=6>JUNIO</option>
				<option value=7>JULIO</option>
				<option value=8>AGOSTO</option>
				<option value=9>SEPTIEMBRE</option>
				<option value=10>OCTUBRE</option>
				<option value=11>NOVIEMBRE</option>
				<option value=12>DICIEMBRE</option>
			</select>
		&nbsp;&nbsp;&nbsp;
		AÑO:&nbsp;<input type="text" name="anio" value="<?php echo $anio; ?>" onkeyUp="return ValNumero(this);" size="5px" >
		&nbsp;&nbsp;&nbsp;
		ASESOR: <select name="asesor" id="asesor"><option value=<?php echo $asesor; ?>><?php echo VerUsuario($asesor); ?></option><?php echo VerAsesor();?></select>

		<br><br>
		
		<input type="submit" name="btn_consultar" value="Consultar">

		<br><br>

		
		<!--<input type="hidden" name="prod_ide" value="<?php echo $usu_ide; ?>">	
		<input type="hidden" name="mes" value="<?php echo $mes; ?>">
		<input type="hidden" name="anio" value="<?php echo $anio; ?>">-->
		
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				
				<th widt="15%" bgcolor=#85C1E9>VTAS PERIODO</th>
				<th widt="10%" bgcolor=#85C1E9>VTAS SIN PAGO 2º CUOTA</th>
				<th widt="10%" bgcolor=#ABEBC6>VTAS EFECTIVAS</th>
			
			</thead>
			<tbody>
				<?php VerVentas(); ?>
			</tbody>
	
		</table>
		

	<p><input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'">

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
	
	$rows = Maestro::getMaestro(7,$afiliado);
	
	foreach ($rows as $row) {
	
		return ($row['NOMBRES'].' '.$row['APELLIDOS']);
	}
    
}
function TraerAlta($afiliado){
	
	$rows = Maestro::getMaestro(7,$afiliado);
	
	foreach ($rows as $row) {
	
		return ($row['ALTA']);
	}
    
}
function TraerZona($afiliado){
	
	$rows = Maestro::getMaestro(7,$afiliado);
	
	foreach ($rows as $row) {
	
		return ($row['ZONA']);
	}
    
}
function TraerCuota($afiliado){
	
	$rows = Cuo_Fija::getCuo_Fija(0,$afiliado);
	
	foreach ($rows as $row) {
	
		return ($row['IMPORTE']);
	}
    
}

function VerVentas(){
//echo 'romina';*
if (isset($_REQUEST['btn_consultar'])){	
	
	$anio=$_REQUEST['anio'];
	$hasta=$_REQUEST['hasta'];
	$asesor=$_REQUEST['asesor'];
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
	$mes=null;
	$cont=$_REQUEST['desde'];

	while ($cont<=$hasta){

	$ventas=0;
	$ventas_efec=0;
	switch ($cont) {
		case 1:$mes='ENERO'; break;
		case 2:$mes='FEBRERO'; break;
		case 3:$mes='MARZO';break;
		case 4:$mes='ABRIL'; break;
		case 5:$mes='MAYO'; break;
		case 6:$mes='JUNIO'; break;
		case 7:$mes='JULIO'; break;
		case 8:$mes='AGOSTO'; break;
		case 9:$mes='SEPTIEMBRE'; break;
		case 10:$mes='OCTUBRE'; break;
		case 11:$mes='NOVIEMBRE'; break;
		case 12:$mes='DICIEMBRE'; break;
		default:break;
	}	
	
	$rowsP=Produccion::getProduccion2(5,$asesor,$mes,$anio,$estado);		
	//echo $rowsP->rowCount();
		if($rowsP->rowCount()!=0){	
			foreach ($rowsP as $rowP) {
				//echo 'ingrese';
				$ventas=$ventas+1;
				$plan=$rowP['prod_plan'];
				$afiliado=$rowP['prod_afiliado'];
				$grupo=TraerGrupo($afiliado);
				$zona=TraerZona($afiliado);
				$nom_grupo=TraerNomGrupo($grupo,$zona);
				$nom_afi=TraerAfi($afiliado);
				$alta=TraerAlta($afiliado);
				$cuota=TraerCuota($afiliado);
				$mesp=TraerMes($rowP['prod_mes']);
				
				if ($mesp==1){$anio=$anio+1;}
				if ($plan!='NOVELL'){
						
						$envio=Traerpago($afiliado, $mesp, $anio, $grupo);
						if ($envio=='SI'){$ventas_efec=$ventas_efec+1;}
						else{$vtas_caidas=$vtas_caidas+1;} 
				}
				else{
						$ventas_efec=$ventas_efec+1;
					}					
					//$total_efec=$total_efec+$ventas_efec;
					//$total_premio=$total_premio+$premio;
				
			}
		}		
			echo "<tr>
			  		<td style='text-align:center;'>".$mes."</td>	
			  		<td  >".$ventas."</td>
			  		<td  >".$ventas_efec."</td>
			  		
			  	</tr>";	
		$cont=$cont+1;	  	

		}	
		
		
			
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

function TraerGrupo ($afiliado){

	$rows = Maestro::getMaestro(7,$afiliado);
	foreach ($rows as $row) {
	$grupo=$row['GRUPO'];
	}
    return($grupo);
}

function Traerpago($afiliado,$mes,$anio,$grupo){
	$envio='NO';
	$total=0;
	if ($grupo==1000){$rows = Pagos::getPagos2(1,$afiliado,$mes,$anio);	}
	else{$rows = Pagos::getPagos2(0,$afiliado,$mes,$anio);
		$total=$rows->rowCount();
		if ($total==0){$rows = Pagos::getPagos2(1,$afiliado,$mes,$anio);}
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
function VerAsesor(){

	$usu=$_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3,$usu);
		foreach ($rows as $row) {
		$perfil=$row['usu_perfil'];
		$estado=$row['usu_estado'];
		$nombre=$row['usu_apellido']." ".$row['usu_nombre'];
    }
    
   
    if (($perfil=='ASESOR')and ($estado=='ACTIVO') ){
    	
		echo "<option value='".$usu."'>".$nombre."</option>";
    }
    else{
    		
    		$rows = Usuario::getUsuario(7,0);
			//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
		
			foreach ($rows as $row) {
			
			echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
			}
    }
}
?>