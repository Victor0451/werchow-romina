<script language="javascript" type="text/javascript">

function Imprimir(){

  var cod = document.getElementById("accion").value;

  //alert(cod);
  //document.getElementById("accion").disabled = true; // deshabilitar
  //document.getElementById("plan").disabled = true; // deshabilitar
  switch (cod) {
  	case 'VENTA': alert('Ingresar monto de Venta!!!');
	 document.getElementById("monto").disabled = false; // habilitar
	 document.getElementById("monto").focus();//foco	

  	break;
  	case 'PRESTAMO': alert('Ingresar monto del Prestamo!!!');
	 document.getElementById("monto").disabled = false; // habilitar
	 document.getElementById("monto").focus();//foco	
	 document.getElementById("cuotas").disabled = true; // deshabilitar
	 document.getElementById("recibo").disabled = true; // deshabilitar
	 document.getElementById("caja").disabled = true; // deshabilitar
  	break;
  	default:document.getElementById("cuotas").disabled = false; // habilitar
	 document.getElementById("recibo").disabled = false; // habilitar
	 document.getElementById("caja").disabled = false; // habilitar
	 document.getElementById("plan").focus();//foco;
  }	

}

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
    //*** Fin del Codigo para Validar que sea un campo Numerico
function Solo_Letra(variable){
    
    if (isNaN(variable)){
		if( variable && !(variable.search(/[a-zA-Z]$/)+1) ){
    		 return""; }		
         return variable;
	}
	return "";
}
function ValLetra(Control){
      Control.value=Solo_Letra(Control.value);
}

</script>

<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/Otro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/liquidacion.class.php";
include "libs/class/cuo_fija.class.php"; 
include "libs/class/Campana.class.php";
$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=null; $recibo=0; $cuotas=0;$total=0;$liq_id=0;$caja=0;$campania=null;

$fecha=null;
$campania=null;
$bandera=0;
$bandera2=0;
$pago=null;

if (isset($_REQUEST['btn_bus'])){
	
	$accion=null;
	$bandera2=1;
	$socio=$_REQUEST['socio'];
	$fecha=$_REQUEST['fecha'];
	$empresa=$_REQUEST['empresa'];
	$liq_id=0;
	$empre=$_REQUEST['empresa'];
	if ($empresa=='W'){$rows = Maestro::getMaestro(7,$socio);}	
	else{$rows = Maestro::getMaestro(11,$socio);}
		
	foreach ($rows as $row) {
		$fpago='DEBITO';
		$nombre=$row['APELLIDOS']." ".$row['NOMBRES'];
		
		if (($row['GRUPO']>=3400)and($row['GRUPO']<=4004)){$fpago='TARJETA';}		

		if (($row['GRUPO']==1000)OR($row['GRUPO']==1001)){$fpago='PARTICULAR';}	

		$monto=TraerCuota($socio,$empresa);
		$campania=TraerCampa($socio);
		$pago=TraerPago($socio);
		//	echo 'VER'.$campania;
		if ($campania<>null){

			/*echo 'AQUI';*/
			$fch= explode("-",$campania); 
			$campania=$fch[0];
			$pago=$fch[1];
			$bandera=1;
			switch ($pago) {
				case 'TARJETA':$accion='BLANQUEO';break;
				case 'BANCO':$accion='BLANQUEO';break;
				case 'COBRADOR':$accion='AT1';break;
				case 'POLICIA':$accion='AT1';break;
				case 'OFICINA':$accion='AT1';break;
				case 'RECUPERACION':$accion='RECUPERACION';break;
				case 'REINCIDENTE':$accion='REINCIDENTE';break;
				//case 'RECHAZOS':$accion='BLANQUEO';break;
				case '3 CUOTAS':$accion='ATRASADO';break;
            	default:$bandera=0;break;
        	}
		}
		else{
			$campania=Traercampa2($socio);
			if ($campania<>null){
			//	echo $campania;
				$fch= explode("-",$campania); 
				$campania=$fch[0];
				$pago=$fch[1];
				$bandera=1;
				$bus='REINCIDENTES';
				switch ($pago) {
					case 'RECUPERACION': $res=strpos($campania, $bus); if($res !== FALSE){$accion='REINCIDENTE';}
					else{$accion='RECUPERACION';}
					break; 
					case 'MOROSIDAD': //$res=strpos($campania, $bus); if($res !== FALSE){$accion='BLANQUEO';}
					
					if (strpos($campania, 'DIC 18')!== false){$accion='AT';}
					else{	
					if (($fpago=='DEBITO')OR($fpago=='TARJETA')){$accion='BLANQUEO';}
					else{$accion='AT1';}}
					break;
					case 'RECHAZOS': //$res=strpos($campania, $bus); if($res !== FALSE){$accion='BLANQUEO';}
					if (($fpago=='DEBITO')OR($fpago=='TARJETA')){$accion='BLANQUEO';}
					else{$accion='AT1';}
					break;
					case 'OTRO': if (strpos($campania, 'BACHE') !== false) {
    $accion='BLANQUEO';
}
		else {$bandera=0;}			//if (){$accion='BLANQUEO';}
								//else{
				//					
					break;
					default:break;
        		}
			}
			else{$bandera=0;}
		}
		$dni=$row['NRO_DOC'];
			
	}
}	

