<?php 
//include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php"; 
/*include "libs/class/personal.class.php"; 
include "libs/class/motivo.class.php"; 
include "libs/class/imputar.class.php"; */


if (isset($_REQUEST['op'])){
	switch ($_REQUEST['op']) {
	case 'md': //IMPUTAR
		$fecha = date("d/m/Y",time());
		$fch = explode("/",$fecha); 
		$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
		$carga=$_SESSION["usu_ide"];

		$rows = Imputar::insertImputar($_REQUEST['id_dcto'], $fecha,$carga, $_REQUEST['periodo']);


	break;
	case 'br': //borrar
		$rows = Caracter::getCaracter(0,$_REQUEST['id_dcto']);
		$row = $rows->fetch();
		$_GET['empleado']=$row['Dcto_emple']; 
		$estado='ELIMINADO';
		$rows = Caracter::deleteCaracter($_REQUEST['id_dcto'],$estado);
		break;
	}
};

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Informes - Ultimos 3 Meses</title>

	<link type="image/x-icon" href="libs/img/logo1.jpg" rel="shortcut icon"/>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="libs/js/jquery-1.7.2.js"></script>
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>
</head>
<body>
	<div id="encabezado"><img src="libs/img/encabezado2.jpg"/></div>

	<div id="menu-wrapper">
		<div id="menu"><?php include "menu.php"; ?></div>
	</div>	
	<div id="contenido">

	<input type="hidden" name="empleado" value="<?php echo $_GET['empleado']; ?>">
	<input type="hidden" name="anio" value="<?php echo $_GET['anio']; ?>">
		
		<a href="informes.php" class="nl"><h1>Ultimos 3 Meses <?php //echo VerPersonal();?> </h1></a>
		
		<!--<h2><?php //$ver=$_GET['fechainf'];
				$fchv //= explode("-",$ver); 	
		//echo ObtenerMes($fchv[1])." ".$fchv[0];?></h2>-->
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<!--<th widt="20%">Cod.</th>-->
				<th widt="10%">Legajo</th>
				<th widt="15%">Dni</th>
				<th widt="20%">Apellidos</th>
				<th widt="5%">Nombres</th>
				<th widt="20%">Alta</th>
				<!--<th widt="10%">Cuota</th>-->
				<th widt="10%">Telefono</th>
				<th widt="10%">Celular</th>
				<th widt="10%">Forma Pago</th>
				<!--<th widt="10%">201708</th>
				<th widt="10%">201709</th>
				<th widt="10%">201710</th>
				<th widt="10%">201711</th>-->
				<th widt="10%">TOTAL</th>
				
			</thead>
			<tbody>
			
				<?php VerDes(); ?>
			</tbody>
		</table>
		<!--<h1>TOTAL DESCUENTOS: <?php //echo VerDes2();?></h1>-->
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
/*function VerDes(){
	
	//include "config.php"; 

/*	$conexion = mysql_connect("localhost", "root", "");
mysql_select_db("descuentos", $conexion);
if (!$conexion) 
	{
    echo "<p>Imposible conectarse con la base de datos.</p>";
    exit();
	};
	$ver= 68368;
	$sql = "select * from maestro where contrato=$ver";
	$resBa = mysql_query($sql, $conexion) or die(mysql_error());
	if ($rowBa = mysql_fetch_assoc($resBa))
		{
			$contrato = $rowBa['contrato'];
			$control2 = $rowBa['apellidos'];
			$control3 = $rowBa['nombres'];
		}
	echo $contrato.' '.$control2.' '.$onctrol3;
	/*$contador=0;
	
	$fechainf=$_GET['fechainf'];
	$fechinf =explode("-",$fechainf); 
	$peri= intval($fechinf[1]); */
	/*$val=68368;
	/*$rows = Maestro::getmaestro(1,$val);
	foreach ($rows as $row) {*/
	
			/*$ban=0;
			/*$fechac=$row['Dcto_fecha'];
			$fchc = explode("-",$fechac); 
			if ($row['Dcto_periodo']<=9){
				$control="0".$row['Dcto_periodo'];
			}
			else{$control=$row['Dcto_periodo'];}
			if ($fchc[1]>$row['Dcto_periodo']){
				//echo 'si';
				$cam=$fchc[0]+1;
				$fechacontrol=$cam."-".$control."-"."01";
			}			
			else{
				$fechacontrol=$fchc[0]."-".$control."-01";
			}*/
          /*  $sql="select * from maestro where contrato=$val";
			$row= $db->query($sql);

			$contrato=$row['contrato'];
		    $dni=$row['nro_doc'];
		    $ape=$row['apellidos'];
		    $nom=$row['nombres'];
		/*    $row=68368;
		    //$rowsP = Maestro::getMaestro(0,$row['Dcto_emple']);
		    $rowsM = Maestro::getMaestro(1,$row);
			$rowM = $rowsM->fetch();
			$contrato = $rowM['contrato'];
			$doc = $rowM['nro_doc'];
			$ape = $rowM['apellidos'];
			$nom = $rowM['nombres'];
			$alta = $rowM['alta'];
			$telefono = $rowM['telefono'];
			$movil = $rowM['movil'];
		    $grupo = $rowM['grupo']; 	
	/*$rowsM = Motivo::getMotivo(0,$row['Dcto_mtv']);
			$rowM = $rowsM->fetch();
			$desc = $rowM['mtv_descrip'];

			$per=ObtenerMes($row['Dcto_periodo']);
			
			$rowsI = Imputar::getImputar(0,$row['Id_dcto']);
			
			/*foreach ($rowsI as $rowI) {
					$fecimp=explode("-",$rowI['Imp_fecha']); 
					
				if (($rowI['Imp_periodo']==$peri)and($fecimp[0]==$fechinf[0]))	{$ban=1;}
			}*/
			/**$vercuota=CantidadCuotas($fechacontrol);
			if (($fechacontrol<=$fechainf)and($row['Dcto_fechafin']>=$fechainf)){
			*/
			/*echo "<tr>
			  	
			  	<td>".$contrato."</td>
			  	<td>".$dni."</td>
		      	<td>".$ape."</td>
			   	<td>".$nom."</td>
		      	<td>".$per."</td>
		      	<td>".$row['Dcto_monto']."</td>
		      	<td>".$vercuota.'&nbsp;de&nbsp;'.$row['Dcto_cuotas']."</td>
		      	<td>".$sum."</td>";
		      
		     "</tr>";
		      echo"</tr>";
			};
		
	//}*/

			/* Conexion con base de datos. */
	$conexion = new PDO('mysql:host=localhost;dbname=descuentos;charset=UTF8', 'root', '');
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
	$matriz = array(); // En esta matriz almacenaremos los resultados.
 
	/* Se defina la consulta SQL */
	$consulta = "SELECT * FROM maestro ";
	$consulta .= "WHERE contrato = 68368;";
	
	/* Cada elemento que sea recuperado de la tabla, se almacena en la matriz. */
	foreach ($conexion->query($consulta, PDO::FETCH_ASSOC) as $item) $matriz[] = $item;
 
	/* Se vuelca la matriz en pantalla. */
	echo "<pre>";
	var_dump($matriz);
}*/

