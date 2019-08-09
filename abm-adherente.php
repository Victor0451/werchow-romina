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
<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/produccion.class.php";
include "libs/class/Adherente.class.php";
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";

$recibo=null;$nombre='';$ape_adhe='';$fecha=null;$localidad=0;$monto=null;$plan='';$dni=null;$asesor=0;$mes=null;$anio=null;$pago=null;$adhe_id=0;$afiliado=0;
$cta_tar=0;$nom_adhe='';$fec_nac='';$paren='';$estado='';$dni_afi=0;$ban_mod=0;$pago=0;$fec_pago='';	
$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$mes=VerMes();
if (isset($_REQUEST['btn_bus'])){
$dni_afi=$_REQUEST['dni_afi'];
//echo 'ROMINA'.$dni_afi;
$asesor=$_REQUEST['asesor'];
$fechac=$_REQUEST['fechac'];
//$afi=$_REQUEST['dni_afi'];
$rows = Maestro::getMaestro(9,$dni_afi);
  if($rows->rowCount()!=0){
	foreach ($rows as $row) {
		$nombre=$row['APELLIDOS']." ".$row['NOMBRES'];
		$afiliado=$row['CONTRATO'];	
	}	
  }
  else{print'<script type="text/javascript">alert("NO EXISTE AFILIADO CON DNI INGRESADO...CONTROLAR");</script>';}	
}