if (isset($_REQUEST['btn_guardar'])){
	$fecha=$_REQUEST['fecha'];
	
	$nombre=$_REQUEST['nombre'];
	$monto=$_REQUEST['monto'];
	$fpago=$_REQUEST['fpago'];
	
	$socio=$_REQUEST['socio'];
	
	$fecha=$_REQUEST['fecha'];
	
	$plan=$_REQUEST['plan'];
	$accion=$_REQUEST['accion'];

	
	//echo 'RO'.$accion.'*'.$plan;

	if ($accion=='PRESTAMO'){$recibo=0;$caja=0;$cuotas=0;$nrorec=0;}
	else{
		$recibo=$_REQUEST['recibo'];
		$cuotas=$_REQUEST['cuotas'];
		$caja=$_REQUEST['caja'];
		$nrorec=$_REQUEST['nrorec'];
		$empresa=$_REQUEST['empresa'];
	}
	
	if ($_REQUEST['liq_id'] == 0){ //Nuevo
	$empre=$_REQUEST['empre'];	
	$rows = Liquidacion::insertLiquidacion($fecha,$socio,$_SESSION["usu_ide"],strtoupper($nombre),$monto,$plan,$fpago,$recibo,$cuotas,$accion,$caja,$nrorec,$empre);
		
		//$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;$caja=0;
		//print'<script type="text/javascript">window.location="abm-liquidacion.php";</script>';
	}
	else{ //Modificacion
		$acc=$_REQUEST['accion'];
		if ($acc=='PRESTAMO'){$recibo=0;$cuotas=0;$caja=0;}
		else{$recibo=$_REQUEST['recibo'];$cuotas=$_REQUEST['cuotas'];$caja=$_REQUEST['caja'];}
		$rows = Liquidacion::updateLiquidacion($_REQUEST['liq_id'], $_REQUEST['socio'],strtoupper($_REQUEST['nombre']),$_REQUEST['monto'],$_REQUEST['plan'],$_REQUEST['fpago'],$recibo,$cuotas,$_REQUEST['accion'],$caja);
		//print'<script type="text/javascript">window.location="abm-liquidacion.php";</script>';
		//$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
	}
}