/*function CantidadCuotas($fechacontrol){

	//echo "<br>".$fechacontrol;
	$fechainf=$_GET['fechainf'];
	//echo $fechainf;
	$cuo1=0;
	$fech_mes=$fechacontrol;
	/*echo '<br>kk'.$fech_mes;*/
	//echo $fech_mes;
/***	while ($fech_mes<=$fechainf){
		//echo 'SI'.$fech_mes.'/'.$fechainf;
		//echo 'si';	
			$cuo1=$cuo1+1;
		$fm = explode("-",$fech_mes);
 		$mess=$fm[1]+1;
 		//if ($mess<=9){}
 		if ($mess<=9){$mess='0'.$mess;}
 		if ($mess<=12){$fech_mes=$fm[0].'-'.$mess.'-01';}
 		else{$fm[0]=$fm[0]+1; $mess=$mess-12;
 			if ($mess<=9){$mess='0'.$mess;}
 			$fech_mes=$fm[0].'-'.$mess.'-01';}

 	};
	return($cuo1);
}*/

function VerDes(){

	require_once 'Connection.simple.php';
 
	$conn = dbConnect();
	// Create the query
	$val=68368;
	$sql = 'SELECT * FROM maestro where contrato= $val';
	// Create the query and asign the result to a variable call $result
	$result = $conn->query($sql);
	// Extract the values from $result
	$rows = $result->fetchAll();
	// Since the values are an associative array we use foreach to extract the values from $rows
	foreach ($rows as $row) {
		echo 'LEGAJO: '.$row['contrato'].'<br/>';
		echo 'DNI: '.$row['nro_doc'].'<br/>';
		echo 'APELLIDOS: '.$row['apellidos'].'<br/>';
		echo 'NOMBRES: '.$row['NOMBRES'].'<br/>';
		echo 'TELEFONO: '.$row['telefono'].'<br/>';
		echo "<hr/>";
	}
}

