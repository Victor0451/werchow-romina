<script language="javascript" type="text/javascript">

    //*** Este Codigo permite Validar que sea un campo Numerico
    function Solo_Numerico(variable){
        Numer=parseInt(variable);
        if (isNaN(Numer)){
		
            return "";
		        }
        return Numer;
    }
    function ValNumero(Control){
        Control.value=Solo_Numerico(Control.value);
    }
    
</script>
<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/semana.class.php";
$semana=0; $fecha=null; $venta=null; 

   if (isset($_REQUEST['btn_guardar'])){
  	$rows = Semana::updatesemana($_REQUEST['semase_id'], $_REQUEST['semana'],$_REQUEST['venta']);
}
else{
   		

   	/*	$rows = Usuario::insertUsuario(strtoupper($_REQUEST['ape']),strtoupper($_REQUEST['nom']),$usu,$pass,$_REQUEST['dni'],$_REQUEST['sucursal'],$perfil,$estado,$fecha);
   		
   		print'<script type="text/javascript">
		window.location="abm-asesor.php";
		</script>';
   		


   		
   }
   	
   	$perfil='ASESOR';$fecha=null;$semana=null;$venta=null;
*/

   	if (isset($_REQUEST['op'])){

		switch ($_REQUEST['op']) {
			case 'md': //modificar
				$rows = Semana::getSemana(4,$_REQUEST['semase_id']);
				$row = $rows->fetch();
				$fecha = $row['semase_fecha'];
				$semana = $row['semase_semana'];
				$venta = $row['semase_ventas'];
				$semase_id = $row['semase_id'];
				$aseror = $_REQUEST['asesor'];
				$mes = $_REQUEST['mes'];
				$anio = $_REQUEST['anio'];
				break;
			case 'br': //borrar

	
				$rows = Semana::deleteSemana($_REQUEST['semase_id']);
				print'<script type="text/javascript">
				window.location="ver-cargaasesor.php?asesor="'.$_REQUEST["asesor"].'"&mes="'.$_REQUEST["mes"].'"&anio="'.$_REQUEST["anio"].'";
				</script>';	
				break;
		}
  }
}  
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Cargas Asesor</title>
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
		
		<div id="doctip"><h1> <?php echo VerUsuario($_REQUEST['asesor'])." - ".$_REQUEST['mes']." ".$_REQUEST['anio'];?></h1></div>

		<form action="" id="formulario" action="" >
			<input type="hidden" name="semase_id" value="<?php echo $semase_id; ?>">
			<input type="hidden" name="asesor" value="<?php echo $_REQUEST['asesor']; ?>">
			<input type="hidden" name="mes" value="<?php echo $_REQUEST['mes']; ?>">
			<input type="hidden" name="anio" value="<?php echo $_REQUEST['anio']; ?>">
		<p style="font-size:0.8em;">FECHA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SEMANA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VENTAS<br><input type="text" name="fecha" value="<?php echo $fecha;?>" size="10x" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="semana" value="<?php echo $semana;?>" size="10x" onkeyUp="return ValNumero(this);" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="venta" value="<?php echo $venta;?>" size="8x" >
	
		</p>
		
	
	<p><input type="submit" name="btn_guardar" value="Guardar">&nbsp;<input type="button" name="btn_volver" value="Volver" onclick="location.href = 'abm-ventaasesor.php'"></p>		
</form>
<h2>Lista</h2>
		<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="5%">Fecha</th>
				<th widt="5%">Semana</th>
				<th widt="5%">Ventas</th>
				<th widt="5%">Edit</th>
				<th widt="5%">Borrar</th>
				
			</thead>
			<tbody>
				<?php VerVentas(); ?>
			</tbody>
		</table>
	</div>
	<br>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php

function VerUsuario($asesor){
	$rows = Usuario::getUsuario(3,$asesor);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
	}
    
}

function VerVentas(){
$cont=0;
$row = Semana::getSemana2(0,$_REQUEST["asesor"],$_REQUEST["mes"],$_REQUEST["anio"]);
	foreach ($row as $rows) {
		$cont=$cont+1;
		echo "<tr>
		<td style='text-align:center;'>".$cont."</td>
		<td style='text-align:center;'>".$rows['semase_fecha']."</td>
		<td style='text-align:center;'>".$rows['semase_semana']."</td>
		<td style='text-align:center;'>".$rows['semase_ventas']."</td>
		<td><center><a href='?op=md&semase_id=".$rows['semase_id']."&asesor=".$_REQUEST["asesor"]."&mes=".$_REQUEST["mes"]."&anio=".$_REQUEST["anio"]."'><img src='libs/img/campa.jpg'></a><center></td>
		      <td><center><a href='?op=br&semase_id=".$rows['semase_id']."&asesor=".$_REQUEST["asesor"]."&mes=".$_REQUEST["mes"]."&anio=".$_REQUEST["anio"]."'><img src='libs/img/eliminar1.jpg' ></a><center></td>
		</tr>";
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
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}

?>