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
include "libs/class/Adherente.class.php"; 

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



/*$recup=$_SESSION["usu_ide"];*/
$nom=VerUsuario($asesor);


if (isset($_REQUEST['btn_ver'])){

/*	$desde=$_REQUEST['desde'];
	$hasta=$_REQUEST['hasta'];*/
	$asesor=$_REQUEST['asesor'];
  if ($asesor!=0){$nom=VerUsuario($asesor);}
  else{$nom='TODOS';}
	//$nom=VerUsuario($asesor);
	//echo 'ROMINA - '.$nom;
	

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
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Consulta Adherentes</title>
	
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
		<a href="asesores.php" class="nl"><h1>CONSULTA ADHERENTES </h1></a>
	<form action="" id="for_cns" method="get" >
		
		
		ASESOR: <select name="asesor" id="asesor"><option value=0><?php echo VerUsuario($asesor); ?></option><?php echo VerAsesor();?></select>
			<br><br>
		
		<input type="submit" name="btn_ver" value="Consultar">
		
		<br><br>
		</tr>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="3%" bgcolor=#D5DBDB>Nº</th>
				<th widt="5%" bgcolor=#D5DBDB>Fech_Afil</th>
				<th widt="5%" bgcolor=#D5DBDB>Socio</th>
				<th widt="15%" bgcolor=#D5DBDB>Adherente</th>
				<th widt="5%" bgcolor=#D5DBDB>Recibo</th>
				<th widt="10%" bgcolor=#D5DBDB>Monto</th>
				<th widt="5%" bgcolor=#FF5733>Estado</th>
				<th widt="5%" bgcolor=#FF5733>PAGO</th>
				<th widt="5%" bgcolor=#FF5733>Fecha_pago</th>
				<th widt="5%" bgcolor=#D5DBDB>Asesor</th>
				<th widt="10%" bgcolor=#D5DBDB></th>
				<th widt="10%" bgcolor=#D5DBDB></th>
				
				
				
			</thead>
			<tbody>
				<?php VerAdherentes($asesor); ?>
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

function VerAdherentes($asesor){
	
if (isset($_REQUEST['btn_ver'])){
	$cont=0;
	if ($asesor==0){ $rows =Adherente::getAdherente(2,0);}
	else{$rows = Adherente::getAdherente(1,$asesor);}	
	
	if($rows->rowCount()!=0){	

		foreach ($rows as $row) {
	 		$cont=$cont+1;
			$nick=VerUsuario2($row['adhe_asesor']);
			$estado=$row['adhe_estado'];
			echo "<tr>
			<td style='text-align:center;'>".$cont."</td>	
			<td>".$row['adhe_fechafi']."</td>
			<td>".$row['adhe_contrato']."</td>
			
			<td>".$row['adhe_apellido'].' '.$row['adhe_nombre']."</td>
			<td>".$row['adhe_recibo']."</td>
			<td> $ ".$row['adhe_monto']."</td>
			<td>".$row['adhe_estado']."</td>
			<td>".$row['adhe_pago']."</td>
			<td>".$row['adhe_fecpago']."</td>
			<td style='text-align:center;'>".$nick."</td>";
			
			  		//echo"<td><center><a href= 'cbio-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td>	</tr>";break;
			  		//if ($estado=='PENDIENTE'){//echo"<td><center><a href='?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."'><img src='libs/img/campa.jpg' ></a><center></td>
			  		/*echo"<td><center><a href= 'cbio-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td>
		      		
		     		</tr>";//} */
		     		//else{ if($es) }*/
		    /* 		switch ($estado) {
            			case 'PENDIENTE':echo"<td><center><a href= 'cbio-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td>	</tr>";break;
            			case 'ENTREGADO':echo"<td><center><a href= 'cbio-prod2.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/campa.jpg' ></a><center></td> </tr>";break;
            		           
            		default: echo"<td><center><a href= 'cns-prod.php?op=md&prod_ide=".$row['prod_ide']."&asesor=".$row['prod_asesor']."&mes=".$_REQUEST['mes']."&anio=".$_REQUEST['anio']."&estado=".$_REQUEST['estado']."')'><img src='libs/img/buscar.png' ></a><center></td> </tr>"; break;
        			}*/
		}	
			  		
	}		
	else	{echo 'CONSULTA VACIA';	}
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