/*function VerDes2(){
	$contador=0;
	$contarimp=0;
	$fechainf=$_GET['fechainf'];
	$fechinf =explode("-",$fechainf);
	$peri= intval($fechinf[1]); 
	
	$rows = Caracter::getCaracter1(3,$_GET['concepto'],$_GET['fechainf']);
	foreach ($rows as $row) {
		$ban=0;
		$fechac=$row['Dcto_fecha'];
			$fchc = explode("-",$fechac); 
			
			if ($row['Dcto_periodo']<=9){
				$control="0".$row['Dcto_periodo'];
			}
			else{$control=$row['Dcto_periodo'];}
			if ($fchc[1]>$row['Dcto_periodo']){
				
				$cam=$fchc[0]+1;
				$fechacontrol=$cam."-".$control."-"."01";
			}			
			else{
				
				$fechacontrol=$fchc[0]."-".$control."-01";
			}
	
	    $monto=$row['Dcto_monto'];
	    $cuotas=$row['Dcto_cuotas'];
		$suma=$monto/$cuotas;

		$rowsI = Imputar::getImputar(0,$row['Id_dcto']);
			
		foreach ($rowsI as $rowI) {
			$fecimp=explode("-",$rowI['Imp_fecha']); 
			if (($rowI['Imp_periodo']==$peri)and($fecimp[0]==$fechinf[0]))	{$ban=1;}
			}

if (($fechacontrol<=$fechainf)and($row['Dcto_fechafin']>=$fechainf)){
		    $contador=$contador+$suma;
		    if ($ban==1){$contarimp=$contarimp+$suma;}
		}

	}
	
	return array($contador,$contarimp);
}

function VerPersonal(){
	$rows = Personal::getPersonal(0,$_GET['empleado']);
	
	foreach ($rows as $row) {
		
		return strtoupper($row['prs_nom']." ".$row['prs_ape']);
	}
    
}
function ObtenerMes($mes){
  
  switch ($mes) {
      case "01": $row='ENERO'; return $row; break;
      case "02": $row='FEBRERO'; return $row; break;
      case "03": $row='MARZO'; return $row; break;
      case "04": $row='ABRIL'; return $row; break;
      case "05": $row='MAYO'; return $row; break;
      case "06": $row='JUNIO'; return $row; break;
      case "07": $row='JULIO'; return $row; break;
      case "08": $row='AGOSTO'; return $row; break;
      case "09": $row='SEPTIEMBRE'; return $row; break;
      case "10": $row='OCTUBRE'; return $row; break;
      case "11": $row='NOVIEMBRE'; return $row; break;
      case "12": $row='DICIEMBRE'; return $row; break;
    } 
}
*/
?>