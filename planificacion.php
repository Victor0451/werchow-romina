<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/Otro.class.php";

$ban=0;

   if (isset($_REQUEST['btn_guardar'])){

	$rows = Otro::insertPlanif($_SESSION["usu_ide"], $_REQUEST['dia'], $_REQUEST['obs']); $ban=1;
  /*	$fecha= $_REQUEST['dia'];
	$dd=saber_dia($fecha);
	echo 'RO'.$dd;*/
   	//$ban=1;
   		
 print'<script type="text/javascript">window.location="planificacion.php";</script>';
   }
   	

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Planificacion Mensual</title>
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
		
		<div id="doctip"><h1>Planificacion Mensual </h1> </div>

		<form action="" id="formulario" action="" >
		
		<p style="font-size:0.8em;">SELECCIONAR MES (Fecha):&nbsp;&nbsp;<input type="date" name="dia" value="<?php //echo VerUsuario();?>" ></p>
		<p style="font-size:0.8em;">INGRESAR TAREAS A REALIZAR:<br>
		<textarea name="obs" rows="5" cols="100"></textarea>	
</p>
		<!--<p style="font-size:0.8em;">PERFIL<br><input type="text" name="perfil" value="<?php //echo VerPerfil();?>" size="80x" disabled></p>
		<p style="font-size:0.8em;">USUARIO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PASSWORD<br><input type="text" name="usu" value="<?php //echo VerNick();?>" size="25x" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Password" name="pass" value="<?php //echo VerPass();?>" size="25x" >(Max. 20 caracteres)</p>-->
		
		

	<p><input type="submit" name="btn_guardar" value="Guardar">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'index.php'"></p>		
	<!--<h2><?php //echo Traermes();?><?php //echo VerUsuario();?></h2>-->
	<p ><font size=5  face="Engravers MT"><b><center><?php echo Traermes();?>&nbsp;&nbsp;<?php echo VerUsuario();?></b></center></p></font>
	<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">		
				<thead>
				<th widt="10%" bgcolor=black><font size=2 color=white>LUNES</font></th>
				<th widt="10%" bgcolor=black><font size=2 color=white>MARTES</font></th>
				<th widt="10%" bgcolor=black><font size=2 color=white>MIERCOLES</font></th>
				<th widt="10%" bgcolor=black><font size=2 color=white>JUEVES</font></th>
				<th widt="10%" bgcolor=black><font size=2 color=white>VIERNES</font></th>
				<th widt="10%" bgcolor=black><font size=2 color=white>SABADO</font></th>
			</thead>
			<tbody>
				<?php  //if ($ban==1){
					VerPlanificacion();//}//VerPlanificacion(); ?>
			</tbody>
		</table>
</form>
<br>
	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php

function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
	}
    
}

function VerPerfil(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_perfil']);
	}
    
}

function VerNick(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return $row['usu_nick'];
	}
    
}

function VerPass(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return $row['usu_clave'];
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
				case 'RECUPERADOR':include ('menu_rec.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}


function Traermes(){
	//if ($_REQUEST['ban']== 1){
		$fecha = date("d/m/Y",time());
		$fch = explode("/",$fecha); 
		$fecha = $fch[2]."-".$fch[1]."-".$fch[0];

		if ($fch[0]>25){$fch[1]=$fch[1]+1;}

		switch ($fch[1]) {
			case '01':$mes='ENERO';break;
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
	return($mes.' '.$fch[2]);	
		
}		


function VerPlanificacion(){
	//if ($_REQUEST['ban']== 1){
		$fecha = date("d/m/Y",time());
		$fch = explode("/",$fecha); 
		$fecha = $fch[2]."-".$fch[1]."-".$fch[0];

		if ($fch[0]>25){$fch[1]=$fch[1]+1;$desde=$fch[2]."-".$fch[1]."-01";$hasta= $fch[2]."-".$fch[1]."-31";}
		else{$desde= $fch[2]."-".$fch[1]."-01";$hasta= $fch[2]."-".$fch[1]."-31";}
		
		$usu=$_SESSION["usu_ide"];
		//$dia=$_REQUEST['dia'];
		/*$fch = explode("-",$dia); 
		$desde = $fch[0]."-".$fch[1]."-01";*/
		$con=0;		
		$lun=0;$mar=0;$mie=0;$jue=0;$vie=0;$sab=0;
		$rows = Otro::getOtro2(20,$usu,$desde,$hasta,0);
		foreach ($rows as $row) {
			$con=$con+1;
			$fecha=$row['pln_dia'];
			$dd=saber_dia($fecha);
			//echo 'RO'.$dd;
			if ($con==1){
				switch ($dd){
					case 'Lunes': echo "<tr><td><font size=2 color=red><b>".$fecha."</b></font><br>".$row['pln_obs']."</td>";
					break;
					case 'Martes':echo "<tr><td> </td><td><font size=2 color=red><b>".$fecha."</b></font><br>".$row['pln_obs']."</td>"; 
					break;
					case 'Miercoles':echo "<tr><td> </td><td> </td><td><font size=2 color=red><b>".$fecha."</b></font><br>".$row['pln_obs']."</td>";
					break;
					case 'Jueves':echo "<tr><td> </td><td> </td><td> </td><td><font size=2 color=red><b>".$fecha."</b></font><br>".$row['pln_obs']."</td>";
					break;
					case 'Viernes':echo "<tr><td> </td><td> </td><td> </td><td> </td><td><font size=2 color=red><b>".$fecha."</b></font><br>".$row['pln_obs']."</td>";
					break;
					case 'Sabado': echo "<tr><td> </td><td> </td><td> </td><td> </td><td> </td><td><font size=2 color=red><b>".$fecha."</b></font><br>".$row['pln_obs']."</td></tr>"; break;
					default:break;
				}
			}
			else{
				if ($dd=='Sabado'){echo "<td><font size=2 color=red><b>".$fecha."</b></font><br>".$row['pln_obs']."</td></tr>";

				}
				else{
					echo "<td><font size=2 color=red><b>".$fecha."</b></font><br>".$row['pln_obs']."</td>";
				}
			}
		}	

	//}	
		//echo 'HOLA';
}


function saber_dia($nombredia) {
$dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
$fecha = $dias[date('N', strtotime($nombredia))];
return ($fecha);
}




?>
