<?php
set_time_limit(500);
include "info.php";
include "config.php";
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/sueldo.class.php";
include "libs/class/campana.class.php";
include "libs/class/liquidacion.class.php";
include "libs/class/prestamo.class.php";
include "libs/class/pagos.class.php";


$desde = null;
$hasta = null;
$recup = 0;
$nom = null;
$accion = null;

$fecha = date("d/m/Y", time());
$fch = explode("/", $fecha);
$fecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];

/*$recup=$_SESSION["usu_ide"];*/
$nom = VerUsuario($recup);


if (isset($_REQUEST['btn_ver'])) {

	$desde = $_REQUEST['desde'];
	$hasta = $_REQUEST['hasta'];
	$recup = $_REQUEST['recup'];
	$accion = $_REQUEST['accion'];


	$nom = VerUsuario($recup);
	//echo 'ROMINA - '.$nom;


} else {

	if (isset($_REQUEST['btn_limpiar'])) {

		$monto = 0;
		$accion = null;
		$nombre = "";
		$plan = null;
		$fpago = null;
		$socio = 0;
		$recibo = 0;
		$cuotas = 0;
		$total = 0;
		$liq_id = 0;
	} else {
		if (isset($_REQUEST['op'])) {

			switch ($_REQUEST['op']) {
				case 'md': //modificar
					$rows = Liquidacion::getLiquidacion(0, $_REQUEST['liq_id'], 0);
					$row = $rows->fetch();
					$socio = $row['liq_socio'];
					$nombre = $row['liq_nombre'];
					$monto = $row['liq_monto'];
					$plan = $row['liq_plan'];
					$fpago = $row['liq_fpago'];
					$recibo = $row['liq_recibo'];
					$cuotas = $row['liq_cuotas'];
					$accion = $row['liq_accion'];
					$liq_id = $row['liq_id'];

					break;
				case 'br': //borrar
					$rows = Liquidacion::deleteLiquidacion($_REQUEST['liq_id']);
					break;
			}
		} else {
			$monto = 0;
			$accion = null;
			$nombre = "";
			$plan = null;
			$fpago = null;
			$socio = 0;
			$recibo = 0;
			$cuotas = 0;
			$total = 0;
			$liq_id = 0;
		}
	}
}

?>

<!doctype html>
<html lang="en">

<head>
	<meta charset="UTF-8">

	<title>Consulta Liquidaciones</title>

	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon" />

	<script src="libs/js/jquery-1.7.2.js"></script>

	<style type="text/css">
		a.nl:link {
			text-decoration: none;
		}
	</style>


</head>

<body>

	<div id="encabezado"><img src="libs/img/encabezado22.jpg" /></div>
	<div id="menu-wrapper">
		<!--<div id="menu"><?php 
												?></div>-->
		<div id="menu"><?php TraerPerfil(); ?></div>
	</div>
	<div id="contenido">
		<a href="abm.php" class="nl">
			<h1>CONSULTA LIQUIDACION </h1>
		</a>
		<form action="" id="for_cns" action="" method="get">
			<!--<input type="hidden" name="nom" value="<?php 
																									?>">-->
			Recuperador
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Desde&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Hasta&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACCION<br>
			<select name="recup" id="recup">
				<option value=0><?php echo $nom; ?></option><?php echo VerRecuperador(); ?>
			</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="desde" value="<?php echo $desde; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="hasta" value="<?php echo $hasta; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="accion" id="accion">
				<option value="<?php echo $accion; ?>" selected="selected"><?php echo $accion; ?></option>
				<option value="TODAS">TODAS</option>
				<option value="AT1">AT1</option>
				<option value="AT2">AT2</option>
				<option value="AT">AT</option>
				<option value="RECUPERACION">RECUPERACION</option>
				<option value="REINCIDENTE">REINCIDENTE</option>
				<option value="BLANQUEO">BLANQUEO</option>
				<option value="TRAPASO VISA">TRASPASO VISA</option>
				<option value="VENTA">VENTA</option>
				<option value="PRESTAMO">PRESTAMO</option>
			</select>

			<br>
			<input type="submit" name="btn_ver" value="Consultar">

			<br><br>
			<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
				<thead>
					<th widt="3%" bgcolor=#D5DBDB>Nº</th>
					<th widt="5%" bgcolor=#D5DBDB>Fecha</th>
					<th widt="5%" bgcolor=#D5DBDB>Socio</th>
					<th widt="5%" bgcolor=#D5DBDB>Recibo</th>
					<th widt="15%" bgcolor=#D5DBDB>Afiliado Titular</th>
					<th widt="10%" bgcolor=#D5DBDB>Monto</th>
					<th widt="5%" bgcolor=#D5DBDB>PRO</th>
					<th widt="5%" bgcolor=#D5DBDB>NOA</th>
					<th widt="5%" bgcolor=#D5DBDB>NAC</th>
					<th widt="5%" bgcolor=#D5DBDB>AB</th>
					<th widt="5%" bgcolor=#D5DBDB>NOV</th>
					<th widt="5%" bgcolor=#D5DBDB>DEB</th>
					<th widt="5%" bgcolor=#D5DBDB>TAR</th>
					<th widt="5%" bgcolor=#D5DBDB>PAR</th>
					<th widt="5%" bgcolor=#D5DBDB>Cuot</th>
					<th widt="10%" bgcolor=#D5DBDB>Total</th>
					<th widt="5%" bgcolor=#BB8FCE>01</th>
					<th widt="5%" bgcolor=#BB8FCE>11</th>
					<th widt="5%" bgcolor=#BB8FCE>15</th>
					<th widt="5%" bgcolor=#D5DBDB>Accion</th>
					<th widt="5%" bgcolor=#D5DBDB>%</th>
					<th widt="5%" bgcolor=#D5DBDB>CT</th>
					<th widt="5%" bgcolor=#D5DBDB>LIQ $</th>
					<!--<th widt="5%" bgcolor=#D5DBDB>CAMP</th>-->
					<th widt="5%" bgcolor=#D5DBDB>$FOX</th>
					<th widt="5%" bgcolor=#D5DBDB>CAMPA</th>



				</thead>
				<tbody>
					<?php VerLiquidaciones($desde, $hasta, $recup, $accion); ?>
				</tbody>

			</table>

			<?php
			$rows = Usuario::getUsuario(3, $_SESSION["usu_ide"]);

			foreach ($rows as $row) {

				$per = $row['usu_perfil'];
				
			}
			if (($per == 'ROOT') or ($per == 'AUDITOR')) {
				if ($recup != 'TODAS') {
					if ($recup==7) {
						echo " <h2>RESUMEN</h2>";
						echo '<b>TOTAL A COBRAR =&nbsp;$&nbsp;' . VerComision($recup, $desde, $hasta) . '</b>&nbsp;(Comision: Blanqueos-Recuperaciones-Reindicentes)<br>';
					}
					else{echo " <h2>RESUMEN</h2>
				Basico&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;$&nbsp;" . VerBasico($recup);
					echo "<br>Comision&nbsp;&nbsp;&nbsp;=&nbsp;$&nbsp;" . VerComision($recup, $desde, $hasta);
					echo "<br>Bono 15%&nbsp;=&nbsp;$&nbsp;" . VerBono($recup, $desde, $hasta);
					echo "<br>Premio Prest=&nbsp;$&nbsp;" . VerPremio($recup, $desde, $hasta);
					//echo "<br>Bono Reemp=&nbsp;$&nbsp;3000";//SOLO PARA PPIO DEL AÑO EN REEMPLAZOS
					echo '<br><b>TOTAL A COBRAR =&nbsp;$&nbsp;' . VerCobro($recup, $desde, $hasta) . '</b><br>';}
				}
			}

			?>
			<!-- <h2>RESUMEN</h2>
			Basico&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;$&nbsp;<?php 
																																		?>
			<br>Comision&nbsp;&nbsp;&nbsp;=&nbsp;$&nbsp;<?php 
																									?>
			<br>Bono 15%&nbsp;=&nbsp;$&nbsp;<?php 
																			?>
			<br><b>TOTAL A COBRAR =&nbsp;$&nbsp;<?php 
																					?></b>-->
			<p>

				<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();">&nbsp;<input type="button" name="btn_exp" value="Exportar" onClick="JavaScript: location.href='cns-liqui-exp.php?recup=<?php echo $_GET['recup']; ?>&desde=<?php echo $_GET['desde']; ?>&hasta=<?php echo $_GET['hasta']; ?>';">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'abm.php'">
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

