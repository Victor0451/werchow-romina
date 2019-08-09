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
include "libs/class/cuo_fija.class.php"; 
include "libs/class/sueldo.class.php"; 

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
//$mes=VerMes();

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
		<a href="asesores.php" class="nl"><h1>LIQUIDACION DE COMISIONES  -  <?php echo$_REQUEST['mes'].'    '.$_REQUEST['anio'];?> - GRUPO:&nbsp;<?php echo$_REQUEST['grupo'];?></h1> </a>
	<form action="" id="for_cns" method="get" >
			
	
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				
				<th widt="15%" bgcolor=#D5DBDB >ASESOR</th>
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
				<th widt="5%" bgcolor=#D5DBDB>-----</th>
				<th widt="5%" bgcolor=#85C1E9>DEB</th>
				<th widt="5%" bgcolor=#85C1E9>TAR</th>
				<th widt="5%" bgcolor=#85C1E9>POL</th>
				<th widt="5%" bgcolor=#85C1E9>CON</th>
				<th widt="5%" bgcolor=#F4D03F>TOTAL LIQ</th>
								
			</thead>
			<tbody>
				<?php VerProduccion(); ?>
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

function VerProduccion(){
	$tot_gral=0;
	$tot_pesos=0;
	$sum_tot=0;
	$general=0;
	$general2=0;
	$sandra=0;
	$rodrigo=0;
	$debito=null;
	$policia=null;
	$mes=$_REQUEST['mes'];
	$anio=$_REQUEST['anio'];
	$grupo=$_REQUEST['grupo'];
	$estado='CARGADO';

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

	if ($per=='VENTAS'){$rows=Usuario::getUsuario(15,$grupo);}
	else{$rows=Usuario::getUsuario(15,$grupo);}

		foreach ($rows as $row){
		$asesor= $row['usu_ide'];
		$ases=$row['usu_apellido'].' '.$row['usu_nombre'];
		
		$ventas=0;
		$total=0;
		$novell=0;
		$basico=0;
		$com1=0;
		$comision=0;
		$prem_deb=0;
		$prem_pol=0;
		$tot_nac=0; $tot_prov=0;$tot_noa=0;	$tot_nov=0;	$tot_aba=0;	$tot_a=0;$tot_fa=0;$tot_mut=0;
		$tot_par=0;$tot_deb=0;$tot_tjt=0;$tot_conv=0;$tot_pol=0; $tot_cob=0;$tot_of=0;$tot_espol=0;
		$pesos_cob=0;$pesos_of=0;$pesos_deb=0;$pesos_tjt=0;$pesos_pol=0;$pesos_conv=0;$pesos_estpol=0;
		
		$rowsP=Produccion::getProduccion2(5,$asesor,$mes,$anio,$estado);		
			//if($rowsP->rowCount()!=0){	
				foreach ($rowsP as $rowP) {
					
					$ventas=$ventas+1;
					$pp=$rowP['prod_plan'];
					if (($rowP['prod_plan']!='NOVELL')and($rowP['prod_recibo']>0)){$total=$total+$rowP['prod_monto'];}
					
					switch ($rowP['prod_plan']){
						case 'PROVINCIA':$tot_prov=$tot_prov+1;break;
						case 'PROVINCIAL':$tot_mut=$tot_mut+1;break;
            			case 'NOA':$tot_noa=$tot_noa+1;break;
            			case 'NACIONAL':$tot_nac=$tot_nac+1;break;
            			case 'ABARCAR':$tot_aba=$tot_aba+1;break;
            			case 'NOVELL':$tot_nov=$tot_nov+1;$novell=$novell+(($rowP['prod_monto']*5)/100);break;
            			case 'A':$tot_a=$tot_a+1;break;
            			case 'FAMILIA':$tot_fa=$tot_fa+1;break;
            			default:break;

					}
					switch ($rowP['prod_pago']) {
        				case 'OFICINA':$tot_of=$tot_of+1;$pesos_of=$pesos_of+$rowP['prod_monto'];break;
            			case 'COBRADOR':$tot_cob=$tot_cob+1;$pesos_cob=$pesos_cob+$rowP['prod_monto'];break;
            			case 'EST POLICIA':$tot_espol=$tot_espol+1;$pesos_estpol=$pesos_estpol+150;break;
            			case 'DEBITO':$tot_deb=$tot_deb+1;$pesos_deb=$pesos_deb+$rowP['prod_monto'];$prem_deb=$prem_deb+1;break;
            			case 'TARJETA':if ($pp!='NOVELL') {$tot_tjt=$tot_tjt+1;$pesos_tjt=$pesos_tjt+$rowP['prod_monto'];$prem_deb=$prem_deb+1;} break;
            			case 'POLICIA':$tot_pol=$tot_pol+1;$pesos_pol=$pesos_pol+($rowP['prod_monto']*2);$prem_pol=$prem_pol+1;;break;
            			case 'CONVENIO':$tot_conv=$tot_conv+1;
            			if ($rowP['prod_recibo']==0) {
            				$cuota=TraerCuota($rowP['prod_afiliado']);
            				$pesos_conv=$pesos_conv+$cuota;	
            			}
            			else{$pesos_conv=$pesos_conv+$rowP['prod_monto'];}	
            			break;
            			default:break;
        			}
				}
				$tot_gral=$tot_gral + $ventas;
				$tot_pesos=$tot_pesos+$total;
				
				$sum_tot=$total+$sum_tot;
				//echo 'ver: '.$ases;
				//$basico=TraerBasico($asesor);
				//if ($basico>0){
				echo "<tr>
					  
				<td bgcolor=#5DADE2 align=center><b>".$ases."</b></td>
				  <td style='text-align:center;'bgcolor=#3FF4DE >".$ventas."</td>
			  		<td bgcolor=#3FF4DE>".'$ '.$total."</td>
			  		<td bgcolor=#3FF4DE style='text-align:center;' >".$tot_mut."</td>
			  		<td bgcolor=#3FF4DE style='text-align:center;' >".$tot_prov."</td>
			  		<td bgcolor=#3FF4DE style='text-align:center;' >".$tot_noa."</td>
			  		<td bgcolor=#3FF4DE style='text-align:center;' >".$tot_nac."</td>
			  		<td bgcolor=#3FF4DE style='text-align:center;' >".$tot_aba."</td>
			  		<td bgcolor=#3FF4DE style='text-align:center;' >".$tot_nov."</td>
			  		<td bgcolor=#3FF4DE style='text-align:center;' >".$tot_a."</td>
			  		<td bgcolor=#3FF4DE style='text-align:center;' >".$tot_fa."</td>
			  		<td bgcolor=#D5DBDB style='text-align:center;' >".$tot_of."</td>
			  		<td bgcolor=#D5DBDB style='text-align:center;' >".$tot_cob."</td>
					  
					  <td bgcolor=#D5DBDB style='text-align:center;' >----</td> 
					  
					  <td bgcolor=#85C1E9 style='text-align:center;' >".$tot_deb."</td>
			  		<td bgcolor=#85C1E9 style='text-align:center;' >".$tot_tjt."</td>
			  		<td bgcolor=#85C1E9 style='text-align:center;' >".$tot_pol."</td>
			  		<td bgcolor=#85C1E9 style='text-align:center;' >".$tot_conv."</td>
			  	</tr>";	
					
			  	
			  	//echo $asesor;
				$basico=TraerBasico($asesor);
								
				if ($prem_pol>=5){$policia=500;}else{$policia=0;}
				if (($prem_deb>=8)and ($prem_deb<=15)){$debito=500;}
				else if (($prem_deb>=16)and($prem_deb<=23)){$debito=1000;}else{$debito=0;}
				
				$com1=$pesos_deb+$pesos_tjt+$pesos_pol+$pesos_conv+$pesos_estpol;
				$comision=$com1+$novell+$basico+$policia+$debito;
				$general=$general+$comision; 
			  
			  				  	
			  	echo "<tr>
			  	<td><b>COMISIONES</b></td>
			  	<td  ></td>
			  		<td ><b> $ ".$com1."</b></td>
			  		<td  ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ></td>
			  		<td style='text-align:center;' ><b>----</b></td>
			  		<td style='text-align:center;' ><b>$ ".$pesos_deb."</b></td>
			  		<td style='text-align:center;' ><b>$ ".$pesos_tjt."</b></td>
			  		<td style='text-align:center;' ><b>$ ".$pesos_pol."</b></td>
			  		<td style='text-align:center;' ><b>$ ".$pesos_conv."</b></td>
				  </tr>";
				  
			  	echo "<tr>
			  	<td><b>PREMIO X DEBITOS</b></td>
			  	<td style='text-align:center;'  >".$prem_deb."</td>
			  	<td > <b>$ ".$debito."</b></td>
			   	</tr>";

			  	echo "<tr>
			  	<td><b>PREMIO X POLICIAS</b></td>
			  	<td style='text-align:center;' >".$prem_pol."</td>
			  	<td > <b>$ ".$policia."</b></td>
			   	</tr>";

			  	echo "<tr>
			  	<td><b>NOVELL</b></td>
			  	<td  ></td>
			  	<td > <b>$ ".$novell."</b></td>
			   	</tr>";
			  	
			  	echo "<tr>
			  	<td><b>BASICO</b></td>
			  	<td  ></td>
			  	<td > <b>$ ".$basico."</b></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td  ></td>
			  	<td bgcolor=#F4D03F><b> $ ".$comision."</b></td>
			  	</tr>";
			  	
			}		
		//}	
	echo "<tr>
			  	<td bgcolor=#F4D03F><font size=4><b>TOTAL COMISIONES</font></b></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>

			  	<td bgcolor=#F4D03F><font size=4><b> $ ".$general."</font></b></td>
			  	</tr>";		
			  	$sandra=($sum_tot*50)/100;
			  	$rodrigo=($sum_tot*10)/100;
			  	//$general2=$general + $sandra + $rodrigo;
			  	$general2=$general + $sandra;
	echo "<tr>
			  	<td bgcolor=#EB984E><b>".$grupo."</b></td>
			  	<td bgcolor=#EB984E ><b>50%</b></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E><b> $ ".$sandra."</b></td>
			  	</tr>";		
/*	echo "<tr>
			  	<td bgcolor=#EB984E><b>RODRIGO</b></td>
			  	<td bgcolor=#EB984E ><B>10%</B></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E ></td>
			  	<td bgcolor=#EB984E><b> $ ".$rodrigo."</b></td>
			  	</tr>";				  	*/
	echo "<tr>
			  	<td bgcolor=#F4D03F><font size=4><b>TOTAL MENSUAL</font></b></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F ></td>
			  	<td bgcolor=#F4D03F><font size=4 color=red><b> $ ".$general2."</font></b></td>
			  	</tr>";		
}	 
		