if (isset($_REQUEST['btn_guardar'])){
	//$fecha=$_REQUEST['fecha'];
	$pago='NO';
	$estado='PENDIENTE';
	$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fec=$fecha;
	
	if ($_REQUEST['adhe_id'] == 0){ //Nuevo
		$rows = Adherente::insertAdherente($_REQUEST['afiliado'],$fec,$_REQUEST['fechac'],$_REQUEST['asesor'],strtoupper($_REQUEST['ape_adhe']),strtoupper($_REQUEST['nom_adhe']),$_REQUEST['dni'],$_REQUEST['fec_nac'],$_REQUEST['paren'],$_REQUEST['recibo'],$_REQUEST['monto'],$pago,$estado);
		
		$recibo=null;$nombre='';$apellido='';$fecha=null;$localidad='';$monto=null;$plan='';$dni=null;$asesor=0;$mes=null;$anio=null;$pago=null;$prod_ide=0;$cta_tar=0;
		print'<script type="text/javascript">window.location="abm-adherente.php";</script>';

	}
	else{ //Modificacion
		
		$rows = Produccion::updateProduccion($_REQUEST['prod_ide'], $_REQUEST['fechac'],$_REQUEST['mes'], $_REQUEST['anio'],$_REQUEST['asesor'],strtoupper($_REQUEST['apellido']),strtoupper($_REQUEST['nombre']),$_REQUEST['dni'],$_REQUEST['localidad'],$_REQUEST['recibo'],$_REQUEST['monto'],$_REQUEST['plan'],$_REQUEST['pago'],$_REQUEST['cta_tar']);
		/*$recibo=null;$nombre='';$apellido='';$fecha=null;$localidad='';$monto=null;$plan='';$dni=null;$asesor=null;$mes=null;$anio=null;$pago=null;$prod_ide=0;
		print'<script type="text/javascript">window.location="abm-produccion.php";</script>';*/
}
}
else{

	if (isset($_REQUEST['btn_limpiar'])){
		
	$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;$cta_tar=0;
	print'<script type="text/javascript">window.location="abm-produccion.php";</script>';
		
	}
else{
	if (isset($_REQUEST['op'])){

		switch ($_REQUEST['op']) {
			case 'md': //modificar
				$rows = Adherente::getAdherente(3,$_REQUEST['adhe_id']);
				$row = $rows->fetch();
				$rowms = Maestro::getMaestro(7,$row['adhe_contrato']);
  					foreach ($rowms as $rowm) {
						$nombre=$rowm['APELLIDOS']." ".$rowm['NOMBRES'];
						$dni_afi=$rowm['NRO_DOC'];
						
					}
				$fechac = $row['adhe_fechafi'];
				$asesor = $row['adhe_asesor'];
				$afiliado = $row['adhe_contrato'];
				$ape_adhe = $row['adhe_apellido'];
				$nom_adhe = $row['adhe_nombre'];
				$dni = $row['adhe_dni'];
				$monto = $row['adhe_monto'];
				$recibo = $row['adhe_recibo'];
				$paren = $row['adhe_paren'];
				$estado = $row['adhe_estado'];
				$fec_nac = $row['adhe_fecnac'];
				$pago = $row['adhe_pago'];
				$adhe_id=$row['adhe_id'];
				switch ($estado) {
					case 'PENDIENTE':
						$ban_mod=1;
						break;
					case 'ENTREGADO':
						$ban_mod=2;
						break;	
					
					default:
						# code...
						break;
				}
				
				
			break;
			case 'br': //borrar
				$rows = Adherente::deleteAdherente($_REQUEST['adhe_id']);
				print'<script type="text/javascript">window.location="abm-adherente.php";</script>';
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
	
	<title>Alta Adherente</title>
	
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
		<a href="asesores.php" class="nl"><h1>ALTA ADHERENTE</h1></a>
		<form action="" id="formulario" action="" onSubmit="">
			<input type="hidden" name="adhe_id" value="<?php echo $adhe_id; ?>">
			<input type="hidden" name="afiliado" value="<?php echo $afiliado; ?>">
		<p style="font-size:0.8em;"><b>MES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AÑO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Afiliacion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ASESOR</b><br> 
		<input type="text" name="mes" value="<?php echo $mes; ?>" size="12px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="anio" value="<?php echo $anio; ?>" onkeyUp="return ValNumero(this);" size="3px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="date" name="fechac" value="<?php echo $fechac; ?>" size="8px">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="asesor" id="asesor" ><option value="<?php echo $asesor; ?>"><?php echo TraerAsesor($asesor); ?></option><?php echo VerAsesor();?></select>	
		</p>
		<p style="font-size:0.8em;"> Nº DNI Afiliado:&nbsp;<input type="text" name="dni_afi" value="<?php echo $dni_afi; ?>" onkeyUp="return ValNumero(this);" size="6px" maxlength="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="btn_bus" value="Buscar">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Afiliado:&nbsp;<input type="text" name="afiliado" value="<?php echo $afiliado; ?>"  size="3px" disabled >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Titular:&nbsp;<input type="text" name="nombre" value="<?php echo $nombre; ?>" size="40px" disabled>
		</p>
		<h2>Datos Nuevo Adherente</h2>
		<p style="font-size:0.8em;">Apellido&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Nacim.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parentesco<br>
		<input type="text" name="ape_adhe" value="<?php echo $ape_adhe; ?>" size="18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="nom_adhe" value="<?php echo $nom_adhe; ?>" size="18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dni" value="<?php echo $dni; ?>" onkeyUp="return ValNumero(this);" size="6px" maxlength="8">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="fec_nac" value="<?php echo $fec_nac; ?>" size="5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="paren" id="paren" >
				<option value= "<?php echo $paren; ?>" selected="selected"><?php echo $paren; ?></option>
				<option value='ESPOSA/O'>ESPOSA/O</option>
				<option value='HIJO/A'>HIJO/A</option>
				<option value='HERMANO/A'>HERMANO/A</option>
				<option value='NIETO/A'>NIETO/A</option>
				<option value='SUEGRO/A'>SUEGRO/A</option>
				<option value='OTROS'>OTROS</option>
				
		</select>
		</p>
		<p style="font-size:0.8em;">Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!--Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma de Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CTA-CTE/N°TARJETA-->
		<?php
	/*		if ($pago=='NO'){
				switch ($ban_mod) {
					case 1: echo"Estado";
						break;
					case 2: echo"Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha_pago"	;
						
						break;
					default:
						# code...
						break;
				}
			}*/
		?>	
		<br>
		<input type="text" name="recibo" value="<?php echo $recibo; ?>" onkeyUp="return ValNumero(this);" size="5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<input type="text" name="monto" value="<?php echo $monto; ?>"  onkeyUp="return ValNumero(this);" size="5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php
			/*if ($pago=='NO'){
				
				switch ($ban_mod) {
					case 1: echo"<select name='estado' id='estado' >
									<option value= ".$estado." >".$estado."</option>
									<option value='ENTREGADO'>ENTREGADO</option>
								</select>";
						break;
					case 2: echo"<select name='pago' id='pago' >
									<option value= ".$pago." >".$pago."</option>
									<option value='SI'>SI</option>
								</select>";
							echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='date' name='fec_pago' value=". $fec_pago." size='5px'>"	;
						
						break;
					default:
						# code...
						break;
				}
			}*/
		?>	
<!--		<select name="plan" id="plan" >
				<option value= "<?php echo $plan; ?>" selected="selected"><?php echo $plan; ?></option>
				<option value='A'>A</option>
				<option value='PROVINCIA'>PROVINCIA</option>
				<option value='NOA'>NOA</option>
				<option value='NACIONAL'>NACIONAL</option>
				<option value='ABARCAR'>ABARCAR</option>
				<option value='FAMILIA'>FAMILIA</option>
				<option value='NOVELL'>NOVELL</option>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="pago" id="pago" >
				<option value= "<?php echo $pago; ?>" selected="selected"><?php echo $pago; ?></option>
				<option value='OFICINA'>OFICINA</option>
				<option value='COBRADOR'>COBRADOR</option>
				<option value='TARJETA'>TARJETA</option>
				<option value='POLICIA'>POLICIA</option>
				<option value='EST POLICIA'>EST.POLICIA</option>
				<option value='CONVENIO'>CONVENIO</option>
				<option value='DEBITO'>DEBITO</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="cta_tar" value="<?php echo $cta_tar; ?>" onkeyUp="return ValNumero(this);" size="17px">-->
		</p>

		<p><input type="submit" name="btn_guardar" value="Guardar">&nbsp;<input type="submit" name="btn_Limpiar" value="Limpiar">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'">

		<!--	<a href="abm.php" target="_blank" onclick="window.open(this.href,this.target,'width=400,height=150,top=200,left=200,toolbar=no,location=no,status=no,menubar=no');return false;">Ejemplo</a> 
-->
		</p>


		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%" bgcolor=#F4D03F>N°</th>
				<th widt="5%" bgcolor=#F4D03F>Fecha Afil.</th>
				<th widt="5%" bgcolor=#F4D03F>Socio</th>
				<th widt="5%" bgcolor=#F4D03F>Adherente</th>
				<th widt="5%" bgcolor=#F4D03F>Recibo</th>
				<th widt="5%" bgcolor=#F4D03F>Monto</th>
				<th widt="5%" bgcolor=#F4D03F>Estado</th>
				<th widt="5%" bgcolor=#F4D03F>Cobrado</th>
				<th widt="5%" bgcolor=#F4D03F>Fecha</th>
				<th widt="8%" bgcolor=#F4D03F>Asesor</th>
				<th widt="0%" bgcolor=#F4D03F></th>
				<th widt="0%" bgcolor=#F4D03F></th>
				
			</thead>
			<tbody>
				<?php VerAltaAdhe(); ?>
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

function VerAsesor(){

	$usu=$_SESSION["usu_ide"];
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];

	}

	if ($perfil=='ASESOR'){
		echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
	}

	else{
		$rows = Usuario::getUsuario(7,0);
	foreach ($rows as $row) {
	echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
	}	
	}
	
    
}

function VerAltaAdhe(){
	
	$cont=0;
	$usu=$_SESSION["usu_ide"];
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];
		

	}
	if ($perfil=='ASESOR'){ $rows = Adherente::getAdherente(1,$usu); }
	else{	$rows = Adherente::getAdherente(2,0);	}
	
	foreach ($rows as $row) {
		
		$cont=$cont+1;
		$nick=TraerNick($row['adhe_asesor']);
		
		
	echo "<tr>
			  <td style='text-align:center;'>".$cont."</td>	
			  <td>".$row['adhe_fechafi']."</td>
			   <td>".$row['adhe_contrato']."</td>
			  <td>".$row['adhe_apellido'].' '.$row['adhe_nombre']."</td>
			  <td>".$row['adhe_recibo']."</td>
			  <td>".'$ '.$row['adhe_monto']."</td>
			  <td>".$row['adhe_estado']."</td>
			  <td>".$row['adhe_pago']."</td>
			  <td>".$row['adhe_fecpago']."</td>
			 
			  <td>".$nick."</td>";
			  if (($row['adhe_pago']=='NO')and($row['adhe_estado']=='PENDIENTE')){echo"<td><center><a href='?op=md&adhe_id=".$row['adhe_id']."'><img src='libs/img/campa.jpg'></a><center></td>
		      <td><center><a href='?op=br&adhe_id=".$row['adhe_id']."'><img src='libs/img/eliminar1.jpg' ></a><center></td>";}
			  
		     echo "</tr>";	

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
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}

function VerMes(){
	
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	//echo $fch[1];
	//if ($fch[0]>15){$prueba=$fch[1]+1;}else{$prueba=$fch[1];}
	//echo $prueba;
	switch ($fch[1]) {
				case '01':$mesl='ENERO';break;
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
    return $mes;
	
}

function TraerLocal ($local){

	$rows = Usuario::getUsuario(10,$local);
	foreach ($rows as $row) {
	$local=$row['local_descrip'];
	}
    return($local);
}
function TraerNick ($nick){
	$ver='';
	$rows = Usuario::getUsuario(3,$nick);
	foreach ($rows as $row) {

	$ver=$row['usu_nick'];
	}
    return($ver);
}
function TraerAsesor ($asesor){

	$rows = Usuario::getUsuario(3,$asesor);
	foreach ($rows as $row) {
	$asesor=$row['usu_apellido']." ".$row['usu_nombre'];
	}
    return($asesor);
}
?>