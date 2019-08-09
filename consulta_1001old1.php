<?php
include "config.php";
include "libs/class/maestro.class.php";
include "libs/class/cuo_fija.class.php";

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Informes - CONSULTA GENERAL MAESTRO</title>
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
				<!--<th widt="20%">Cod.</th>-->
				<th widt="10%">Legajo</th>
				<th widt="15%">Dni</th>
				<th widt="20%">Apellidos</th>
				<th widt="5%">Nombres</th>
				<th widt="20%">Alta</th>
				<th widt="10%">Cuota</th>
				<th widt="10%">Telefono</th>
				<th widt="10%">Celular</th>
				<th widt="10%">Forma Pago</th>
				<th widt="10%">TOTAL</th>
				
			</thead>
			<tbody>
				<?php Listar(); ?>

			</tbody>
		</table>
		<!-- <h1>TOTAL REGISTROS 1001: <?php echo $cont;?></h1> -->
	<!--	<h1>TOTAL DESCUENTOS: <?php
		//list($contador, $contarimp) = VerDes2();
		//echo $contador;
		//echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>Total Imputado: ".$contarimp."</font>";
		?></h1>
-->
	
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
	$rows=Maestro::getMaestro(2,0);
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {
			$rows1=Cuo_Fija::getCuo_Fija(0,$row['CONTRATO']);
			if($rows1->rowCount()!=0){ $row1=$rows1->fetch(); $IMPORTE=$row1['IMPORTE']; }
			else                     { $IMPORTE=0; }
			echo "<tr>"
			."<td>".$row['CONTRATO']."</td>"
			."<td>".$row['NRO_DOC']."</td>"
			."<td>".$row['APELLIDOS']."</td>"
			."<td>".$row['NOMBRES']."</td>"
			."<td>".$row['ALTA']."</td>"
			//."<td>".$row['IMPORTE']."</td>"
			."<td>"."$ ".$IMPORTE."</td>"
			."<td>".$row['TELEFONO']."</td>"
			."<td>".$row['MOVIL']."</td>"
			//."<td>".$row['ase_fso']."</td>"
			."<td>&nbsp;</td>"
			//."<td>".$row['ase_fso']."</td>"
			."<td>&nbsp;</td>"
			."</tr>";
		}
	}
	else{
		echo "<tr><td colspan='10'>CONSULTA VACIA</td></tr>";
	}

}



?>