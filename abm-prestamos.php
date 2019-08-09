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
    ficha = form.ficha.value
    if (ficha==0){
      alert("Tiene que introducir un N° de Ficha.");
      form.ficha.focus();
      return false;
    }  


	//valido Legajo
    if (form.legajo.value==0){
       alert("Tiene que introducir un N° de Legajo.");
       form.legajo.focus();
       return false;
    }

//valido Antiguedad
    num1 = form.NroAbonadoEnc.value
    if (num1==0){
      alert("Tiene que introducir Antiguedad");
      form.antiguedad.focus();
      return false;
    }  

//valido nro de FECHA SOLICITUD
    fecha = form.fechasol.value
    if (fecha==""){
      alert("Tiene que completar el campo Fecha Solicitud.");
      form.fechasol.focus();
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
    num = form.prestamo.value
    if (num==0){
      alert("Tiene que completar el campo PRESTAMO.");
      form.prestamo.focus();
      return false;
    }  


	//valido cuotas
    if (form.cuotas.value==0){
       alert("Tiene que seleccionar las CUOTAS");
       form.cuotas.focus();
       return false;
    }

    //valido NETO
    if (form.neto.value==0){
       alert("Tiene que introducir Sueldo Neto");
       form.neto.focus();
       return false;
    }

    
}

</script>

<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/prestamo.class.php";
include "libs/class/cuo_prestamo.class.php"; 

$dni=0; $zona = null; $nombre = ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
$prestamo=0;$cuotas=0;$neto=0;$val_cuota=0;$ptm_id=0;


$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
if (isset($_REQUEST['btn_bus'])){
	$ficha=$_REQUEST['ficha'];
	
	$rows = Maestro::getMaestro(7,$ficha);
	if($rows->rowCount()!=0){
	 foreach ($rows as $row) {
	if ($row['GRUPO']==6) {

			$nombre=$row['APELLIDOS']." ".$row['NOMBRES'];
			$dni=$row['NRO_DOC'];
			switch ($row['SUCURSAL']) {
				case 'W':$zona='CASA CENTRAL';break;
				case 'L':$zona='PALPALA';break;
				case 'P':$zona='SAN PEDRO';break;
				case 'R':$zona='PERICO';break;
            	default:break;
        	}
        }
       else{
        	print '<script language="JavaScript">'; 
		print 'alert("EL AFILIADO NO PERTENECE AL GRUPO DE POLICIA");'; 
		print'</script>';
		print'<script type="text/javascript">
			window.location="abm-prestamos.php";
			</script>';	
        }
	  }
	}
	else{
		print '<script language="JavaScript">'; 
		print 'alert("EL AFILIADO NO EXISTE");'; 
		print'</script>';
		print'<script type="text/javascript">
			window.location="abm-prestamos.php";
			</script>';
	}
}	

