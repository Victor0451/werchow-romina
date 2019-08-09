<?php
		include "config.php";
		include "libs/class/maestro.class.php";
		include "libs/class/cuo_fija.class.php";
		include "libs/class/productor.class.php";

if(isset($_POST['submit'])!=0){

	$desde=$_POST['desde'];
	$hasta=$_POST['hasta'];
  
	if (($desde==null) or ($hasta==null))
	{
	print '<script language="JavaScript">'; 
	print 'alert("DEBE SELECCIONAR FECHAS A CONSULTAR");'; 
	print '</script>'; 	}
}
else{
	
	$desde='';
	$hasta='';}

     $cont=0;

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Carga Liquidaciones</title>
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
		
		<div id="doctip"><h1>Cargar Liquidaciones</h1> </div>
			
		Periodo	Desde:  <input type="date" name="hasta" value="<?php echo $desde; ?>">

		 Hasta: <input type="date" name="hasta" value="<?php echo $hasta; ?>">	
		
		<br><br>
		 <table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
		  	
		<thead>			
				<th >Legajo</th>
				<th >Dni</th>
				<th >Apellidos</th>
				<th >Nombres</th>
				<th >Alta</th>
				<th >Cuota</th>
				<th >Telefono</th>
				<th >F.Pago</th>
				<th >Productor</th>
				<th >Adh</th>
				<th >Plan</th>
				<th >SPlan</th>
			
	    </thead>
		
		<?php 	Listar($desde, $hasta); ?>

	</table> 
</form>
<br>
<!--		<div id="doctip"><a  href="?opcion=1" class="nl"><h1>Consultar x Periodo</h1></a></div>
		<div id="doctip"><a  href="?opcion=2" class="nl"><h1>Consultar Ventas Abarcar</h1></a></div>
		<!--<div id="doctip"><a  href="?opcion=1" class="nl"><h1>CONSULTA</h1></a></div>-->
		
		<?php // MenuOpcion(); ?>


	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2017 - </center>
	</div>
</body>
</html>

<?php

/*function MenuOpcion(){

if (isset($_REQUEST['opcion'])){
	$desde='';
	$hasta='';
	
   switch ($_REQUEST['opcion']) {
      case 1: //Consultar x Período
      //echo 'HOLA';
        echo '<form name="nuevo" method="post" action="ventas.php?opcion='.$_REQUEST['opcion'].'">
         Periodo desde: <input type="date" name="desde" value="'.$desde.'"> Hasta: <input type="date" name="hasta" value="'.$hasta.'">';
        	
     
          
		echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="submit" value="IR"> <br> <br>'; 

       // echo'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="image" name="img" src="libs/img/tilde.png"  alt="Ir" <font color= black size=4>Ir</font></p></form>'; 

     /*   echo '<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
		  	
			
	  <thead>			
				<th >Legajo</th>
				<th >Dni</th>
				<th >Apellidos</th>
				<th >Nombres</th>
				<th >Alta</th>
				<th >Cuota</th>
				<th >Telefono</th>
				<th >F.Pago</th>
				<th >Productor</th>
				<th >Adh</th>
				<th >Plan</th>
				<th >SPlan</th>
			
	</thead>';
			//ECHO 'VER'.$_POST['desde'].'y'.$hasta;
			Listar($desde, $hasta); 

	echo '</table> </form> <br>';*/

  /*    break;  
      case 2: //CONSULTAR Empleado
      echo '<form name="nuevo" method="post" action="div-inf.php" onSubmit="return valida_envia(this);">
      
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
*/
function Listar($desde, $hasta){
	//consulto si las variables desde y hasta son distinto de null
	if(($desde!=null)and($hasta!=null)){
		$cont=0;
		//consulto maestro
		$rows=Maestro::getMaestro2(2,$desde,$hasta);
		if($rows->rowCount()!=0){
			foreach ($rows as $row) {

				$cont=$cont+1;
				//Cuota_Fija
				$rows1=Cuo_Fija::getCuo_Fija(0,$row['CONTRATO']);
				if($rows1->rowCount()!=0){
					$row1=$rows1->fetch(); $IMPORTE=$row1['IMPORTE']; 
				}
				else                     { $IMPORTE=0; }
				
				//Grupo
				switch ($row['GRUPO']) {
					case 6    : $pago = "POLICIA"; break;
					case 666  : $pago = "POLICIA"; break;
					case 1000 : 
								switch ($row["ZONA"]) {
									case 1  : $pago = "OFICINA"; break;
									case 3  : $pago = "OFICINA"; break;
									case 5  : $pago = "OFICINA"; break;
									case 60 : $pago = "OFICINA"; break;
									case 99 : $pago = "OFICINA"; break;
									default : $pago = "COBRADOR"; break;
								}
								break;
					case 1001 : 
								switch ($row["ZONA"]) {
									case 1  : $pago = "OFICINA"; break;
									case 3  : $pago = "OFICINA"; break;
									case 5  : $pago = "OFICINA"; break;
									case 60 : $pago = "OFICINA"; break;
									case 99 : $pago = "OFICINA"; break;
									default : $pago = "COBRADOR"; break;
								}
								break;
					case 8500  : $pago = "OFICINA"; break;
					
					default   : $pago = "DEBITO"; break;

				}
				//Productor
				$rows2=Productor::getProductor(0,$row['PRODUCTOR']);
				if($rows2->rowCount()!=0){
					$row2=$rows2->fetch(); $prod=$row2['DESCRIP']; 
				}
				else {
					$prod=" "; 
				}
				//Listar
				echo "<tr>"
				."<td>".$row['CONTRATO']."</td>"
				."<td>".$row['NRO_DOC']."</td>"
				."<td>".$row['APELLIDOS']."</td>"
				."<td>".$row['NOMBRES']."</td>"
				."<td>".$row['ALTA']."</td>"
				."<td>$ ".$IMPORTE."</td>"
				."<td>".$row['TELEFONO']."</td>"
				."<td>".$pago."</td>"
				."<td>".$prod."</td>"
				."<td>".$row['ADHERENTES']."</td>"
				."<td>".$row['PLAN']."</td>"
				."<td>".$row['SUB_PLAN']."</td>"
				."</tr>";
			}
		}
	}
	else{
		echo "<tr><td colspan='10'>CONSULTA VACIA</td></tr>";
	}
}

?>