function VerRecuperador()
{

	$usu = $_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3, $usu);
	foreach ($rows as $row) {
		$perfil = $row['usu_perfil'];
		$estado = $row['usu_estado'];
		$nombre = $row['usu_apellido'] . " " . $row['usu_nombre'];
	}


	if (($perfil == 'RECUPERADOR') and ($estado == 'ACTIVO')) {

		echo "<option value='" . $usu . "'>" . $nombre . "</option>";
	} else {
		$rows = Usuario::getUsuario(5, 0);
		//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
		echo "<option value='TODAS'>TODAS</option>";
		foreach ($rows as $row) {

			echo "<option value='" . $row['usu_ide'] . "'>" . $row['usu_apellido'] . " " . $row['usu_nombre'] . "</option>";
		}
	}
}

function VerUsuario($recup)
{
	if ($recup == 'TODAS') {
		return $recup;
	} else {
		$rows = Usuario::getUsuario(3, $recup);
		foreach ($rows as $row) {
			return strtoupper($row['usu_apellido'] . " " . $row['usu_nombre']);
		}
	}
}
function VerBasico($recup)
{

	$ver = '';
	$bas = '';
	$cod = '';
	$rows = Usuario::getUsuario(3, $recup);

	foreach ($rows as $row) {
		$cod = $row['usu_ide'];
		$ver = $row['usu_perfil'];
	}

	//$ver='RECUPERADOR';
	$rows = Sueldo::getSueldo(1, $ver);

	foreach ($rows as $row) {

		if ($cod == 64) {
			$bas = $row['sld_basico'] / 2;
			return $bas;
		} else {
			return $row['sld_basico'];
		}
	}
}
function VerComision($recup, $desde, $hasta)
{
	$total_rec = 0;
	$subtotal = 0;
	$cuo = 0;
	$pcj = 0;
	$co9 = 0;
	$total_bono = 0;
	$desdef = explode("-", $hasta);
	$mesd = $desdef[1];
	$rows = Liquidacion::getLiquidacion2(1, $desde, $hasta, $recup);

	foreach ($rows as $row) {


		$mesp = TraerMesPago($row['liq_socio'], $row['liq_recibo'], $row['liq_emp']);
		$grupo = TraerGrupo($row['liq_socio']);
		if ($mesp <> '') {
			$pp = explode("-", $mesp);
			$mesp = $pp[0];
			$co9 = $pp[1];
		}
		switch ($row['liq_accion']) {
			case 'AT1':
				$pcj = 10;
				$cuo = $row['liq_cuotas'];
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'AT':
				$pcj = 25;
				$cuo = $row['liq_cuotas'];
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'AT2':
				$pcj = 15;
				$cuo = 1;
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'RECUPERACION':
				if ($row['liq_cuotas'] == 1) {
					$pcj = 50;
				} else {
					$pcj = 90;
				}
				$cuo = 1;
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'REINCIDENTE':
				$pcj = 90;
				$cuo = 1;
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'TRASPASO VISA':
				$pcj = 50;
				$cuo = 1;
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'VENTA':
				$pcj = 100;
				$cuo = $row['liq_cuotas'];
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'PRESTAMO':
				$pcj = 5;
				$cuo = 1;
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'NOVELL':
				$pcj = 5;
				$cuo = 1;
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;
			case 'BLANQUEO':
				if ($row['liq_recibo'] == 0) {
					$mesp = TraerMesPago2($row['liq_socio'], $row['liq_recibo'], $row['liq_emp']);
					if ($mesp <> '') {
						$pp = explode("-", $mesp);
						$mesp = $pp[0];
						$co9 = $pp[1];
					}
				}
				if (($row['liq_cuotas'] > 1) and ($co9 > 1)) {
					$pcj = 90;
				} else {
					$pcj = 50;
				}
				$cuo = 1;
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				break;

			case 'BLANQUEO':
				if ($row['liq_recibo'] == 0) {
					$mesp = TraerMesPago2($row['liq_socio'], $row['liq_recibo'], $row['liq_emp']);
					if ($mesp <> '') {
						$pp = explode("-", $mesp);
						$mesp = $pp[0];
						$co9 = $pp[1];
					}
				} else {
					$submonto = $submonto + $row['liq_monto'];
				}
				if (($row['liq_cuotas'] > 1) and ($co9 > 1)) {
					$pcj = 90;
				} else {
					$pcj = 50;
				}
				$cuo = 1;
				$subtotal = ($row['liq_monto'] * $pcj) / 100;
				$prom = $prom + 1;
				break;
			case 'ADELANTO':
				if ($row['liq_cuotas'] >= 4) {
					$pcj = 5;
				} else {
					$pcj = 0;
				}
				$cuo = 1;
				$subtotal = (($row['liq_monto'] * $row['liq_cuotas']) * $pcj) / 100;
				break;
			default:
				break;
		}
		if (($row['liq_accion'] == 'RECUPERACION') or ($row['liq_accion'] == 'REINCIDENTE')) {
			if ($grupo == 1001) {
				$subtotal = 0;
			}
		}
		if ((($row['liq_accion'] == 1) or ($row['liq_accion'] == 11)) and ($row['liq_rendido'] == 'NO')) {
			$subtotal = 0;
		}
		if ($recup==7){if (($row['liq_accion'] == 'RECUPERACION')or($row['liq_accion'] == 'REINCIDENTE')or($row['liq_accion'] == 'BLANQUEO')){$total_rec = $total_rec + $subtotal;}}
		else{$total_rec = $total_rec + $subtotal;}

		
	}

	return $total_rec;
}

