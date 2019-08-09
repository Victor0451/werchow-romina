<?php
		include "config.php";
		include "libs/class/maestro.class.php";
		include "libs/class/cuo_fija.class.php";
		include "libs/class/productor.class.php";


if (isset($_REQUEST['btn_ver'])){

//if(isset($_POST['submit'])!=0){
	
	$desde=$_REQUEST['desde'];
	$hasta=$_REQUEST['hasta'];
  
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
	<title>Informes Ventas</title>
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
		
		<div id="doctip"><h1>Consultar Ventas</h1> </div>
		<form action="" id="for_vta" action="" method="get" >	
			Periodo	Desde:  <input type="date" name="desde" value="<?php echo $desde; ?>">

		 	Hasta: <input type="date" name="hasta" value="<?php echo $hasta; ?>">	&nbsp;&nbsp;
			<input type="submit" name="btn_ver" value="Consultar">
		<br><br>
		 <table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
		  	
		<thead>			
				<th >Legajo</th>
				<th >Alta</th>
				<!--<th >Dni</th>-->
				<th >Apellidos</th>
				<th >Nombres</th>
				<!--<th >Telefono</th>-->
				<th >$Cuota</th>
				<th >CuoAdeu</th>
				<th >Deuda</th>
				<th >S/Pag</th>
				<th >FPago</th>
				<th >Zona</th>
				<th >Sucursal</th>
				<th >Productor</th>
				<th >Adh</th>
				<th >Plan</th>
				<th >SPlan</th>
				<!--<th >Recibo</th>-->

			
	    </thead>
		
		<?php Listar($desde, $hasta); ?>

	</table> 
	<p>
			
		<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_exp" value="Exportar" onClick="JavaScript: location.href='cns-liqui-exp.php?recup=<?php echo $_GET['recup'];?>&desde=<?php echo $_GET['desde'];?>&hasta=<?php echo $_GET['hasta'];?>';">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'abm.php'">
	</p>
</form>
</div>
<div id="footer">
		<center>WERCHOW - Año 2018 - </center>
</div>
</body>
</html>

<?php

function Listar($desde, $hasta){
	//consulto si las variables desde y hasta son distinto de null
	if(($desde!=null)and($hasta!=null)){
		$cont=0;
		$vacio=0;
	
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
				//sucursal
				switch ($row['SUCURSAL']) {
            		case 'R':$sucursal='PERICO';break;
            		case 'P':$sucursal='SAN PEDRO';break;
            		case 'L':$sucursal='PALPALA';break;
            		case 'W':$sucursal='JUJUY';break;
            		
            		break;
            		default:break;
            	}
				//Productor
				//ECHO 'ROMINA'.$row['PRODUCTOR'];
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
				."<td>".$row['ALTA']."</td>"
				
				."<td>".$row['APELLIDOS']."</td>"
				."<td>".$row['NOMBRES']."</td>"
				
				."<td>$ ".$IMPORTE."</td>"
				."<td>$ ".$vacio."</td>"
				."<td>".$pago."</td>"
				."<td>".$row['ZONA']."</td>"
				."<td>".$sucursal."</td>"
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


