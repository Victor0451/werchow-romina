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
		
		<div id="doctip"><h1>Ficha de Producción</h1></div>

		<form action="" id="formulario" action="" >

		<input type="hidden" name="prod_ide" value="<?php echo $prod_ide; ?>">	
		<input type="hidden" name="mes" value="<?php echo $mes; ?>">
		<input type="hidden" name="anio" value="<?php echo $anio; ?>">
		<input type="hidden" name="estado" value="<?php echo $estado; ?>">
		<input type="hidden" name="asesor" value="<?php echo $asesor; ?>">

		<p style="font-size:0.8em;">Mes&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Año&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semana&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Afiliacion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Localidad<br>
		<input type="text" name="id" value="<?php echo $_REQUEST["mes"];?>" size="10px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="fecha" value="<?php echo $_REQUEST["anio"];?>" size="5px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="n" value="<?php echo TraerSemana()?>" size="5px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="nombre" value="<?php echo TraerFecha()?>" size="10px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="nombre" value="<?php echo TraerLocalidad()?>" size="18px" disabled>
		</p>
		<p style="font-size:0.8em;">Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto<br>
		<input type="text" name="id" value="<?php echo TraerAfiliado()?>"size="40px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="fecha" value="<?php echo TraerDni()?>" size="8px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="nombre" value="<?php echo TraerRecibo()?>" size="5px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$<input type="text" name="nombre" value="<?php echo TraerMonto()?>" size="5px" disabled>
		</p>

		<p style="font-size:0.8em;">Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma de Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CTA-CTE/N°TARJETA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Asesor<br>	
		<input type="text" name="recibo" value="<?php echo TraerPlan();?>" size="10px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="monto" value="<?php echo TraerPago();?>" size="11px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="pago" value="<?php echo TraerCta();?>" size="18px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="pago" value="<?php echo TraerEstado();?>" size="10px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="pago" value="<?php echo TraeUsuario();?>" size="8px" disabled>
		
		</p>
		
		<p style="font-size:0.8em;">OBSERVACION<br>
		<textarea name="obs" rows="3" cols="100"><?php echo TraerObs();?></textarea>	

		</p>
		
		

	<p><input type="button" name="btn_volver" value="Volver" onclick="location.href = 'cns-produccion.php?asesor=<?php echo $_REQUEST['asesor'];?>&mes=<?php echo $_REQUEST['mes'];?>&anio=<?php echo $_REQUEST['anio'];?>&estado=<?php echo $_REQUEST['estado'];?>&btn_ver=Consultar'">

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

function TraeUsuario(){
	$rows = Usuario::getUsuario(3,$_REQUEST["asesor"]);
	
	foreach ($rows as $row) {
	
		return ($row['usu_nick']);
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
function TraerSemana(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_semana']);
	}
    
}
/*function TraerFecha(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_fechaafi']);
	}
    
}*/
function TraerDni(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_dniafi']);
	}
    
}
function TraerEstado(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_estado']);
	}
    
}
function TraerLocalidad(){
	$rows = Produccion::getProduccion(4,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['local_descrip']);
	}
    
}
function TraerPago(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_pago']);
	}
    
}
function TraerCta(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_cta_tar']);
	}
    
}
function TraerObs(){
	$rows = Produccion::getProduccion(2,$_REQUEST["prod_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['prod_obs']);
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
