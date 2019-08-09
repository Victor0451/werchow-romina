<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/prestamo.class.php";
include "libs/class/cuo_prestamo.class.php"; 

$usu=$_SESSION["usu_ide"];
$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];

}

if (($perfil =='AUDITOR')OR($perfil =='ROOT')OR($perfil =='RENDICION')){


$dni=0; $zona = null; $nombre = ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
$prestamo=0;$cuotas=0;$neto=0;$val_cuota=0;$ptm_id=0;$op=0;$ptj=0;$total=0;$vcuota=0;$estado=null;$usu=null;


if (isset($_REQUEST['btn_guardar'])){
	
		$rows = Prestamo::updatePrestamo1($_REQUEST['ptm_id'], $_REQUEST['estado']);
		$dni=0; $zona = null; $nombre = ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
		$prestamo=0;$cuotas=0;$neto=0;$val_cuota=0;$ptm_id=0;$op=0;$ptj=0;$total=0;$vcuota=0;$estado=null;$usu=null;

	}

else{

	if (isset($_REQUEST['btn_limpiar'])){
		
	$dni=0; $zona = null; $nombre = ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
	$prestamo=0;$cuotas=0;$neto=0; $ptm_id=0;$val_cuota=0;
		
	}
else{
	if (isset($_REQUEST['op'])){

		switch ($_REQUEST['op']) {
			case 'md': //modificar
				$rows = Prestamo::getPrestamo(0,$_REQUEST['ptm_id'],0);
				$row = $rows->fetch();
				$ficha = $row['ptm_ficha'];
				$legajo = $row['ptm_legajo']; 
				$antiguedad = $row['ptm_ant'];
				$fechasol = $row['ptm_fechasol'];
				$renovacion = $row['ptm_renov'];
				$prestamo = $row['ptm_prestamo'];
				$cuotas = $row['ptm_cuotas'];
				$neto = $row['ptm_neto'];
				$estado = $row['ptm_estado'];
				$ptj=($neto*30)/100;
				$ptm_id=$row['ptm_id'];
				$fecha=$row['ptm_fechacarga'];
				$op=$row['ptm_op'];
				$usu=VerUsuario($op);
				$rowsp = Cuo_prestamo::getCuo_prestamo(0,$row['ptm_prestamo'],$row['ptm_cuotas']);
	
				foreach ($rowsp as $rowp) {
	
		 		$vcuota=$rowp['cuoptm_cuota'];
	    		} 
				$total=$vcuota*$cuotas;
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
				
				break;
			case 'br': //borrar
				$rows = Prestamo::deletePrestamo($_REQUEST['ptm_id']);
				break;
		}
	}
	else{
	//	$dni=0; $zona = null; $nombre = ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
	//$prestamo=0;$cuotas=0;$neto=0;$ptm_id=0;$val_cuota=0;
	}
	}
}

}
else{
	print '<script language="JavaScript">'; 
	print 'alert("NO ESTA HABILITADO PARA LA OPCION SOLICITADA");'; 
	print'</script>';
	print'<script type="text/javascript">
window.location="prestamos_abm.php";
</script>';
}



