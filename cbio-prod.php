<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/produccion.class.php";

$semana=null;$estado2=null;
$prod_ide=$_REQUEST['prod_ide'];
$mes=$_REQUEST['mes'];
$anio=$_REQUEST['anio'];
$estado=$_REQUEST['estado'];
$asesor=$_REQUEST['asesor'];

   if (isset($_REQUEST['btn_guardar'])){
   		$esta=$_REQUEST['estado2'];
   		$semana=$_REQUEST['semana'];
   		$prod_ide=$_REQUEST['prod_ide'];

   		$rows = Produccion::updateProduccion1(0,$prod_ide, $esta, $semana);

		print'<script type="text/javascript">
		window.location="cns-produccion.php?asesor='.$asesor.'&mes='.$mes.'&anio='.$anio.'&estado='.$estado.'&btn_ver=Consultar";
		</script>';
   		
   		
   }
   	

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cambio de Clave</title>
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
		
		<div id="doctip"><h1>Asignar Semana y Estado</h1></div>

		<form action="" id="formulario" action="" >

		<input type="hidden" name="prod_ide" value="<?php echo $prod_ide; ?>">	
		<input type="hidden" name="mes" value="<?php echo $mes; ?>">
		<input type="hidden" name="anio" value="<?php echo $anio; ?>">
		<input type="hidden" name="estado" value="<?php echo $estado; ?>">
		<input type="hidden" name="asesor" value="<?php echo $asesor; ?>">

		<p style="font-size:0.8em;">NRO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Afiliado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI<br>
		<input type="text" name="id" value="<?php echo $_REQUEST["prod_ide"];?>" size="3px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="fecha" value="<?php echo TraerFecha()?>" size="10px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="nombre" value="<?php echo TraerAfiliado()?>" size="30px" disabled>	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="dni" value="<?php echo TraerDni()?>" size="8px" ></p>

		<p style="font-size:0.8em;">Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma de Pago<br>	
		<input type="text" name="recibo" value="<?php echo TraerRecibo();?>" size="5px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="monto" value="<?php echo TraerMonto();?>" size="5px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="plan" value="<?php echo TraerPlan();?>" size="10px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="pago" value="<?php echo TraerPago();?>" size="13px" disabled>
		</p>
		<p style="font-size:0.8em;">SEMANA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO<br>
			<select name="semana" id="semana" >
				<option value= "<?php echo $semana; ?>" selected="selected"><?php echo $semana; ?></option>
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
			</select>	
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="estado2" id="estado2" >
				<!--<option value= "<?php echo $estado; ?>" selected="selected"><?php echo $estado; ?></option>-->
				<option value="ENTREGADO">ENTREGADO</option>
				<option value="APROBADO">APROBADO</option>
				<option value="MOROSO">MOROSO</option>
				<option value="RECHAZADO">RECHAZADO</option>
				
				
			</select></p>
		
		

	<p><input type="submit" name="btn_guardar" value="Guardar">&nbsp;<input type="button" name="btn_volver" value="Volver" onclick="location.href = 'cns-produccion.php'">

	</p>		
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


function TraerFecha(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return $row['prod_fechaafi'];
	}
    
}
function TraerAfiliado(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_apeafi'].' '.$row['prod_nomafi']);
	}
    
}
function TraerRecibo(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_recibo']);
	}
    
}
function TraerDni(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_dniafi']);
	}
    
}
function TraerMonto(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_monto']);
	}
    
}
function TraerPlan(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_plan']);
	}
    
}
function TraerPago(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_pago']);
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
?>
