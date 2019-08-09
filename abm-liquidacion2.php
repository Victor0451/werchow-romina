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

function valida_envia(){

//valido Accion
    if (form.accion.value==""){
       alert("Tiene que seleccionar una Acción.");
       form.accion.focus();
       return false;
    }


//valido nro de Socio
    socio = form.Socio.value
    if (socio==0){
      alert("Tiene que introducir un N° de Socio.");
      form.socio.focus();
      return false;
    }  

	//valido Nombre y Apellido
    if (form.nombre.value==""){
       alert("Tiene que completa Nombre y Apellido.");
       form.nombre.focus();
       return false;
    }

//valido Monto
    num1 = form.monto.value
    if (num1==0){
      alert("Tiene que introducir Monto de Cuota");
      form.monto.focus();
      return false;
    }  

//valido nro de FECHA SOLICITUD
    plan = form.plan.value
    if (plan==""){
      alert("Tiene que seleccionar Plan.");
      form.plan.focus();
      return false;
    }  


//valido nro de RENOVACION
    num5 = form.renovacion.value
    if (num5==""){
      alert("Tiene que completar el campo Renovación.");
      form.renovacion.focus();
      return false;
    }  


//valido nro de PRESTAMO
    num = form.fpago.value
    if (num==""){
      alert("Tiene que seleccionar Forma de Pago.");
      form.prestamo.focus();
      return false;
    }  


	//valido recibo
    if (form.recibo.value==0){
       alert("Tiene que ingresar Nº de Recibo");
       form.NºRecibo.focus();
       return false;
    }

    //valido NETO
    if (form.cuotas.value==0){
       alert("Tiene que introducir Cuotas a Pagar");
       form.cuotas.focus();
       return false;
    }

    
}

</script>

<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/liquidacion.class.php";
include "libs/class/cuo_fija.class.php"; 

$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;$fecha=null;

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