function TraerCuota ($afiliado){

	$rows = Cuo_Fija::getCuo_Fija(0,$afiliado);
	foreach ($rows as $row) {
	$cuota=$row['IMPORTE'];
	}
    return($cuota);
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
function TraerBasico($asesor){
	$c1=0;
	$c2=0;
	$ban=0;
	$sem=1;
	$estado='CARGADO';
	$perfil='ASESOR';
	$con=0;
	$resul=0;	
	$basico=0;
	$cont1=0;
	//$ssem=$_REQUEST['semana'];
	$smes=$_REQUEST['mes'];
	$sanio=$_REQUEST['anio'];

	$ing=TraerMes($smes);
	
	$ct = explode("-",$ing); 
     
     $fec1=$sanio.'-'.$ct[1].'-16';
     $fec2=$sanio.'-'.$ct[0].'-15';

     
	$rowc = Sueldo::getSueldo(1,$perfil);
	foreach ($rowc as $rowcc) {
		$bas=$rowcc['sld_basico'];
		$cont1=($rowcc['sld_basico']/4);
	}
	//	echo $asesor;
	//if (($asesor>=30) and ($asesor<=33)){$c2=$c2+2;} 
	//if ($ssem==0){ 

	$rowu = Usuario::getUsuario(3,$asesor);
	
	foreach ($rowu as $rowus) {
		$gral=0;

		if (($rowus['usu_alta']>=$fec1)and($rowus['usu_alta']<$fec2)){
			if ($rowus['usu_sem1']==1){$basico=$basico+$cont1;}
			if ($rowus['usu_sem2']==1){$basico=$basico+$cont1;}
			if ($rowus['usu_sem3']==1){$basico=$basico+$cont1;}
			if ($rowus['usu_sem4']==1){$basico=$basico+$cont1;}
		}
	}
	while ($sem<=4){
		$rows = Produccion::getProduccion3(0,$asesor,$smes,$sanio, $estado, $sem);
		
		$con=$rows->rowCount();
		$gral=$gral+$con;
			if ($con >= 5){
				//$c2=$c2+1;
				switch ($sem) {
				case 1:$basico=$basico+$cont1;break;
				case 2:$basico=$basico+$cont1;break;
				case 3:$basico=$basico+$cont1;break;
				case 4:$basico=$basico+$cont1;break;
				
            	default:break;
        		}

			}
			$sem=$sem+1;
			$con=0;
	}
	$sem=1;	
	
	if  (($gral>=20)and($gral<25)){$basico=round($bas);}
	else{ if(($gral>=25)and($gral<30)){$basico=8000;}else{if($gral>=30){$basico=10000;}}	
	}	

 return $basico;
}

function TraerMes($mes){
$mm='';
switch ($mes) {
				case 'ENERO':$mm='01-12'; break;
				case 'FEBRERO':$mm='02-01'; break;
				case 'MARZO':$mm='03-02'; break;
				case 'ABRIL':$mm='04-03'; break;
				case 'MAYO':$mm='05-04'; break;
				case 'JUNIO':$mm='06-05'; break;
				case 'JULIO':$mm='07-06'; break;
				case 'AGOSTO':$mm='08-07'; break;
				case 'SEPTIEMBRE':$mm='09-08'; break;
				case 'OCTUBRE':$mm='10-09'; break;
				case 'NOVIEMBRE':$mm='11-10'; break;
				case 'DICIEMBRE':$mm='12-11'; break;

				default:break;
			}
return($mm);
}
?>