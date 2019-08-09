<?php 
set_time_limit(500);
include "info.php"; 
include "config.php"; 
include "libs/class/usuario.class.php";
include "libs/class/Otro.class.php"; 


$desde=null; $anio= null; $recup =0;$nom=null; $mes=null; $mesn=null;

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha =$fch[2]."-".$fch[1]."-".$fch[0];

/*$recup=$_SESSION["usu_ide"];*/
$nom=VerUsuario($recup);


if (isset($_REQUEST['btn_ver'])){

	$anio=$_REQUEST['anio'];
	$mes=$_REQUEST['mes'];
	$recup=$_REQUEST['recup'];


	$nom=VerUsuario($recup);
	//echo 'ROMINA - '.$nom;
	$mesn=VerMes($mes);
}


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Consulta Planificiacion</title>
	
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
		<!--<div id="menu"><?php //include "menu.php"; ?></div>-->
		<div id="menu"><?php TraerPerfil(); ?></div>
	</div>	
	<div id="contenido">
		<a href="abm.php" class="nl"><h1>CONSULTAR PLANIFICACION </h1></a>
	<form action="" id="for_cns" action="" method="get" >
		<!--<input type="hidden" name="nom" value="<?php //echo $nom; ?>">-->
		AGENTE 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		MES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
        AÑO<br>
        <select name="recup" id="recup"><option value=><?php echo $nom; ?></option><?php echo TraerUsuario();?></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        
        <select name="mes" id="mes" >
				<option value= "<?php echo $mes; ?>" selected="selected"><?php echo $mesn; ?></option>
				<option value="01" >ENERO</option>
				<option value="02">FEBRERO</option>
				<option value="03">MARZO</option>
				<option value="04">ABRIL</option>
				<option value="05">MAYO</option>
				<option value="06">JUNIO</option>
				<option value="07">JULIO</option>
				<option value="08">AGOSTO</option>
				<option value="09">SEPTIEMBRE</option>
				<option value="10">OCTUBRE</option>
				<option value="11">NOVIEMBRE</option>
				<option value="12">DICIEMBRE</option>
			</select>	
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="anio" name="anio" value="<?php echo $anio; ?>" size="6px" maxlength="4">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="btn_ver" value="Consultar">
		
		<br><br>
		<!--<p ><font size=5  face="Engravers MT"><b><center><?php //echo Traermes();?>&nbsp;&nbsp;<?php //echo TraerUsuario();?></b></center></p></font>-->
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
				<?php VerPlanificacion();?>
			</tbody>
		</table>

		<p>
			
			<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_exp" value="Exportar" onClick="JavaScript: location.href='cns-liqui-exp.php?recup=<?php echo $_GET['recup'];?>&desde=<?php echo $_GET['desde'];?>&hasta=<?php echo $_GET['hasta'];?>';" disabled>&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'abm.php'">
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

function TraerUsuario(){

	$usu=$_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3,$usu);
		foreach ($rows as $row) {
		$perfil=$row['usu_perfil'];
		$estado=$row['usu_estado'];
		$nombre=$row['usu_apellido']." ".$row['usu_nombre'];
    }
    
   
    if ((($perfil=='RECUPERADOR')or($perfil=='ASESOR'))and ($estado=='ACTIVO') ){
    	
		echo "<option value='".$usu."'>".$nombre."</option>";
    }
    else{
    		$rows = Usuario::getUsuario(12,0);
			//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
			
			foreach ($rows as $row) {
			
			echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
			}
    }
}

function VerUsuario($recup){
	if ($recup=='TODAS'){return $recup;}
	else{	
			$rows = Usuario::getUsuario(3,$recup);
			foreach ($rows as $row) {
			return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
			}
		}	
}

function VerMes($mes){
	switch ($mes) {
		case '01': $mesn='ENERO';break;
		case '02': $mesn='FEBRERO';break;
		case '03': $mesn='MARZO';break;
		case '04': $mesn='ABRIL';break;
		case '05': $mesn='MAYO';break;
		case '06': $mesn='JUNIO';break;
		case '07': $mesn='JULIO';break;
		case '08': $mesn='AGOSTO';break;
		case '09': $mesn='SEPTIEMBRE';break;
		case '10': $mesn='OCTUBRE';break;
		case '11': $mesn='NOVIEMBRE';break;
		case '12': $mesn='DICIEMBRE';break;
		
		default:break;
	}
	return($mesn);
}


function TraerPerfil(){
$usu=$_SESSION["usu_ide"];

$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$per=$row['usu_perfil'];

	}
switch ($per) {
				case 'VENTAS':include ('menu_vta.php'); break;
				case 'ASESOR':include ('menu_vta.php'); break;
				case 'RECUPERADOR':include ('menu_rec.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}

function VerPlanificacion(){
	//if ($_REQUEST['ban']== 1){
if (isset($_REQUEST['btn_ver'])){		
		$usu=$_REQUEST['recup'];
		$mes=$_REQUEST['mes'];
		$anio=$_REQUEST['anio'];

		$desde=$anio.'-'.$mes.'-01';
		$hasta=$anio.'-'.$mes.'-31';
		
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
 }			
}

function saber_dia($nombredia) {
$dias = array('Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado');
$fecha = $dias[date('N', strtotime($nombredia))];
return ($fecha);
}
	
?>