<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";  
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Informes Descuentos</title>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<script src="libs/js/jquery-1.7.2.js"></script>
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>

</head>
<script language="javascript" type="text/javascript">

    //*** Este Codigo permite Validar que sea un campo Numerico
    function Solo_Numerico(variable){
        Numer=parseInt(variable);
        if (isNaN(Numer)){
			//alert ("Por favor ingrese solo numeros");
            return "";
			//return (alert ("Por favor ingrese dni o apellido correctamente"));
			
        }
        return Numer;
    }
    function ValNumero(Control){
        Control.value=Solo_Numerico(Control.value);
    }

function valida_envia(nuevo){
    	
    //valido FECHA
    
    if (nuevo.anio.value==""){
       alert("Completar AÑO");
       nuevo.anio.focus();
       return false;
    }
   
}  
</script>
<body>
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>
	<div id="menu-wrapper">
		
		<div id="menu"><?php TraerPerfil(); ?></div>
	</div>	
	<div id="contenido">	
		
		<div id="doctip"><a  href="abm-liquidacion.php" class="nl"><h1>Cargar Liquidacion</h1></a></div>
		<div id="doctip"><a  href="cns-liquidacion.php" class="nl"><h1>Consultar Liquidacion</h1></a></div>
		<div id="doctip"><a  href="rendicion-liq.php" class="nl"><h1>Rendicion</h1></a></div>
		<!--<div id="doctip"><a  href="imp-solicitud.php" class="nl"><h1>Solicitud</h1></a></div>-->
		<div id="doctip"><a  href="?opcion=1" class="nl"><h1>Solicitud</h1></a></div>
		<div id="doctip"><a  href="rsm-liquidacion.php" class="nl"><h1>Consultar Liquidacion Mensual</h1></a></div>
		<div id="doctip"><a  href="inf-mora2.php" class="nl"><h1>Informe MORA</h1></a></div>
		<!--<div id="doctip"><a  href="inf-mora.php" class="nl"><h1>Informe MORA</h1></a></div>
		<!--<div id="doctip"><a  href="planificacion.php" class="nl"><h1>Carga Planificacion</h1></a></div>
		<div id="doctip"><a  href="cns-planif.php" class="nl"><h1>Consulta Planificacion</h1></a></div>-->
		
		
		<?php  MenuOpcion(); ?>

	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php

function MenuOpcion(){

if (isset($_REQUEST['opcion'])){
   switch ($_REQUEST['opcion']) {
      case 1: //Consultar Concepto

     /* echo '<form name="nuevo" method="get" action="div-imp.php">
      
      	<p style="font-size:0.8em; left=250px;"> Seleccionar Empleado: 
        <select name="empleado" >'; 
        VerPersonal();
        echo '</select>&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="image" name="img" src="libs/img/tilde.png"  alt="Ir" <font color= black size=4>Ir</font></p></form>';*/
      /*  echo '<form name="nuevo" method="get" action="div-concepto.php" onSubmit="return valida_envia(this);">
      
      	<p style="font-size:0.8em; left=250px;">Concepto: 
        <select name="concepto" >'; 
        VerConcepto();
        echo '</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Periodo: <select name="imputar" id="imputar" >
        <option value=0 selected="selected">   </option>
				<option value="01">Enero</option>
				<option value="02">Febrero</option>
				<option value="03">Marzo</option>
				<option value="04">Abril</option>
				<option value="05">Mayo</option>
				<option value="06">Junio</option>
				<option value="07">Julio</option>
				<option value="08">Agosto</option>
				<option value="09">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
				</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Año(ej.2000):
		<input name="anio" type="text" maxlength="4" size="3px" onkeyUp="return ValNumero(this);" >
		
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" name="img" src="libs/img/tilde.png"  alt="Ir" <font color= black size=4>Ir</font></p></form>'; */


        echo '<form name="nuevo" method="get" action="imp-solicitud.php" onSubmit="return valida_envia(this);">';
      
        echo '<b>Afiliado:</b>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="afiliado"  onkeyUp="return ValNumero(this);" size="5px" >';

      		
		
       echo' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" name="img" src="libs/img/tilde.png"  alt="Ir" <font color= black size=4>Ir</font></p></form>'; 

      break;  
      case 2: //CONSULTAR LIQUIDACION MENSUAL
      echo '<form name="nuevo" method="get" action="div-inf.php" onSubmit="return valida_envia(this);">
      
      	<p style="font-size:0.8em; left=250px;">Empleado: 
        <select name="empleado" >'; 
        VerPersonal();
        echo '</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Periodo: <select name="imputar" id="imputar" >
        <option value=0 selected="selected">   </option>
				<option value="01">Enero</option>
				<option value="02">Febrero</option>
				<option value="03">Marzo</option>
				<option value="04">Abril</option>
				<option value="05">Mayo</option>
				<option value="06">Junio</option>
				<option value="07">Julio</option>
				<option value="08">Agosto</option>
				<option value="09">Septiembre</option>
				<option value="10">Octubre</option>
				<option value="11">Noviembre</option>
				<option value="12">Diciembre</option>
				</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Año(ej.2000):
		<input name="anio" type="text" maxlength="4" size="3px" onkeyUp="return ValNumero(this);" >
		
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" name="img" src="libs/img/tilde.png"  alt="Ir" <font color= black size=4>Ir</font></p></form>'; 
      

      break;  

   }
  }
}

function VerPersonal(){
	$rows = Personal::getPersonal(1,0);
	echo "<option value= 0>TODOS</option>";
	foreach ($rows as $row) {
		echo "<option value='".$row['prs_ide']."'>".$row['prs_ape']." ".$row['prs_nom']."</option>";
	}
    
}

function VerConcepto(){
	$rows = Motivo::getMotivo(1,0);
	echo "<option value= 0>TODOS</option>";
	foreach ($rows as $row) {
		echo "<font size=1><option value='".$row['mtv_ide']."'>".strtolower($row['mtv_descrip'])."</option></font>";
		
	}
    
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
				case 'ENCARGADO':include ('menu_enc.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				case 'ENCARGADO':include ('menu_enc.php'); break;
				default:break;
			}

}

?>
