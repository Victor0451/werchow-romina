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

/*function Solo_Letra(variable){
    
        if (isNaN(variable)){
			if( variable && !(variable.search(/[a-zA-Z]$/)+1) ){
     return""; }		
            return variable;
		    }
		    return "";
    }
    function ValLetra(Control){
        Control.value=Solo_Letra(Control.value);
    }*/

</script>

<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/semana.class.php";

$semana=0; $mes = null; $asesor= ""; $val=''; $venta=null; 
$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$anio=$fch[2];
$mes=VerMes();

if (isset($_REQUEST['btn_guardar'])){
	
		//echo $_SESSION["usu_ide"];
		$rows = Semana::insertSemana($fecha,$_REQUEST['asesor'],$_REQUEST['mes'],$_REQUEST['semana'],$_REQUEST['venta'],$_SESSION["usu_ide"],$anio);
		
		$semana=0;  $asesor= ""; $val=''; $venta=null;
		print'<script type="text/javascript">
window.location="abm-ventaasesor.php";
</script>';

	}

else{

	if (isset($_REQUEST['btn_limpiar'])){
		$semana=0;  $asesor= ""; $val=''; $venta=null;
		print'<script type="text/javascript">
window.location="abm-ventaasesor.php";
</script>';
	}
}
$semana=0;  $asesor= ""; $val=''; $venta=null;
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Alta-Ventas Asesores</title>
	
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
		<a href="asesores.php" class="nl"><h1><?php echo VerMes();echo '&nbsp;&nbsp;2018';?></h1></a>
		<form action="" id="formulario" action="" onSubmit="">
		<p style="font-size:0.8em;"><b>ASESOR&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;MES&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AÑO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SEMANA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;VENTAS</b><br> 
		<select name="asesor" id="asesor"><option value=0><?php echo $asesor; ?></option><?php echo VerAsesor();?></select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
			</select>	
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		
		<input type="text" name="venta" value="<?php echo $venta; ?>" onkeyUp="return ValNumero(this);" size="3px" >
			
		</p>
		<p><input type="submit" name="btn_guardar" value="Guardar">&nbsp;<input type="submit" name="btn_Limpiar" value="Limpiar">&nbsp;<input type="button" name="btn_nuevo" value="Nuevo Asesor" onclick="location.href = 'abm-asesor.php'">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'index.php'">

		<!--	<a href="abm.php" target="_blank" onclick="window.open(this.href,this.target,'width=400,height=150,top=200,left=200,toolbar=no,location=no,status=no,menubar=no');return false;">Ejemplo</a> 
-->
		</p>


		<h2>EQUIPO DE VENTA</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%"></th>
				<th widt="5%" bgcolor=#F4D03F>SEMANA 1</th>
				<th widt="5%" bgcolor=#F4D03F>SEMANA 2</th>
				<th widt="5%" bgcolor=#F4D03F>SEMANA 3</th>
				<th widt="5%" bgcolor=#F4D03F>SEMANA 4</th>
				<th widt="5%" bgcolor=#85C1E9>PROMEDIO</th>
				<th widt="8%" bgcolor=#52BE80>TOTAL</th>
				
			</thead>
			<thead>
				<th widt="70%" bgcolor=#F4D03F>SAN SALVADOR DE JUJUY</th>
				
			</thead>
			<tbody>
				<?php $val='JUJUY';VerAsesor2($val); ?>
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
				<th widt="70%" bgcolor=#F4D03F>TOTALES</th>
				<th widt="70%" bgcolor=#F4D03F><?php $sem=1;$totsem1= VerSem($sem); echo $totsem1;?></th>
				<th widt="70%" bgcolor=#F4D03F><?php $sem=2;$totsem1= VerSem($sem); echo $totsem1;?></th>
				<th widt="70%" bgcolor=#F4D03F><?php $sem=3;$totsem1= VerSem($sem); echo $totsem1;?></th>
				<th widt="70%" bgcolor=#F4D03F><?php $sem=4;$totsem1= VerSem($sem); echo $totsem1;?></th>
				<th widt="70%" bgcolor=#52BE80>TOTAL</th>
				<th widt="70%" bgcolor=#52BE80><?php $total= VerSem1(); echo $total;?></th>
			</thead>
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

function VerSem($sem){
	$c1=0;
	//echo 'ro'.$sem;
	$rows = Semana::getSemana(2,$sem);
	//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
	foreach ($rows as $row) {
		//echo $row['semase_ventas'];
		if ($row['semase_asesor'] > 0) {
		$c1=$c1 + $row['semase_ventas'];}
	}
   // echo "<td style='text-align:center;'>".$c1."</td>";
	 return $c1;
}
function VerSem1(){
	$c1=0;
	//echo 'ro'.$sem;
	$rows = Semana::getSemana(3,0);
	//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
	foreach ($rows as $row) {
		//echo $row['semase_ventas'];
		if ($row['semase_asesor'] > 0) 
		{$c1=$c1 + $row['semase_ventas'];}
	}
   // echo "<td style='text-align:center;'>".$c1."</td>";
	 return $c1;
}
function VerAsesor(){

	$rows = Usuario::getUsuario(7,0);
	//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
	foreach ($rows as $row) {
	echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
	}
    
}

function VerAsesor2($val){
	
	$rows = Usuario::getUsuario(8,$val);
	foreach ($rows as $row) {
		$venta1=null;
		$venta2=null;
		$venta3=null;
		$venta4=null;
		$cont=0;
		//$ban=0;
		
		$cod=$row['usu_ide'];
		$rowa = Semana::getSemana(1,$cod);
		foreach ($rowa as $rowp) {
			
			switch ($rowp['semase_semana']) {
				case 1:$venta1=$rowp['semase_ventas']; break;
				case 2:$venta2=$rowp['semase_ventas']; break;
				case 3:$venta3=$rowp['semase_ventas']; break;
				case 4:$venta4=$rowp['semase_ventas']; break;
			default:break;}
       	
			//$venta=$rowp['semase_ventas'];
			$cont=$cont+$rowp['semase_ventas'];
		}	
		$prom=$cont/4;
		
		echo"<tr> <td>".$row['usu_apellido'].' '.$row['usu_nombre']."</td>";
		if ($venta1>=5){echo "<td style='text-align:center;' bgcolor=#EC7063><b>".$venta1."</b></td>";}
		else{echo "<td style='text-align:center;'>".$venta1."</td>";}
		if ($venta2>=5){echo "<td style='text-align:center;' bgcolor=#EC7063><b>".$venta2."</b></td>";}
		else{echo "<td style='text-align:center;'>".$venta2."</td>";}
		if ($venta3>=5){echo "<td style='text-align:center;' bgcolor=#EC7063><b>".$venta3."</b></td>";}
		else{echo "<td style='text-align:center;'>".$venta3."</td>";}
		if ($venta4>=5){echo "<td style='text-align:center;' bgcolor=#EC7063><b>".$venta4."</b></td>";}
		else{echo "<td style='text-align:center;'>".$venta4."</td>";}
		echo "<td style='text-align:center;'>".$prom."</td>
		<td style='text-align:center;'>".$cont."</td>
		<td><center><a href='ver-cargasesor.php?asesor=".$rowp['semase_asesor']."&mes=".$rowp['semase_mes']."&anio=".$rowp['semase_anio']."'><img src='libs/img/buscar.png' ></a><center></td>
		 
		  </tr>";	
		
	}
	
}

function VerMes(){
	
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	//echo $fch[1];
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
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}

?>