if (isset($_REQUEST['btn_guardar'])){
	$fecha=$_REQUEST['fecha'];
	//echo 'RO'.$fecha;
	//$fch = explode("/",$fecha); 
	//$fecha = $fch[2]."-".$fch[1]."-".$fch[0];

	if ($_REQUEST['liq_id'] == 0){ //Nuevo
		
		$rows = Liquidacion::insertLiquidacion($fecha,$_REQUEST['socio'],$_SESSION["usu_ide"],strtoupper($_REQUEST['nombre']),$_REQUEST['monto'],$_REQUEST['plan'],$_REQUEST['fpago'],$_REQUEST['recibo'],$_REQUEST['cuotas'],$_REQUEST['accion']);
		
		$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
	}
	else{ //Modificacion
		$rows = Liquidacion::updateLiquidacion($_REQUEST['liq_id'], $_REQUEST['socio'],strtoupper($_REQUEST['nombre']),$_REQUEST['monto'],$_REQUEST['plan'],$_REQUEST['fpago'],$_REQUEST['recibo'],$_REQUEST['cuotas'],$_REQUEST['accion']);;
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
				$rows = Liquidacion::getLiquidacion(0,$_REQUEST['liq_id'],0);
				$row = $rows->fetch();
				$socio = $row['liq_socio'];
				$nombre = $row['liq_nombre']; 
				$monto = $row['liq_monto'];
				$plan = $row['liq_plan'];
				$fpago = $row['liq_fpago'];
				$recibo = $row['liq_recibo'];
				$cuotas = $row['liq_cuotas'];
				$accion = $row['liq_accion'];
				$liq_id=$row['liq_id'];
				
				break;
			case 'br': //borrar
				$rows = Liquidacion::deleteLiquidacion($_REQUEST['liq_id']);
				break;
		}
	}
	else{
		$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
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
		<div id="menu"><?php include "menu.php"; ?></div>
	</div>	
	<div id="contenido">
		<a href="abm.php" class="nl"><h1>Carga Item de Liquidacion</h1></a>
		<form action="" id="form" action="" onSubmit=">
			<input type="hidden" name="liq_id" value="<?php echo $liq_id; ?>">
			<p style="font-size:0.8em;"><b>Recuperador&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ACCION </b><br> <input type="texto" name="recup" value="<?php echo VerUsuario();?>" size="20px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="fecha" value="<?php echo $fecha; ?>" size="8px" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="accion" id="accion" >
				<option value= "<?php echo $accion; ?>" selected="selected"><?php echo $accion; ?></option>
				<option value="AT1">AT1</option>
				<option value="AT2">AT2</option>
				<option value="RECUPERACION">RECUPERACION</option>
				<option value="REINCIDENTE">REINCIDENTE</option>
				<option value="BLANQUEO">BLANQUEO</option>
				<option value="TRAPASO VISA">TRASPASO VISA</option>
				<option value="VENTA">VENTA</option>
				<option value="PRESTAMO">PRESTAMO</option>
			</select>	
			</p>
			<p style="font-size:0.8em;">Socio: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<!--<input type="submit" name="btn_bus" value="Buscar">-->
			Apellido y Nombre<br> 
			<input type="text" name="socio"  value="<?php echo $socio; ?>" onkeyUp="return ValNumero(this);" size="5px">
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="nombre" value="<?php echo $nombre; ?>" size="57px">
			</p>
			<p style="font-size:0.8em;">Monto Cuota&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Plan&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Forma de Pago<br> $<input type="text" name="monto" value="<?php echo $monto; ?>"  onkeyUp="return ValNumero(this);" size="5px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="plan" id="plan" >
				<option value= "<?php echo $plan; ?>" selected="selected"><?php echo $plan; ?></option>
				<option value="PROVINCIA">PROVINCIA</option>
				<option value="NOA">NOA</option>
				<option value="NACIONAL">NACIONAL</option>
				<option value="ABARCAR">ABARCAR</option>
				<option value="NOVELL">NOVELL</option>
			</select>	
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="fpago" id="fpago" >
				<option value= "<?php echo $fpago; ?>" selected="selected"><?php echo $fpago; ?></option>
				<option value="PARTICULAR">PARTICULAR</option>
				<option value="DEBITO">DEBITO</option>
				<option value="TARJETA">TARJETA</option>
			</select>	
			<p style="font-size:0.8em;">Recibo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuotas a pagar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total<br> <input type="text" name="recibo" value="<?php echo $recibo; ?>" onkeyUp="return ValNumero(this);" size=8>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="cuotas" value="<?php echo $cuotas; ?>" onkeyUp="return ValNumero(this);" size=5>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="art_codigo" value="<?php echo $total; ?>" size=8 disabled></p>

			<p><input type="submit" name="btn_guardar" value="Guardar" onClick="valida_envia()">&nbsp;<input type="submit" name="btn_Limpiar" value="Limpiar">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'abm.php'"></p>
		</form>
		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="5%">Fecha</th>
				<th widt="5%">Socio</th>
				<th widt="10%">NºRecibo</th>
				<th widt="15%">Afiliado Titular</th>
				<th widt="10%">Monto</th>
				<th widt="15%">Plan</th>
				<th widt="15%">Forma Pago</th>
				<th widt="5%">Cuotas</th>
				<th widt="10%">Total</th>
				<th widt="5%">Accion</th>
				<th widt="5%">Editar</th>
				<th widt="5%">Eliminar</th>
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
			  <td>".$row['liq_socio']."</td>
			  <td>".$row['liq_recibo']."</td>
			  <td>".$row['liq_nombre']."</td>
			  <td>".'$ '.$row['liq_monto']."</td>
			  <td>".$row['liq_plan']."</td>
			  <td>".$row['liq_fpago']."</td>
			  <td>".$row['liq_cuotas']."</td>
			  <td>".'$ '.$total2."</td>
			  <td>".$row['liq_accion']."</td>
		      <td><center><a href='?op=md&liq_id=".$row['liq_id']."'><img src='libs/img/btn_editar.jpg' width='10%' height='5%'></a><center></td>
		      <td><center><a href='?op=br&liq_id=".$row['liq_id']."'><img src='libs/img/btn_eliminar.jpg' width='10%' height='5%'></a><center></td>
		     </tr>";
	    }
	}
/*else
	echo 'CONSULTA VACIA';	
}*/

function VerSocio(){
	echo 'hola';
	$socio = $_POST['socio'];
}

function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
	}
    
}
	
?>