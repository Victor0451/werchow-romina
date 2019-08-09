<?php
include "config.php";
include "libs/class/maestro.class.php";
include "libs/class/cuo_fija.class.php";
include "libs/class/productor.class.php";

if(isset($_POST['submit'])!=0){
	$desde=$_POST['desde'];
	$hasta=$_POST['hasta'];
	
	if (($desde==null) or ($hasta==null))
	{
	print '<script language="JavaScript">'; 
	print 'alert("DEBE SELECCIONAR FECHAS A CONSULTAR");'; 
	print '</script>'; 	}
}
else{
	$desde=null;
	$hasta=null;}

$cont=0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Informes - CONSULTA GENERAL MAESTRO</title>
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="libs/js/jquery-1.7.2.js"></script>
	<script language="javascript" src="js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="libs/js/filtergrid.css" media="screen" />
	<script type="text/javascript" src="libs/js/tablefilter.js"></script>
	
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
		
		<a href="informes.php" class="nl"><h1>CONSULTA ALTAS MENSUALES </h1></a>
	
	<form name="nuevo" method="POST" action="consulta_altanew.php">
	Periodo desde: <input type="date" name="desde" value="<?php echo $desde; ?>"> Hasta: <input type="date" name="hasta" value="<?php echo $hasta; ?>"> &nbsp;

	 <input type="submit" name="submit" value="Consultar">
	<p>
	</p>

	<!--<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>-->
	<table border="0"   [b] id=”tablaaltas” [/b]cellspacing="0" cellpadding="0" >
		
	  <thead>			
				<th >Legajo</th>
				<th >Dni</th>
				<th >Apellidos</th>
				<th >Nombres</th>
				<th >Alta</th>
				<th >Cuota</th>
				<th >Telefono</th>
				<th >F.Pago</th>
				<th >Productor</th>
				<th >Adh</th>
				<th >Plan</th>
				<th >SPlan</th>
			
	</thead>
			<?php Listar($desde, $hasta); ?>

	</table>
		
	<h1>TOTAL REGISTROS: <?php echo $cont;?></h1>
	
<p>
	<input name="" type="button" onClick="JavaScript: window.print();" value="Imprimir" />&nbsp;
	<input name="" type="button" onClick="JavaScript: location.href='dcto-exp4.php?concepto=<?php echo $_GET['concepto']?>&fechainf=<?php echo $_GET['fechainf']?>';" value="Exportar">
		&nbsp;
	<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'index.php'"></p>

</form>

</div>
	<div id="footer">
		<center>Werchow - Año 2017 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php

function Listar($desde, $hasta){
	//consulto si las variables desde y hasta son distinto de null
	if(($desde!=null)and($hasta!=null)){
		$cont=0;
		//consulto maestro
		$rows=Maestro::getMaestro2(2,$desde,$hasta);
		if($rows->rowCount()!=0){
			foreach ($rows as $row) {

				$cont=$cont+1;
				//Cuota_Fija
				$rows1=Cuo_Fija::getCuo_Fija(0,$row['CONTRATO']);
				if($rows1->rowCount()!=0){
					$row1=$rows1->fetch(); $IMPORTE=$row1['IMPORTE']; 
				}
				else                     { $IMPORTE=0; }
				
				//Grupo
				switch ($row['GRUPO']) {
					case 6    : $pago = "POLICIA"; break;
					case 666  : $pago = "POLICIA"; break;
					case 1000 : 
								switch ($row["ZONA"]) {
									case 1  : $pago = "OFICINA"; break;
									case 3  : $pago = "OFICINA"; break;
									case 5  : $pago = "OFICINA"; break;
									case 60 : $pago = "OFICINA"; break;
									case 99 : $pago = "OFICINA"; break;
									default : $pago = "COBRADOR"; break;
								}
								break;
					case 1001 : 
								switch ($row["ZONA"]) {
									case 1  : $pago = "OFICINA"; break;
									case 3  : $pago = "OFICINA"; break;
									case 5  : $pago = "OFICINA"; break;
									case 60 : $pago = "OFICINA"; break;
									case 99 : $pago = "OFICINA"; break;
									default : $pago = "COBRADOR"; break;
								}
								break;
					case 8500  : $pago = "OFICINA"; break;
					
					default   : $pago = "DEBITO"; break;

				}
				//Productor
				$rows2=Productor::getProductor(0,$row['PRODUCTOR']);
				if($rows2->rowCount()!=0){
					$row2=$rows2->fetch(); $prod=$row2['DESCRIP']; 
				}
				else {
					$prod=" "; 
				}
				//Listar
				echo "<tr>"
				."<td>".$row['CONTRATO']."</td>"
				."<td>".$row['NRO_DOC']."</td>"
				."<td>".$row['APELLIDOS']."</td>"
				."<td>".$row['NOMBRES']."</td>"
				."<td>".$row['ALTA']."</td>"
				."<td>$ ".$IMPORTE."</td>"
				."<td>".$row['TELEFONO']."</td>"
				."<td>".$pago."</td>"
				."<td>".$prod."</td>"
				."<td>".$row['ADHERENTES']."</td>"
				."<td>".$row['PLAN']."</td>"
				."<td>".$row['SUB_PLAN']."</td>"
				."</tr>";
			}
		}
	}
	else{
		echo "<tr><td colspan='10'>CONSULTA VACIA</td></tr>";
	}
}

?>