function VerBono($recup, $desde, $hasta)
{
	$total_rec = 0;
	$subtotal = 0;
	$cuo = 0;
	$pcj = 0;
	$tot_rec = 0;
	$tot_blan = 0;
	$total_bono = 0;
	$totalb = 0;
	$rows = Liquidacion::getLiquidacion2(1, $desde, $hasta, $recup);

	foreach ($rows as $row) {
		$grupo = TraerGrupo($row['liq_socio']);
		switch ($row['liq_accion']) {

			case 'RECUPERACION':
				$subtotal = $row['liq_monto'] * $row['liq_cuotas'];
				if (($grupo <> 1001)) {
					$tot_rec = $tot_rec + $subtotal;
				}
				break;
			case 'BLANQUEO':
				$subtotal = $row['liq_monto'] * $row['liq_cuotas'];
				$tot_blan = $tot_blan + $subtotal;
				break;

			default:
				break;
		}
		$totalb = $tot_rec + $tot_blan;
		$total_bono = ($totalb * 15) / 100;
	}
	return $total_bono . ' (Blanqueo $' . $tot_blan . ' - ' . 'Recup $' . $tot_rec . ')';
}
function VerPremio($recup, $desde, $hasta)
{

	$cant = 0;
	$total_premio = 0;
	$af = 0;

	$rows = Liquidacion::getLiquidacion2(1, $desde, $hasta, $recup);

	foreach ($rows as $row) {
		if ($row['liq_accion'] == 'PRESTAMO') {
			$ver = VerPrestamo($row['liq_socio'], $row['liq_monto']);
			if (($ver == 1) and ($af <> $row['liq_socio'])) {
				$cant = $cant + 1;
				$af = $row['liq_socio'];
			}
		}
	}

	if (($cant >= 5) and ($cant < 10)) {
		$total_premio = 500;
	} else {
		if ($cant < 5) {
			$total_premio = 0;
		} else {
			if (($cant > 5) and ($cant <= 10)) {
				$total_premio = 1000;
			}
		}
		/*	else{(($cant>=10)and($cant<15)){$total_premio=1000;}}*/
	}

	return $total_premio;
}

function VerCobro($recup, $desde, $hasta)
{
	$total_rec = 0;
	$subtotal = 0;
	$tot_rec = 0;
	$tot_blan = 0;
	$total_bono = 0;
	$premio_pres = 0;
	$bono_ree = 3000;

	$basico = VerBasico($recup);
	$comision = VerComision($recup, $desde, $hasta);
	$premio_pres = VerPremio($recup, $desde, $hasta);

	$rows = Liquidacion::getLiquidacion2(1, $desde, $hasta, $recup);

	foreach ($rows as $row) {
		$grupo = TraerGrupo($row['liq_socio']);
		switch ($row['liq_accion']) {

			case 'RECUPERACION':
				if ($grupo <> 1001) {
					$subtotal = $row['liq_monto'] * $row['liq_cuotas'];
				} else {
					$subtotal = 0;
				}
				$tot_rec = $tot_rec + $subtotal;
				break;
			case 'BLANQUEO':
				$subtotal = $row['liq_monto'] * $row['liq_cuotas'];
				$tot_blan = $tot_blan + $subtotal;
				break;

			default:
				break;
		}
		$totalb = $tot_rec + $tot_blan;
		$total_bono = ($totalb * 15) / 100;
	}

	//$cobro=$basico + $comision + $total_bono + $premio_pres + $bono_ree; CUANDO HAY REEPLAZO
	$cobro = $basico + $comision + $total_bono + $premio_pres;
	return $cobro;
}

