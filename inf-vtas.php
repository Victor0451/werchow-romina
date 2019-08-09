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
include "libs/class/pagos.class.php";
include "libs/class/Maestro.class.php";
include "libs/class/grupo.class.php";
include "libs/class/produccion.class.php"; 
include "libs/class/cuo_fija.class.php"; 

$perfil=VerPerfil();
if ($perfil=='ASESOR'){	print'<script type="text/javascript">
						window.location="cns-produccion2.php";
					  </script>';}
else{


$desde=null; $hasta = null; $asesor =0;$nom=null; $grupo='';

$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
$fechac=$fecha;
$anio=$fch[2];
//$mes=VerMes();


/*$recup=$_SESSION["usu_ide"];*/
$nom=VerUsuario($asesor);

$semana=0;
if (isset($_REQUEST['btn_ver'])){

	$asesor=$_REQUEST['asesor'];
  	$nom=VerUsuario($asesor);
  	$desde=$_REQUEST['desde'];
	$hasta=$_REQUEST['hasta'];


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
<style>
    	div.hoja{
      		background-color: rgb(2,62,95);
      		background-color: #6D8398;
      		font-size: .9em;
       		width: 90%;
      		padding: .5em;
      		text-align: center;
      		width: 90%;
    	}
      input, select {
      background: #fff;
      border: 1px solid #eae1c0;
      border-radius: 5px;
      box-shadow: rgba(0,0,0,.5) 1px 1px 1px 1px inset;
      font-size: .8em;
      margin: 2px;
      padding: .5em;
    }
    table{width: 90%;}
    table td { border: 1px solid black; padding: .5em; font-size: .7em;}
    a:visited { color: black; font-size: 1.5em;}
    a:link  { color: black; text-decoration: none; }
    a:hover { color: white; }
	
	a.nl:link{	text-decoration: none; }
	</style>



</head>

<body>
	
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>
	<div id="menu-wrapper">
		<div id="menu"><?php TraerPerfil(); ?></div>
	</div>
	<div id="contenido">
		
	<div class="hoja">	
	<a href="asesores.php" class="nl"><h1>CONSULTA EFECTIVIDAD PRODUCCION</h1></a>	
	<form action="" id="for_cns" method="get" >
		
		Asesor: <select name="asesor" id="asesor"><option value=0><?php echo VerUsuario($asesor); ?></option><?php echo VerAsesor();?></select>
		&nbsp;&nbsp;&nbsp;&nbsp;
		Desde:&nbsp; <input type="date" name="desde" value="<?php echo $desde; ?>" >
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Hasta:&nbsp; <input type="date" name="hasta" value="<?php echo $hasta; ?>" >
		&nbsp;&nbsp;&nbsp;
		<input type="submit" name="btn_ver" value="Consultar">
		
		<br><br>
		</tr>
		<div id="tabla">
			<table class="food_planner" align="center" border="1" width="100%" style="border-collapse:collapse;">
		<!--<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">-->
			<thead>
				<th widt="3%" bgcolor=#D5DBDB>Nº</th>
				<th widt="3%" bgcolor=#D5DBDB>Empresa</th>
				<th widt="3%" bgcolor=#D5DBDB>Contrato</th>
				<th widt="5%" bgcolor=#D5DBDB>Fech_Afil</th>
				<th widt="5%" bgcolor=#D5DBDB>Mes_Alta</th>
				<th widt="15%" bgcolor=#D5DBDB>Grupo</th>
				<th widt="10%" bgcolor=#D5DBDB>Cuota</th>
				<th widt="5%" bgcolor=#D5DBDB>Cant.Cuotas</th>
			</thead>
			<tbody>
				<?php VerProduccion($asesor,$desde,$hasta); ?>
			</tbody>
	
		</table>
</div>
		<p>
			
			<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<!--<input type="button" name="btn_exp" value="Exportar" onClick="JavaScript: location.href='cns-prod-exp.php?asesor=<?php echo $_GET['asesor'];?>&mes=<?php echo $_GET['mes'];?>&anio=<?php echo $_GET['anio'];?>&estado=<?php echo $_GET['estado'];?>';">-->&nbsp;<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'asesores.php'">
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

function TraerCuota($socio,$empresa){
$cuota=0;
if ($empresa=='W'){$rows = Cuo_fija::getCuo_Fija(0,$socio);}
else{$rows = Cuo_fija::getCuo_Fija(1,$socio);}	

	foreach ($rows as $row) {
		
		$cuota=$row['IMPORTE'];

	}
	
	return 	$cuota;
}	

function TraerGrupo($socio,$empresa){
$grupo=0;
$zona=0;
$descrip='';
if ($empresa=='W'){$rows = Maestro::getMaestro(7,$socio);}
else{$rows = Maestro::getMaestro(11,$socio);}	

	foreach ($rows as $row) {
		
		$grupo=$row['GRUPO'];
		$zona=$row['ZONA'];
		//echo $socio.'*'.$grupo.'*'.$zona.'<BR>';

	}
switch ($grupo) {
	case 0:$descrip='AFILIADO DE BAJA';	break;
	case 1000: switch ($zona) {
				case 1:	$descrip='OFICINA-JUJUY';break;
				case 3:	$descrip='OFICINA-PALPALA';break;
				case 5:	$descrip='OFICINA-PERICO';break;
				case 60:$descrip='OFICINA-SAN PEDRO';break;
				default: if($zona==99){$descrip='COBRADOR - VERIFICAR!!';}
				else{   $rows=grupo::getGrupo(1,$zona);
						foreach ($rows as $row) {
							$descrip='COBRADOR: '.$row['DESCRIP'];
						}
				}		
				break;
			}
	break;
	default: $rows = grupo::getGrupo(0,$grupo);
		foreach ($rows as $row) {
		$descrip=$row['DESCRIP'];}break;
}


return 	$descrip;
}
function TraerAlta($socio,$empresa){

$alta='';
if ($empresa=='W'){$rows = Maestro::getMaestro(7,$socio);}
else{$rows = Maestro::getMaestro(11,$socio);}	

	foreach ($rows as $row) {
		
		$alta=$row['ALTA'];

	}
//echo 'LLEGUE',$alta;
return 	$alta;
}	

function TraerCantCuota($socio,$empresa,$alta){
$c1=0;
$c2=0;
$cant=0;
//echo 'romina-'.$alta.'<br>';
if ($empresa=='W'){
	$rows = pagos::getPagos3(1,$socio,0,$alta);
	$c1=$rows->rowCount();
	$rows = pagos::getPagos3(2,$socio,0,$alta);
	$c2=$rows->rowCount();
}
else{
	$rows = pagos::getPagos3(4,$socio,0,$alta);
	$c1=$rows->rowCount();
	$rows = pagos::getPagos3(5,$socio,0,$alta);
	$c2=$rows->rowCount();
}	

$cant= $c1+$c2;

return 	$cant;

}	

function VerAsesor(){

	$usu=$_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3,$usu);
		foreach ($rows as $row) {
		$perfil=$row['usu_perfil'];
		$cod=$row['usu_ide'];
		$estado=$row['usu_estado'];
		$nombre=$row['usu_apellido']." ".$row['usu_nombre'];
    }
    
   
    if (($perfil=='ASESOR')and ($estado=='ACTIVO') ){
    	
		echo "<option value='".$usu."'>".$nombre."</option>";
    }
    else{
    		if (($perfil=='VENTAS')and ($estado=='ACTIVO')){
    			switch ($cod) {
    				case 23:$grupo='RODRIGO';break;
    				case 24:$grupo='SANDRA';break;
    				default:break;
    			}
    			//echo "<option value=0>TODOS</option>";
    			$rows = Usuario::getUsuario(14,$grupo);
				foreach ($rows as $row) {
					echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";}
    		}
    		else{
    				//echo "<option value=0>TODOS</option>";
    				$rows = Usuario::getUsuario(7,0);
					foreach ($rows as $row) {
						echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";}	
				}		
    	/*	echo "<option value=0>TODOS</option>";
    		$rows = Usuario::getUsuario(7,0);
			foreach ($rows as $row) {
				echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
			}*/

    	}
}

function VerUsuario($recup){
	
	/*if ($recup==0){ $ve='TODOS';return $ve;}
	else{ */
		$rows = Usuario::getUsuario(3,$recup);
	
		foreach ($rows as $row) {
	
			return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
		}
   //}
}
function VerUsuario2($recup){
	
	$rows = Usuario::getUsuario(3,$recup);
		foreach ($rows as $row) {
			return ($row['usu_nick']);
		}
    
}

function VerProduccion($asesor, $desde, $hasta){
	
if (isset($_REQUEST['btn_ver'])){
	$cont=0;
	$tot_mut=0;
	$tot_wer=0;
	$tot_uno=0;
	$tot_mas=0;
	$can_cuota=0;
	$grupo='';
	$estado='CARGADO';
	$grp='';

		
	$rows = Produccion::getProduccion2(12,$asesor,$desde,$hasta,$estado);
	
	
	if($rows->rowCount()!=0){	

	foreach ($rows as $row) {
	 	$emp='';
	 	$alta='';
		$cont=$cont+1;
		$socio=$row['prod_afiliado'];
		$empresa=$row['prod_empre'];
		switch ($empresa) {
    	case 'W':$emp='WERCHOW';$tot_wer=$tot_wer+1;break;
    	case 'M':$emp='MUTUAL';$tot_mut=$tot_mut+1;break;
    	default:break;
    }
	   
    $cuota=TraerCuota($socio,$empresa);
    $grp=TraerGrupo($socio,$empresa);
    $alta=TraerAlta($socio,$empresa);
    $can_cuota=TraerCantCuota($socio,$empresa,$alta);
    if ($can_cuota<=1){ $tot_uno=$tot_uno+1;
    	echo "<tr>
		<td style='text-align:center;' bgcolor=pink>".$cont."</td>	
		<td bgcolor=pink> ".$emp."</td>
		<td bgcolor=pink>".$row['prod_afiliado']."</td>
		<td bgcolor=pink>".$row['prod_fechaafi']."</td>
		<td bgcolor=pink>".$row['prod_mes']."</td>
		<td bgcolor=pink> ".$grp."</td>
		<td bgcolor=pink> $ ".$cuota."</td>
		<td bgcolor=pink>".$can_cuota."</td>";
    }
    else{	$tot_mas=$tot_mas+1;
		echo "<tr>
		<td style='text-align:center;'>".$cont."</td>	
		<td> ".$emp."</td>
		<td>".$row['prod_afiliado']."</td>
		<td>".$row['prod_fechaafi']."</td>
		<td>".$row['prod_mes']."</td>
		<td> ".$grp."</td>
		<td> $ ".$cuota."</td>
		<td>".$can_cuota."</td>";
	}		  		
			  		
    }    	
    $por=round((($tot_uno*100)/$cont),2);
       /*echo "
     TOTAL AFILIACIONES PERIODO= ".$cont;
     echo "
     TOTAL AFILIACIONES 1 CUOTA= ".$tot_uno;
    /*echo "<tr> 
    <td> TOTAL AFILIACIONES CON PAGO UNA CUOTA </td>
    <tr>";*/
    echo"
    <table class='food_planner' align='center' border='1' width='100%'' style='border-collapse:collapse;''>
		
			<thead>
				<th widt='100%' bgcolor=#D5DBDB style='text-align:left;'>TOTAL AFILIACIONES PERIODO= ".$cont."</th>
					
			</thead>
			<thead>
				<th widt='100%' bgcolor=#D5DBDB style='text-align:left;'>AFILIACIONES CON 1 SOLA CUOTA PAGA= ".$tot_uno.' -> '.$por.'%'."</th>
					
			</thead>
	</table>		
    ";
	}	
	else 	echo 'CONSULTA VACIA';			 
}	

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