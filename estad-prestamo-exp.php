<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/prestamo.class.php";
include "libs/class/pagos.class.php";
include "libs/class/cuo_prestamo.class.php"; 


$desde=''; $hasta=''; $estado='';$ver=0;	



	$desde=$_GET['desde'];
	$hasta=$_GET['hasta'];
	$estado=$_GET['estado'];


	
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Estadisticas-Préstamos</title>
	
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	
	<script src="libs/js/jquery-1.7.2.js"></script>
	
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>


</head>

<body>
	<?php //include('header1.php'); 
		header('Content-type: application/vnd.ms-excel');
		header("Content-Disposition: attachment; filename=resumen-prestamos.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
	?>
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>
	
	<div id="contenido">
		<a href="prestamos_abm.php" class="nl"><h1>Informe Préstamos</h1></a>

	<!--	<form action="" id="formulario"  onSubmit="">
			
			<p style="font-size:0.8em;"><b>Fecha&nbsp;&nbsp;&nbsp;&nbsp;</b> <input type="date" name="desde" value="<?php //echo $desde; ?>">&nbsp;&nbsp;A&nbsp;&nbsp;<input type="date" name="hasta" value="<?php //echo $hasta; ?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Estado:</b>
				<select name="estado" id="estado" >
				<option value=0><?php //echo $estado; ?></option>	
				<option value="TODOS">TODOS</option>
				<option value="ACTIVO">ACTIVO</option>
				<option value="CANCELADO">CANCELADO</option>
				<option value="PENDIENTE">PENDIENTE</option>
				<option value="RECHAZADO">RECHAZADO</option>

			</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		 <input type="submit" name="btn_ver" value="Consultar">
		</p>
			

			<!--<p><input type="submit" name="btn_guardar" value="Guardar">&nbsp;<input type="submit" name="btn_Limpiar" value="Limpiar">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'prestamos_abm.php'"></p>-->
<!--		</form>-->



		<form action="" id="formulario" action="" onSubmit="enviarDatos(); return false">

			<input type="hidden" name="afiliado" value="<?php echo $afiliado; ?>">

		<h2>RESUMEN &nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;TOTAL:&nbsp;<?php echo VerTotal(); ?>			
		</h2>	
		<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%" bgcolor=#B2BABB>ACTIVOS</th>
				<th widt="15%" bgcolor=#B2BABB>CANCELADOS</th>
				<th widt="15%" bgcolor=#B2BABB>PENDIENTES</th>
				<th widt="15%" bgcolor=#B2BABB>RECHAZADOS</th>
				
								
			</thead>
			<tbody>
				<?php VerResumen(); ?>
			</tbody>
		</table>
		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%" bgcolor=#B2BABB>Nº</th>
				<th widt="15%" bgcolor=#B2BABB>FechaSol</th>
				<th widt="15%" bgcolor=#B2BABB>Apellido y Nombre</th>
				<th widt="15%" bgcolor=#B2BABB>Socio</th>
				<th widt="5%" bgcolor=#B2BABB>CAPITAL</th>
				<th widt="5%" bgcolor=#B2BABB>Cuotas</th>
				<th widt="5%" bgcolor=#B2BABB>Val.Cuota</th>
				<th widt="5%" bgcolor=#B2BABB>Total Dev</th>
				<th widt="5%" bgcolor=#B2BABB>Interes</th>
				<th widt="8%" bgcolor=#B2BABB>Estado</th>
								
			</thead>
			<tbody>
				<?php VerPrestamos(); ?>
			</tbody>
		</table>
 			
		</form>
	</div>
	<br>
	<div id="footer">
		<center>Werchow - Año 2018 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php

function VerTotal(){
$ver=0;
$desde=$_GET['desde'];
$hasta=$_GET['hasta'];
$estado=$_GET['estado'];
if (($desde!='')AND($hasta!='')){
		
		if ($estado=='TODOS'){$rows = Prestamo::getPrestamo2(2,$desde,$hasta,0);}
		else{$rows = Prestamo::getPrestamo2(1,$desde,$hasta,$estado);}
		$ver=$rows->rowCount();

	}
	
	else {$rows = Prestamo::getPrestamo2(0,0,0,0);$ver=$rows->rowCount();
 }

return $ver;
	
}

function VerResumen(){
$cancel=0;
$pen=0;
$rech=0;
$activo=0;
$desde=$_GET['desde'];
$hasta=$_GET['hasta'];
$estado=$_GET['estado'];

if (($desde!='')AND($hasta!='')){
		
		if ($estado=='TODOS'){$rows = Prestamo::getPrestamo2(2,$desde,$hasta,0);}
		else{$rows = Prestamo::getPrestamo2(1,$desde,$hasta,$estado);}
		

	}
	
	else {$rows = Prestamo::getPrestamo2(0,0,0,0);}

if($rows->rowCount()!=0){
	
	foreach ($rows as $row) {

		switch ($row['ptm_estado']) {
				case 'CANCELADO':$cancel=$cancel+1;;break;
				case 'ACTIVO':$activo=$activo+1;break;
				case 'PENDIENTE':$pen=$pen+1;break;
				case 'RECHAZADO':$rech=$rech+1;break;
            	default:break;
        }

	
}
echo "<tr>
			  <td style='text-align:center;'><B>".$activo."</B></td>	
			  <td style='text-align:center;'><B>".$cancel."</B></td>
			  <td style='text-align:center;'><B>".$pen."</B></td>
			  <td style='text-align:center;'><B>".$rech."</B></td>
			 
		
		    </tr>";	
}	    
else
	echo 'CONSULTA VACIA';	
	
}


function VerPrestamos(){

	$cont=0;
	$capital=0;
	$totint=0;
	$totdev=0;
	$vacio='';
	$nombre=null;
	
	$desde=$_GET['desde'];
	$hasta=$_GET['hasta'];
	$estado=$_GET['estado'];

	if (($desde!='')AND($hasta!='')){
		
		if ($estado=='TODOS'){$rows = Prestamo::getPrestamo2(2,$desde,$hasta,0);}
		else{$rows = Prestamo::getPrestamo2(1,$desde,$hasta,$estado);}
		$ver=$rows->rowCount();

	}
	
	else {$rows = Prestamo::getPrestamo2(0,0,0,0);}


	if($rows->rowCount()!=0){
	
	foreach ($rows as $row) {

		$tot=0;
		$interes=0;
		$rowsm = Maestro::getMaestro(7,$row['ptm_ficha']);
		foreach ($rowsm as $rowm) {
		
			$nombre=$rowm['APELLIDOS']." ".$rowm['NOMBRES'];
			$dni=$rowm['NRO_DOC'];
			switch ($rowm['SUCURSAL']) {
				case 'W':$zona='CASA CENTRAL';break;
				case 'L':$zona='PALPALA';break;
				case 'P':$zona='SAN PEDRO';break;
				case 'R':$zona='PERICO';break;
            	default:break;
        	}
		}

		  	
		$cont=$cont+1;
		$tot=$row['ptm_valcuota']*$row['ptm_cuotas'];
		$interes=$tot-$row['ptm_prestamo'];
		$capital=$capital+$row['ptm_prestamo'];
		$totint=$totint+$interes;
		$totdev=$totdev+$tot;
		echo "<tr>
			  <td style='text-align:center;'>".$cont."</td>	
			  <td>".$row['ptm_fechasol']."</td>
			  <td>".$nombre."</td>
			  <td>".$row['ptm_ficha']."</td>
			  <td>".'$ '.$row['ptm_prestamo']."</td>
			  <td style='text-align:center;'>".$row['ptm_cuotas']."</td>
			  <td>".'$'.$row['ptm_valcuota']."</td>
			  <td>".'$ '.$tot."</td>
			  <td>".'$ '.$interes."</td>
			  <td>".$row['ptm_estado']."</td>
		    </tr>";
	    }
	    echo "<tr>
			  <td><b>".$vacio."</b></td>	
			  <td><b>".$vacio."</b></td>
			  <td><b>".$vacio."</b></td>
			  <td><b>".$vacio."</b></td>
			  <td bgcolor=#B2BABB><font size=2><b>".'$ '.$capital."</font></b></td>
			  <td><b>".$vacio."</b></td>
			  <td><b>".$vacio."</b></td>
			  <td bgcolor=#B2BABB><font size=2><b>".'$ '.$totdev."</font></b></td>
			  <td bgcolor=#B2BABB><font size=2><b>".'$ '.$totint."</font></b></td>
			 
		    </tr>";
	}
else
	echo 'CONSULTA VACIA';	

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
				case 'RECUPERADOR':include ('menu_rec.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}
?>