if (isset($_REQUEST['btn_guardar'])){
	//$fecha=$_REQUEST['fecha'];
	//echo 'RO'.$fecha;
	//$fch = explode("/",$fecha); 
	//$fecha = $fch[2]."-".$fch[1]."-".$fch[0];

	echo"<script> return valida_envia(this);
	</script>";

	$rows = Cuo_prestamo::getCuo_prestamo(0,$_REQUEST['prestamo'],$_REQUEST['cuotas']);
	
		foreach ($rows as $row) {
	
		 $valcuota=$row['cuoptm_cuota'];
	    }  

	if ($_REQUEST['ptm_id'] == 0){ //Nuevo

		$estado='PENDIENTE';
		$rows = Prestamo::insertPrestamo($fecha,$_REQUEST['ficha'],$_SESSION["usu_ide"],$_REQUEST['legajo'],$_REQUEST['antiguedad'],$_REQUEST['fechasol'],$_REQUEST['renovacion'],$_REQUEST['prestamo'],$_REQUEST['cuotas'],$_REQUEST['neto'],$estado,$valcuota);
		
		$dni=0; $zona = null; $nombre = ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
		$prestamo=0;$cuotas=0;$neto=0; $ptm_id=0;
	}
	else{ //Modificacion 
		$rows = Prestamo::updatePrestamo($_REQUEST['ptm_id'], $_REQUEST['legajo'],$_REQUEST['neto'],$_REQUEST['antiguedad'],$_REQUEST['fechasol'],$_REQUEST['renovacion'],$_REQUEST['cuotas'],$_REQUEST['prestamo'], $valcuota);
		$dni=0; $zona = null; $nombre = ""; $antiguedad=0; $legajo=0; $operador=0; $codigo=0; $ficha=0;$fechasol=null;$renovacion=null;$fecha=null;
		$prestamo=0;$cuotas=0;$neto=0; $ptm_id=0;$val_cuota=0;
	}
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
				$ptm_id=$row['ptm_id'];
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





?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>ABM-Préstamos</title>
	
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
		<a href="prestamos_abm.php" class="nl"><h1>Carga Préstamo</h1></a>
		<form action="" id="formulario"  onSubmit="">
			<input type="hidden" name="ptm_id" value="<?php echo $ptm_id; ?>">
			<p style="font-size:0.8em;"><b>Operador&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Codigo &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha </b><br> <input type="text" name="operador" value="<?php echo VerUsuario();?>" size="23x" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="codigo" value="<?php echo $_SESSION["usu_ide"]; ?>" disabled size="5x" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="fecha" value="<?php echo $fecha; ?>" disabled size="8px" >
			
			</p>
			<p style="font-size:0.8em;">Ficha: 
			<input type="text" name="ficha"  value="<?php echo $ficha; ?>" onkeyUp="return ValNumero(this);" size="5px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="submit" name="btn_bus" value="Buscar">
			</p>
			<p style="font-size:0.8em;">Apellido y Nombre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Zona	<br>	
			<input type="text" name="nombre" value="<?php echo $nombre; ?>" size="50px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="dni" value="<?php echo $dni; ?>" size="10px" disabled>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="zona" value="<?php echo $zona; ?>" size="15px" disabled>
			
			</p>
			<p style="font-size:0.8em;">Legajo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Antiguedad&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Fecha de Solicitud&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Renovacion<br>
			<input type="text" name="legajo" value="<?php echo $legajo; ?>"  onkeyUp="return ValNumero(this);" size="5px" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="antiguedad" value="<?php echo $antiguedad; ?>"  onkeyUp="return ValNumero(this);" size="5px" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="date" name="fechasol" value="<?php echo $fechasol; ?>" size="5px" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="renovacion" id="renovacion" >
				<option value= "<?php echo $renovacion; ?>" selected="selected"><?php echo $renovacion; ?></option>
				<option value="SI">SI</option>
				<option value="NO">NO</option>
			</select>	</p>
			
			<p style="font-size:0.8em;">Préstamo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cuotas&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Neto A Cobrar<br> 
			<select name="prestamo" id="prestamo" >
				<option value= "<?php echo $prestamo; ?>" selected="selected"><?php echo $prestamo; ?></option>
				<option value=1000>1000</option>
				<option value=1500>1500</option>
				<option value=2000>2000</option>
				<option value=2500>2500</option>
				<option value=3000>3000</option>
				<option value=4000>4000</option>
				<option value=5000>5000</option>
				<option value=6000>6000</option>
				<option value=8000>8000</option>
				<option value=10000>10000</option>
				<option value=12000>12000</option>
				<option value=15000>15000</option>
			</select>	

			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="cuotas" id="cuotas" >
				<option value= "<?php echo $cuotas; ?>" selected="selected"><?php echo $cuotas; ?></option>
				<option value=3>3</option>
				<option value=6>6</option>
				<option value=10>10</option>
				<option value=12>12</option>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="neto" value="<?php echo $neto; ?>" size="8px" ></p>

			<p><input type="submit" name="btn_guardar" value="Guardar">&nbsp;<input type="submit" name="btn_Limpiar" value="Limpiar">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'prestamos_abm.php'"></p>
		</form>
		<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="5%">Fecha</th>
				<th widt="5%">Ficha</th>
				<th widt="10%">Nombre</th>
				<th widt="15%">DNI</th>
				<th widt="10%">Legajo</th>
				<th widt="15%">Ant</th>
				<th widt="15%">F.Sol</th>
				<th widt="5%">Zona</th>
				<th widt="10%">Renov</th>
				<th widt="5%">Préstamo</th>
				<th widt="5%">Cuotas</th>
				<th widt="5%">Val.Cuota</th>
				<!--<th widt="8%">Total</th>-->
				<th widt="8%">Neto a Cobrar</th>
				<th widt="5%">Edit</th>
				<th widt="5%">Borrar</th>
				<th widt="5%">Imp</th>
			</thead>
			<tbody>
				<?php VerPrestamos(); ?>
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
	$cuo=0;

	$rows = Prestamo::getPrestamo(1,0,$operador);
	
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
		
		echo "<tr>
			  <td>".$cont."</td>	
			  <td>".$row['ptm_fechacarga']."</td>
			  <td>".$row['ptm_ficha']."</td>
			  <td>".$nombre."</td>
			  <td>".$dni."</td>
			  <td>".$row['ptm_legajo']."</td>
			  <td>".$row['ptm_ant']."</td>
			  <td>".$row['ptm_fechasol']."</td>
			  <td>".$zona."</td>
			  <td>".$row['ptm_renov']."</td>
			  <td>".$row['ptm_prestamo']."</td>
			  <td>".$row['ptm_cuotas']."</td>
			  <td>".'$'.$row['ptm_valcuota']."</td>
			 
			  <td>".'$'.$row['ptm_neto']."</td>
		      <td><center><a href='?op=md&ptm_id=".$row['ptm_id']."'><img src='libs/img/campa.jpg' ></a><center></td>
		      <td><center><a href='?op=br&ptm_id=".$row['ptm_id']."'><img src='libs/img/eliminar1.jpg' ></a><center></td>
		      <td><center><a href='imp-caratula.php?ptm_id=".$row['ptm_id']."'><img src='libs/img/imp2.jpg' ></a><center></td>
		      
		     </tr>";
	    }
	}
else
	echo 'CONSULTA VACIA';	
}


function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
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