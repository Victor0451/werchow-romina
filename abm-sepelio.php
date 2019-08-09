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
<script language="javascript" type="text/javascript">

function valida_envia(form){

//valido nro de Ficha
    ficha = form.btn_bus.value
    if (ficha=='buscar'){
     
      form.btn_guardar.enabled();
      return false;
    } 

function ShowSelected()
{
/* Para obtener el valor */
var cod = document.getElementById("accion").value;
alert('entro');
alert(cod);
 
/* Para obtener el texto */
/*var combo = document.getElementById("accion");
var selected = combo.options[combo.selectedIndex].text;
alert(selected);*/
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
include "libs/class/Adherente.class.php"; 

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];

$hora= date('H:i:s');


$monto=0; $lugar = null; $nombre = ""; $causa=null; $sector=0; $socio=null; $recibo=null; $numero=0;$total=0;$liq_id=0;$caja=null;$tel=0;$parentesco=null;
$dni_den=0;$seccion=0;$estatura='';$peso=''; $motivo='';$estado_civil='';
$retiro='';$hora_com='';$comun='';


$campania=null;
$bandera=0;
$bandera2=0;
$pago=null;
$bande3=0;
if (isset($_REQUEST['btn_bus'])){
	$socio=$_REQUEST['socio'];
	$accion=null;
	$bandera2=1;
	if ($socio==0){$bande3=1;}
	else{
	
	//$fecha=$_REQUEST['fecha'];
	$bande3=0;	
	$rows = Maestro::getMaestro(7,$socio);
	foreach ($rows as $row) {
		$fpago='DEBITO';
		$titular=$row['APELLIDOS']." ".$row['NOMBRES'];
		//echo $titular;
		if ($row['ADHERENTES']>0){
			TraeAdherente($socio);
		}
		else{print '<script language="JavaScript">'; 
			print 'alert("NO CUENTA CON ADHERENTES!!");'; 
			print'</script>';}

		if (($row['GRUPO']>=3400)and($row['GRUPO']<=4004)){$fpago='TARJETA';}		

		if (($row['GRUPO']==1000)OR($row['GRUPO']==1001)){$fpago='PARTICULAR';}		
		//$monto=TraerCuota($socio);
		//$campania=TraerCampa($socio);
		/*	if ($campania<>null){
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
            	default:break;
        	}
		}
		else{
			$campania=Traercampa2($socio);
			if ($campania<>null){
				$fch= explode("-",$campania); 
			$campania=$fch[0];
			$pago=$fch[1];
			$bandera=1;
			$bus='BACHE';
			switch ($pago) {
				case 'RECUPERACION':$accion='RECUPERACION';break; 
				case 'MOROSIDAD': $res=strpos($campania, $bus); if($res !== FALSE){$accion='BLANQUEO';}else{$accion='AT1';}
//				if($campania=='BACHES AT'){$accion='BLANQUEO';}else{$accion='AT1';}
				break;
				case 'OTRO':$bandera=0;break;
				default:break;
        	}
			}
		}*/
		$dni=$row['NRO_DOC'];
		
	}
   }		
}	

//echo 'romina'.$fecha;

/*$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];*/
/*if (isset($_REQUEST['btn_bus'])){
	$socio=$_REQUEST['socio'];
	$rows = Cuo_fija::getCuo_fija(0,$socio);
	foreach ($rows as $row) {
		
		$monto=$row['IMPORTE'];
	}
	$rows = Maestro::getMaestro(7,$socio);
	foreach ($rows as $row) {
		
		$nombre=$row['APELLIDOS']." ".$row['NOMBRES'];
	}
}*/	
//$ape=TraerApellido();
if (isset($_REQUEST['btn_guardar'])){
	$fecha=$_REQUEST['fecha'];
	//echo 'RO'.$fecha;
	//$fch = explode("/",$fecha); 
	//$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	//$ape=TraerApellido();
	$caja=$_REQUEST['caja'];
	$nombre=$_REQUEST['nombre'];
	$monto=$_REQUEST['monto'];
	$fpago=$_REQUEST['fpago'];
	$accion=$_REQUEST['accion'];
	$socio=$_REQUEST['socio'];
	$fecha=$_REQUEST['fecha'];
	$caja=$_REQUEST['caja'];
	$plan=$_REQUEST['plan'];
	$recibo=$_REQUEST['recibo'];
	$cuotas=$_REQUEST['cuotas'];
	
	
	if ($_REQUEST['liq_id'] == 0){ //Nuevo
		//echo 'NUEVOOOOO';
		$rows = Liquidacion::insertLiquidacion($fecha,$socio,$_SESSION["usu_ide"],strtoupper($nombre),$monto,$plan,$fpago,$recibo,$cuotas,$accion,$caja);
		
		$monto=0; $accion = null; $nombre = ""; $causa=null; $lugar=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;$caja=0;
		print'<script type="text/javascript">window.location="abm-liquidacionew.php";</script>';
	}
	else{ //Modificacion
		switch ($_REQUEST['liq_id']) {
			case '01':$caja='01'.$ape;
				# code...
				break;
			case '11':$caja='11'.$ape;
				# code...
				break;
			case '15':$caja='15'.$ape;
				
				break;	
			default:
					$caja=$_REQUEST['caja'];
				break;
		}
		$rows = Liquidacion::updateLiquidacion($_REQUEST['liq_id'], $_REQUEST['socio'],strtoupper($_REQUEST['nombre']),$_REQUEST['monto'],$_REQUEST['plan'],$_REQUEST['fpago'],$_REQUEST['recibo'],$_REQUEST['cuotas'],$_REQUEST['accion'],$caja);
		$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
	}
}
else{

	if (isset($_REQUEST['btn_limpiar'])){
		
	$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
		
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
	else{
		//$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
	}
	}
}





?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>ABM-Item Servicio</title>
	
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
		<a href="abm.php" class="nl"><h1>SOLICITUD DE SERVICIO</h1></a>
		<form id="formulario" action="#">	
			<input type="hidden" name="liq_id" value="<?php echo $liq_id; ?>">
			<input type="hidden" name="nombre" value="<?php echo $nombre; ?>">
			<input type="hidden" name="monto" value="<?php echo $monto; ?>">
			<input type="hidden" name="fpago" value="<?php echo $fpago; ?>">
			<input type="hidden" name="accion" value="<?php echo $accion; ?>">
			<p style="font-size:0.8em;"><b>Usuario&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Recepcion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUCURSAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SOCIO</b><br> <input type="texto" name="recup" value="<?php echo VerUsuario();?>" size="10px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="fecha" value="<?php echo $fecha; ?>" size="8px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="sucu" id="sucu"  >
						
						<option value="CASA CENTRAL">CASA CENTRAL</option>
						<option value="PALPALA">PALPALA</option>
						<option value="PERICO">PERICO</option>
						<option value="SAN PEDRO">SAN PEDRO</option>
						</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="socio"  value="<?php echo $socio; ?>" onkeyUp="return ValNumero(this);" size="5px" required>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="btn_bus" value="Buscar"></p>
			
			<?php
			 if ($bandera2==1){
			 	echo'
			<p style="font-size:0.8em;">Seleccionar Extinto: &nbsp;';

			if ($bande3==1){echo '<input type="text" name="nombre" id="nombre" value="'.$nombre.'" size="35px"';}
			else{echo '<select name="nombre" id="nombre"><option value=0>'.$nombre.'</option>';VerAfiliados();echo'</select>';}	
			
			echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI:&nbsp;<input type="text" name="dni" size="8px" maxlength="8" onkeyUp="return ValNumero(this);" disabled>';
			echo'	</p>';
			echo'
			<p style="font-size:0.8em;">Estatura Aprox.:&nbsp;<input type="text" name="estatura" id="estatura" value= "'.$estatura.'" size="5px">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Peso Aprox.:&nbsp;
			<input type="text" name="peso" id="peso" value="'.$peso.'"  size="5px" required> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Motivo Fallecimiento:&nbsp;<input type="text" name="motivo" id="motivo" value="'.$motivo.'"  size="25px" required>';
			echo'	</p>';
			echo'
			<p style="font-size:0.8em;">Retiro del Extinto:&nbsp;<input type="text" name="retiro" id="retiro" value= "'.$retiro.'" size="25px">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Comunicado:&nbsp;
			<input type="text" name="comun" id="comun" value="'.$comun.'"  size="15px" required> 
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hs comun.:&nbsp;<input type="time" name="hora" id="hora" value="'.$hora.'"  size="25px" disabled>';
			echo'	</p>';
				
			 }
			 
			?>
	
		<h2>BENEFICIARIO</h2>
		<p style="font-size:0.8em;">Apellido y Nombre:&nbsp;<input type="text" name="beneficiario" id="beneficiario" size="40px"></p>
        <p style="font-size:0.8em;">DNI:&nbsp;<input type="text" name="dni_ben" id="dni_ben" size="10px" maxlength="8" onkeyUp="return ValNumero(this);">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Estado Civil:&nbsp;
        <select name="estado_civil" id="estado_civil"  >
        	<option value="SOLTERO">SOLTERO</option>
			<option value="CASADO">CASADO</option>
			<option value="DIVORCIADO">DIVORCIADO</option>
			<option value="VIUDO">VIUDO</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Nacimiento:&nbsp;
		<input type="date" name="nacimiento" id="nacimiento" >
        </p>    
        <p style="font-size:0.8em;">Domicilio - Calle:&nbsp;<input type="text" name="calle" id="calle" size="20px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nº:&nbsp;<input type="text" name="nro" id="nro" size="3px" maxlength="4" onkeyUp="return ValNumero(this);">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Piso:&nbsp;<input type="text" name="piso" id="piso" size="3px" maxlength="2">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Barrio:&nbsp;<input type="text" name="barrio" id="barrio" size="20px" >
        </p>
        <p style="font-size:0.8em;">Localidad:&nbsp;<input type="text" name="localidad" id="localidad" size="20px">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Código Postal:&nbsp;<input type="text" name="postal" id="postal" size="3px" maxlength="4" onkeyUp="return ValNumero(this);">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Teléfono&nbsp;<input type="text" name="piso" id="piso" size="8px" maxlength="10" onkeyUp="return ValNumero(this);">
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Celular:&nbsp;<input type="text" name="barrio" id="barrio" size="10px" maxlength="10" onkeyUp="return ValNumero(this);">
        </p><br>
		<!--	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aviso Fúnebre &nbsp;<input type="radio" name="aviso" value="SI" checked="checked" />SI
            <input type="radio" name="aviso" value="NO" />NO
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Velatorio&nbsp;<select name="sala" id="sala"  >
						
						<option value="PARTICULAR">Dclio Particular</option>
						<option value="INDEPENDENCIA">Sala Independencia</option>
						<option value="PALPALA">Sala Palpala</option>
						<option value="LOS OLIVOS">Sala Los Olivos</option>
						<option value="SAN PEDRO">Sala San Pedro</option>
						</select>
		</p>
		<p style="font-size:0.8em;">Cementerio &nbsp;<select name="cementerio" id="cementerio"  >
						
						<option value="ROSARIO">ROSARIO</option>
						<option value="EL SALVADOR">EL SALVADOR</option>
						<option value="CASTILLO">JARDIN DEL CASTILLO</option>
						<option value="SOLAR">PARQUE DEL SOLAR</option>
						<option value="CREMACION">CREMACION</option>
						</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Sector &nbsp;<input type="text" name="numero"  value="<?php echo $numero; ?>" onkeyUp="return ValNumero(this);" size="1px" maxlength="3" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parcela&nbsp;<input type="text" name="nro_par"  value="<?php echo $nro_par; ?>" onkeyUp="return ValNumero(this);" size="1px" maxlength="3" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Seccion&nbsp;<input type="text" name="seccion"  value="<?php echo $seccion; ?>" onkeyUp="return ValNumero(this);" size="1px" maxlength="3" required>&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="parcela" value="PROPIA" checked="checked" />PROPIA
            <input type="radio" name="parcela" value="EMPRESA" />EMPRESA
		</p>	
		<p style="font-size:0.8em;">Set Cafetería &nbsp;&nbsp;<input type="radio" name="cafeteria" value="SI" checked="checked" />SI
            <input type="radio" name="cafeteria" value="NO" />NO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AUTOS&nbsp;&nbsp;<input type="text" name="sector"  value="<?php echo $sector; ?>" onkeyUp="return ValNumero(this);" size="3px" maxlength="3" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</p>
		<p style="font-size:0.8em;">Gtos Luto &nbsp;&nbsp;<input type="radio" name="luto" value="SI" checked="checked" />SI
            <input type="radio" name="luto" value="NO" />NO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gtos Munic.&nbsp;&nbsp;<input type="radio" name="muni value="SI" checked="checked" />SI
            <input type="radio" name="muni" value="NO" />NO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gtos Cremación&nbsp;&nbsp;<input type="radio" name="cremacion" value="SI"  />SI
            <input type="radio" name="cremacion" value="NO" checked="checked"/>NO
		</p>	
-->
		<p><input type="submit" name="btn_guardar" value="Guardar" onClick=" return valida_envia(this)">&nbsp;<input type="button" name="btn_Limpiar" value="Limpiar"onclick="location.href = 'abm-sepelio.php'">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'abm.php'"></p>
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


function VerAfiliados(){

	$socio=$_REQUEST["socio"];

	$rows = Maestro::getMaestro(7,$socio);
		foreach ($rows as $row) {
		
		$nombre=$row['APELLIDOS']." ".$row['NOMBRES'].'-Titular';
    }
    
	echo "<option value='".$nombre."'>".$nombre."</option>";
    
    $rows = Adherente::getAdherente(0,$socio);
	foreach ($rows as $row) {
				$nombre=$row['APELLIDOS']." ".$row['NOMBRES'].'-Adherente';	
				echo "<option value='".$nombre."'>".$nombre."</option>";
			//	echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
	}
    
}



function VerSocio(){
	echo 'hola';
	$socio = $_POST['socio'];
}

function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['usu_nick']);
	}
    
}

function TraerApellido(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_apellido']);
	}
    
}
function TraeAdherente($socio){
	$rows = Adherente::getAdherente(0,$socio);
	
	foreach ($rows as $row) {
	
//		echo $row['APELLIDOS'].' '.$row['NOMBRES'].'<br>';
	}
    
}
function TraerCuota($socio){
	$rows = Cuo_Fija::getCuo_Fija(0,$socio);
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
	$archivo='mora_'.$mes;
	//echo $archivo;
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

?>