function VerLiquidaciones($desde, $hasta, $recup, $accion)
{
	//$desde=$_REQUEST['desde'];
	//$hasta=$_REQUEST['hasta'];
	//$recup=$_REQUEST['recup'];
	if (isset($_REQUEST['btn_ver'])) {
		$total_prom = 0;
		$campa = null;
		$pago = null;
		$cont = 0;
		$pcj = 0;
		$subtotal = 0;
		$submonto = 0;
		$cuo = 0;
		$vacio = "";
		$totrec = 0;
		$totbla = 0;
		$subcuotas = 0;
		$total_rec = 0;
		$total_cuotas = 0;
		$tot_noa = 0;
		$tot_prov = 0;
		$tot_nac = 0;
		$tot_aba = 0;
		$tot_nov = 0;
		$tot_deb = 0;
		$tot_par = 0;
		$tot_tjt = 0;
		$prom = 0;
		$ban = 0;
		$tot_caja1 = 0;
		$tot_caja11 = 0;
		$tot_caja15 = 0;

		$desdef = explode("-", $hasta);
		$mesd = $desdef[1];
		$aniod = $desdef[0];
		//$duplicado=0;
		//$dupli_rec=0;
		$prov = "";
		$noa = "";
		$nac = "";
		$aba = "";
		$nov = "";
		$par = "";
		$deb = "";
		$tar = "";
		$caja1 = "";
		$caja11 = "";
		$caja15 = "";
		if ($recup == 'TODAS') {
			if ($accion == 'TODAS') {
				$rows = Liquidacion::getLiquidacion2(3, $desde, $hasta, 0);
			} else {
				$rows = Liquidacion::getLiquidacion3(3, $desde, $hasta, $accion, 0);
			}
		} else {
			if ($accion == 'TODAS') {
				$rows = Liquidacion::getLiquidacion2(1, $desde, $hasta, $recup);
			} else {
				$rows = Liquidacion::getLiquidacion3(2, $desde, $hasta, $accion, $recup);
			}
		}


		foreach ($rows as $row) {

			//$prom=0;
			$mesp = 0;
			$seriep = 0;
			$bandif = 0;
			$bancuota = 0;
			$ban = 1;
			$duplicado = 0;
			$caja = null;
			$dupli_rec = 0;
			$rrr = 0;

			$aniop = '';
			$rrr = $row['liq_recup'];
			if (($row['liq_accion'] == 'PRESTAMO') or ($row['liq_accion'] == 'NOVELL')) {
				$total2 = 0;
			} else {
				if ((($row['liq_accion'] == 'BLANQUEO') or ($row['liq_accion'] == 'REINCIDENTE')) and ($row['liq_recibo'] == 0)) {
					$total2 = 0;
				} else {
					$total2 = $row['liq_monto'] * $row['liq_cuotas'];
				}
			}

			if ($row['liq_socio'] > 0)
			//echo $row['liq_socio'].'**'.$desde.'**'.$hasta.'&';
			{
				$duplicado = VerDuplicado($row['liq_socio'], $desde, $hasta, $row['liq_recup']);
				$dupli_rec = VerDuplRecup($row['liq_socio'], $desde, $hasta, $row['liq_recup']);

				//echo $duplicado;
				//echo $dupli_rec;
			}
			//$duplicado=Liquidacion::getLiquidacion2(2,$desde,$hasta,$row['liq_socio']);

			$cont = $cont + 1;

			//if($cant==0){ECHO'SI';}else{echo'NO';}
			$co9 = '';
			$subcuotas = $subcuotas + $total2;

			$total_cuotas = $total_cuotas + $row['liq_cuotas'];

			$dia = $row['liq_fecha'];
			$di = explode("-", $dia);
			$diad = $di[2];


			$campa = TraerCampa($row['liq_socio']);
			$pago = TraerPago($row['liq_socio'], $row['liq_recibo'], $row['liq_canrec'], $row['liq_emp']);
			$mesp = TraerMesPago($row['liq_socio'], $row['liq_recibo'], $row['liq_emp']);
			if ($mesp <> '') {
				$pp = explode("-", $mesp);
				$mesp = $pp[0];
				$co9 = $pp[1];
			}


			$grupo = TraerGrupo($row['liq_socio']);
			$seriep = TraerSerie($row['liq_socio'], $row['liq_recibo'], $row['liq_emp']);

			switch ($row['liq_accion']) {
				case 'AT1':
					if ($mesp == $mesd) {
						if ($row['liq_cuotas'] == 1) {
							if (($grupo < 3000) or ($grupo > 4004)) {
								$bancuota = 1;
							}
						}
					}
					break;
				case 'AT2':
					if ($diad <= 15) {
						$bancuota = 1;
					}
					break;
				case 'TRASPASO VISA':
					if ($grupo < 3400) {
						$bancuota = 1;
					}
					break;
				default:
					break;
			}

			if ($pago <> $total2) {
				$bandif = 1;
			}
			switch ($row['liq_plan']) {
				case 'PROVINCIA':
					$prov = "X";
					$noa = "";
					$nac = "";
					$aba = "";
					$nov = "";
					$tot_prov = $tot_prov + 1;
					break;
				case 'NOA':
					$prov = "";
					$noa = "X";
					$nac = "";
					$aba = "";
					$nov = "";
					$tot_noa = $tot_noa + 1;
					break;
				case 'NACIONAL':
					$prov = "";
					$noa = "";
					$nac = "X";
					$aba = "";
					$nov = "";
					$tot_nac = $tot_nac + 1;
					break;
				case 'ABARCAR':
					$prov = "";
					$noa = "";
					$nac = "";
					$aba = "X";
					$nov = "";
					$tot_aba = $tot_aba + 1;
					break;
				case 'NOVELL':
					$prov = "";
					$noa = "";
					$nac = "";
					$aba = "";
					$nov = "X";
					$tot_nov = $tot_nov + 1;
					break;
				default:
					break;
			}
			switch ($row['liq_fpago']) {
				case 'PARTICULAR':
					$par = "X";
					$deb = "";
					$tar = "";
					$tot_par = $tot_par + 1;
					break;
				case 'DEBITO':
					$par = "";
					$deb = "X";
					$tar = "";
					$tot_deb = $tot_deb + 1;
					break;
				case 'TARJETA':
					$par = "";
					$deb = "";
					$tar = "X";
					$tot_tjt = $tot_tjt + 1;
					break;
				default:
					break;
			}
			//$caja=substr($row['liq_caja'],0,2);
			switch ($row['liq_caja']) {
				case 01:
					$caja1 = "X";
					$caja11 = "";
					$caja15 = "";
					$tot_caja1 = $tot_caja1 + $total2;
					break;
				case 11:
					$caja1 = "";
					$caja11 = "X";
					$caja15 = "";
					$tot_caja11 = $tot_caja11 + $total2;
					break;
				case 15:
					$caja1 = "";
					$caja11 = "";
					$caja15 = "X";
					$tot_caja15 = $tot_caja15 + $total2;
					break;
				default:
					$caja1 = "";
					$caja11 = "";
					$caja15 = "";
					break;
			}

			$accion = $row['liq_accion'];
			switch ($row['liq_accion']) {
				case 'AT1':
					$pcj = 10;
					$cuo = $row['liq_cuotas'];
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					$submonto = $submonto + $row['liq_monto'];
					$prom = $prom + 1;
					break;
				case 'AT':
					$pcj = 25;
					$cuo = $row['liq_cuotas'];
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					$submonto = $submonto + $row['liq_monto'];
					$prom = $prom + 1;
					break;
				case 'AT2':
					$pcj = 15;
					$cuo = 1;
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					$submonto = $submonto + $row['liq_monto'];
					$prom = $prom + 1;
					break;
				case 'RECUPERACION':
					if ($row['liq_cuotas'] == 1) {
						$pcj = 50;
					} else {
						$pcj = 90;
					}
					$cuo = 1;
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					$submonto = $submonto + $row['liq_monto'];
					$prom = $prom + 1;
					break;
				case 'REINCIDENTE':
					$pcj = 90;
					$cuo = 1;
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					$submonto = $submonto + $row['liq_monto'];
					$prom = $prom + 1;
					break;
				case 'TRASPASO VISA':
					$pcj = 50;
					$cuo = 1;
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					break;
				case 'VENTA':
					$pcj = 100;
					$cuo = $row['liq_cuotas'];
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					$submonto = $submonto + $row['liq_monto'];
					$prom = $prom + 1;
					break;
				case 'PRESTAMO':
					$pcj = 5;
					$cuo = 1;
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					break;
				case 'NOVELL':
					$pcj = 5;
					$cuo = 1;
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					break;
				case 'BLANQUEO':
					if ($row['liq_recibo'] == 0) {
						$mesp = TraerMesPago2($row['liq_socio'], $row['liq_recibo'], $row['liq_emp']);
						if ($mesp <> '') {
							$pp = explode("-", $mesp);
							$mesp = $pp[0];
							$co9 = $pp[1];
						}
					} else {
						$submonto = $submonto + $row['liq_monto'];
					}
					if (($row['liq_cuotas'] > 1) and ($co9 > 1)) {
						$pcj = 90;
					} else {
						$pcj = 50;
					}
					$cuo = 1;
					$subtotal = ($row['liq_monto'] * $pcj) / 100;
					$prom = $prom + 1;
					break;
				case 'ADELANTO':
					if (($row['liq_cuotas'] >= 4)) {
						$pcj = 5;
					} else {
						$pcj = 0;
					}
					$cuo = 1;
					$subtotal = (($row['liq_monto'] * $row['liq_cuotas']) * $pcj) / 100;
					$submonto = $submonto + $row['liq_monto'];
					$prom = $prom + 1;
					break;
				default:
					break;
			}
			if (($row['liq_accion'] == 'RECUPERACION') or ($row['liq_accion'] == 'REINCIDENTE')) {
				if (($grupo == 1001) or ($grupo == 4004)) {
					$subtotal = 0;
				}
			}
			// if ($row['liq_rendido']<>'SI'){$subtotal=0;}
			if ($row['liq_accion'] == 'PRESTAMO') {
				$bus = VerPrestamo($row['liq_socio'], $row['liq_monto']);
				if ($bus == 0) {
					$subtotal = 0;
				}
			}
			$total_rec = $total_rec + $subtotal;

			if ($duplicado > 1) {
				echo "<tr>
			  <td bgcolor=red>" . $cont . "</td>	
			  <td bgcolor=red>" . $row['liq_fecha'] . "</td>
			  <td bgcolor=red>" . $row['liq_socio'] . "</td>
			  <td bgcolor=red>" . $row['liq_recibo'] . "</td>
			  <td bgcolor=red>" . $row['liq_nombre'] . "</td>
			  <td bgcolor=red>" . '$ ' . $row['liq_monto'] . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $prov . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $noa . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $nac . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $aba . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $nov . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $deb . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $tar . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $par . "</td>
			  <td bgcolor=red style='text-align:center;'>" . $row['liq_cuotas'] . "</td>
			  <td bgcolor=red >" . '$ ' . $total2 . "</td>
			  <td style='text-align:center;' bgcolor=red>" . $caja1 . "</td>
			  <td style='text-align:center;' bgcolor=red>" . $caja11 . "</td>
			  <td style='text-align:center;' bgcolor=red>" . $caja15 . "</td>
			  <td bgcolor=red>" . $row['liq_accion'] . "</td>
			  <td bgcolor=red>" . $pcj . "</td>
			  <td bgcolor=red>" . $cuo . "</td>
		      <td bgcolor=red>" . '$ ' . $subtotal . "</td>
		      <td bgcolor=red>$ " . $pago . '<br>M:' . $mesp . '-S:' . $seriep . "</td>
		      <td bgcolor=red>" . $campa . '-G:' . $grupo . "</td>
		      
		
		     </tr>";
			} else {
				if ($dupli_rec > 0) {
					echo "<tr>
			  		<td bgcolor=#BB8FCE>" . $cont . "</td>	
			  		<td bgcolor=#BB8FCE>" . $row['liq_fecha'] . "</td>
			  		<td bgcolor=#BB8FCE>" . $row['liq_socio'] . "</td>
			  		<td bgcolor=#BB8FCE>" . $row['liq_recibo'] . "</td>
			  		<td bgcolor=#BB8FCE>" . $row['liq_nombre'] . "</td>
			  		<td bgcolor=#BB8FCE>" . '$ ' . $row['liq_monto'] . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $prov . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $noa . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $nac . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $aba . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $nov . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $deb . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $tar . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $par . "</td>
			  		<td bgcolor=#BB8FCE style='text-align:center;'>" . $row['liq_cuotas'] . "</td>
			  		<td bgcolor=#BB8FCE >" . '$ ' . $total2 . "</td>
			  		<td style='text-align:center;' bgcolor=#BB8FCE>" . $caja1 . "</td>
			  		<td style='text-align:center;' bgcolor=#BB8FCE>" . $caja11 . "</td>
			  		<td style='text-align:center;' bgcolor=#BB8FCE>" . $caja15 . "</td>
			  		<td bgcolor=#BB8FCE>" . $row['liq_accion'] . "</td>
			  		<td bgcolor=#BB8FCE>" . $pcj . "</td>
			  		<td bgcolor=#BB8FCE>" . $cuo . "</td>";

					//  		<td bgcolor=#BB8FCE>".'$ '.$subtotal."</td>
					if ($subtotal == 0) {
						echo "<td bgcolor=red>" . '$ ' . $subtotal . "</td>";
					} else {
						echo "<td bgcolor=#BB8FCE>" . '$ ' . $subtotal . "</td>";
					}

					echo "<td bgcolor=#BB8FCE>$ " . $pago . '<br>M:' . $mesp . '-S:' . $seriep . "</td>";
					if (($grupo == 1001) or ($grupo == 4004)) {
						echo "
		      		<td bgcolor=red>" . $campa . '-G:' . $grupo . "</td>";
					} else {
						echo "
		      		<td bgcolor=#BB8FCE>" . $campa . '-G:' . $grupo . "</td>";
					}



					echo "</tr>";
				} else {
					if ($bandif == 1) {
						echo "<tr>
			  		<td bgcolor=aqua>" . $cont . "</td>	
			  		<td bgcolor=aqua>" . $row['liq_fecha'] . "</td>
			  		<td bgcolor=aqua>" . $row['liq_socio'] . "</td>
			  		<td bgcolor=aqua>" . $row['liq_recibo'] . "</td>
			  		<td bgcolor=aqua>" . $row['liq_nombre'] . "</td>
			  		<td bgcolor=aqua>" . '$ ' . $row['liq_monto'] . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $prov . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $noa . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $nac . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $aba . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $nov . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $deb . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $tar . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $par . "</td>
			  		<td bgcolor=aqua >" . $row['liq_cuotas'] . "</td>
			  		<td bgcolor=aqua>" . '$ ' . $total2 . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $caja1 . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $caja11 . "</td>
			  		<td bgcolor=aqua style='text-align:center;'>" . $caja15 . "</td>
			  		<td bgcolor=aqua>" . $row['liq_accion'] . "</td>
			  		<td bgcolor=aqua>" . $pcj . "</td>
			  		<td bgcolor=aqua>" . $cuo . "</td>";
						//<td bgcolor=aqua>".'$ '.$subtotal."</td>
						if ($subtotal == 0) {
							echo "<td bgcolor=red>" . '$ ' . $subtotal . "</td>";
						} else {
							echo "<td bgcolor=aqua>" . '$ ' . $subtotal . "</td>";
						}

						echo "<td bgcolor=aqua>$ " . $pago . '<br>M:' . $mesp . '-S:' . $seriep . "</td>";
						if (($grupo == 1001) or ($grupo == 4004)) {
							echo "
		      		<td bgcolor=red>" . $campa . '-G:' . $grupo . "</td>";
						} else {
							echo "
		      		<td bgcolor=aqua>" . $campa . '-G:' . $grupo . "</td>";
						}



						echo "</tr>";
						echo "</tr>";
					} else {
						if ($bancuota == 1) {
							echo "<tr>
			  		<td bgcolor=pink>" . $cont . "</td>	
			  		<td bgcolor=pink>" . $row['liq_fecha'] . "</td>
			  		<td bgcolor=pink>" . $row['liq_socio'] . "</td>
			  		<td bgcolor=pink>" . $row['liq_recibo'] . "</td>
			  		<td bgcolor=pink>" . $row['liq_nombre'] . "</td>
			  		<td bgcolor=pink>" . '$ ' . $row['liq_monto'] . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $prov . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $noa . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $nac . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $aba . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $nov . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $deb . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $tar . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $par . "</td>
			  		<td bgcolor=pink >" . $row['liq_cuotas'] . "</td>
			  		<td bgcolor=pink>" . '$ ' . $total2 . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $caja1 . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $caja11 . "</td>
			  		<td bgcolor=pink style='text-align:center;'>" . $caja15 . "</td>
			  		<td bgcolor=pink>" . $row['liq_accion'] . "</td>
			  		<td bgcolor=pink>" . $pcj . "</td>
			  		<td bgcolor=pink>" . $cuo . "</td>";
							//<td bgcolor=pink>".'$ '.$subtotal."</td>
							if ($subtotal == 0) {
								echo "<td bgcolor=red>" . '$ ' . $subtotal . "</td>";
							} else {
								echo "<td bgcolor=pink>" . '$ ' . $subtotal . "</td>";
							}

							echo "<td bgcolor=pink>$ " . $pago . '<br>M:' . $mesp . '-S:' . $seriep . "</td>";
							if (($grupo == 1001) or ($grupo == 4004)) {
								echo "
		      		<td bgcolor=red>" . $campa . '-G:' . $grupo . "</td>";
							} else {
								echo "
		      		<td bgcolor=pink>" . $campa . '-G:' . $grupo . "</td>";
							}



							echo "</tr>";

							echo "</tr>";
						} else {
							echo "<tr>
			  		<td>" . $cont . "</td>	
			  		<td>" . $row['liq_fecha'] . "</td>
			  		<td>" . $row['liq_socio'] . "</td>
			  		<td>" . $row['liq_recibo'] . "</td>
			  		<td>" . $row['liq_nombre'] . "</td>
			  		<td>" . '$ ' . $row['liq_monto'] . "</td>
			  		<td style='text-align:center;'>" . $prov . "</td>
			  		<td style='text-align:center;'>" . $noa . "</td>
			  		<td style='text-align:center;'>" . $nac . "</td>
			  		<td style='text-align:center;'>" . $aba . "</td>
			  		<td style='text-align:center;'>" . $nov . "</td>
			  		<td style='text-align:center;'>" . $deb . "</td>
			  		<td style='text-align:center;'>" . $tar . "</td>
			  		<td style='text-align:center;'>" . $par . "</td>
			  		<td >" . $row['liq_cuotas'] . "</td>
			  		<td>" . '$ ' . $total2 . "</td>
			  		<td style='text-align:center;'>" . $caja1 . "</td>
			  		<td style='text-align:center;'>" . $caja11 . "</td>
			  		<td style='text-align:center;'>" . $caja15 . "</td>
			  		<td>" . $row['liq_accion'] . "</td>
			  		<td>" . $pcj . "</td>
			  		<td>" . $cuo . "</td>";
							//<td>".'$ '.$subtotal."</td>
							if ($subtotal == 0) {
								echo "<td bgcolor=red>" . '$ ' . $subtotal . "</td>";
							} else {
								echo "<td >" . '$ ' . $subtotal . "</td>";
							}
							echo "<td>$ " . $pago . '<br>M:' . $mesp . '-S:' . $seriep . "</td>";
							if (($grupo == 1001) or ($grupo == 4004)) {
								echo "
		      		<td bgcolor=red>" . $campa . '-G:' . $grupo . "</td>";
							} else {
								echo "
		      		<td >" . $campa . '-G:' . $grupo . "</td>";
							}



							echo "</tr>";

							echo "</tr>";
						}
					}
				}
			}
		}
		if ($ban == 1) {
			if ($accion != 'PRESTAMO') {
				$total_prom = $submonto / $prom;
				$total_prom = round($total_prom, 2);
			}
		}
		echo "<tr>
			  <td>" . $vacio . "</td>	
			  <td>" . $vacio . "</td>
			  <td>" . $vacio . "</td>
			  <td>" . $vacio . "</td>
			  <td>" . $vacio . "</td>
			  <td bgcolor='yellow'><b>" . '$ ' . $submonto . "</b></td>
			  <td style='text-align:center;'><b>" . $tot_prov . "</b></td>
			  <td style='text-align:center;'><b>" . $tot_noa . "</b></td>
			  <td style='text-align:center;'><b>" . $tot_nac . "</b></td>
			  <td style='text-align:center;'><b>" . $tot_aba . "</b></td>
			  <td style='text-align:center;'><b>" . $tot_nov . "</b></td>
			  <td style='text-align:center;'><b>" . $tot_deb . "</b></td>
			  <td style='text-align:center;'><b>" . $tot_tjt . "</b></td>
			  <td style='text-align:center;'><b>" . $tot_par . "</b></td>
			  <td style='text-align:center;'><b>" . $total_cuotas . "</b></td>
			  <td bgcolor='yellow'><b>" . '$ ' . $subcuotas . "</b></td>
			  <td bgcolor='yellow'><b>" . '$ ' . $tot_caja1 . "</b></td>
			  <td bgcolor='yellow'><b>" . '$ ' . $tot_caja11 . "</b></td>
			  <td bgcolor='yellow'><b>" . '$ ' . $tot_caja15 . "</b></td>
			  <td>" . $vacio . "</td>
			  <td>" . $vacio . "</td>
			  <td>" . $vacio . "</td>
		      <td bgcolor=#AED6F1><b>" . '$ ' . $total_rec . "</b></td>
		       
		     </tr>";
		echo "<tr>
			  <td>" . $vacio . "</td>	
			  <td>" . $vacio . "</td>
			  <td>" . $vacio . "</td>
			  <td>" . $vacio . "</td>
			  <td> <b>CUOTA PROMEDIO</b></td>
			  <td bgcolor='yellow'><b>" . '$ ' . $total_prom . "</b></td>
		     </tr>";
	}
}


