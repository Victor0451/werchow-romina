<?php 

require 'libs/class/database.php';
$objData = new Database();


$sth= $objData->prepare("SELECT * FROM maestro WHERE GRUPO=1000");

$sth->execute();

$result= $sth->fetchAll();	

/*$ver = $sth->rowCount();

if ($ver==0) echo 'no tiene nada';

else echo 'tiene resgistro';*/

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Informes - CONSULTA ALTAS ASESORES</title>

	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<script src="libs/js/jquery-1.7.2.js"> </script>
	<script language="JavaScript" src="libs/calendario/javascripts.js"></script>	
		<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>
</head>
<body>
	<!--<form name="formInforme" >-->
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>

	<div id="menu-wrapper">
		<div id="menu"><?php include "menu.php"; include ("calendario/calendario.php");?></div>
	</div>
	<div id="contenido">

	<input type="hidden" name="empleado" value="<?php //echo $_GET['empleado']; ?>">
	<input type="hidden" name="anio" value="<?php //echo $_GET['anio']; ?>"
		
		<a href="informes.php" class="nl"><h1>CONSULTA VENTAS ASESORES</h1></a>
<!--<table width="100%" border="0">
  <tr>
      <td width="10%">Periodo de: <?php// escribe_formulario_fecha_vacio("desde","formInforme");?></td>
      <td width="35%">Hasta: <?php //escribe_formulario_fecha_vacio("hasta","formInforme");?>&nbsp;&nbsp;&nbsp;&nbsp;Asesor:<?php //escribe_formulario_fecha_vacio("hasta","formInforme");?> </td>
  </tr>
</table>-->
<p>
</p>
<table width="100%" border=3 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<!--<th widt="20%">Cod.</th>-->
				<th widt="10%">Legajo</th>
				<th widt="15%">Dni</th>
				<th widt="20%">Apellidos</th>
				<th widt="5%">Nombres</th>
				<th widt="20%">Alta</th>
				<th widt="10%">Cuota</th>
				<th widt="10%">Telefono</th>
				<th widt="10%">Celular</th>
				<th widt="10%">Forma Pago</th>
				<th widt="10%">Asesor</th>
				<th widt="10%">201708</th>
				<th widt="10%">201709</th>
				<th widt="10%">201710</th>
				<th widt="10%">201711</th>
				<th widt="10%">TOTAL</th>
				
			</thead>
			<tbody>
			
			<?php 
			$cont=0;
			
			foreach ($result as $key => $value){
				

			$contrato=$value['CONTRATO'];
			$productor=$value['PRODUCTOR'];
			
			$cuota=0;	
			$cont=$cont+1;

			$sth= $objData->prepare("SELECT * FROM cuo_fija WHERE CONTRATO='$contrato'");

				$sth->execute();

				$result2= $sth->fetchAll();	
			    
			  			    
			    
				
				$ver = $sth->rowCount();

				if ($ver==0) $cuota=0;

				else $cuota=$result2[0]['IMPORTE'];//VER VACIOOOO

			/*$sth= $objData->prepare("SELECT * FROM producto WHERE CODIGO='$productor'");

				$sth->execute();

				$result3= $sth->fetchAll();	
			    
			  	   
			    $prod=$result3[0]['DESCRIP'];//VER VACIOOOOO			*/

			if (($value['GRUPO']==6)OR($value['GRUPO']==666))
		      		{ $pago='POLICIA';}
		     else if ((($value['GRUPO']==1000)OR($value['GRUPO']==1001)) AND(($value['ZONA']==1)OR($value['ZONA']==3)OR($value['ZONA']==5)OR($value['ZONA']==60)OR($value['ZONA']==99))){ $pago='OFICINA';}
		   
		          else
		          	if ((($value['GRUPO']==1000)OR($value['GRUPO']==1001))AND(($value['ZONA']!=1)OR($value['ZONA']!=3)OR($value['ZONA']!=5)OR($value['ZONA']!=60)OR($value['ZONA']!=99)))
		          			{ $pago='COBRADOR';} 
		          		else if ($value['GRUPO']>=4200) {$pago='BANCO';}
		          		else if (($value['GRUPO']>=3400)and($value['GRUPO']<=4100)){$pago='TARJETA';}
		          		else if (($value['GRUPO']>=2500)and($value['GRUPO']<3400)){$pago='CONVENIO';}
	 		 echo "<tr>
			  	
			  	<td>".$value['CONTRATO']."</td>
			  	<td>".$value['NRO_DOC']."</td>
		      	<td>".$value['APELLIDOS']."</td>
		      	<td>".$value['NOMBRES']."</td>
		      	<td>".$value['ALTA']."</td>
		      	<td>"."$ ".$cuota."</td>
		      	<td>".$value['TELEFONO']."</td>
		      	<td>".$value['MOVIL']."</td>
		      	<td>".$pago."</td>
		      	

			
		     </tr>";
		     echo"</tr>";
	 	}	
	?>
			</tbody>
		</table>
		<h1>TOTAL REGISTROS 1000: <?php //echo $cont;?></h1>
	<!--	<h1>TOTAL DESCUENTOS: <?php
		//list($contador, $contarimp) = VerDes2();
		//echo $contador;
		//echo"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font color=red>Total Imputado: ".$contarimp."</font>";
		?></h1>
-->
	
<p>
	<input name="" type="button" onClick="JavaScript: window.print();" value="Imprimir" />&nbsp;
	<input name="" type="button" onClick="JavaScript: location.href='dcto-exp4.php?concepto=<?php echo $_GET['concepto']?>&fechainf=<?php echo $_GET['fechainf']?>';" value="Exportar">
		&nbsp;
	<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'index.php'">
</p>



	</div>

	<div id="footer">
		<center>Werchow - Año 2017 - </center>
		<img src="" alt="" width="" height="">
	</div>
<!--</form>-->
</body>
</html>

