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
   

</script>
<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/sueldo.class.php";
include "libs/class/Produccion.class.php";

$perfil=VerPerfil();
if ($perfil=='ASESOR'){print '<script language="JavaScript">'; 
	print 'alert("NO ESTA HABILITADO PARA LA OPCION SOLICITADA");'; 
	print'</script>';
	print'<script type="text/javascript">
window.location="asesores.php";
</script>';}
else{


$semana=0; $mes = null; $asesor= ""; $val=''; $venta=null; 
$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$anio=$fch[2];
$mes=VerMes();

if (isset($_REQUEST['btn_consulta'])){
$semana=$_REQUEST['semana'];
$anio=$_REQUEST['anio'];
$mes=$_REQUEST['mes'];

	}

else{

	if (isset($_REQUEST['btn_limpiar'])){
		$semana=0;  $asesor= ""; $val=''; $venta=null;
		print'<script type="text/javascript">
window.location="abm-ventaasesor.php";
</script>';	
	}
}
}
//  $asesor= ""; $val=''; $venta=null;
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Informe-Ventas Asesores</title>
	
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
		<a href="asesores.php" class="nl"><h1>INFORME VENTAS LIQUIDACION SEMANAL</h1></a>
		<form action="" id="formulario" action="" onSubmit="enviarDatos(); return false">
		<p style="font-size:0.8em;"><b>MES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AÑO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SEMANA</b><br> 
		
		
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
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="semana" id="semana" >
				<option value= "<?php echo $semana; ?>" selected="selected"><?php echo $semana; ?></option>
				<option value=0>TODAS</option>
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
			</select>	
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
					
		</p>
		<p><input type="submit" name="btn_consulta" value="Consultar">&nbsp;<input type="submit" name="btn_Limpiar" value="Limpiar">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'"></p>


		<h2>EQUIPO DE VENTA</h2> <?php  if (isset($_REQUEST['btn_consulta'])){ if ($_REQUEST['semana']==0){$tex='TODAS';}else{$tex=$_REQUEST['semana'];} echo "<span style='text-decoration:blink;'> SEMANA ".$tex."</span>";}
?></h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%"></th>
				<th widt="5%" bgcolor=#F4D03F>SEMANA 1</th>
				<th widt="5%" bgcolor=#F4D03F>SEMANA 2</th>
				<th widt="5%" bgcolor=#F4D03F>SEMANA 3</th>
				<th widt="5%" bgcolor=#F4D03F>SEMANA 4</th>
				<th widt="5%" bgcolor=#85C1E9>A LIQUIDAR $</th>
				
				
			</thead>
			<thead>
				<th widt="70%" bgcolor=#F4D03F>SAN SALVADOR DE JUJUY</th>
				
			</thead>
			<tbody>
				<?php $val='JUJUY';VerAsesor2($val); ?>
			</tbody>
			<thead>
				<th widt="70%" bgcolor=#F4D03F>PALPALA</th>
				
			</thead>
			<tbody>
				<?php $val='PALPALA';VerAsesor2($val); ?>
			</tbody>
			<thead>
				<th widt="70%" bgcolor=#F4D03F>PERICO</th>
				
			</thead>
			<tbody>
				<?php $val='PERICO';VerAsesor2($val); ?>
			</tbody>
			<thead>
				<th widt="70%" bgcolor=#F4D03F>SAN PEDRO</th>
				
			</thead>
			<tbody>
				<?php $val='SAN PEDRO';VerAsesor2($val); ?>
			</tbody>
			<thead>
				<th widt="70%" bgcolor=#F4D03F>LIQUIDACION MENSUAL</th>
				<th widt="70%" bgcolor=#F4D03F></th>
				<th widt="70%" bgcolor=#F4D03F></th>
				<th widt="70%" bgcolor=#F4D03F></th>
				<th widt="70%" bgcolor=#F4D03F></th>
				<th widt="70%" bgcolor=#85C1E9><?php //echo '$ '.VerTotal();?></th>
				
			</thead>
		</table>
		<p><font size=2 color="red"><b>
					* Asesor nuevo</font></b>
 </p>
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

function VerTotal(){
	$fin=0;
	$c1=0;
	$c2=0;
	$perfil='ASESOR';
	$estado='CARGADO';
	$rowc = Sueldo::getSueldo(1,$perfil);
	foreach ($rowc as $rowcc) {
		$por_sem=$rowcc['sld_basico']/4;
	}
	if (isset($_REQUEST['btn_consulta'])){
		$sem=1;
		$perfil='ASESOR';
		$ssem=$_REQUEST['semana'];
		$smes=$_REQUEST['mes'];
		$sanio=$_REQUEST['anio'];
		$estado	='CARGADO';

		$usu=$_SESSION["usu_ide"];

		$rows = Usuario::getUsuario(3,$usu);
		foreach ($rows as $row) {
			$cod=$row['usu_ide'];
			$per=$row['usu_perfil'];
		}
    	switch ($cod) {
    		case 23:$grupo='RODRIGO';break;
    		case 24:$grupo='SANDRA';break;
    		default:break;
    	}
    	if ($per=='VENTAS'){$rows = Usuario::getUsuario(15,$grupo);}
    	else{$rows = Usuario::getUsuario(7,0);}
		
		foreach ($rows as $row) {
			if ($ssem==0){$rows = Produccion::getProduccion3(2,$asesor,$smes,$sanio, $estado, 0);
				$con=$rows->rowCount();
				switch(true) {
					case ($con>= 5) && ($con < 10): $suma=$por_sem*1; break;
					case ($con>= 10) && ($con < 15): $suma=$por_sem*2; break;
					case ($con>= 15) && ($con < 20): $suma=$por_sem*3; break;
					case ($con>= 20) && ($con < 25): $suma=$por_sem*4; break;
					case ($con>= 25) && ($con < 30): $suma=8000; break;
					default:break;
				}

			}	
			//else{}	

		}	

	}
 return $fin;
}


function VerAsesor2($val){
	$buscar=0;
	if (isset($_REQUEST['btn_consulta'])){

	$ssem=$_REQUEST['semana'];
	$smes=$_REQUEST['mes'];
	$sanio=$_REQUEST['anio'];
	
	$usu=$_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3,$usu);
	foreach ($rows as $row) {
		$cod=$row['usu_ide'];
		$per=$row['usu_perfil'];
	}
    switch ($cod) {
    	case 23:$grupo='RODRIGO';break;
    	case 24:$grupo='SANDRA';break;
    	default:break;
    }
    if ($per=='VENTAS'){$rows = Usuario::getUsuario2(0,$val,$grupo);}
    else{$rows = Usuario::getUsuario(8,$val);}
	
	foreach ($rows as $row) {
		$venta1=null;
		$venta2=null;
		$venta3=null;
		$venta4=null;
		$cont=0;
		$cont1=0;
		$ban1=0;
		$ban2=0;
		$ban3=0;
		$gral=0;
		$ban4=0;	
		$b1=0;$b2=0;$b3=0;$b4=0;
		$nom=null;
		$perfil='ASESOR';
		//$ban=0;
		
		$rowc = Sueldo::getSueldo(1,$perfil);
		foreach ($rowc as $rowcc) {
				$bas=$rowcc['sld_basico'];
				$cont1=($rowcc['sld_basico']/4);
		}

		$cod=$row['usu_ide'];
		$fecha=$row['usu_alta'];
		/*if (($row['usu_ide']>=30)and($row['usu_ide']<=33)){$nom=$row['usu_apellido'].' '.$row['usu_nombre'].' *';echo"<tr> <td><b>".$nom."</b></td>";}*/
			//else{
		$nom=$row['usu_apellido'].' '.$row['usu_nombre'];
		if ($row['usu_alta']>='2019-03-15'){$nom=$nom.'*';
			/*if ($ssem==0){*/
		 		if ($row['usu_sem1']==1){$venta1=$cont1;$b1=1;}
		 		if ($row['usu_sem2']==1){$venta2=$cont1;$b2=1;}
		 		if ($row['usu_sem3']==1){$venta3=$cont1;$b3=1;}
		 		if ($row['usu_sem4']==1){$venta4=$cont1;$b4=1;}
		 //	}	
		 	/*else{
		 		switch ($ssem) {
					case 1:if ($row['usu_sem1']==1){$venta1=$cont1;}break;
					case 2:if ($row['usu_sem2']==1){$venta2=$cont1;}break;
					case 3:if ($row['usu_sem3']==1){$venta3=$cont1;}break;
					case 4:if ($row['usu_sem4']==1){$venta4=$cont1;}break;
					default:break;
				}
		 	}*/
		}

		
		echo"<tr> <td>".$nom."</td>";//}
		

		//echo"<tr> <td>".$nom."</td>";
		$est='CARGADO';
		$rowa = Produccion::getProduccion2(5,$cod,$smes,$sanio,$est);
		foreach ($rowa as $rowp) {
			$gral=$gral+1;
			/*$buscar=BuscarMaestro($rowp['prod_dniafi']);
			if ($buscar==1){*/

			switch ($rowp['prod_semana']) {
				case 1:$venta1=$venta1+1; if ($rowp['prod_semana']==$ssem) {$ban1=1;} break;
				case 2:$venta2=$venta2+1; if ($rowp['prod_semana']==$ssem) {$ban2=1;} break;
				case 3:$venta3=$venta3+1; if ($rowp['prod_semana']==$ssem) {$ban3=1;} break;
				case 4:$venta4=$venta4+1; if ($rowp['prod_semana']==$ssem) {$ban4=1;} break;
			default:break;}
		}
		if ($ssem==0){
			if ($venta1>=5){$cont=$cont+$cont1;
				echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta1."</b></td>";}
			else{echo "<td style='text-align:center;'>".$venta1."</td>";}
			if ($venta2>=5){$cont=$cont+$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta2."</b></td>";}
			else{echo "<td style='text-align:center;'>".$venta2."</td>";}
			if ($venta3>=5){$cont=$cont+$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta3."</b></td>";}
			else{echo "<td style='text-align:center;'>".$venta3."</td>";}
			if ($venta4>=5){$cont=$cont+$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta4."</b></td>";}
			else{echo "<td style='text-align:center;'>".$venta4."</td>";}		
			
			//if ($gral>=20){$cont=round($bas);}		
				if (($gral>=20)and ($gral<25)){$cont=round($bas);}	
				else{if (($gral>=25)and ($gral<30)){$cont=8000;}
					else{if ($gral>=30){$cont=1000;}}
			}	

		}	
		else{



			if ($venta1>=5){//$cont=$cont1;
				if (($ban1==1)or(($b1==1)and($ssem==1))){$cont=$cont1; echo "<td style='text-align:center;' bgcolor=#EC7063 ><font color='blue'><b>".$venta1."</b></font></td>";}	
				//echo "<td style='text-align:center;' ><b>".$venta1."</b></td>";
				else{echo "<td style='text-align:center;'>".$venta1."</td>";}	
				}
			else{ if ($ssem==1){echo "<td style='text-align:center;' bgcolor=#EC7063 ><b>".$venta1."</b></td>";}

				else	{echo "<td style='text-align:center;' >".$venta1."</td>";}
			}
			if ($venta2>=5){//$cont=$cont1;//$cont=$cont+$cont1
				if (($ban2==1)or(($b2==1)and($ssem==2))){$cont=$cont1; echo "<td style='text-align:center;'bgcolor=#EC7063 ><font color='blue'><b>".$venta2."</b></font></td>";}	
				else{echo "<td style='text-align:center;' ><b>".$venta2."</b></td>";}
			}
			else{if ($ssem==2) {echo "<td style='text-align:center;'bgcolor=#EC7063 ><b>".$venta2."</b></td>";}
				else{echo "<td style='text-align:center;'>".$venta2."</td>";}
				}
			if ($venta3>=5){//$cont=$cont1;//$cont=$cont+$cont1
				if (($ban3==1)or(($b3==1)and($ssem==3))){$cont=$cont1; echo "<td style='text-align:center;'bgcolor=#EC7063 ><font color='blue'><b>".$venta3."</b></font></td>";}	
				else{echo "<td style='text-align:center;' ><b>".$venta3."</b></td>";}
			}
			else{if ($ssem==3) {echo "<td style='text-align:center;'bgcolor=#EC7063 ><b>".$venta3."</b></td>";}
				else{echo "<td style='text-align:center;'>".$venta3."</td>";}
				}	
			
			if ($venta4>=5){//$cont=$cont1;//$cont=$cont+$cont1;
				if (($ban4==1)or(($b4==1)and($ssem==4))){$cont=$cont1;echo "<td style='text-align:center;'bgcolor=#EC7063 ><font color='blue'><b>".$venta4."</b></font></td>";}	
				else{echo "<td style='text-align:center;' ><b>".$venta4."</b></td>";}
			}
			else{if ($ssem==4){echo "<td style='text-align:center;' bgcolor=#EC7063 >".$venta4."</td>";}
				else{echo "<td style='text-align:center;'>".$venta4."</td>";}}	
		}
		/*if ($ban1==1){
			if ($venta1>=5){$cont=$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta1."</b></td>";}
			else{echo "<td style='text-align:center;' bgcolor=#EC7063>".$venta1."</td>";}
			echo "<td style='text-align:center;'>".$venta2."</td>";
			echo "<td style='text-align:center;' >".$venta3."</td>";
			echo "<td style='text-align:center;' >".$venta4."</td>";}
		else if ($ban2==1) {echo "<td style='text-align:center;' >".$venta1."</td>"; if ($venta2>=5)
			      { $cont=$cont1; echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta2."</b></td>";}
			     else{echo "<td style='text-align:center;' bgcolor=#EC7063>".$venta2."</td>";}
			     echo "<td style='text-align:center;'>".$venta3."</td>";
			     echo "<td style='text-align:center;' >".$venta4."</td>";}
		else if ($ban3==1)	{echo "<td style='text-align:center;' >".$venta1."</td>";
			   	echo "<td style='text-align:center;'>".$venta2."</td>";
			    if ($venta3>=5){ $cont=$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta3."</b></td>";}
				else{echo "<td style='text-align:center;' bgcolor=#EC7063>".$venta3."</td>";}
			    echo "<td style='text-align:center;' >".$venta4."</td>";}
		else if ($ban4==1){echo "<td style='text-align:center;' >".$venta1."</td>";
			echo "<td style='text-align:center;'>".$venta2."</td>";
			echo "<td style='text-align:center;' >".$venta3."</td>";
			if ($venta4>=5){$cont=$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta4."</b></td>";}
			else {echo "<td style='text-align:center;' bgcolor=#EC7063>".$venta4."	</td>";}
		}
		else{ 
				
			/*if ($venta1>=5){$cont=$cont+$cont1;
				echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta1."</b></td>";}
			else{echo "<td style='text-align:center;'>".$venta1."</td>";}
			if ($venta2>=5){$cont=$cont+$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta2."</b></td>";}
			else{echo "<td style='text-align:center;'>".$venta2."</td>";}
			if ($venta3>=5){$cont=$cont+$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta3."</b></td>";}
			else{echo "<td style='text-align:center;'>".$venta3."</td>";}
			if ($venta4>=5){$cont=$cont+$cont1;echo "<td style='text-align:center;' bgcolor=#85C1E9><b>".$venta4."</b></td>";}
			else{echo "<td style='text-align:center;'>".$venta4."</td>";}*/
			//aqui}
				/*if (($row['usu_ide']>=30)and($row['usu_ide']<=33)){$cont=$cont+2000; echo "<td style='text-align:center;'><b>".$cont."</b></td> </tr>";}
				else{*/
				
		echo "<td style='text-align:center;'>".$cont."</td> </tr>";	///}
		
			
		
	}
  }

}
function BuscarMaestro($dni){
$buscar=0;
	$rows = Maestro::getMaestro(8,$dni);
	foreach ($rows as $row) {
		$buscar=1;
	}
return $buscar;
}
function VerMes(){
	
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	//echo $fch[1];
	//if ($fch[0]>15){$prueba=$fch[1]+1;}else{$prueba=$fch[1];}
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
function VerPerfil(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_perfil']);
	}
    
}
?>