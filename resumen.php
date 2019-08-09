<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/Maestro.class.php";
   include "libs/class/usuario.class.php";
   include "libs/class/liquidacion.class.php"; 

$desde=$_GET['desde'];
$hasta=$_GET['hasta'];
  	

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Resumen de Recibos</title>
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
		<div id="menu"><?php //TraerPerfil(); ?></div>
	</div>	
	<div id="contenido">	
		
		<div id="doctip"><h1>RECIBOS DEL PERIODO:&nbsp;<?php echo  $_GET["desde"].' a '. $_GET["hasta"]; ?></h1></div>

		<form action="" id="formulario" action="" >

		
		<input type="hidden" name="desde" value="<?php echo $desde; ?>">
		<input type="hidden" name="hasta" value="<?php echo $hasta; ?>">
		
		<table width="80%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%" bgcolor=#D5DBDB>Nº</th>
				<th widt="10%" bgcolor=#D5DBDB>Fecha</th>
				<th widt="10%" bgcolor=#D5DBDB>Afiliado</th>
				<th widt="10%" bgcolor=#85C1E9>Recibo</th>
				<th widt="10%" bgcolor=#85C1E9>Tipo</th>
				<th widt="10%" bgcolor=#85C1E9>Monto</th>
				<th widt="10%" bgcolor=#85C1E9>Usuario</th>
			</thead>
			<tbody>
				<?php VerRecibos(); ?>
			</tbody>
		</table>
			

	<p><input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_volver" value="Volver" onclick="location.href = 'rsm-liquidacion.php?desde=<?php echo $_REQUEST['desde'];?>&hasta=<?php echo $_REQUEST['hasta'];?>&btn_ver=Consultar'">

	</p>		
</form>
	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php

function VerRecibos(){
	
	$desde=$_GET['desde'];
	$hasta=$_GET['hasta'];
	$total_gral=0;
	$total_1=0;
	$total_11=0;
	$total_15=0;
	$total_premio=0;
	$ventas=0;
	$ventas_efec=0;
	$vtas_caidas=0;
	$envio=null;
	$rowsP=liquidacion::getLiquidacion2(4,$desde,$hasta,0);		
		if($rowsP->rowCount()!=0){	
			foreach ($rowsP as $rowP) {
				if (($rowP['liq_accion']<>'PRESTAMO')and($rowP['liq_recibo']>0)){
				$ventas=$ventas+1;
				$rec=$rowP['liq_recup'];
				$usu=TraerUsuario($rec);
				$monto=$rowP['liq_monto']*$rowP['liq_cuotas'];
				switch ($rowP['liq_caja']) {
					case 1:
						$total_1=$total_1+$monto;
					break;
					case 11:
						$total_11=$total_11+$monto;
					break;
					case 15:
						$total_15=$total_15+$monto;
					break;
					
					default:break;
				}
				$total_gral=$total_gral+$monto;
				echo "<tr>
			  		<td style='text-align:center;'>".$ventas."</td>	
			  		<td  >".$rowP['liq_fecha']."</td>
			  		<td  >".$rowP['liq_socio']."</td>
			  		<td  >".$rowP['liq_recibo']."</td>
			  		<td  >".$rowP['liq_caja']."</td>
			  		<td  >$ ".$monto."</td>
			  		<td  >".$usu."</td>
			  					  		
			  		</tr>";	
			  	}	
			}
	    echo"<tr><td></td></tr>";
		echo"<tr><td bgcolor=#85C1E9><b>RESUMEN</b></td>
		<td bgcolor=#85C1E9><b>TOTAL 1= $ ".$total_1."</b></td>
		<td bgcolor=#85C1E9><b>TOTAL 11= $ ".$total_11." </b></td>
		<td bgcolor=#85C1E9><b>TOTAL 15= $ ".$total_15." </b></td>
		<td bgcolor=#85C1E9><b>TOTAL GRAL= $ ".$total_gral."</b></td>
		</tr>";

		}		
}	 


function TraerUsuario($rec){


$rows = Usuario::getUsuario(3,$rec);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_nick'];

	}
return($perfil);

}

?>
