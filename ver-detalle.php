<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/Maestro.class.php";
   include "libs/class/pagos.class.php";
   include "libs/class/Otro.class.php";
  
$recup=$_GET['recup'];
$estado=$_GET['estado'];
$archivo=$_GET['archivo'];
$vista=$_GET['vista'];
$anio=$_GET['anio'];
$mes=$_GET['mes'];
$accion=$_GET['accion'];
	

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Detalle de Mora</title>
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
		
		<div id="doctip"><h1>DETALLE DE MORA:&nbsp;<?php echo  $mes.' '. $anio.' - '.$accion; ?></h1></div>

		<form action="" id="formulario" action="" >

		<input type="hidden" name="recup" value="<?php echo $recup; ?>">	
		<input type="hidden" name="accion" value="<?php echo $accion; ?>">	
		<input type="hidden" name="estado" value="<?php echo $estado; ?>">
		<input type="hidden" name="archivo" value="<?php echo $archivo; ?>">
		<input type="hidden" name="anio" value="<?php echo $anio; ?>">
		<input type="hidden" name="mes" value="<?php echo $mes; ?>">
		<input type="hidden" name="vista" value="<?php echo $vista;?>">
		
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%" bgcolor=#D5DBDB>Nº</th>
				<th widt="15%" bgcolor=#D5DBDB>Contrato</th>
				<th widt="15%" bgcolor=#D5DBDB>Afiliado</th>
				<th widt="15%" bgcolor=#85C1E9>Deuda</th>
				<th widt="15%" bgcolor=#85C1E9>FormaPago</th>
				<th widt="15%" bgcolor=#85C1E9>Campania</th>
				<th widt="15%" bgcolor=#85C1E9>PAGO</th>
				<th widt="15%" bgcolor=#85C1E9>$</th>
				
				
				
						
			</thead>
			<tbody>
				<?php VerDetalle(); ?>
			</tbody>
	
		</table>
		
		

	<p><input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_volver" value="Volver" onclick="location.href = 'inf-mora.php?mes=<?php echo $_GET['mes'];?>&anio=<?php echo $_GET['anio'];?>&recup=<?php echo $_GET['recup'];?>&vista=<?php echo $_GET['vista'];?>&btn_consultar=Consultar&btn_ver=Ver'">


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

function TraerAfi($afi){
	
	$rows = Maestro::getMaestro(7,$afi);
	if($rows->rowCount()!=0){	
		foreach ($rows as $row) {
	
			return ($row['NOMBRES'].' '.$row['APELLIDOS']);
		}
    }
    else{$ver='BAJA'; return($ver);}
}

