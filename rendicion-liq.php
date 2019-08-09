<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/liquidacion.class.php";


$asesor='';$rendido='';$fecha=null;$nombre=null;$monto=null;$recibo=null;$estado=null;$plan=null;$pago=null;$estado=null;$prod_ide=null;
$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$mes=VerMes();

$usu=$_SESSION["usu_ide"];
$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];
	}

if (($perfil =='RENDICION')or ($perfil =='ROOT')){
	if (isset($_REQUEST['btn_ver'])){
		$asesor=$_REQUEST['asesor'];
		$desde=$_REQUEST['desde'];
		$hasta=$_REQUEST['hasta'];
	}
	if (isset($_REQUEST['btn_guardar'])){
		   $mes=$_REQUEST['mes'];
		   $anio=$_REQUEST['anio'];
		   $asesor=$_REQUEST['asesor'];
		   $prod_ide=$_REQUEST['prod_ide'];
		   //echo'romina';
		//echo 'RO'.$_REQUEST['prod_ide'];
		$rows = Produccion::updateProduccion1(3,$_REQUEST['prod_ide'], $_REQUEST['rendido'],0);
		/*$dni=0; $zona = null; $nombre = ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
		$prestamo=0;$cuotas=0;$neto=0;$val_cuota=0;$ptm_id=0;$op=0;$ptj=0;$total=0;$vcuota=0;$estado=null;$usu=null;*/

		print'<script type="text/javascript">
		window.location="rendicion.php?asesor='.$asesor.'&mes='.$mes.'&anio='.$anio.'&btn_ver=Consultar";
		</script>';
	}
	else{
			if (isset($_REQUEST['op'])){
				switch ($_REQUEST['op']) {
					case 'md': //modificar
						$rendido='SI';
						$fecren=$fecha;
						$rows = Liquidacion::UpdateLiquidacion2($_REQUEST['liq_id'],$rendido,$fecren);
					/*	$row = $rows->fetch();
						$fecha = $row['prod_fechaafi'];
						$nombre = $row['prod_apeafi']." ".$row['prod_nomafi']; 
						$recibo = $row['prod_recibo'];
						$monto = $row['prod_monto'];
						$plan = $row['prod_plan'];
						$pago = $row['prod_pago'];
						$estado = $row['prod_estado'];
						$rendido = $row['prod_rendido'];
						$estado = $row['prod_estado'];
						$asesor=$_REQUEST['asesor'];
						$mes=$row['prod_mes'];
						$anio=$row['prod_anio'];
						$prod_ide=$row['prod_ide'];*/
			
				break;
				}	
			}
	}

}
else{
	print '<script language="JavaScript">'; 
	print 'alert("NO ESTA HABILITADO PARA LA OPCION SOLICITADA");'; 
	print'</script>';
	print'<script type="text/javascript">
window.location="asesores.php";
</script>';
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Rendicion-Produccion</title>
	
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
		<a href="abm.php" class="nl"><h1>LIQUIDACION</h1></a>
		<form action="" id="formulario" >
			<input type="hidden" name="prod_ide" value="<?php echo $prod_ide; ?>">
			<!--<input type="hidden" name="asesor" value="<?php echo $asesor; ?>">-->
			<p style="font-size:0.8em;">ASESOR: <select name="asesor" id="asesor"><option value=<?php echo $asesor; ?>><?php echo VerUsuario($asesor); ?></option><?php echo VerAsesor();?></select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		Desde: <input type="date" name="desde" value="<?php echo $desde; ?>" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Hasta: <input type="date" name="hasta" value="<?php echo $hasta; ?>" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="btn_ver" value="Consultar">	
		</p>	
		
		<!--<p style="font-size:0.8em;">Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apellido y Nombre<br>
		<input type="text" name="fecha" value="<?php echo $fecha; ?>" size="8px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="nombre" value="<?php echo $nombre; ?>" size="50px" disabled>
		</p>
		<p style="font-size:0.8em;">Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estado<br>	
		<input type="text" name="recibo" value="<?php echo $recibo; ?>" size="5px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		$<input type="text" name="monto" value="<?php echo $monto; ?>" size="5px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="plan" value="<?php echo $plan; ?>" size="8px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="pago" value="<?php echo $pago; ?>" size="8px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="estado" value="<?php echo $estado; ?>" size="10px" disabled>
		</p>
				
		<p style="font-size:0.8em;"><b>RENDIDO:</b>&nbsp;&nbsp;&nbsp;<select name="rendido" id="rendido" >
		<option value= "<?php echo $rendido; ?>" selected="selected"><?php echo $rendido; ?></option>
			<option value="SI">SI</option>
			<option value="NO">NO</option>
		</select>	</p>-->

		<p><!--<input type="submit" name="btn_guardar" value="Guardar" >&nbsp;--><input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'"></p>
		</form>
		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="5%">Fecha</th>
				<th widt="10%">Nombre</th>
				<th widt="15%">Recibo</th>
				<th widt="15%">Monto</th>
				<th widt="5%">Afiliado</th>
				<!--<th widt="10%">Estado</th>-->
				<th widt="5%">Rendido</th>
				<th widt="5%">Edit</th>
				
			</thead>
			<tbody>
				<?php VerLiquidaciones();?>
			</tbody>
		</table>
	</div>
	<br>
	<div id="footer">
		<center>Werchow - Año 2018 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php

function VerLiquidaciones(){
	
	if (isset($_REQUEST['btn_ver'])or isset($_REQUEST['btn_guardar'])){

	$asesor=$_REQUEST["asesor"];
	$desde=$_REQUEST["desde"];
	$hasta=$_REQUEST["hasta"];
	$cont=0;

	
	$rows = Liquidacion::getLiquidacion2(1,$desde,$hasta,$asesor);
	
	if($rows->rowCount()!=0){
	
	foreach ($rows as $row) {
			
			if ($row['liq_recibo']>0){
				$cont=$cont+1;
				echo "<tr>
			  		<td>".$cont."</td>	
			  		<td>".$row['liq_fecha']."</td>
			  		<td>".$row['liq_nombre']."</td>
			  		<td>".$row['liq_recibo']."</td>
			  		<td>".$row['liq_monto']."</td>
			  		<td>".$row['liq_socio']."</td>
			 		<td>".$row['liq_rendido'].' / '.$row['liq_fechren']."</td>";
			 		if ($row['liq_rendido']!='SI'){
			    	ECHO"<td><center><a href='?op=md&liq_id=".$row['liq_id']."&asesor=".$asesor."&desde=".$desde."&hasta=".$hasta."&btn_ver=Consultar'><img src='libs/img/campa.jpg' ></a><center></td>";
					}		     	
				echo"</tr>";
			}	
	    }
	}
else
	echo 'CONSULTA VACIA';	
}
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
    		
    		$rows = Usuario::getUsuario(11,0);
			//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
		
			foreach ($rows as $row) {
				if ($row['usu_estado']=='ACTIVO')
					{echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";}
			}
    }
}

function VerUsuario($recup){
	
	if ($recup==0){ $ve='';return $ve;}
	else{ 
		$rows = Usuario::getUsuario(3,$recup);
	
		foreach ($rows as $row) {
	
			return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
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
				case 'ROOT':include ('menu.php'); break;
				case 'RENDICION':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}

function VerMes(){
	
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	//echo $fch[1];
	if ($fch[0]>15){$prueba=$fch[1]+1;}else{$prueba=$fch[1];}
	switch ($prueba) {
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