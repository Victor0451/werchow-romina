<?php
include "config.php";
include "libs/class/maestro.class.php";
include "libs/class/cuo_fija.class.php";
include "libs/class/pagos.class.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Informes - CONSULTA 3 ULTIMOS MESES</title>
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="libs/js/jquery-1.7.2.js"></script>
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>
</head>
<body>
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>

	<div id="menu-wrapper">
		<div id="menu"><?php include "menu.php"; ?></div>
	</div>	
	<div id="contenido">

	<input type="hidden" name="empleado" value="<?php echo $_GET['empleado']; ?>">
	<input type="hidden" name="anio" value="<?php echo $_GET['anio']; ?>">
		
		<a href="informes.php" class="nl"><h1>CONSULTA</h1></a>
	
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="10%">Pago</th>
				<th widt="15%">Mes</th>
				<th widt="20%">Año</th>
				<th widt="5%">Contrato</th>
				<th widt="20%">Recibo</th>
				<th widt="10%">importe</th>
				<th widt="10%">dni</th>
				<th widt="10%">Apellido</th>
				<th widt="10%">Nombre</th>
				<th widt="10%">Sucursal</th>
				
			</thead>
			<tbody>
				<?php Listar(); ?>

			</tbody>
		</table>
<p>
	<input name="" type="button" onClick="JavaScript: window.print();" value="Imprimir" />&nbsp;
	<input name="" type="button" onClick="JavaScript: location.href='dcto-exp4.php?concepto=<?php echo $_GET['concepto']?>&fechainf=<?php echo $_GET['fechainf']?>';" value="Exportar">
		&nbsp;
	<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'index.php'"></p>



	</div>

	<div id="footer">
		<center>Werchow - Año 2017 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php 

function Listar(){
	$rows=Pagos::getPagos(1,0);
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {

			/*switch ($row['SUCURSAL']) {
									case R  : $pago = "PERICO"; break;
									case W  : $pago = "S.S.JUJUY"; break;
									case L  : $pago = "PALPALA"; break;
									case 60 : $pago = "OFICINA"; break;
									case 99 : $pago = "OFICINA"; break;
									default : $pago = "COBRADOR"; break;
								}
								break;*/

			//Listar
			echo "<tr>"
			."<td>".$row['PAGO']."</td>"
			."<td>".$row['MES']."</td>"
			."<td>".$row['ANO']."</td>"
			."<td>".$row['CONTRATO']."</td>"
			."<td>".$row['RECIBO']."</td>"
			."<td>".$row['IMPORTE']."</td>"
			."<td>".$row['DNI']."</td>"
			."<td>".$row['APELLIDO']."</td>"
			."<td>".$row['NOMBRE']."</td>"
			."<td>".$row['SUCURSAL']."</td>"
			."</tr>";
		}
	}
	else{
		echo "<tr><td colspan='10'>CONSULTA VACIA</td></tr>";
	}

}



?>