else{

	
	if (isset($_REQUEST['op'])){

		switch ($_REQUEST['op']) {
			case 'md': //modificar
				$bandera2=1;
				$rows = Liquidacion::getLiquidacion(0,$_REQUEST['liq_id'],0);
				$row = $rows->fetch();
				$socio = $row['liq_socio'];
				$fecha = $row['liq_fecha'];
				$nombre = $row['liq_nombre'];
				$monto = $row['liq_monto'];
				$plan = $row['liq_plan'];
				$fpago = $row['liq_fpago'];
				$recibo = $row['liq_recibo'];
				$cuotas = $row['liq_cuotas'];
				$accion = $row['liq_accion'];
				$liq_id=$row['liq_id'];
				$caja=$row['liq_caja'];
				
				break;
			case 'br': //borrar
				$rows = Liquidacion::deleteLiquidacion($_REQUEST['liq_id']);
				break;
		}
	}
	
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>ABM-Item Liquidaciones</title>
	
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
		<a href="abm.php" class="nl"><h1>Carga Item de Liquidacion</h1></a>
		<form id="frm" action="" method="get">	
			<input type="hidden" name="liq_id" value="<?php echo $liq_id; ?>">
			<input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
			<input type="hidden" name="monto" value="<?php echo $monto; ?>">
			<input type="hidden" name="fpago" value="<?php echo $fpago; ?>">
			<input type="hidden" name="campania" value="<?php echo $campania; ?>">
			<input type="hidden" name="accion" value="<?php echo $accion; ?>">
			<input type="hidden" name="empre" value="<?php echo $empre; ?>">
		
			<p style="font-size:0.8em;"><b>Recuperador&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Empresa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			SOCIO</b><br> <input type="texto" name="recup" value="<?php echo VerUsuario();?>" size="10px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="fecha" value="<?php echo $fecha; ?>" required >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="empresa" value="W" checked>Werchow
  		  	<input type="radio" name="empresa" value="M">SanValentin
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="socio"  value="<?php echo $socio; ?>" onkeyUp="return ValNumero(this);" size="5px" required>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="btn_bus" value="Buscar"  style="background-color:#99CCFF"></p>
			
			<?php
			 if ($bandera2==1){
			 	echo'
			<p style="font-size:0.8em;">Apellido y Nombre &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto Cuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma de Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Campaña<br>	

			<input type="text" name="nombre" value="'.$nombre.'" size="35px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<input type="text" id= "monto" name="monto" value="'.$monto.'" size="7px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="fpago" value="'.$fpago.'" size="10px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="campania" value="'.$campania.'" size="20px" disabled>

			</p>';


			echo'<p style="font-size:0.8em;">PLAN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACCION&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cant.Cuotas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Recibo</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CAJA<br>';
			echo'<select name="plan" id="plan" >
				<option value= "'.$plan.'" selected="selected"  required >'.$plan.'</option>
				<option value="PROVINCIA">PROVINCIA</option>
				<option value="NOA">NOA</option>
				<option value="NACIONAL">NACIONAL</option>
				<option value="ABARCAR">ABARCAR</option>
				<option value="PROVINCIAL">PROVINCIAL</option>
				<option value="NOVELL">NOVELL</option></select>';	
				if ($bandera==1) {
					echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="accion" id="accion" value="'.$accion.'" size="15px" disabled>';
				}
				else{
					 echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<select name="accion" id="accion" onChange="Imprimir();" >
						<option value= "'.$accion.'" selected="selected">'.$accion.'</option>
						<option value="TRASPASO VISA">TRAS.VISA</option>
						<option value="VENTA">VENTA</option>
						<option value="PRESTAMO">PRESTAMO</option>
						<option value="ADELANTO">ADEL.CUOTAS</option>
						<option value="NOVELL">NOVELL</option>
										
						</select>';	
				}
				
				echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="cuotas" name="cuotas" value="'.$cuotas.'" onkeyUp="return ValNumero(this);" size=5  maxlength="2" required>';
				echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="radio" name="nrorec" value=0 checked>1 &nbsp;&nbsp;&nbsp;
  		  		<input type="radio" name="nrorec" value=1>+1
				<input type="text" id="recibo" name="recibo" value="'.$recibo.'" onkeyUp="return ValNumero(this);" size=5  maxlength="5" required>';
				echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="caja" id="caja" required >
					<option value= "'.$caja.'" selected="selected">'.$caja.'</option>
					<option value=01>01 </option>
					<option value=11>11 </option>
					<option value=15>15 </option>
					</select>
			</p>';
				
			 }
			 			?>
	
	
		<p><input type="submit" name="btn_guardar" value="Guardar" >&nbsp;<input type="button" name="btn_Limpiar" value="Limpiar"onclick="location.href = 'abm-liquidacion.php'">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'abm.php'"></p>

		</form>
		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="5%">Fecha</th>
				<th widt="5%">Emp</th>
				<th widt="5%">Socio</th>
				<th widt="10%">NºRecibo</th>
				<th widt="15%">Afiliado Titular</th>
				<th widt="10%">Monto</th>
				<th widt="15%">Plan</th>
				<th widt="15%">Forma Pago</th>
				<th widt="5%">Cuotas</th>
				<th widt="10%">Total</th>
				<th widt="10%">Caja</th>
				<th widt="5%">Accion</th>
				<!--<th widt="5%">Edit</th>
				<th widt="5%">Elim</th>-->
			</thead>
			<tbody>
				<?php VerLiquidaciones(); ?>
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

function VerLiquidaciones(){
	
	$recup=$_SESSION["usu_ide"];

	$cont=0;

	$rows = Liquidacion::getLiquidacion(1,0,$recup);

	//if($rows->rowCount()!=0){
	
	foreach ($rows as $row) {

		$total2= $row['liq_monto'] * $row['liq_cuotas'];
		$cont=$cont+1;
		
		echo "<tr>
			  <td>".$cont."</td>	
			  <td>".$row['liq_fecha']."</td>
			  <td>".$row['liq_emp']."</td>
			  <td>".$row['liq_socio']."</td>
			  <td>".$row['liq_recibo']."</td>
			  <td>".$row['liq_nombre']."</td>
			  <td>".'$ '.$row['liq_monto']."</td>
			  <td>".$row['liq_plan']."</td>
			  <td>".$row['liq_fpago']."</td>
			  <td>".$row['liq_cuotas']."</td>
			  <td>".'$ '.$total2."</td>
			  <td>".$row['liq_caja']."</td>
			  <td>".$row['liq_accion']."</td>";
			  if ($_SESSION["usu_ide"]==1){echo"<td><center><a href='?op=md&liq_id=".$row['liq_id']."'><img src='libs/img/campa.jpg' ></a><center></td>
		      <td><center><a href='?op=br&liq_id=".$row['liq_id']."'><img src='libs/img/eliminar1.jpg' ></a><center></td> ";}
			  	else{echo"</tr>";}
		      
	    }
	}
/*else
	echo 'CONSULTA VACIA';	
}*/



function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		//return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
		return strtolower($row['usu_nick']);
	}
    
}

