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
    


function popUp(URL) {
    window.open(URL, 'log.php', 'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=1,width=300,height=200,left = 390,top = 50');
}

</script>
<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/prestamo.class.php";
include "libs/class/pagos.class.php";
include "libs/class/cuo_prestamo.class.php"; 


$dni=0; $zona = null; $nombre= ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
$prestamo=0;$cuotas=0;$neto=0;$val_cuota=0;$ptm_id=0;$op=0;$ptj=0;$total=0;$vcuota=0;$estado=null;$usu=null;
$afiliado=$_GET['afiliado'];
	
if (isset($_REQUEST['btn_guardar'])){
	
		

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
				//$ficha = $row['ptm_ficha'];
				//$legajo = $row['ptm_legajo']; 
				//$antiguedad = $row['ptm_ant'];
				$fechasol = $row['ptm_fechasol'];
				//$renovacion = $row['ptm_renov'];
				$prestamo = $row['ptm_prestamo'];
				$cuotas = $row['ptm_cuotas'];
				//$neto = $row['ptm_neto'];
				$estado = $row['ptm_estado'];
				//$ptj=($neto*30)/100;
				$afiliado=$row['ptm_ficha'];
				$ptm_id=$row['ptm_id'];
				//$fecha=$row['ptm_fechacarga'];
				$op=$row['ptm_op'];
				//$usu=VerUsuario($op);
				$vcuota=$row['ptm_valcuota'];
				$total=$vcuota*$cuotas;
				/*$rowsm = Maestro::getMaestro(7,$row['ptm_ficha']);
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
				}*/
			
				 //VerPrestamos(); 
		
				
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






?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Consulta-Préstamo</title>
	
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
		<a href="prestamos_abm.php" class="nl"><h1>Préstamos&nbsp;&nbsp;&nbsp;<?php echo VerAfiliado();?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo Verpago();?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Af:&nbsp;<?php echo $_REQUEST['afiliado'];?></h1></a>
		<form action="" id="formulario" action="" onSubmit="enviarDatos(); return false">
			<input type="hidden" name="afiliado" value="<?php echo $afiliado; ?>">
			

		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="5%">Cod_Proc</th>
				<th widt="15%">FechaSol</th>
				<th widt="5%">Préstamo</th>
				<th widt="5%">Cuotas</th>
				<th widt="5%">Val.Cuota</th>
				<th widt="8%">Estado</th>
				<th widt="8%">Asesor</th>
				<th widt="15%">Ver</th>
				
			</thead>
			<tbody>
				<?php VerPrestamos(); ?>
			</tbody>
		</table>
 <p><input type="button" name="btn_salir" value="Salir" onclick="location.href = 'prestamos_abm.php'"></p>
 <!--<p style="font-size:0.8em;"><b>Afiliado:</b>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="afiliado"  value="<?php echo $afiliado; ?>" onkeyUp="return ValNumero(this);" size="5px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="btn_bus" value="Buscar"></p>-->
			<p style="font-size:0.8em;""> Fecha solicitud&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red><b>Estado</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Préstamo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red><b>Cuotas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Valor Cuota</b></font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total a devolver<br>
			<input type="text" name="fechasol" value="<?php echo $fechasol; ?>" size="10px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="estado" value="<?php echo $estado; ?>" size="8px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="prestamo" value="<?php echo '$ '.$prestamo; ?>" size="5px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="cuotas" value="<?php echo $cuotas; ?>" size="2px" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="vcuota"  value="<?php echo '$ '.$vcuota; ?>" size="7px" disabled> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="total"  value="<?php echo '$ '.$total; ?>" size="8px" disabled>
			</p>
			
			<?php
			if (isset($_REQUEST['op'])){

			echo'<h2>Cuotas</h2>
				<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%" bgcolor=#B2BABB>CUOTA</th>
				<th widt="5%" bgcolor=#B2BABB>MESES</th>
				<th widt="5%" bgcolor=#B2BABB>FECHA DE PAGO</th>
				
			</thead>
			<tbody>';
			VerCuotas(); 
			echo'</tbody>
		</table>';
	}
?>
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

function VerCuotas(){
	
	$ptm_id=$_REQUEST['ptm_id'];

	$fpago='';
	$cont=0;
	$tot=0;
	$afiliado=$_REQUEST['afiliado'];
	$rows = Prestamo::getPrestamo(0,$ptm_id,0);
	
	if($rows->rowCount()!=0){
	
	foreach ($rows as $row) {

		
		$cont=$cont+1;
		$tot=$row['ptm_cuotas']*$row['ptm_cuotas'];
		$fech=$row['ptm_fechasol'];
		$cuo=$row['ptm_cuotas'];
		$vcuo=$row['ptm_valcuota'];
        $fch = explode("-",$fech); 
        $anio=$fch[0];
        $mes=$fch[1];
        $dia=$fch[2];
        $rest = substr($anio, -2);
        $cant=0;

        if ($dia>=20){if ($mes==12){$mes=2;$rest=$rest+1;$anio=$anio+1;}else if ($mes==11){$mes=1;$rest=$rest+1;$anio=$anio+1;}else{$mes=$mes+2;}}

        else{ if ($mes==12) {$mes=1;$rest=$rest+1;$anio=$anio+1;}else{$mes=$mes+1;}    }
    

        while ($cont<=$cuo){
        	//echo $anio;
        	$fpago=Traerpago($afiliado,$mes,$anio,$vcuo);

        	if ($fpago<>''){$cant=$cant+1;}
        		
        switch ($mes) {	
        	case 1:$mesl='01-'.$rest;break;
			case 2:$mesl='02-'.$rest;break;
			case 3:$mesl='03-'.$rest;break;
			case 4:$mesl='04-'.$rest;break;
			case 5:$mesl='05-'.$rest;break;
			case 6:$mesl='06-'.$rest;break;
			case 7:$mesl='07-'.$rest;break;
			case 8:$mesl='08-'.$rest;break;
			case 9:$mesl='09-'.$rest;break;
			case 10:$mesl='10-'.$rest;break;
			case 11:$mesl='11-'.$rest;break;
			case 12:$mesl='12-'.$rest;break;
            default:break;
        }
        	echo"<tr>
        	<td style='text-align:center;'><b>".$cont."</b></td>	
        	<td style='text-align:center;'><b>".$mesl."</b></td>
        	<td><b>".$fpago."</b></td>	
        	</tr>";
        	$cont=$cont+1;
        	$mes=$mes+1;
        	if($mes>12){$mes=1;$rest=$rest+1;$anio=$anio+1;}
        }

		/*echo "<tr>
			  <td>".$cont."</td>	
			  <td>".$row['ptm_id']."</td>
			  <td>".$row['ptm_fechasol']."</td>
			  <td>".$row['ptm_prestamo']."</td>
			  <td>".$row['ptm_cuotas']."</td>
			  <td>".'$'.$row['ptm_valcuota']."</td>
			  <td>".$row['ptm_estado']."</td>
			  <td><center><a href='?op=md&ptm_id=".$row['ptm_id']."&afiliado=".$_GET['afiliado']."'><img src='libs/img/btn_editar.jpg' width='10%' height='5%'></a><center></td>
		           
		     </tr>";*/
	    }
	}
else
	echo 'CONSULTA VACIA';	
if ($cant==$cuo){$estado='CANCELADO';}
else{$estado='ACTIVO';}
echo '<span style="text-decoration:blink;">'.$estado.'</span>';
}



function VerPrestamos(){
	
	$afiliado=$_REQUEST['afiliado'];


	$cont=0;
	$tot=0;

	//$afi=$_REQUEST['afiliado'];
	$rows = Prestamo::getPrestamo(3,0,$afiliado);
	
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
		
		
		/*$rowsp = Cuo_prestamo::getCuo_prestamo(0,$row['ptm_prestamo'],$row['ptm_cuotas']);
	
		foreach ($rowsp as $rowp) {
	
		 $cuo=$rowp['cuoptm_cuota'];
	    } */   
  	
		$cont=$cont+1;
		$tot=$row['ptm_cuotas']*$row['ptm_cuotas'];
		//$fechap=Traerpagos($);
		$nick=VerAsesor($row['ptm_op']);
		echo "<tr>
			  <td style='text-align:center;'>".$cont."</td>	
			  <td style='text-align:center;'>".$row['ptm_id']."</td>
			  <td>".$row['ptm_fechasol']."</td>
			  <td>".'$ '.$row['ptm_prestamo']."</td>
			  <td style='text-align:center;'>".$row['ptm_cuotas']."</td>
			  <td>".'$ '.$row['ptm_valcuota']."</td>
			  <td>".$row['ptm_estado']."</td>
			  <td>".$nick."</td>
			  <td><center><a href='?op=md&ptm_id=".$row['ptm_id']."&afiliado=".$_GET['afiliado']."'><img src='libs/img/campa.jpg'></a><center></td>
		           
		     </tr>";
	    }
	}