function VerDuplicado($socio, $desde, $hasta, $rec)
{ // busca duplicado en misma liq
	$val = 0;
	$hasta = $_REQUEST['hasta'];
	//echo $rec;

	$rows = Liquidacion::getLiquidacion3(1, $desde, $hasta, $socio, $rec);

	foreach ($rows as $row) {
		$val = $val + 1;
	}

	return ($val);
}

function VerDuplRecup($socio, $desde, $hasta, $rec)
{ //busca duplicado con otras liquidaciones
	$val = 0;
	/*$c=0;
	echo $socio;*/
	$rows = Liquidacion::getLiquidacion3(0, $desde, $hasta, $socio, $rec);

	foreach ($rows as $row) {
		//$c=$c+1;

		if ($rec <> $row['liq_recup']) {
			$val = $val + 1;
		}
	}
	//echo $c;
	return ($val);
}


function TraerPerfil()
{
	$usu = $_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3, $_SESSION["usu_ide"]);

	foreach ($rows as $row) {

		$per = $row['usu_perfil'];
	}
	switch ($per) {
		case 'VENTAS':
			include('menu_vta.php');
			break;
		case 'ASESOR':
			include('menu_vta.php');
			break;
		case 'RECUPERADOR':
			include('menu_rec.php');
			break;
		case 'ROOT':
			include('menu.php');
			break;
		case 'AUDITOR':
			include('menu.php');
			break;
		default:
			break;
	}
}
function TraerCampa($socio)
{
	$campa = null;
	//echo $socio;
	$rows = Campana::getCampana(0, $socio);

	foreach ($rows as $row) {

		$campa = $row['CAMPANA'];
	}

	return $campa;
}

