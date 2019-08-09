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




$desde=null; $hasta = null; $asesor =0;$nom=null; $estado=null;$mes=null;$anio=null;

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$mes=VerMes();


/*$recup=$_SESSION["usu_ide"];*/
$nom=VerUsuario($asesor);


if (isset($_REQUEST['btn_ver'])){

/*	$desde=$_REQUEST['desde'];
	$hasta=$_REQUEST['hasta'];*/
	//$asesor=$_REQUEST['asesor'];
  if ($asesor!=0){$nom=VerUsuario($asesor);}
  else{$nom='TODOS';}
	//$nom=VerUsuario($asesor);
	//echo 'ROMINA - '.$nom;
	$mes=$_REQUEST['mes'];
	$anio=$_REQUEST['anio'];
	//$estado=$_REQUEST['estado'];
	

}
else{

	if (isset($_REQUEST['btn_limpiar'])){
		
	$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
		
	}
else{
	if (isset($_REQUEST['op'])){

		switch ($_REQUEST['op']) {
			case 'md': //modificar
				$est='ENTREGADO';
				$rows = Produccion::updateProduccion1($_REQUEST['prod_ide'],$est);
				
				$asesor=$_REQUEST['asesor'];
				$mes=$_REQUEST['mes'];
				$anio=$_REQUEST['anio'];
				$estado=$_REQUEST['estado'];
				/*print '<script language="JavaScript">'; 
				print 'alert("Se cambio de estado a ENTREGADO");'; 
				print'</script>';
				print'<script type="text/javascript">
					window.location="cns-produccion.php?asesor='.$asesor.'&mes='.$mes.'&anio='.$anio.'&estado='.$estado.'&btn_ver=Consultar";';
				print'</script>';*/
				
			
				break;
			case 'br': //borrar
				$rows = Liquidacion::deleteLiquidacion($_REQUEST['liq_id']);
				break;
		}
	}
	else{
	//	$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
	}
	}
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Consulta Produccion</title>
	
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
		<a href="asesores.php" class="nl"><h1>CONSULTA PRODUCCION&nbsp;&nbsp;<?php echo VerUsuario();?></h1></a>
	<form action="" id="for_cns" method="get" >
		
		
		<!--ASESOR: <select name="asesor" id="asesor"><option value=0><?php //echo VerUsuario($asesor); ?></option><?php //echo VerAsesor();?></select>
		&nbsp;&nbsp;&nbsp;&nbsp;	-->
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
		
		<!--&nbsp;&nbsp;&nbsp;
		ESTADO:&nbsp;<select name="estado" id="estado" >
				<option value= "<?php echo $estado; ?>" selected="selected"><?php echo $estado; ?></option>
				<option value="TODOS">TODOS</option>
				<option value="PENDIENTE">PENDIENTE</option>
				<option value="ENTREGADO">ENTREGADO</option>
				<option value="APROBADO">APROBADO</option>
				<option value="MOROSO">MOROSO</option>
				<option value="MOROSO">RECHAZADO</option>
				<option value="CARGADO">CARGADO</option>
				
			</select>-->	<br><br>
		
		<input type="submit" name="btn_ver" value="Consultar">
		
		<br><br>
		</tr>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%" bgcolor=#D5DBDB>Nº</th>
				<th widt="5%" bgcolor=#D5DBDB>Fech_Afil</th>
				<th widt="5%" bgcolor=#D5DBDB>Recibo</th>
				<th widt="15%" bgcolor=#D5DBDB>Afiliado Titular</th>
				<th widt="10%" bgcolor=#D5DBDB>Monto</th>
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
				<th widt="5%" bgcolor=#D5DBDB>CON</th>
				<th widt="10%" bgcolor=#FF5733>Sem</th>
				<th widt="10%" bgcolor=#FF5733>AFI</th>
				<th widt="10%" bgcolor=#FF5733>REN</th>
				<th widt="5%" bgcolor=#FF5733>Estado</th>
				<th  bgcolor=#D5DBDB></th>
				
			</thead>
			<tbody>
				<?php VerProduccion($mes,$anio); ?>
			</tbody>
	
		</table>

		<p>
			
			<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'">
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

function VerUsuario(){
	
	
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
		foreach ($rows as $row) {
	
			return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
		}
    
}
function VerUsuario2($recup){
	
	$rows = Usuario::getUsuario(3,$recup);
		foreach ($rows as $row) {
			return ($row['usu_nick']);
		}
    
}

function VerProduccion($mes, $anio){
	$ase=$_SESSION["usu_ide"];
if (isset($_REQUEST['btn_ver'])){
	$cont=0;
	$tot_par=0;$tot_deb=0;$tot_tjt=0;$tot_conv=0;$tot_pol=0;$tot_espol=0;	
	$tot_nac=0;
		$tot_prov=0;
		$tot_noa=0;
		$tot_nov=0;
		$tot_aba=0;
		$tot_cob=0;
		$tot_a=0;
		$tot_fa=0;
		$tot_of=0;
	$total=0;	

/*	if($asesor==0){
		if ($estado=='TODOS'){$rows = Produccion::getProduccion2(1,$asesor,$mes,$anio,$estado);} 
	}else{$rows = Produccion::getProduccion2(2,$asesor,$mes,$anio,$estado);}

	else{
	$rows = Produccion::getProduccion2(0,$asesor,$mes,$anio,$estado);
	}*/
	$rows = Produccion::getProduccion2(3,$ase,$mes,$anio,0);
	/*if ($asesor==0){if ($estado=='TODOS'){$rows = Produccion::getProduccion2(1,$asesor,$mes,$anio,$estado);}
		else{$rows = Produccion::getProduccion2(2,$asesor,$mes,$anio,$estado);}
	}
	else{if ($estado=='TODOS') {$rows = Produccion::getProduccion2(3,$asesor,$mes,$anio,$estado);} else {$rows = Produccion::getProduccion2(0,$asesor,$mes,$anio,$estado);}
	}*/	
	
	if($rows->rowCount()!=0){	

	foreach ($rows as $row) {
	 
		$cont=$cont+1;
		$mon=0;
		$noa=null;
		$prov=null;
		$nac=null;
		$nov=null;
		$aba=null;
		$a=null;
		$fa=null;
		$of=null;
		$cob=null;
		$par=null;$deb=null;$tar=null;$conv=null;$pol=null; $es_pol=null;		
		$nick=VerUsuario2($row['prod_asesor']);

		$local=TraerLocal($row['prod_local']);
		if ($row['prod_plan']=='NOVELL'){$mon=0;}
			else{ if (($row['prod_pago']=='POLICIA') and ($row['prod_recibo']==0)){$mon=0;}
				else{
					$mon=$row['prod_monto'];}
		}

		$total=$total+$mon;

		switch ($row['prod_plan']) {
            case 'PROVINCIA':$prov="X";$tot_prov=$tot_prov+1;break;
            case 'NOA':$noa="X";$tot_noa=$tot_noa+1;break;
            case 'NACIONAL':$nac="X";$tot_nac=$tot_nac+1;break;
            case 'ABARCAR':$aba="X";$tot_aba=$tot_aba+1;break;
            case 'NOVELL':$nov="X";$tot_nov=$tot_nov+1;break;
            case 'A':$a="X";$tot_a=$tot_a+1;break;
             case 'FAMILIA':$fa="X";$tot_fa=$tot_fa+1;break;
            default:break;
        }
        switch ($row['prod_pago']) {
        	case 'OFICINA':$of="X";$tot_of=$tot_of+1;break;
            case 'COBRADOR':$cob="X";$tot_cob=$tot_cob+1;break;
            case 'DEBITO':$deb="X";$tot_deb=$tot_deb+1;break;
            case 'TARJETA':$tar="X";$tot_tjt=$tot_tjt+1;break;
            case 'POLICIA':$pol="X";$tot_pol=$tot_pol+1;break;
            case 'EST POLICIA':$es_pol="X";$tot_espol=$tot_espol+1;break;
            case 'CONVENIO':$conv="X";$tot_conv=$tot_conv+1;break;
            default:break;
        }
        
					echo "<tr>
			  		<td style='text-align:center;'>".$cont."</td>	
			  		<td>".$row['prod_fechaafi']."</td>
			  		<td>".$row['prod_recibo']."</td>
			  		<td>".$row['prod_apeafi'].' '.$row['prod_nomafi']."</td>
			  		<td> $ ".$mon."</td>
			  		<td style='text-align:center;'>".$prov."</td>
			  		<td style='text-align:center;'>".$noa."</td>
			  		<td style='text-align:center;'>".$nac."</td>
			  		<td style='text-align:center;'>".$aba."</td>
			  		<td style='text-align:center;'>".$nov."</td>
			  		<td style='text-align:center;'>".$a."</td>
			  		<td style='text-align:center;'>".$fa."</td>
			  		<td style='text-align:center;'>".$of."</td>
			  		<td style='text-align:center;'>".$cob."</td>
			  		<td style='text-align:center;'>".$deb."</td>
			  		<td style='text-align:center;'>".$tar."</td>
			  		<td style='text-align:center;'>".$pol."</td>
			  		<td style='text-align:center;'>".$es_pol."</td>
			  		<td style='text-align:center;'>".$conv."</td>
			  		<td style='text-align:center;'>".$row['prod_semana']."</td>
			  		<td>".$row['prod_afiliado']."</td>
			  		<td>".$row['prod_rendido']."</td>
			  		<td>".$row['prod_estado']."</td>
			  		<td><center><a href= 'cns-prod2.php?op=md&prod_ide=".$row['prod_ide']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."')'><img src='libs/img/buscar.png' ></a><center></td> </tr>"; 
			  		/*if ($estado=='PENDIENTE'){//echo"<td><center><a href='?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."'><img src='libs/img/campa.jpg' ></a><center></td>
			  		echo"<td><center><a href= 'cbio-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td>
		      		
		     		</tr>";} 
		     		else{ if($es) }*/
		     		/*switch ($estado) {
            			case 'PENDIENTE':echo"<td><center><a href= 'cbio-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td>	</tr>";break;
            			case 'ENTREGADO':echo"<td><center><a href= 'cbio-prod2.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td> </tr>";break;
            		           
            		default: echo"<td><center><a href= 'cns-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/buscar.png' ></a><center></td> </tr>"; break;
        			}	*/

		     		//else{} 
			  		
				}
			echo "<tr>
			  		<td>".''."</td>	
			  		<td>".''."</td>
			  		<td>".''."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9><b>TOTALES</b></td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b> $ ".$total."</b></td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_prov."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_noa."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_nac."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_aba."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_nov."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_a."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_fa."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_of."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_cob."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_deb."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_tjt."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_pol."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_espol."</td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_conv."</td></b></tr>";
			  		
		}		
	else
	echo 'CONSULTA VACIA';			 
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
	if ($fch[0]>15){$prueba=$fch[1]+1;}else{$prueba=$fch[1];}
	switch ($prueba) {
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