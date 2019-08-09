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
include "libs/class/usuario.class.php";
include "libs/class/maestro.class.php";
include "libs/class/pagos.class.php";
include "libs/class/produccion.class.php"; 

$perfil=VerPerfil();
if ($perfil=='ASESOR'){	print'<script type="text/javascript">
	window.location="cns-produccion2.php";
	</script>';}
else{


$desde=null; $hasta = null; $asesor =0;$nom=null; $estado=null;$mes=null;$anio=null;

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];

$mes=VerMes();

$nom=VerUsuario($asesor);


if (isset($_REQUEST['btn_ver'])){

	$mes=$_REQUEST['mes'];
	$anio=$_REQUEST['anio'];

	}
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Liquidación Premios</title>
	
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
		<a href="asesores.php" class="nl"><h1>LIQUIDACION PREMIO MENSUAL</h1></a>
	<form action="" id="for_cns" method="get" >
			
		MES:&nbsp;
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
		&nbsp;&nbsp;&nbsp;
		AÑO:&nbsp;<input type="text" name="anio" value="<?php echo $anio; ?>" onkeyUp="return ValNumero(this);" size="5px" >


		<br><br>
		
		<input type="submit" name="btn_ver" value="Consultar">
		
		<br><br>
		</tr>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%" bgcolor=#D5DBDB>Nº</th>
				<th widt="15%" bgcolor=#D5DBDB>ASESOR</th>
				<th widt="15%" bgcolor=#85C1E9>VTAS PERIODO</th>
				<th widt="10%" bgcolor=#85C1E9>VTAS SIN PAGO 2º CUOTA</th>
				<th widt="10%" bgcolor=#ABEBC6>VTAS EFECTIVAS</th>
				<th widt="5%" bgcolor=#D5DBDB>PREMIO</th>
				<th widt="5%" bgcolor=#D5DBDB></th>
				
						
			</thead>
			<tbody>
				<?php VerVentas(); ?>
			</tbody>
	
		</table>

		<p>
			
			<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_exp" value="Exportar" onClick="JavaScript: location.href='cns-prod-exp.php?asesor=<?php echo $_GET['asesor'];?>&mes=<?php echo $_GET['mes'];?>&anio=<?php echo $_GET['anio'];?>&estado=<?php echo $_GET['estado'];?>';" disabled>&nbsp;
			
			<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'">
		</p>
		</form>
	</div>
	
	<div id="footer">
		<center>Werchow - Año 2018 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php

function VerAsesor(){

	$usu=$_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3,$usu);
		foreach ($rows as $row) {
		$perfil=$row['usu_perfil'];
		$estado=$row['usu_estado'];
		$nombre=$row['usu_apellido']." ".$row['usu_nombre'];
    }
    
   
    if (($perfil=='ASESOR')and ($estado=='ACTIVO') ){
    	
		echo "<option value='".$usu."'>".$nombre."</option>";
    }
    else{
    		echo "<option value=0>TODOS</option>";
    		$rows = Usuario::getUsuario(7,0);
			//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
		
			foreach ($rows as $row) {
			
			echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
			}
    }
}

function VerUsuario($recup){
	
	if ($recup==0){ $ve='TODOS';return $ve;}
	else{ 
		$rows = Usuario::getUsuario(3,$recup);
	
		foreach ($rows as $row) {
	
			return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
		}
    }
}
function VerUsuario2($recup){
	
	$rows = Usuario::getUsuario(3,$recup);
		foreach ($rows as $row) {
			return ($row['usu_nick']);
		}
    
}