function TraerPago($socio, $recibo, $cant, $emp)
{
	$pago = 0;
	$desde = $_REQUEST['desde'];
	if ($emp == 'W') {
		if ($cant == 0) {
			$rows = Pagos::getpagos3(0, $socio, $recibo, $desde);
		} else {
			$rows = Pagos::getpagos3(1, $socio, $recibo, $desde);
		}
	} else {

		if ($cant == 0) {
			$rows = Pagos::getpagos3(3, $socio, $recibo, $desde);
		} else {
			$rows = Pagos::getpagos3(4, $socio, $recibo, $desde);
		}
	}
	//$rows = Pagos::getpagos3(0,$socio,$recibo,$desde);
	//$rows = Pagos::getpagos3(1,$socio,$recibo,$desde);
	foreach ($rows as $row) {

		$pago = $pago + $row['IMPORTE'];
	}

	return 	$pago;
}
function TraerGrupo($socio)
{
	$grupo = 0;

	$rows = Maestro::getMaestro(7, $socio);
	foreach ($rows as $row) {

		$grupo = $row['GRUPO'];
	}

	return 	$grupo;
}
function TraerMesPago($socio, $recibo, $emp)
{
	$mesp = '';
	$desde = $_REQUEST['desde'];
	$desdef = explode("-", $desde);
	$aniod = $desdef[0];
	$mesd = $desdef[1];
	$cont = 0;
	if ($emp = 'W') {
		$rows = Pagos::getpagos3(0, $socio, $recibo, $desde);
	} else {
		$rows = Pagos::getpagos3(3, $socio, $recibo, $desde);
	}
	foreach ($rows as $row) {
		if (($row['ANO'] < $aniod) or (($row['ANO'] == $aniod) and ($row['MES'] <> $mesd)) and ($row['MOVIM'] == 'P')) {
			$cont = $cont + 1;
		}
		$mesp = $row['MES'] . '-' . $cont;
	}

	return 	$mesp;
}

