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
		
		<a href="informes.php" class="nl"><h1>RESUMEN AFILIADOS 1001 </h1></a>
	
		
		<h1>CANTIDAD TOTAL 1001: <?php echo Cantidad();?> </h1>	
		<h1>CANTIDAD 1001 x GESTIONAR: <?php echo Gestion1001();?> &nbsp;&nbsp;&nbsp;
		<A href="?opcion=1"><IMG  src="libs/img/ver.png">Ver</a>&nbsp;&nbsp;&nbsp;
		<A href="?opcion=3"><IMG  src="libs/img/campa.jpg" >Generar Campaña</a>
		</h1>
		<h1>CANTIDAD 1001 SIN TELEFONO: <?php echo Sintelefono();?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<A href="?opcion=2"><IMG  src="libs/img/ver.png" >Ver</a></h1>
		<br>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<!--<th widt="20%">Cod.</th>-->
				<th widt="5%">Legajo</th>
				<!--<th widt="10%">Dni</th>-->
				<th widt="10%">Apellidos</th>
			<!--	<th widt="10%">Nombres</th>
				<th widt="10%">Alta</th><!-->
				<th widt="5%">Cuota</th>
			<!--	<th widt="10%">Telef.</th>
				<th widt="10%">Movil</th>-->
				<th widt="10%">F.Pago</th>
				<th widt="10%">Barrio</th>
				<th widt="10%">Sucursal</th>
				<th widt="5%"></th>
				
			</thead>
			<tbody>
				<?php MenuOpcion();  //Listar(); ?>

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

function MenuOpcion(){

if (isset($_REQUEST['opcion'])){
   switch ($_REQUEST['opcion']) {
   	case 1: Listar(); break;
   	case 2: Listar2(); break;
   }
  } 	
}   	

function Listar(){
	$rows=Maestro::getMaestro(6,0);
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {

			//Cuota_Fija
			$rows1=Cuo_Fija::getCuo_Fija(0,$row['CONTRATO']);
			if($rows1->rowCount()!=0){ $row1=$rows1->fetch(); $IMPORTE=$row1['IMPORTE']; }
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
				
				default   : $pago = "NADA"; break;
			}
			switch ($row["SUCURSAL"]) {
				case 'W' : $suc = "S.S.JUJUY"; break;
				case 'R' : $suc = "PERICO"; break;
				case 'P' : $suc = "SAN PEDRO"; break;
				case 'L' : $suc = "PALPALA"; break;
				
			default : $suc = ""; break;
						}
			//Listar
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
			."<td>".$pago."</td>"
			."<td>".$row['BARRIO']."</td>"
			."<td>".$suc."</td>"		
			."</tr>";
		}
	}
	else{
		echo "<tr><td colspan='10'>CONSULTA VACIA</td></tr>";
	}

}


function Listar2(){
	$rows=Maestro::getMaestro(5,0);
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {

			//Cuota_Fija
			$rows1=Cuo_Fija::getCuo_Fija(0,$row['CONTRATO']);
			if($rows1->rowCount()!=0){ $row1=$rows1->fetch(); $IMPORTE=$row1['IMPORTE']; }
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
				
				default   : $pago = "NADA"; break;
			}

			switch ($row["SUCURSAL"]) {
				case 'W' : $suc = "S.S.JUJUY"; break;
				case 'R' : $suc = "PERICO"; break;
				case 'P' : $suc = "SAN PEDRO"; break;
				case 'L' : $suc = "PALPALA"; break;
				
			default : $suc = ""; break;
						}
			//Listar
			echo "<tr>"
			."<td>".$row['CONTRATO']."</td>"
			//."<td>".$row['NRO_DOC']."</td>"
			."<td>".$row['APELLIDOS']."</td>"
			//."<td>".$row['NOMBRES']."</td>"
			//."<td>".$row['ALTA']."</td>"
			//."<td>".$row['IMPORTE']."</td>"
			."<td>"."$ ".$IMPORTE."</td>"
		//	."<td>".$row['TELEFONO']."</td>"
		//	."<td>".$row['MOVIL']."</td>"
			//."<td>".$row['ase_fso']."</td>"
			."<td>".$pago."</td>"
			."<td>".$row['BARRIO']."</td>"
			."<td>".$suc."</td>
			<td><input type='checkbox' id=".$row['CONTRATO']."></td>"
		
			
			//."<td>".$row['ase_fso']."</td>"
			
			."</tr>";
		}
	}
	else{
		echo "<tr><td colspan='10'>CONSULTA VACIA</td></tr>";
	}

}

function Cantidad(){
	$rows=Maestro::getMaestro(2,0);	
	
	return ($rows->rowCount());
}	

function Sintelefono(){
	$rows=Maestro::getMaestro(5,0);	
	
	return ($rows->rowCount());
}
function Gestion1001(){
	$rows=Maestro::getMaestro(6,0);	
	
	return ($rows->rowCount());
}
?>