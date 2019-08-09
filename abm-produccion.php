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
include "libs/class/usuario.class.php";

$recibo=null;$nombre='';$apellido='';$fecha=null;$localidad=0;$monto=null;$plan='';$dni=null;$asesor=0;$mes=null;$anio=null;$pago=null;$prod_ide=0;
$cta_tar=0;
$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$mes=VerMes();

if (isset($_REQUEST['btn_guardar'])){
	//$fecha=$_REQUEST['fecha'];
	$estado='PENDIENTE';
	$cierre=0;
	$rendido='NO';
	
	if ($_REQUEST['prod_ide'] == 0){ //Nuevo
		$rows = Produccion::insertProduccion($fecha,$_REQUEST['fechac'],$_REQUEST['asesor'],$_REQUEST['mes'],$_REQUEST['anio'],strtoupper($_REQUEST['apellido']),strtoupper($_REQUEST['nombre']),$_REQUEST['dni'],$_REQUEST['localidad'],$_REQUEST['recibo'],$_REQUEST['monto'],$_REQUEST['plan'],$_REQUEST['pago'],$_REQUEST['cta_tar'],$estado,$cierre,$rendido,$_REQUEST['empresa']);
		
		$recibo=null;$nombre='';$apellido='';$fecha=null;$localidad='';$monto=null;$plan='';$dni=null;$asesor=null;$mes=null;$anio=null;$pago=null;$prod_ide=0;$cta_tar=0;
		print'<script type="text/javascript">window.location="abm-produccion.php";</script>';

	}
	else{ //Modificacion
			$rows = Produccion::updateProduccion($_REQUEST['prod_ide'], $_REQUEST['fechac'],$_REQUEST['mes'], $_REQUEST['anio'],$_REQUEST['asesor'],strtoupper($_REQUEST['apellido']),strtoupper($_REQUEST['nombre']),$_REQUEST['dni'],$_REQUEST['localidad'],$_REQUEST['recibo'],$_REQUEST['monto'],$_REQUEST['plan'],$_REQUEST['pago'],$_REQUEST['cta_tar'],$_REQUEST['empresa']);
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
				$rows = Produccion::getProduccion(2,$_REQUEST['prod_ide']);
				$row = $rows->fetch();
				$mes = $row['prod_mes'];
				$anio = $row['prod_anio'];
				$fechac = $row['prod_fechaafi'];
				$apellido = $row['prod_apeafi'];
				$nombre = $row['prod_nomafi'];
				$dni = $row['prod_dniafi'];
				$monto = $row['prod_monto'];
				$plan = $row['prod_plan'];
				$pago = $row['prod_pago'];
				$cta_tar = $row['prod_cta_tar'];
				$recibo = $row['prod_recibo'];
				$prod_ide=$row['prod_ide'];
				$localidad=$row['prod_local'];
				$asesor=$row['prod_asesor'];
				$empresa=$row['prod_empre'];
				
			break;
			case 'br': //borrar
				$rows = Produccion::deleteProduccion($_REQUEST['prod_ide']);
				print'<script type="text/javascript">window.location="abm-produccion.php";</script>';
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
	
	<title>Carga-Produccion</title>
	
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
		<a href="asesores.php" class="nl"><h1>CARGA PRODUCCION</h1></a>
		<form action="" id="formulario" action="" onSubmit="">
			<input type="hidden" name="prod_ide" value="<?php echo $prod_ide; ?>">
		<p style="font-size:0.8em;"><b>MES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AÑO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha Afiliacion&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ASESOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EMPRESA</b><br> 
		<select name="mes" id="mes" >
				<option value= "<?php echo $mes; ?>" selected="selected"><?php echo $mes; ?></option>
				<option value='ENERO'>ENERO</option>
				<option value='FEBRERO'>FEBRERO</option>
				<option value='MARZO'>MARZO</option>
				<option value='ABRIL'>ABRIL</option>
				<option value='MAYO'>MAYO</option>
				<option value='JUNIO'>JUNIO</option>
				<option value='JULIO'>JULIO</option>
				<option value='AGOSTO'>AGOSTO</option>
				<option value='SEPTIEMBRE'>SEPTIEMBRE</option>
				<option value='OCTUBRE'>OCTUBRE</option>
				<option value='NOVIEMBRE'>NOVIEMBRE</option>
				<option value='DICIEMBRE'>DICIEMBRE</option>
			</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="anio" value="<?php echo $anio; ?>" onkeyUp="return ValNumero(this);" size="5px" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="date" name="fechac" value="<?php echo $fechac; ?>" size="8px">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="asesor" id="asesor" ><option value="<?php echo $asesor; ?>"><?php echo TraerAsesor($asesor); ?></option><?php echo VerAsesor();?></select>	
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="empresa" id="empresa" >
				<option value= "<?php echo $empresa; ?>" selected="selected"></option>
				<option value='W'>Werchow</option>
				<option value='M'>San Valentin</option>
		</select>		
		</p>
		<p style="font-size:0.8em;">Apellido&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Localidad<br>
		<input type="text" name="apellido" value="<?php echo $apellido; ?>" size="15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="nombre" value="<?php echo $nombre; ?>" size="15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="dni" value="<?php echo $dni; ?>" onkeyUp="return ValNumero(this);" size="10px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="localidad" id="localidad"><option value="<?php echo $localidad; ?>"><?php echo TraerLocal($localidad); ?></option><?php echo VerLocalidad();?></select>
		</p>
		<p style="font-size:0.8em;">Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Monto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma de Pago&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CTA-CTE/N°TARJETA<br>
		<input type="text" name="recibo" value="<?php echo $recibo; ?>" onkeyUp="return ValNumero(this);" size="5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<input type="text" name="monto" value="<?php echo $monto; ?>"  onkeyUp="return ValNumero(this);" size="5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="plan" id="plan" >
				<option value= "<?php echo $plan; ?>" selected="selected"><?php echo $plan; ?></option>
				<option value='A'>A</option>
				<!--<option value='PROVINCIA'>PROVINCIA</option>-->
				<option value='PROVINCIAL'>PROVINCIAL</option>
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
		<input type="text" name="cta_tar" value="<?php echo $cta_tar; ?>" onkeyUp="return ValNumero(this);" size="17px">
		</p>
		<!--<p style="font-size:0.8em;"><b>Empresa:</b><input type="radio" name="empresa" value="W" checked>Werchow
  		  	<input type="radio" name="empresa" value="M">San Valentin
		</p>-->	
		<p><input type="submit" name="btn_guardar" value="Guardar">&nbsp;<input type="submit" name="btn_Limpiar" value="Limpiar">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'">

		<!--	<a href="abm.php" target="_blank" onclick="window.open(this.href,this.target,'width=400,height=150,top=200,left=200,toolbar=no,location=no,status=no,menubar=no');return false;">Ejemplo</a> 
-->
		</p>


		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%" bgcolor=#F4D03F>N°</th>
				<th widt="5%" bgcolor=#F4D03F>Fecha</th>
				<th widt="5%" bgcolor=#F4D03F>Recibo</th>
				<th widt="5%" bgcolor=#F4D03F>Afiliado Titular</th>
				<th widt="5%" bgcolor=#F4D03F>Monto</th>
				<th widt="5%" bgcolor=#F4D03F>PROV</th>
				<th widt="5%" bgcolor=#F4D03F>MUT</th>
				<th widt="5%" bgcolor=#F4D03F>NOA</th>
				<th widt="5%" bgcolor=#F4D03F>NAC</th>
				<th widt="5%" bgcolor=#F4D03F>AB</th>
				<th widt="5%" bgcolor=#F4D03F>NOV</th>
				<th widt="5%" bgcolor=#F4D03F>A</th>
				<th widt="5%" bgcolor=#F4D03F>FA</th>
				<th widt="5%" bgcolor=#E67E22>OF</th>
				<th widt="5%" bgcolor=#E67E22>COB</th>
				<th widt="5%" bgcolor=#E67E22>DEB</th>
				<th widt="5%" bgcolor=#E67E22>TARJ</th>
				<th widt="5%" bgcolor=#E67E22>POL</th>
				<th widt="5%" bgcolor=#E67E22>EST.POL</th>
				<th widt="5%" bgcolor=#E67E22>CONV</th>
				<!--<th widt="8%" bgcolor=#F4D03F>Localidad</th>-->
				<th widt="8%" bgcolor=#F4D03F>Asesor</th>
				<th widt="0%" bgcolor=#F4D03F></th>
				<th widt="0%" bgcolor=#F4D03F></th>
				
			</thead>
			<tbody>
				<?php VerProduccion(); ?>
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
		//echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
		echo "<option value='".$row['usu_ide']."'>".$row['usu_nick']."</option>";
	}

	else{
		$rows = Usuario::getUsuario(7,0);
	foreach ($rows as $row) {
	//echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
		echo "<option value='".$row['usu_ide']."'>".$row['usu_nick']."</option>";
	}	
	}
	
    
}
function VerLocalidad(){

	$rows = Usuario::getUsuario(9,0);
	foreach ($rows as $row) {
	echo "<option value='".$row['local_id']."'>".$row['local_descrip']."</option>";
	}
    
}
function VerProduccion(){
	
	$cont=0;
	$usu=$_SESSION["usu_ide"];
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];
		

	}
	if ($perfil=='ASESOR'){ $rows = Produccion::getProduccion(0,$usu); }
	else{	$rows = Produccion::getProduccion(1,0);	}
	
	foreach ($rows as $row) {
		$plan1=null;
		$plan2=null;
		$plan3=null;
		$plan4=null;
		$plan5=null;
		$plan6=null;
		$plan7=null;
		$plan8=null;
		$pago1=null;
		$pago2=null;
		$pago3=null;
		$pago4=null;
		$pago5=null;
		$pago6=null;
		$pago0=null;
		$cont=$cont+1;
		$nick=TraerNick($row['prod_asesor']);
		$local=TraerLocal($row['prod_local']);
		switch ($row['prod_plan']) {
				case 'PROVINCIA':$plan1='X';break;
				case 'PROVINCIAL':$plan8='X';break;
				case 'NOA':$plan2='X';break;
				case 'NACIONAL':$plan3='X';break;
				case 'ABARCAR':$plan4='X';break;
				case 'NOVELL':$plan5='X';break;
				case 'A':$plan6='X';break;
				case 'FAMILIA':$plan7='X';break;

				
            	default:break;
       	}

       	switch ($row['prod_pago']) {
				case 'OFICINA':$pago0='X';break;
				case 'COBRADOR':$pago1='X';break;
				case 'DEBITO':$pago2='X';break;
				case 'TARJETA':$pago3='X';break;
				case 'POLICIA':$pago4='X';break;
				case 'EST POLICIA':$pago6='X';break;
				case 'CONVENIO':$pago5='X';break;
				
            	default:break;
       	}
	echo "<tr>
			  <td style='text-align:center;'>".$cont."</td>	
			  <td>".$row['prod_fechacarga']."</td>
			  <td>".$row['prod_recibo']."</td>
			  <td>".$row['prod_apeafi'].' '.$row['prod_nomafi']."</td>
			  <td>".'$ '.$row['prod_monto']."</td>
			  <td style='text-align:center;'>".$plan1."</td>
			  <td style='text-align:center;'>".$plan8."</td>
			  <td style='text-align:center;'>".$plan2."</td>
			  <td style='text-align:center;'>".$plan3."</td>
			  <td style='text-align:center;'>".$plan4."</td>
			  <td style='text-align:center;'>".$plan5."</td>
			  <td style='text-align:center;'>".$plan6."</td>
			  <td style='text-align:center;'>".$plan7."</td>
			  <td style='text-align:center;'>".$pago0."</td>
			  <td style='text-align:center;'>".$pago1."</td>
			  <td style='text-align:center;'>".$pago2."</td>
			  <td style='text-align:center;'>".$pago3."</td>
			  <td style='text-align:center;'>".$pago4."</td>
			  <td style='text-align:center;'>".$pago6."</td>
			  <td style='text-align:center;'>".$pago5."</td>
			  <td>".$nick."</td>
			  <td><center><a href='?op=md&prod_ide=".$row['prod_ide']."'><img src='libs/img/campa.jpg'></a><center></td>
		      <td><center><a href='?op=br&prod_ide=".$row['prod_ide']."'><img src='libs/img/eliminar1.jpg' ></a><center></td>
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
				case 'ASESOR':include ('menu_vta.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				case 'ENCARGADO':include ('menu_enc.php'); break;
				default:break;
			}

}

function VerMes(){
	
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	//echo $fch[1];
	if ($fch[0]>15){$prueba=$fch[1]+1; if ($prueba>12){$prueba='01';}
	}else{$prueba=$fch[1];}
	//echo $prueba;
	switch ($prueba) {
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
	//$asesor=strtolower($row['usu_apellido']." ".$row['usu_nombre']);
	$asesor=$row['usu_nick'];
	}
    return($asesor);
}
?>