function TraerApellido(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_apellido']);
	}
    
}
function TraerCuota($socio,$empresa){
	if ($empresa=='W'){$rows = Cuo_Fija::getCuo_Fija(0,$socio);}
	else{$rows = Cuo_Fija::getCuo_Fija(1,$socio);}
	
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {
			return ($row['IMPORTE']);
		}
    }
    else{print '<script language="JavaScript">'; 
	print 'alert("NO tiene cuota valida Verificar");'; 
	print'</script>';}
}

function TraerCampa($socio){
	
$campa=0;

	$fec= date("d/m/Y",time());
	$fch= explode("/",$fec); 
	if ($fch[1]==1){$fch[1]=12;}else{$fch[1]=$fch[1]-1;}
	
	 switch ($fch[1]) {	
        	case 1:$mes='enero';break;
			case 2:$mes='febrero';break;
			case 3:$mes='marzo';break;
			case 4:$mes='abril';break;
			case 5:$mes='mayo';break;
			case 6:$mes='junio';break;
			case 7:$mes='julio';break;
			case 8:$mes='agosto';break;
			case 9:$mes='septiembre';break;
			case 10:$mes='octubre';break;
			case 11:$mes='noviembre';break;
			case 12:$mes='diciembre';break;
            default:break;
        }
	//$archivo='mora_'.$mes;
	$archivo='mora042019';
	
	$rows = Otro::getOtro(13,$archivo,$socio);
	//if($rows->rowCount()!=0){
		foreach ($rows as $row) {
			
			return($row['CAMPANIA'].'-'.$row['FORMA_PAGO']);
		}
    //}
    /*else{print '<script language="JavaScript">'; 
	print 'alert("NO tiene campaña asignada!!");'; 
	print'</script>';}*/


}

function TraerPago($socio){
	
$pago=0;

	$fec= date("d/m/Y",time());
	$fch= explode("/",$fec); 
	if ($fch[1]==1){$fch[1]=12;}else{$fch[1]=$fch[1]-1;}
	
	 switch ($fch[1]) {	
        	case 1:$mes='enero';break;
			case 2:$mes='febrero';break;
			case 3:$mes='marzo';break;
			case 4:$mes='abril';break;
			case 5:$mes='mayo';break;
			case 6:$mes='junio';break;
			case 7:$mes='julio';break;
			case 8:$mes='agosto';break;
			case 9:$mes='septiembre';break;
			case 10:$mes='octubre';break;
			case 11:$mes='noviembre';break;
			case 12:$mes='diciembre';break;
            default:break;
        }
	//$archivo='mora_'.$mes;
	$archivo='mora032019';
	$rows = Otro::getOtro(13,$archivo,$socio);
	//if($rows->rowCount()!=0){
		foreach ($rows as $row) {
			

			$pago=$row['FORMA_PAGO'];
		}
    //}
    /*else{print '<script language="JavaScript">'; 
	print 'alert("NO tiene campaña asignada!!");'; 
	print'</script>';}*/

return($pago);
}

function TraerPerfil(){
$usu=$_SESSION["usu_ide"];

$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];

	}
switch ($perfil) {
				case 'ASESOR':include ('menu_vta.php'); break;
				case 'VENTAS':include ('menu_vta.php'); break;
				case 'RECUPERADOR':include ('menu_rec.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'RENDICION':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}
function TraerCampa2($socio){
$campa=null;
//echo $socio;
$rows = Campana::getCampana(0,$socio);
if($rows->rowCount()!=0){
	foreach ($rows as $row) {
		
		$campa=$row['CAMPANA'].'-'.$row['Tipo'];
	}
}
else{print '<script language="JavaScript">'; 
	print 'alert("NO tiene campaña asignada!!");'; 
	print'</script>';
}
	//echo $campa;
	return $campa;	

}	
?>