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

$perfil=VerPerfil();
if ($perfil=='ASESOR'){	print'<script type="text/javascript">
						window.location="cns-produccion2.php";
					  </script>';}
else{


$desde=null; $hasta = null; $asesor =0;$nom=null; $estado=null;$mes=null;$anio=null;$grupo='';

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
$mes=VerMes();


/*$recup=$_SESSION["usu_ide"];*/
$nom=VerUsuario($asesor);

$semana=0;
if (isset($_REQUEST['btn_ver'])){

/*	$desde=$_REQUEST['desde'];
	$hasta=$_REQUEST['hasta'];*/
	$asesor=$_REQUEST['asesor'];
  if ($asesor!=0){$nom=VerUsuario($asesor);}
  else{$nom='TODOS';}
	//$nom=VerUsuario($asesor);
	//echo 'ROMINA - '.$nom;
	$mes=$_REQUEST['mes'];
	$anio=$_REQUEST['anio'];
	$estado=$_REQUEST['estado'];
	$semana=$_REQUEST['semana'];
	

}
else{

	if (isset($_REQUEST['btn_limpiar'])){
		
	$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;$grupo='';
		
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
		<a href="asesores.php" class="nl"><h1>CONSULTA PRODUCCION </h1></a>
	<form action="" id="for_cns" method="get" >
		
		Asesor: <select name="asesor" id="asesor"><option value=0><?php echo VerUsuario($asesor); ?></option><?php echo VerAsesor();?></select>
		&nbsp;
		Mes:&nbsp;
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
		&nbsp;
		Año:&nbsp;<input type="text" name="anio" value="<?php echo $anio; ?>" onkeyUp="return ValNumero(this);" size="3px" >
		&nbsp;
		Estado:&nbsp;<select name="estado" id="estado" >
				<option value= "<?php echo $estado; ?>" selected="selected"><?php echo $estado; ?></option>
				<option value="TODOS">TODOS</option>
				<option value="PENDIENTE">PENDIENTE</option>
				<option value="ENTREGADO">ENTREGADO</option>
				<option value="APROBADO">APROBADO</option>
				<option value="MOROSO">MOROSO</option>
				<option value="RECHAZADO">RECHAZADO</option>
				<option value="CARGADO">CARGADO</option>
				
			</select>	
		&nbsp;
		Semana:&nbsp;<select name="semana" id="semana" >
				<option value= "<?php echo $semana; ?>" selected="selected"><?php echo $semana; ?></option>
				<option value=0>Todas</option>
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				
			</select>		

		<br><br>
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
				<th widt="5%" bgcolor=#D5DBDB>SEM</th>
				<th widt="5%" bgcolor=#D5DBDB>Asesor</th>
				<th widt="10%" bgcolor=#FF5733>AFI</th>
				<th widt="10%" bgcolor=#FF5733>REN</th>
				<th widt="5%" bgcolor=#FF5733>Estado</th>
				<th  bgcolor=#D5DBDB></th>
				
			</thead>
			<tbody>
				<?php VerProduccion($asesor,$mes,$anio,$estado, $semana); ?>
			</tbody>
	
		</table>

		<p>
			
			<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_exp" value="Exportar" onClick="JavaScript: location.href='cns-prod-exp.php?asesor=<?php echo $_GET['asesor'];?>&mes=<?php echo $_GET['mes'];?>&anio=<?php echo $_GET['anio'];?>&estado=<?php echo $_GET['estado'];?>';">&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'">
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
		$cod=$row['usu_ide'];
		$grupo=$row['usu_grupo'];;
		$estado=$row['usu_estado'];
		$nombre=$row['usu_apellido']." ".$row['usu_nombre'];
	}



    /*if (($perfil=='ASESOR')and ($estado=='ACTIVO') ){
    	
		echo "<option value='".$usu."'>".$nombre."</option>";
    }
    else{
    		if ((($perfil=='ENCARGADO')or($perfil=='VENTAS'))and ($estado=='ACTIVO')){
				echo 'ENTRE';
				/*switch ($cod) {
    				case 23:$grupo='RODRIGO';break;
					case 24:$grupo='SANDRA';break;
				
					default:$grupo=$grupo;echo 'RO'.$grupo;break;
    			}*/
    /*			echo "<option value=0>TODOS</option>";
    			$rows = Usuario::getUsuario(14,$grupo);
				foreach ($rows as $row) {
					echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";}
    			}
    		else{
    				echo "<option value=0>TODOS</option>";
    				$rows = Usuario::getUsuario(7,0);
					foreach ($rows as $row) {
						echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";}	
			}	*/	
			
			//$grupo='JUJUY';
			echo "<option value=0>TODOS</option>";
			switch ($grupo) {
				case 'JUJUY':$rows = Usuario::getUsuario(17,'JUJUY');break;
				case 'PERICO':$rows = Usuario::getUsuario(17,'PERICO');;break;
				case 'SAN PEDRO':$rows = Usuario::getUsuario(17,'SAN PEDRO');;break;
				case 'PALPALA':$rows = Usuario::getUsuario(17,'PALPALA');;break;
			
				default:$rows = Usuario::getUsuario(15,'');break;}
    		//$rows = Usuario::getUsuario(7,0);
			foreach ($rows as $row) {
				echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
			}

    	//}
}

function VerUsuario($recup){
	
	if ($recup==0){ $ve='TODOS'; return $ve;}
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

function VerProduccion($asesor, $mes, $anio, $estado, $semana){
	
if (isset($_REQUEST['btn_ver'])){
	$cont=0;
	$tot_par=0;$tot_deb=0;$tot_tjt=0;$tot_conv=0;$tot_pol=0;$tot_espol=0;
	$tot_nac=0;
		$tot_prov=0;
		$tot_mut=0;
		$tot_noa=0;
		$tot_nov=0;
		$tot_aba=0;
		$tot_cob=0;
		$tot_a=0;
		$tot_fa=0;
		$tot_of=0;
		$total=0;	
		$mon=0;
		
		$grupo='';

		$usu=$_SESSION["usu_ide"];

		$rows = Usuario::getUsuario(3,$usu);

		foreach ($rows as $row) {
			$grupo=$row['usu_grupo'];			
			$cod=$row['usu_ide'];
		}
		/*switch	($cod) {
    				case 'JUJUY':$grupo='RODRIGO';break;
    				case 'SAN PEDRO':$grupo='SANDRA';break;
    				default:break;
		}
/*	if($asesor==0){
		if ($estado=='TODOS'){$rows = ion::getProduccion2(1,$asesor,$mes,$anio,$estado);} 
	}else{$rows = Produccion::getProduccion2(2,$asesor,$mes,$anio,$estado);}

	else{
	$rows = Produccion::getProduccion2(0,$asesor,$mes,$anio,$estado);
	}*/
	if (($asesor==0)){
		
			if ($estado=='TODOS'){
				
				if ($grupo==''){ $rows = Produccion::getProduccion2(10,$asesor,$mes,$anio,'');}
				else{$rows = Produccion::getProduccion2(1,$asesor,$mes,$anio,$grupo);}	
				
			}
			else{if ($grupo==''){$rows = Produccion::getProduccion2(11,$estado,$mes,$anio,''); }
				else{$rows = Produccion::getProduccion2(2,$estado,$mes,$anio,$grupo);}		}
			/*else {if (($cod>=23)and($cod<=24)){echo'hola';$rows = Produccion::getProduccion2(10,$asesor,$mes,$anio,$grupo);})
				else{$rows = Produccion::getProduccion2(2,$asesor,$mes,$anio,$estado);}
			}*/
		
	}
	else{if ($estado=='TODOS') {$rows = Produccion::getProduccion2(3,$asesor,$mes,$anio,$estado);} else {$rows = Produccion::getProduccion2(0,$asesor,$mes,$anio,$estado);}
	}	
	
	if($rows->rowCount()!=0){	

	foreach ($rows as $row) {
	 
		$cont=$cont+1;
		
		$noa=null;
		$prov=null;
		$mut=null;
		$nac=null;
		$nov=null;
		$aba=null;
		$a=null;
		$fa=null;
		$of=null;
		$cob=null;
		$par=null;$deb=null;$tar=null;$conv=null;$pol=null;$es_pol=null;				
		$nick=VerUsuario2($row['prod_asesor']);


		//if ($semana==)

		$local=TraerLocal($row['prod_local']);
		//$total=$total+$row['prod_monto'];
		if ($row['prod_plan']=='NOVELL'){$mon=0;}
			else{ if ((($row['prod_pago']=='POLICIA') or ($row['prod_pago']=='EST POLICIA')) and ($row['prod_recibo']==0)){$mon=0;}
				else{
					$mon=$row['prod_monto'];}
		}

		$total=$total+$mon;
		switch ($row['prod_plan']) {
            case 'PROVINCIA':$prov="X";$tot_prov=$tot_prov+1;break;
            case 'PROVINCIAL':$mut="X";$tot_mut=$tot_mut+1;break;
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
        
			if (($semana==$row['prod_semana'])or($semana==0)){
					echo "<tr>
			  		<td style='text-align:center;'>".$cont."</td>	
			  		<td>".$row['prod_fechaafi']."</td>
			  		<td>".$row['prod_recibo']."</td>
			  		<td>".$row['prod_apeafi'].' '.$row['prod_nomafi']."</td>
			  		<td> $ ".$mon."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$mut."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$prov."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$noa."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$nac."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$aba."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$nov."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$a."</td>
			  		<td style='text-align:center;' bgcolor=#D5DBDB>".$fa."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9>".$of."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9>".$cob."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9>".$deb."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9>".$tar."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9>".$pol."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9>".$es_pol."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9>".$conv."</td>
			  		<td style='text-align:center;'>".$row['prod_semana']."</td>
			  		<td style='text-align:center;'>".$nick."</td>
			  		<td>".$row['prod_afiliado']."</td>
			  		<td>".$row['prod_rendido']."</td>
			  		<td>".$row['prod_estado']."</td>";
			  		//echo"<td><center><a href= 'cbio-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td>	</tr>";break;
			  		//if ($estado=='PENDIENTE'){//echo"<td><center><a href='?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."'><img src='libs/img/campa.jpg' ></a><center></td>
			  		/*echo"<td><center><a href= 'cbio-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td>
		      		
		     		</tr>";//} */
		     		//else{ if($es) }*/
		     		switch ($estado) {
            			case 'PENDIENTE':echo"<td><center><a href= 'cbio-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td>	</tr>";break;
            			case 'ENTREGADO':echo"<td><center><a href= 'cbio-prod2.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td> </tr>";break;
            		           
            		default: echo"<td><center><a href= 'cns-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/buscar.png' ></a><center></td> </tr>"; break;
        			}	
        		}	
		     		//else{} 
				}
			echo "<tr>
			  		<td>".''."</td>	
			  		<td>".''."</td>
			  		<td>".''."</td>
			  		<td style='text-align:center;' bgcolor=#85C1E9><b>TOTALES</b></td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b> $ ".$total."</b></td>
			  		<td style='text-align:center;' bgcolor=#E67E22><b>".$tot_mut."</td>
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
//	if ($fch[0]>15){$prueba=$fch[1]+1;}else{$prueba=$fch[1];}
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