function VerDetalle(){
	
	$recup=$_GET['recup'];
	$accion=$_GET['accion'];
	$estado=$_GET['estado'];
	$archivo=$_GET['archivo'];
	$cont=0;
	if ($accion=='RECUPERACION'){
		if ($estado==2){
			if ($recup=='TODAS'){$rows = Otro::getOtro2(2,$archivo,0,$accion,0);}
			else{
				switch ($recup) {
				case 'L': $rows = Otro::getOtro2(1,$archivo,$recup,$accion,0);break;
				case 'R': $rows = Otro::getOtro2(1,$archivo,$recup,$accion,0);break;
				case 'P': $rows = Otro::getOtro2(1,$archivo,$recup,$accion,0);break;
				default: $rows = Otro::getOtro2(0,$archivo,$recup, $accion,0);break;
				}
			}	
		}
		else{
			if ($recup=='TODAS'){$rows = Otro::getOtro2(3,$archivo,0,$accion,$estado);}
			else{
				switch ($recup) {
				case 'L': $rows = Otro::getOtro2(4,$archivo,$recup,$accion,$estado);break;
				case 'R': $rows = Otro::getOtro2(4,$archivo,$recup,$accion,$estado);break;
				case 'P': $rows = Otro::getOtro2(4,$archivo,$recup,$accion,$estado);break;
				default:$rows = Otro::getOtro2(5,$archivo,$recup, $accion,$estado);break;
				}
			}		
		}
	}
	else{
		
			if ($accion=='ATRASADO'){	
				$acc='RECUPERACION';
				if ($estado==2){
					if ($recup=='TODAS'){$rows = Otro::getOtro2(6,$archivo,0,$acc,0);}
					else{
						switch ($recup) {
							case 'L': $rows = Otro::getOtro2(7,$archivo,$recup,$acc,0);break;
							case 'R': $rows = Otro::getOtro2(7,$archivo,$recup,$acc,0);break;
							case 'P': $rows = Otro::getOtro2(7,$archivo,$recup,$acc,0);break;
							default: $rows = Otro::getOtro2(8,$archivo,$recup, $acc,0);break;
						}
					}	
				}
				else{
					if ($recup=='TODAS'){$rows = Otro::getOtro2(15,$archivo,0,$acc,$estado);}
					else{
						switch ($recup) {
							case 'L': $rows = Otro::getOtro2(17,$archivo,$recup,$acc,$estado);break;
							case 'R': $rows = Otro::getOtro2(17,$archivo,$recup,$acc,$estado);break;
							case 'P': $rows = Otro::getOtro2(17,$archivo,$recup,$acc,$estado);break;
							default:$rows = Otro::getOtro2(16,$archivo,$recup, $acc,$estado);break;
						}
					}		
				}		
			}
			else{
				if ($estado==2){
					if ($recup=='TODAS'){$rows = Otro::getOtro2(11,$archivo,0,$accion,0);}
					else{
						switch ($recup) {
							case 'L': $rows = Otro::getOtro2(12,$archivo,$recup,$accion,0);break;
							case 'R': $rows = Otro::getOtro2(12,$archivo,$recup,$accion,0);break;
							case 'P': $rows = Otro::getOtro2(12,$archivo,$recup,$accion,0);break;
							default: $rows = Otro::getOtro2(13,$archivo,$recup, $accion,0);break;
						}
					}	
				}
				else{
					if ($recup=='TODAS'){$rows = Otro::getOtro2(14,$archivo,0,$accion,$estado);}
					else{
						switch ($recup) {
							case 'L': $rows = Otro::getOtro2(18,$archivo,$recup,$accion,$estado);break;
							case 'R': $rows = Otro::getOtro2(18,$archivo,$recup,$accion,$estado);break;
							case 'P': $rows = Otro::getOtro2(18,$archivo,$recup,$accion,$estado);break;
							default:$rows = Otro::getOtro2(19,$archivo,$recup, $accion,$estado);break;
						}
					}		
				}	
			}	
	}

	if($rows->rowCount()!=0){	
			foreach ($rows as $row) {
				$cont=$cont+1;
				$afi=$row['ID_ABONADO'];
				$deuda=$row['DEUDA'];
				$campa=$row['CAMPANIA'];
				$fpago=$row['FORMA_PAGO'];
				$monto=$row['IMP_PAGO'];
				$est=$row['ESTADO'];
				$nombre=TraerAfi($afi);

				if ($est==1){$pago='SI';}else{$pago='NO'; }
				if ($estado==2){
					if ($est==1){echo "<tr>
			  						<td style='text-align:center;'bgcolor=pink>".$cont."</td>	
			  						<td bgcolor=pink >".$afi."</td>
			  						<td bgcolor=pink>".$nombre."</td>
			  						<td bgcolor=pink>".$deuda."</td>
			  						<td bgcolor=pink>".$fpago."</td>
			  						<td bgcolor=pink>".$campa."</td>
			  						<td bgcolor=pink>".$pago."</td>
			  						<td bgcolor=pink>$ ".$monto."</td>
			  					</tr>";	}
			  		else{echo "<tr>
			  						<td style='text-align:center;'>".$cont."</td>	
			  						<td  >".$afi."</td>
			  						<td  >".$nombre."</td>
			  						<td  >".$deuda."</td>
			  						<td  >".$fpago."</td>
			  						<td  >".$campa."</td>
			  						<td  >".$pago."</td>
			  						<td  >$ ".$monto."</td>
			  					</tr>";

			  		}
				}
				else{
					echo "<tr>
			  		<td style='text-align:center;'>".$cont."</td>	
			  		<td  >".$afi."</td>
			  		<td  >".$nombre."</td>
			  		<td  >".$deuda."</td>
			  		<td  >".$fpago."</td>
			  		<td  >".$campa."</td>
			  		<td  >".$pago."</td>
			  		<td  >$ ".$monto."</td>
			  		</tr>";	
				}	
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