?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Estados-Préstamos</title>
	
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
		<div id="menu"><?php include "menu.php"; ?></div>
	</div>	
	<div id="contenido">
		<a href="prestamos_abm.php" class="nl"><h1>Préstamo</h1></a>
		<form action="" id="formulario" action="" onSubmit="enviarDatos(); return false">
			<input type="hidden" name="ptm_id" value="<?php echo $ptm_id; ?>">
			<p style="font-size:0.8em;">Operador&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Codigo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha carga<br> <input type="text" name="operador" value="<?php echo $usu;?>" size="23x" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="op" value="<?php echo $op; ?>" disabled size="5x" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="fecha" value="<?php echo $fecha; ?>" disabled size="8px" >
			
			</p>
			<p style="font-size:0.8em;">Ficha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Apellido y Nombre<br>
			<input type="text" name="ficha"  value="<?php echo $ficha; ?>" onkeyUp="return ValNumero(this);" size="5px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="nombre" value="<?php echo $nombre; ?>" size="50px" disabled>
			</p>
			<p style="font-size:0.8em;">DNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zona&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Legajo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Antiguedad<br>	
			<input type="text" name="dni" value="<?php echo $dni; ?>" size="10px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="zona" value="<?php echo $zona; ?>" size="15px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="legajo" value="<?php echo $legajo; ?>" size="5px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="antiguedad" value="<?php echo $antiguedad; ?>" size="5px" disabled>
			</p>
			<p style="font-size:0.8em;">Fecha Solicitud&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Renovacion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Préstamo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuotas<br>
			<input type="text" name="fechasol" value="<?php echo $fechasol; ?>" size="10px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="renovacion" value="<?php echo $renovacion; ?>" size="5px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="prestamo" value="<?php echo '$ '.$prestamo; ?>" size="5px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="cuotas" value="<?php echo $cuotas; ?>" size="5px" disabled>
			</p>		
			<p style="font-size:0.8em;"><font color=red><b>Valor Cuota</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total a devolver&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Neto A Cobrar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red><b>30%Neto</b></font><br> <input type="text" name="vcuota"  value="<?php echo '$ '.$vcuota; ?>" size="8px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="total"  value="<?php echo '$ '.$total; ?>" size="8px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="neto" value="<?php echo '$ '.$neto; ?>" size="8px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="ptj" value="<?php echo '$ '.$ptj; ?>" size="8px" disabled></p>
			<p style="font-size:0.8em;"><b>ESTADO:</b>&nbsp;&nbsp;&nbsp;<select name="estado" id="estado" >
				<option value= "<?php echo $estado; ?>" selected="selected"><?php echo $estado; ?></option>
				<option value="APROBADO">ACTIVO</option>
				<option value="RECHAZADO">RECHAZADO</option>
				
			</select>	</p>

			<p><input type="submit" name="btn_guardar" value="Guardar" >&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'prestamos_abm.php'"></p>
		</form>
		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="5%">Fecha</th>
				<th widt="5%">Ficha</th>
				<th widt="10%">Nombre</th>
				<th widt="15%">DNI</th>
			<!--	<th widt="10%">Legajo</th>
				<th widt="15%">Ant</th>-->
				<th widt="15%">F.Sol</th>
				<th widt="5%">Zona</th>
				<th widt="10%">Ren</th>
				<th widt="5%">Préstamo</th>
				<th widt="5%">Cuotas</th>
				<th widt="5%">V.Cuota</th>
				<!--<th widt="8%">Total</th>-->
				<th widt="8%">Neto a Cobrar</th>
				<th widt="8%">Estado</th>
				<th widt="8%">Oper</th>
				<th widt="5%">Edit</th>
				
			</thead>
			<tbody>
				<?php VerPrestamos();?>
			</tbody>
		</table>
	</div>
	<br>
	<div id="footer">
		<center>Werchow - Año 2018 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php

function VerPrestamos(){
	
	$operador=$_SESSION["usu_ide"];

	$cont=0;
	$tot=0;

	$rows = Prestamo::getPrestamo(2,0,0);
	
	if($rows->rowCount()!=0){
	
	foreach ($rows as $row) {

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

		//$ver='RECUPERADOR';
	
		$rowsp = Cuo_prestamo::getCuo_prestamo(0,$row['ptm_prestamo'],$row['ptm_cuotas']);
	
		foreach ($rowsp as $rowp) {
	
		 $cuo=$rowp['cuoptm_cuota'];
	    }    
  	
		$cont=$cont+1;
		$tot=$cuo*$row['ptm_cuotas'];
		
		$nick=VerUsuario2($row['ptm_op']);

		echo "<tr>
			  <td>".$cont."</td>	
			  <td>".$row['ptm_fechacarga']."</td>
			  <td>".$row['ptm_ficha']."</td>
			  <td>".$nombre."</td>
			  <td>".$dni."</td>
			  <td>".$row['ptm_fechasol']."</td>
			  <td>".$zona."</td>
			  <td>".$row['ptm_renov']."</td>
			  <td>".$row['ptm_prestamo']."</td>
			  <td>".$row['ptm_cuotas']."</td>
			  <td>".'$'.$cuo."</td>
			
			  <td>".'$'.$row['ptm_neto']."</td>
			  <td>".$row['ptm_estado']."</td>
			  <td>".$nick."</td>
		      <td><center><a href='?op=md&ptm_id=".$row['ptm_id']."'><img src='libs/img/campa.jpg' ></a><center></td>
		     
		      
		     </tr>";
	    }
	}
else
	echo 'CONSULTA VACIA';	
}


function VerUsuario($op){
	$rows = Usuario::getUsuario(3,$op);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
	}
    
}
function VerUsuario2($op){
	$rows = Usuario::getUsuario(3,$op);
	
	foreach ($rows as $row) {
	
		return strtolower($row['usu_nick']);
	}
    
}
	
?>