function VerVentas(){
	
if (isset($_REQUEST['btn_ver'])){
	$cont=0;
	$mes=$_REQUEST['mes'];
	$anio=$_REQUEST['anio'];
	$estado='CARGADO';
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$mes_act=$fch[1];
	$total_efec=0;
	$total_premio=0;
	$empre='';
	
	$rows=Usuario::getUsuario(7,0);
	
	foreach ($rows as $row){
		$cont=$cont+1;
		$asesor= $row['usu_ide'];
		$ventas=0;
		$ventas_efec=0;
		$vtas_caidas=0;
		$ases=$row['usu_apellido'].' '.$row['usu_nombre'];
		$rowsP=Produccion::getProduccion2(5,$asesor,$mes,$anio,$estado);		
			if($rowsP->rowCount()!=0){	
				foreach ($rowsP as $rowP) {
					$ventas=$ventas+1;
					$grupo='';
					$plan=$rowP['prod_plan'];
					$empre=$rowP['prod_empre'];
					$afiliado=$rowP['prod_afiliado'];
					$grupo=TraerGrupo($afiliado,$empre);
					$mesp=Traermes($rowP['prod_mes']);
					
					if ($mesp==1){$anio=$anio+1;}else{$panio=$anio;}
					if ($plan!='NOVELL'){
							if ($grupo!=''){ 
								$envio=0;
						$envio=Traerpago($afiliado, $mesp, $anio, $grupo, $empre);
							if ($envio==1){$ventas_efec=$ventas_efec+1;}
							else{$vtas_caidas=$vtas_caidas+1;}
						}
						else{$vtas_caidas=$vtas_caidas+1;}
				  } 
				  else{$ventas_efec=$ventas_efec+1;}
				  $anio=$_REQUEST['anio'];					
				}
			}
			/*if ($ventas_efec==0){$premio=0;}else{if($ventas_efec<=10){$premio=500;}else{if ($ventas_efec<=15){$premio=1500}else{if($ventas_efec<=20){$premio=2500;}else{$premio=3500;}}}}*/
			/*if (($ventas_efec>0)and($ventas_efec<=10)){$premio=500;}
			else{if (($ventas_efec>0)and($ventas_efec<=15)){$premio=1500;}else{if (($ventas_efec>0)and($ventas_efec<=20)){$premio=2500;}else{$premio=3500;}}}*/

			if (($ventas_efec>=0)and($ventas_efec<=9)){$premio=0;}
			else{if (($ventas_efec>=10)and($ventas_efec<=14)){$premio=500;}else{if (($ventas_efec>=15)and($ventas_efec<=19)){$premio=1500;}else{if (($ventas_efec>=20)and($ventas_efec<=29)){$premio=2500;}else{$premio=3500;}}}}	
			$total_efec=$total_efec+$ventas_efec;
			$total_premio=$total_premio+$premio;
			
			echo "<tr>
			  		<td style='text-align:center;'>".$cont."</td>	
			  		<td  >".$ases."</td>
			  		<td style='text-align:center;' >".$ventas."</td>
			  		<td style='text-align:center;' >".$vtas_caidas."</td>
			  		<td style='text-align:center;' bgcolor=#ABEBC6><b>".$ventas_efec."</b></td>
			  		<td ><font size=4><b>$ ".$premio."</b></font></td>
			  		<td><center><a href= 'ver-ventas.php?op=md&usu_ide=".$asesor."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."')'><img src='libs/img/buscar.png' ></a><center></td>
			  		</tr>";	
					
		}		
		echo "<tr>
			  		<td style='text-align:center;'bgcolor=yellow></td>	
			  		<td bgcolor=yellow><font size=4><b>TOTALES</font></b></td>
			  		<td style='text-align:center;' bgcolor=yellow></td>
			  		<td style='text-align:center;' bgcolor=yellow></td>
			  		<td style='text-align:center;' bgcolor=yellow><font size=4><b>".$total_efec."</font></b></td>
			  		<td bgcolor=yellow><font size=4><b>$ ".$total_premio."</b></font></td>
			  		
			  		</tr>";	

	 }
}	 
		
function TraerLocal ($local){

	$rows = Usuario::getUsuario(10,$local);
	foreach ($rows as $row) {
	$local=$row['local_descrip'];
	}
    return($local);
}
function TraerGrupo ($afiliado,$empre){
$grupo='';
if($empre=='M'){
	$rows = Maestro::getMaestro(11,$afiliado);
	
		foreach ($rows as $row) {
			$grupo=$row['GRUPO'];
		}	
	
}

else{

	$rows = Maestro::getMaestro(7,$afiliado);
	foreach ($rows as $row) {
		$grupo=$row['GRUPO'];
	}
}
    return($grupo);
}

function VerMes(){
	
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	//echo $fch[1];
	//if ($fch[0]>15){$prueba=$fch[1]+1;}else{$prueba=$fch[1];}
	switch ($fch[1]) {
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
function TraerMes($mes){
	switch ($mes) {
				case 'ENERO':$mes=2;break;
				case 'FEBRERO':$mes=3;break;
				case 'MARZO':$mes=4;break;
				case 'ABRIL':$mes=5;break;
				case 'MAYO':$mes=6;break;
				case 'JUNIO':$mes=7;break;
				case 'JULIO':$mes=8;break;
				case 'AGOSTO':$mes=9;break;
				case 'SEPTIEMBRE':$mes=10;break;
				case 'OCTUBRE':$mes=11;break;
				case 'NOVIEMBRE':$mes=12;break;
				case 'DICIEMBRE':$mes=1;break;
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
 
function Traerpago($afiliado,$mes,$anio,$grupo,$empre){

	$envio=0;
	$total=0;
	

	if ($empre=='M'){if ($grupo==1000){$rows = Pagos::getPagos2(3,$afiliado,$mes,$anio);	}
		else{$rows = Pagos::getPagos2(2,$afiliado,$mes,$anio);
				$total=$rows->rowCount();
				if ($total==0){$rows = Pagos::getPagos2(3,$afiliado,$mes,$anio);$total=$rows->rowCount();}
			}
	}
	else{	
		if ($grupo==1000){$rows = Pagos::getPagos2(1,$afiliado,$mes,$anio);	$total=$rows->rowCount();}
		else{$rows = Pagos::getPagos2(0,$afiliado,$mes,$anio);
			$total=$rows->rowCount();
			if ($total==0){$rows = Pagos::getPagos2(1,$afiliado,$mes,$anio);$total=$rows->rowCount();}
		}
	}
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {
			$envio=1;
		}
	}
	
	return ($envio);
	
}
    

?>