function TraerMesPago2($socio, $recibo, $emp)
{
	$mesp = '';
	$desde = $_REQUEST['desde'];
	$desdef = explode("-", $desde);
	$aniod = $desdef[0];
	$mesd = $desdef[1];
	$cont = 0;
	if ($emp = 'W') {
		$rows = Pagos::getpagos3(2, $socio, $recibo, $desde);
	} else {
		$rows = Pagos::getpagos3(5, $socio, $recibo, $desde);
	}

	foreach ($rows as $row) {
		if (($row['ANO'] < $aniod) or (($row['ANO'] == $aniod) and ($row['MES'] <> $mesd))) {
			$cont = $cont + 1;
		}
		$mesp = $row['MES'] . '-' . $cont;
	}

	return 	$mesp;
}

function TraerSerie($socio, $recibo, $emp)
{
	$seriep = 0;
	$desde = $_REQUEST['desde'];
	if ($emp == 'W') {
		$rows = Pagos::getpagos3(0, $socio, $recibo, $desde);
	} else {
		$rows = Pagos::getpagos3(3, $socio, $recibo, $desde);
	}

	foreach ($rows as $row) {
		$seriep = $row['SERIE'];
	}

	return 	$seriep;
}
function VerPrestamo($socio, $monto)
{
	$bus = 0;
	$hasta = $_REQUEST['hasta'];
	$desde = $_REQUEST['desde'];

	$rows = Prestamo::getPrestamo(6, $socio, 0);
	foreach ($rows as $row) {

		if ((($row['ptm_estado'] == 'ACTIVO') or ($row['ptm_estado'] == 'APROBADO')) and (($row['ptm_fechasol'] >= $desde) and ($row['ptm_fechasol'] <= $hasta)) and ($row['ptm_prestamo'] == $monto)) {
			$bus = 1;
		}
	}

	return 	$bus;
}
?>