else
	echo 'CONSULTA VACIA';	
}

function VerAfiliado(){

	$afi=$_GET['afiliado'];

	$rows = Maestro::getMaestro(7,$afi);
	foreach ($rows as $row) {
		
		//$nombre=$row['APELLIDOS']." ".$row['NOMBRES'];
		return strtoupper($row['NOMBRES']." ".$row['APELLIDOS']);
	
	}
    
}

function VerAsesor ($ase){

	//$afi=$_GET['afiliado'];

	$rows = Usuario::getUsuario(3,$ase);
	foreach ($rows as $row) {
		
		//$nombre=$row['APELLIDOS']." ".$row['NOMBRES'];
		return strtolower($row['usu_nick']);
	
	}
    
}

function VerPago(){

	$afi=$_GET['afiliado'];

	$rows = Maestro::getMaestro(7,$afi);
	foreach ($rows as $row) {
		switch ($row['GRUPO']) {
				case 6:$pago='POLICIA-DEBITO';break;
				case 1000:$pago='PARTICULAR/COBRADOR';break;
				//case 1000:$pago='OFICINA';break;
				case ($row['GRUPO']<=2500):$pago='CONVENIO';break;
				case (($row['GRUPO']>=3400)AND($row['GRUPO']<=4100)):$pago='TARJETA';break;
				case ($row['GRUPO']<=4200):$pago='BANCO';break;
				default:break;
        }

		return $pago;
	
	}
    
}

function Traerpago($afiliado,$mes,$anio,$vcuo){
	$envio='';
	//echo 'ro'.$afiliado.'-'.$mes.'-'.$anio;
	$rows = Pagos::getPagos2(0,$afiliado,$mes,$anio);
	foreach ($rows as $row) {
		//echo 'ro'.$afiliado.'-'.$mes.'-'.$anio;
		if ($row['IMPORTE'] >= $vcuo){
			$envio=$row['DIA_PAGO'].' - $ '.$row['IMPORTE'];

		}
		//$nombre=$row['APELLIDOS']." ".$row['NOMBRES'];
	return ($envio);
	
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
?>