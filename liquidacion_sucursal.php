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
include "libs/class/produccion.class.php"; 

$grupo='';
$sucursal='';
$perfil=VerPerfil();
if ($perfil=='ASESOR'){	print'<script type="text/javascript">
						window.location="cns-produccion2.php";
					  </script>';}
else{
switch ($usu=$_SESSION["usu_ide"]
) {
	case 23:$grupo='RODRIGO';
		
		break;
	case 24:$grupo='SANDRA';
		
		break;
	default:break;
}
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
    //$grupo=$_REQUEST['grupo'];
    $sucursal=$_REQUEST['sucursal'];

	}
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Liquidación Produccion</title>
	
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
		<a href="asesores.php" class="nl"><h1>LIQUIDACION PRODUCCION GENERAL</h1></a>
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
		&nbsp;&nbsp;&nbsp;
		SUCURSAL    :
		<?php
			/*if ($perfil=='VENTAS'){
				echo '<select name="grupo" id="grupo" >
					<option value= "'.$grupo.'" selected="selected">'.$grupo.'</option>
					
				</select>';
			}
			else{*/
				echo '<select name="sucursal" id="sucursal" >
					<option value= "'.$sucursal.'" selected="selected">'.$sucursal.'</option>
					<option value="PALPALA">PALPALA</option>
                    <option value="PERICO">PERICO</option>
                    <option value="SAN PEDRO">SAN PEDRO</option>
				</select>';
			//}	
		?>
		
		<br><br>
		
		<input type="submit" name="btn_ver" value="Consultar">
		
		<br><br>
		</tr>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%" bgcolor=#D5DBDB>Nº</th>
				<th widt="15%" bgcolor=#D5DBDB>ASESOR</th>
				<th widt="15%" bgcolor=#85C1E9>VENTAS</th>
				<th widt="10%" bgcolor=#85C1E9>TOTAL $</th>
				<th widt="5%" bgcolor=#D5DBDB>MUT</th>
				<th widt="5%" bgcolor=#D5DBDB>PRO</th>
				<th widt="5%" bgcolor=#D5DBDB>NOA</th>
				<th widt="5%" bgcolor=#D5DBDB>NAC</th>
				<th widt="5%" bgcolor=#D5DBDB>AB</th>
				<th widt="5%" bgcolor=#D5DBDB>NOV</th>
				<th widt="5%" bgcolor=#D5DBDB>A</th>
				<th widt="5%" bgcolor=#D5DBDB>FA</th>
				<th widt="5%" bgcolor=#D5DBDB>OF</th>
				<th widt="5%" bgcolor=#D5DBDB>COB</th>
				<th widt="5%" bgcolor=#D5DBDB>DEB</th>
				<th widt="5%" bgcolor=#D5DBDB>TAR</th>
				<th widt="5%" bgcolor=#D5DBDB>POL</th>
				<th widt="5%" bgcolor=#D5DBDB>EST.POL</th>
				<th widt="5%" bgcolor=#D5DBDB>CVN</th>
								
			</thead>
			<tbody>
				<?php VerProduccion(); ?>
			</tbody>
	
		</table>

		<p>
			
			<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_exp" value="Exportar" onClick="JavaScript: location.href='cns-prod-exp.php?asesor=<?php echo $_GET['asesor'];?>&mes=<?php echo $_GET['mes'];?>&anio=<?php echo $_GET['anio'];?>&estado=<?php echo $_GET['estado'];?>';" disabled>&nbsp;
			<input type="button" name="btn_liq" value="Liquidacion Individual" onClick="JavaScript: location.href='liqu-ind-suc.php?mes=<?php echo $_GET['mes'];?>&anio=<?php echo $_GET['anio'];?>&sucursal=<?php echo $_GET['sucursal'];?>';" >&nbsp;
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

function VerProduccion(){
	$tot_gral=0;
	$tot_pesos=0;

	$tot1=0;$tot2=0;$tot3=0;$tot4=0;$tot5=0;$tot6=0;$tot7=0;$tot8=0;$tot9=0;$tot10=0;$tot11=0;$tot12=0;$tot13=0;$tot14=0;$tot15=0;
if (isset($_REQUEST['btn_ver'])){
	$cont=0;
	$mes=$_REQUEST['mes'];
	$anio=$_REQUEST['anio'];
    //$grupo=$_REQUEST['grupo'];
    $sucursal=$_REQUEST['sucursal'];
	$estado='CARGADO';

	$usu=$_SESSION["usu_ide"];

		$rows = Usuario::getUsuario(3,$usu);
		foreach ($rows as $row) {
			
			$cod=$row['usu_ide'];
			$per=$row['usu_perfil'];
			
    	}

	if ($per=='VENTAS'){$rows=Usuario::getUsuario(17,$sucursal);}
	else{$rows=Usuario::getUsuario(16,$sucursal);}
	
	
	foreach ($rows as $row){
		$asesor= $row['usu_ide'];
		$ases=$row['usu_apellido'].' '.$row['usu_nombre'];
		$ventas=0;
		$total=0;
		$tot_nac=0; $tot_prov=0;$tot_noa=0;	$tot_nov=0;	$tot_aba=0;	$tot_a=0;$tot_fa=0;$tot_mut=0;
		$tot_par=0;$tot_deb=0;$tot_tjt=0;$tot_conv=0;$tot_pol=0; $tot_cob=0;$tot_of=0;$tot_espol=0;
		$cont=$cont+1;
			$rowsP=Produccion::getProduccion2(15,$asesor,$mes,$anio,$estado);		
			if($rowsP->rowCount()!=0){	
				foreach ($rowsP as $rowP) {
					$ventas=$ventas+1;
					if ($rowP['prod_plan']!='NOVELL')
					{if ($rowP['prod_recibo']>0) {$total=$total+$rowP['prod_monto'];}}
					
					switch ($rowP['prod_plan']){
						case 'PROVINCIA':$tot_prov=$tot_prov+1;break;
						case 'PROVINCIAL':$tot_mut=$tot_mut+1;break;
            			case 'NOA':$tot_noa=$tot_noa+1;break;
            			case 'NACIONAL':$tot_nac=$tot_nac+1;break;
            			case 'ABARCAR':$tot_aba=$tot_aba+1;break;
            			case 'NOVELL':$tot_nov=$tot_nov+1;break;
            			case 'A':$tot_a=$tot_a+1;break;
            			case 'FAMILIA':$tot_fa=$tot_fa+1;break;
            			default:break;

					}
					switch ($rowP['prod_pago']) {
        				case 'OFICINA':$tot_of=$tot_of+1;break;
            			case 'COBRADOR':$tot_cob=$tot_cob+1;break;
            			case 'DEBITO':$tot_deb=$tot_deb+1;break;
            			case 'TARJETA':$tot_tjt=$tot_tjt+1;break;
            			case 'POLICIA':$tot_pol=$tot_pol+1;break;
            			case 'EST POLICIA':$tot_espol=$tot_espol+1;break;
            			case 'CONVENIO':$tot_conv=$tot_conv+1;break;
            			default:break;
        			}
				}
				
				$tot_gral=$tot_gral + $ventas;
				$tot_pesos=$tot_pesos+$total;
				$tot1=$tot1 + $tot_prov;
				$tot2=$tot2 + $tot_noa;
				$tot3=$tot3 + $tot_nac;
				$tot4=$tot4 + $tot_aba;
				$tot5=$tot5 + $tot_nov;
				$tot15=$tot15 + $tot_mut;
				$tot6=$tot6 + $tot_a;
				$tot7=$tot7 + $tot_fa;
				$tot8=$tot8 + $tot_of;
				$tot9=$tot9 + $tot_cob;
				$tot10=$tot10 + $tot_deb;
				$tot11=$tot11+ $tot_tjt;
				$tot12=$tot12 + $tot_pol;
				$tot14=$tot14 + $tot_espol;
				$tot13=$tot13 + $tot_conv;

			/*	$sandra=($tot_pesos*50)/100;
				$sandra=round($sandra,2);
				$rodrigo=($tot_pesos*10)/100;
				$rodrigo=round($rodrigo,2);*/
				/*echo "<tr>
			  		<td style='text-align:center;'>".$cont."</td>	
			  		<td  >".$ases."</td>
			  		<td style='text-align:center;' >".$ventas."</td>
			  		<td  >".'$ '.$total."</td>
			  		<td style='text-align:center;' >".$tot_prov."</td>
			  		<td style='text-align:center;' >".$tot_noa."</td>
			  		<td style='text-align:center;' >".$tot_nac."</td>
			  		<td style='text-align:center;' >".$tot_aba."</td>
			  		<td style='text-align:center;' >".$tot_nov."</td>
			  		<td style='text-align:center;' >".$tot_a."</td>
			  		<td style='text-align:center;' >".$tot_fa."</td>
			  		<td style='text-align:center;' >".$tot_of."</td>
			  		<td style='text-align:center;' >".$tot_cob."</td>
			  		<td style='text-align:center;' >".$tot_deb."</td>
			  		<td style='text-align:center;' >".$tot_tjt."</td>
			  		<td style='text-align:center;' >".$tot_pol."</td>
			  		<td style='text-align:center;' >".$tot_espol."</td>
			  		<td style='text-align:center;' >".$tot_conv."</td>
			  		
			  		</tr>";	*/

			//}		
			echo "<tr>
			  		<td style='text-align:center;'>".$cont."</td>	
			  		<td  >".$ases."</td>
			  		<td style='text-align:center;' >".$ventas."</td>
			  		<td  >".'$ '.$total."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$tot_mut."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$tot_prov."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$tot_noa."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$tot_nac."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$tot_aba."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$tot_nov."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$tot_a."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$tot_fa."</td>
			  		<td style='text-align:center;' bgcolor=#FAEBC2>".$tot_of."</td>
			  		<td style='text-align:center;' bgcolor=#FAEBC2>".$tot_cob."</td>
			  		<td style='text-align:center;' bgcolor=#FAEBC2>".$tot_deb."</td>
			  		<td style='text-align:center;' bgcolor=#FAEBC2>".$tot_tjt."</td>
			  		<td style='text-align:center;' bgcolor=#FAEBC2>".$tot_pol."</td>
			  		<td style='text-align:center;' bgcolor=#FAEBC2>".$tot_espol."</td>
			  		<td style='text-align:center;' bgcolor=#FAEBC2>".$tot_conv."</td>
			  		
			  		</tr>";	
		}	  		
		}

		echo "<tr>
			  		<td style='text-align:center;'></td>	
			  		<td  style='text-align:center;' bgcolor=#85C1E9><b>TOTALES</b></td>
			  		<td style='text-align:center;'bgcolor=#85C1E9 ><b>".$tot_gral."</b></td>
			  		<td  bgcolor=#85C1E9><b>".'$ '.$tot_pesos."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot15."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot1."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot2."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot3."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot4."</b></td>
			  		<td  style='text-align:center;' bgcolor=#85C1E9><b>".$tot5."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot6."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot7."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot8."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot9."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot10."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot11."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot12."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot14."</b></td>
			  		<td  style='text-align:center;'  bgcolor=#85C1E9><b>".$tot13."</b></td>
			</tr>";	
		/*echo "<tr>
			  		<td style='text-align:center;'></td>	
			  		<td  style='text-align:center;' bgcolor=#ABEBC6><b>".$sucursal."</b></td>
			  		<td style='text-align:center;'bgcolor=#ABEBC6 ><b>50%</b></td>
			  		<td  bgcolor=#ABEBC6><b>".'$ '.$sandra."</b></td>
			  		
			  		</tr>";	*/
	/*	echo "<tr>
			  		<td style='text-align:center;'></td>	
			  		<td  style='text-align:center;' bgcolor=#ABEBC6><b>RODRIGO</b></td>
			  		<td style='text-align:center;'bgcolor=#ABEBC6 ><b>10%</b></td>
			  		<td  bgcolor=#ABEBC6><b>".'$ '.$rodrigo."</b></td>
			  		
			  		</tr>";		  		  		*/

	
	 }
}	 
		
function TraerLocal ($local){

	$rows = Usuario::getUsuario(10,$local);
	foreach ($rows as $row) {
	$local=$row['local_descrip'];
	}
    return($local);
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