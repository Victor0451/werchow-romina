<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/Maestro.class.php";
   include "libs/class/pagos.class.php";
   include "libs/class/Grupo.class.php";
   include "libs/class/Cuo_Fija.class.php";
   include "libs/class/Otro.class.php";


$recup=0;
$nom=VerUsuario($recup);
$mes=null;
$hasta=null;
$anio=null;
$vista=null;

if ((isset($_REQUEST['btn_consultar'])or(isset($_REQUEST['btn_ver'])))){

   		$mes=$_REQUEST['mes'];
   	    $anio=$_REQUEST['anio'];
   		$recup=$_REQUEST['recup'];
   		$vista=$_REQUEST['vista'];
  		
   }



 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Consultar Mora del Periodo</title>
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
		<a href="asesores.php" class="nl"><h1>INFORME DE MORA</h1></a>
		<div id="doctip">
	<form action="" id="formulario" action="" >
		Ingrese Mora a Consultar &nbsp;&nbsp;&nbsp; MES:&nbsp;
		<select name="mes" id="mes" >
				<option value= "<?php echo $mes; ?>" selected="selected"><?php echo Traer($mes); ?></option>
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
		AÑO:&nbsp;<input type="text" name="anio" value="<?php echo $anio; ?>" onkeyUp="return ValNumero(this);" size="5px" >&nbsp;&nbsp;&nbsp; Vista:
		<select name="vista" id="vista" >
				<option value= "<?php echo $vista; ?>" selected="selected"><?php echo $vista; ?></option>
				<option value=0>$</option>
				<option value=1>Fichas</option>
			</select>
		 &nbsp;&nbsp;&nbsp;	<input type="submit" name="btn_consultar" value="Consultar"><br><br>

		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
	    <thead>
				
				<th widt="50%" bgcolor=#85C1E9></th>
				<th widt="25%" bgcolor=#ABEBC6><font size=2>ATRASADOS</font></th>
				<th widt="25%" bgcolor=#ABEBC6></th>
				<th widt="25%" bgcolor=#ABEBC6><font size=2>RECUPERACION (1001)</font></th>
				<th widt="25%" bgcolor=#ABEBC6></th>
				<th widt="25%" bgcolor=yellow><font size=2>TOTAL</font></th>
							
			</thead>
		
			<tbody>
				<?php VerMoraTotal(); ?>
			</tbody>
			 <thead>
				
				<th widt="100%" bgcolor=yellow>DETALLE </th>
										
			</thead>
			<tbody>
				<?php VerMoraDetalle(); ?>
			</tbody>
	
		</table><BR>
	
		Ingrese operador a consultar  &nbsp;&nbsp;RECUPERADOR: <select name="recup" id="recup"><option value=0><?php echo VerUsuario($recup); ?></option><?php echo VerRecuperador();?></select>
			&nbsp;&nbsp;&nbsp;<input type="submit" name="btn_ver" value="Ver">
		
			<!--<font color=blue><b>DETALLE DE MORA ASIGNADA</b></font><BR>-->
			<h1>DETALLE DE MORA OBJETIVO ASIGNADA A LEVANTAR</h1>
			<table width="30%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				
				
				<th widt="5%" bgcolor=#ABEBC6>MORA ASIGNADA</th>
				<th widt="5%" bgcolor=violet>MORA COBRADA</th>
				<th widt="5%" bgcolor=orange>MORA FALTANTE AL OBJETIVO</th>
				
				
			 
			</thead>
		
			
	
		</table><br>

		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				
				<th widt="10%" bgcolor=#85C1E9></th>
				<th widt="5%" bgcolor=#ABEBC6>TOTAL</th>
				<th widt="5%" bgcolor=#ABEBC6>OF</th>
				<th widt="5%" bgcolor=#ABEBC6>COB</th>
				<th widt="5%" bgcolor=#ABEBC6>TAR</th>
				<th widt="5%" bgcolor=#ABEBC6>BCO</th>
				<th widt="5%" bgcolor=#ABEBC6>POL</th>
				<th widt="10%" bgcolor=RED></th>
				<th widt="5%" bgcolor=violet>TOTAL</th>
				<th widt="5%" bgcolor=violet>OF</th>
				<th widt="5%" bgcolor=violet>COB</th>
				<th widt="5%" bgcolor=violet>TAR</th>
				<th widt="5%" bgcolor=violet>BCO</th>
				<th widt="5%" bgcolor=violet>POL</th>
				<th widt="10%" bgcolor=RED></th>
				<th widt="5%" bgcolor=orange>TOTAL</th>
				<th widt="5%" bgcolor=orange>OF</th>
				<th widt="5%" bgcolor=orange>COB</th>
				<th widt="5%" bgcolor=orange>TAR</th>
				<th widt="5%" bgcolor=orange>BCO</th>
				<th widt="5%" bgcolor=orange>POL</th>

			 
			</thead>
		
			<tbody>
				<?php VerMora($recup); ?>
			</tbody>
	
		</table>
<!--<h2>EVOLUCION COBRANZA MORA</h2>		
<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
	<thead>
				
				<th widt="50%" bgcolor=#85C1E9></th>
				<th widt="25%" bgcolor=#ABEBC6>TOTAL</th>
				<th widt="25%" bgcolor=#ABEBC6>Oficina</th>
				<th widt="25%" bgcolor=#ABEBC6>Cobrador</th>
				<th widt="25%" bgcolor=#ABEBC6>Tarjeta</th>
				<th widt="25%" bgcolor=#ABEBC6>Banco</th>
				<th widt="25%" bgcolor=#ABEBC6>Policia</th>

			
			</thead>
		
			<tbody>
				<?php //VerMoraActu($recup); ?>
			</tbody>
	
		</table>-->
	<p><input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_salir" value="SALIR" onclick="location.href = 'abm.php'">

	</p>		
</form>
	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php
function VerMoraTotal(){
if ((isset($_REQUEST['btn_consultar'])or(isset($_REQUEST['btn_ver'])))){	

	$anio=$_REQUEST['anio'];
	$mes=$_REQUEST['mes'];
	$vista=$_REQUEST['vista'];
	$total_atra=0;
	$total_gral=0;
	
	$total_recup=0;
	$total_rein=0;
	$por_recup=0;
	$por_atra=0;
	$por_recup1=0;
	$por_atra1=0;
	
	$envio=null;
	$estado=0;
	$can_atra=0;
	$can_recup=0;
	$can_rein=0;
	
	$archivo='mora_'.strtolower($mes);
	
	$rows = Otro::getOtro(8,$archivo,0);
		
	foreach ($rows as $row) {

		switch ($row['FORMA_PAGO']) {
				
				case 'RECUPERACION':$total_recup=$total_recup+$row['DEUDA'];$can_recup=$can_recup+1; break;
				case 'REINCIDENTE':$total_rein=$total_rein+$row['DEUDA'];$can_rein=$can_rein+1; break;
				default: $total_atra=$total_atra+$row['DEUDA'];$can_atra=$can_atra+1;break;
			}

	}
$total_gral=$total_atra+$total_recup+$total_rein;
$total_can=$can_recup+$can_atra+$can_rein;
$total_rec=$total_recup+$total_rein;
$can_rec=$can_recup+$can_rein;


$por_recup=round(($total_rec*100)/$total_gral);
$por_atra=round(($total_atra*100)/$total_gral);
$por_recup1=round(($can_rec*100)/$total_can);
$por_atra1=round(($can_atra*100)/$total_can);
if($vista==0){
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><font size=3><b>".$mes.$anio."</font></b></td>	
			  		<td  ><font size=3><b>$ ".$total_atra."</font></b></td>
			  		<td  ><font size=3><b>".$por_atra." %</font></b></td>
			  		<td  ><font size=3><b>$ ".$total_rec."</font></b></td>
			  		<td  ><font size=3><b>".$por_recup." %</font></b></td>
			  		<td bgcolor=yellow><font size=3><b>$ ".$total_gral."</font></b></td>
	  	</tr>";	
}
else{	
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><font size=3><b>".$mes.$anio."</font></b></td>	
			  		<td  ><font size=3><b> ".$can_atra."</font></b></td>
			  		<td  ><font size=3><b>".$por_atra1." %</font></b></td>
			  		<td  ><font size=3><b> ".$can_recup."</font></b></td>
			  		<td  ><font size=3><b>".$por_recup1." %</font></b></td>
			  		<td bgcolor=yellow><font size=3><b> ".$total_can."</font></b></td>
	  	</tr>";	
	}  	

}
}
function VerMoraDetalle(){
if ((isset($_REQUEST['btn_consultar']))or(isset($_REQUEST['btn_ver']))){	

	$anio=$_REQUEST['anio'];
	$mes=$_REQUEST['mes'];
	$vista=$_REQUEST['vista'];
	$total_atrapa=0;
	$total_gralpa=0;
	$total_atrape=0;
	$total_gralpe=0;
	$total_atrasa=0;
	$total_gralsa=0;


	$total=0;
	$totalc=0;
	
	$total_recuppa=0;
	$por_recuppa=0;
	$por_atrapa=0;
	$can_recpa=0;
	$can_atpa=0;
	$can_recpe=0;
	$can_atpe=0;
	$can_recsp=0;
	$can_atsp=0;
	$can_rec=0;
	$can_at=0;
	$total_recuppe=0;
	$por_recuppe=0;
	$por_atrape=0;
	$total_recupsa=0;
	$por_recupsa=0;
	$por_atrasa=0;
	$por_pal=0;
	$por_pe=0;
	$por_sp=0;
	$por_re=0;
	$total_canpa=0;
	
	
	$estado=0;
	
	$archivo='mora_'.strtolower($mes);
	
		$rows = Otro::getOtro(10,$archivo,0);
		$row = $rows->fetch();
		$total=$row["total"];
		$rows = Otro::getOtro(14,$archivo,0);
		$totalc=$rows->rowCount();	
	
	$zona='L';
	$rows = Otro::getOtro(9,$archivo,$zona);
		
	foreach ($rows as $row) {
		switch ($row['FORMA_PAGO']) {
				
				case 'RECUPERACION':$total_recuppa=$total_recuppa+$row['DEUDA']; $can_recpa=$can_recpa+1;break;
				case 'REINCIDENTE':$total_recuppa=$total_recuppa+$row['DEUDA']; $can_recpa=$can_recpa+1;break;
				default: $total_atrapa=$total_atrapa+$row['DEUDA'];$can_atpa=$can_atpa+1;break;
		}

	}
		
if ($vista==0){	
	$total_gralpa=$total_atrapa+$total_recuppa;
	$por_recuppa=round(($total_recuppa*100)/$total);
	$por_atrapa=round(($total_atrapa*100)/$total);
	$por_pal=round(($total_gralpa*100)/$total);
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>PALPALA</b></td>	
			  		<td  ><b>$ ".$total_atrapa."</b></td>
			  		<td  ><b>".$por_atrapa." %</b></td>
			  		<td  ><b>$ ".$total_recuppa."</b></td>
			  		<td  ><b>".$por_recuppa." %</b></td>
			  		<td bgcolor=yellow><b>$ ".$total_gralpa.' ->'.$por_pal." %</b></td>
</tr>";	
}
else{
	
	$total_canpa=$can_atpa+$can_recpa;
	$por_recuppa=round(($can_recpa*100)/$totalc);
	$por_atrapa=round(($can_atpa*100)/$totalc);
	$por_pal=round(($total_canpa*100)/$totalc);
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>PALPALA</b></td>	
			  		<td  ><b> ".$can_atpa."</b></td>
			  		<td  ><b>".$por_atrapa." %</b></td>
			  		<td  ><b> ".$can_recpa."</b></td>
			  		<td  ><b>".$por_recuppa." %</b></td>
			  		<td bgcolor=yellow><b> ".$total_canpa.' ->'.$por_pal." %</b></td>
	</tr>";	

}	

$zona='R';
	$rows = Otro::getOtro(9,$archivo,$zona);
		
	foreach ($rows as $row) {

		switch ($row['FORMA_PAGO']) {
				
				case 'RECUPERACION':$total_recuppe=$total_recuppe+$row['DEUDA'];$can_recpe=$can_recpe+1; break;
				case 'REINCIDENTE':$total_recuppe=$total_recuppe+$row['DEUDA'];$can_recpe=$can_recpe+1; break;
				default: $total_atrape=$total_atrape+$row['DEUDA'];$can_atpe=$can_atpe+1;break;
			}

	}
if ($vista==0){	
	$total_gralpe=$total_atrape+$total_recuppe;
	$por_recuppe=round(($total_recuppe*100)/$total);
	$por_atrape=round(($total_atrape*100)/$total);
	$por_pe=round(($total_gralpe*100)/$total);
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>PERICO</b></td>	
			  		<td  ><b>$ ".$total_atrape."</b></td>
			  		<td  ><b>".$por_atrape." %</b></td>
			  		<td  ><b>$ ".$total_recuppe."</b></td>
			  		<td  ><b>".$por_recuppe." %</b></td>
			  		<td bgcolor=yellow><b>$ ".$total_gralpe.' ->'.$por_pe." %</b></td>
</tr>";	
}
else{
	
	$total_canpe=$can_atpe+$can_recpe;
	$por_recuppe=round(($can_recpe*100)/$totalc);
	$por_atrape=round(($can_atpe*100)/$totalc);
	$por_pe=round(($total_canpe*100)/$totalc);
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>PERICO</b></td>	
			  		<td  ><b> ".$can_atpe."</b></td>
			  		<td  ><b>".$por_atrape." %</b></td>
			  		<td  ><b> ".$can_recpe."</b></td>
			  		<td  ><b>".$por_recuppe." %</b></td>
			  		<td bgcolor=yellow><b> ".$total_canpe.' ->'.$por_pe." %</b></td>
	</tr>";	

}	
	/*$total_gralpe=$total_atrape+$total_recuppe;
	$por_recuppe=round(($total_recuppe*100)/$total);
	$por_atrape=round(($total_atrape*100)/$total);
	$por_pe=round(($total_gralpe*100)/$total);	


echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>PERICO</b></td>	
			  		<td  ><b>$ ".$total_atrape."</b></td>
			  		<td  ><b>".$por_atrape." %</b></td>
			  		<td  ><b>$ ".$total_recuppe."</b></td>
			  		<td  ><b>".$por_recuppe." %</b></td>
			  		<td bgcolor=yellow><b>$ ".$total_gralpe.' ->'.$por_pe." %</b></td>
			  		
			  	
</tr>";	*/

$zona='P';
	$rows = Otro::getOtro(9,$archivo,$zona);
		
	foreach ($rows as $row) {

		switch ($row['FORMA_PAGO']) {
				
				case 'RECUPERACION':$total_recupsa=$total_recupsa+$row['DEUDA'];$can_recsp=$can_recsp+1; break;
				case 'REINCIDENTE':$total_recupsa=$total_recupsa+$row['DEUDA'];$can_recsp=$can_recsp+1; break;
				default: $total_atrasa=$total_atrasa+$row['DEUDA'];$can_atsp=$can_atsp+1;break;
			}

	}
if ($vista==0){	
	$total_gralsa=$total_atrasa+$total_recupsa;
	$por_recupsa=round(($total_recupsa*100)/$total);
	$por_atrasa=round(($total_atrasa*100)/$total);
	$por_sp=round(($total_gralsa*100)/$total);
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>SAN PEDRO</b></td>	
			  		<td  ><b>$ ".$total_atrasa."</b></td>
			  		<td  ><b>".$por_atrasa." %</b></td>
			  		<td  ><b>$ ".$total_recupsa."</b></td>
			  		<td  ><b>".$por_recupsa." %</b></td>
			  		<td bgcolor=yellow><b>$ ".$total_gralsa.' ->'.$por_sp." %</b></td>
</tr>";	
}
else{
	
	$total_cansp=$can_atsp+$can_recsp;
	$por_recupsa=round(($can_recsp*100)/$totalc);
	$por_atrasa=round(($can_atsp*100)/$totalc);
	$por_sp=round(($total_cansp*100)/$totalc);
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>SAN PEDRO</b></td>	
			  		<td  ><b> ".$can_atsp."</b></td>
			  		<td  ><b>".$por_atrasa." %</b></td>
			  		<td  ><b> ".$can_recsp."</b></td>
			  		<td  ><b>".$por_recupsa." %</b></td>
			  		<td bgcolor=yellow><b> ".$total_cansp.' ->'.$por_sp." %</b></td>
	</tr>";	

}	
/*$total_gralsa=$total_atrasa+$total_recupsa;
$por_recupsa=round(($total_recupsa*100)/$total);
$por_atrasa=round(($total_atrasa*100)/$total);
$por_sp=round(($total_gralsa*100)/$total);

echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>SAN PEDRO</b></td>	
			  		<td  ><b>$ ".$total_atrasa."</b></td>
			  		<td  ><b>".$por_atrasa." %</b></td>
			  		<td  ><b>$ ".$total_recupsa."</b></td>
			  		<td  ><b>".$por_recupsa." %</b></td>
			  		<td bgcolor=yellow><b>$ ".$total_gralsa.' ->'.$por_sp." %</b></td>
			  		
			  	
</tr>";*/
$rows = Usuario::getUsuario(11,0);
if($rows->rowCount()!=0){	
	foreach ($rows as $row) {
		$rec=$row['usu_ide'];

		$total_atrare=0;
		$total_gralre=0;
		$por_re=0;
		$can_rec=0;
		$can_atra=0;

		$total_recupre=0;
		$por_recupre=0;
		$por_atrare=0;

		$rows = Otro::getOtro(11,$archivo,$rec);
		
	foreach ($rows as $row) {

		switch ($row['FORMA_PAGO']) {
				
				case 'RECUPERACION':$total_recupre=$total_recupre+$row['DEUDA']; $can_rec=$can_rec+1;break;
				case 'REINCIDENTE':$total_recupre=$total_recupre+$row['DEUDA']; $can_rec=$can_rec+1;break;
				default: $total_atrare=$total_atrare+$row['DEUDA'];$can_atra=$can_atra+1;break;
			}

	}
if ($vista==0){
	$total_gralre=$total_atrare+$total_recupre;
	$por_recupre=round(($total_recupre*100)/$total);
	$por_atrare=round(($total_atrare*100)/$total);
	$por_re=round(($total_gralre*100)/$total);
	$nom=VerUsuario($rec);
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>".$nom."</b></td>	
			  		<td  ><b>$ ".$total_atrare."</b></td>
			  		<td  ><b>".$por_atrare." %</b></td>
			  		<td  ><b>$ ".$total_recupre."</b></td>
			  		<td  ><b>".$por_recupre." %</b></td>
			  		<td bgcolor=yellow><b>$ ".$total_gralre.' ->'.$por_re." %</b></td>
	</tr>";
}
else{
	$total_gralre=$can_atra+$can_rec;
	$por_recupre=round(($can_rec*100)/$totalc);
	$por_atrare=round(($can_atra*100)/$totalc);
	$por_re=round(($total_gralre*100)/$totalc);
	$nom=VerUsuario($rec);
	echo "<tr>
			  		<td style='text-align:center;' bgcolor=#85C1E><b>".$nom."</b></td>	
			  		<td  ><b> ".$can_atra."</b></td>
			  		<td  ><b>".$por_atrare." %</b></td>
			  		<td  ><b> ".$can_rec."</b></td>
			  		<td  ><b>".$por_recupre." %</b></td>
			  		<td bgcolor=yellow><b> ".$total_gralre.' ->'.$por_re." %</b></td>
	</tr>";	
}

}
}
}

}

function VerMora($recup){
//echo 'romina';*
if (isset($_REQUEST['btn_ver'])){	
	
	$anio=$_REQUEST['anio'];
	//$mes=$_R['mes'];
	$mes=$_REQUEST['mes'];
	$vista=$_REQUEST['vista'];

	
	$total_ofi=0;
	$total_cob=0;
	$total_bco=0;
	$total_tar=0;
	$total_pol=0;
	$can_ofi=0;
	$can_cob=0;
	$can_bco=0;
	$can_tar=0;
	$can_pol=0;
	$can_rec=0;
	$can_recac=0;
	$can_ofiac=0;
	$can_cobac=0;
	$can_bcoac=0;
	$can_tarac=0;
	$can_polac=0;
	$total_ofiac=0;
	$total_cobac=0;
	$total_bcoac=0;
	$total_tarac=0;
	$total_polac=0;
	$total_recac=0;
	$total_ofidif=0;
	$total_cobdif=0;
	$total_bcodif=0;
	$total_tardif=0;
	$total_poldif=0;
	$total=0;
	
	$ventas=0;
	$total_recup=0;
	$ventas_efec=0;
	$vtas_caidas=0;
	$envio=null;
	$estado=0;
	
	$archivo='mora_'.strtolower($mes);
	

	if ($recup=='TODAS'){$rows = Otro::getOtro(14,$archivo,0);}
	else{
			switch ($recup) {
				case 'L': $rows = Otro::getOtro(9,$archivo,$recup);break;
				case 'R': $rows = Otro::getOtro(9,$archivo,$recup);break;
				case 'P': $rows = Otro::getOtro(9,$archivo,$recup);break;
				
				default:$rows = Otro::getOtro(5,$archivo,$recup);break;
			}
		
	}	
	
	foreach ($rows as $row) {

		switch ($row['FORMA_PAGO']) {
				case 'TARJETA':$total_tar=$total_tar+$row['DEUDA']; if ($row['ESTADO']==1){$total_tarac=$total_tarac+$row['DEUDA'];$can_tarac=$can_tarac+1;}; $can_tar=$can_tar+1;break;
				case 'BANCO':$total_bco=$total_bco+$row['DEUDA']; if ($row['ESTADO']==1){$total_bcoac=$total_bcoac+$row['DEUDA'];$can_bcoac=$can_bcoac+1;}; $can_bco=$can_bco+1;break;
				case 'POLICIA':$total_pol=$total_pol+$row['DEUDA']; if ($row['ESTADO']==1){$total_polac=$total_polac+$row['DEUDA'];$can_polac=$can_polac+1;}; $can_pol=$can_pol+1;break;
				case 'COBRADOR':$total_cob=$total_cob+$row['DEUDA']; if ($row['ESTADO']==1){$total_cobac=$total_cobac+$row['DEUDA'];$can_cobac=$can_cobac+1;};$can_cob=$can_cob+1;break;
				case 'OFICINA':$total_ofi=$total_ofi+$row['DEUDA']; if ($row['ESTADO']==1){$total_ofiac=$total_ofiac+$row['DEUDA'];$can_ofiac=$can_ofiac+1;}; $can_ofi=$can_ofi+1;break;
				case 'RECUPERACION':$total_recup=$total_recup+$row['DEUDA']; if ($row['ESTADO']==1){$total_recac=$total_recac+$row['DEUDA'];$can_recac=$can_recac+1;};$can_rec=$can_rec+1; break;
				case 'REINCIDENTE':$total_recup=$total_recup+$row['DEUDA']; if ($row['ESTADO']==1){$total_recac=$total_recac+$row['DEUDA'];$can_recac=$can_recac+1;};$can_rec=$can_rec+1; break;
				default:break;
			}

	}
	if ($vista==0){
		$total_ofidif=$total_ofi-$total_ofiac;
		$total_cobdif=$total_cob-$total_cobac;
		$total_bcodif=$total_bco-$total_bcoac;
		$total_tardif=$total_tar-$total_tarac;
		$total_poldif=$total_pol-$total_polac;
		$total_gral=$total_tar+$total_ofi+$total_cob+$total_bco+$total_pol;
		$total_gralac=$total_tarac+$total_ofiac+$total_cobac+$total_bcoac+$total_polac;
		$total_graldif=$total_gral-$total_gralac;
		$total=$total_recup+$total_gral;
		$totalrec=$total_recup-$total_recac;
		$totalac=$total_recac+$total_gralac;
		$totaldif=$total-$totalac;
		echo "<tr>
			  		<td style='text-align:center;'><b>ATRAS</b></td>	
			  		
			  		<td  bgcolor=#ABEBC6><b>$ ".$total_gral."</b></td>

			  		<td  >$ ".$total_ofi."</td>
			  		<td  >$ ".$total_cob."</td>
			  		<td  >$ ".$total_tar."</td>
			  		<td  >$ ".$total_bco."</td>
			  		<td  >$ ".$total_pol."</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		
			  		<td  bgcolor=violet><b>$ ".$total_gralac."</b></td>
			  		<td  >$ ".$total_ofiac."</td>
			  		<td  >$ ".$total_cobac."</td>
			  		<td  >$ ".$total_tarac."</td>
			  		<td  >$ ".$total_bcoac."</td>
			  		<td  >$ ".$total_polac."</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		<td  bgcolor=orange><b>$ ".$total_graldif."</b></td>
			  		<td  >$ ".$total_ofidif."</td>
			  		<td  >$ ".$total_cobdif."</td>
			  		<td  >$ ".$total_tardif."</td>
			  		<td  >$ ".$total_bcodif."</td>
			  		<td  >$ ".$total_poldif."</td> 	

			  	
			  	</tr>";	
echo "<tr>
			  		<td style='text-align:center;'><b>RECUP</a></b></td>	

			  	
			  		<td  bgcolor=#ABEBC6><b>$ ".$total_recup."</b></td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		<td  bgcolor=violet><b>$ ".$total_recac."</b></td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		<td  bgcolor=orange><b>$ ".$totalrec."</b></td>
			  	</tr>";	
echo "<tr>
	  		<td bgcolor=yellow style='text-align:center;'><b>TOT.MORA</b></td>	
	  		<td bgcolor=#ABEBC6><b>$ ".$total."</b></td>
	  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		<td  bgcolor=violet><b>$ ".$totalac."</b></td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		<td  bgcolor=orange><b>$ ".$totaldif."</b></td>
			  	</tr>";	
	}
	else{
		$total_ofidif=$can_ofi-$can_ofiac;
		$total_cobdif=$can_cob-$can_cobac;
		$total_bcodif=$can_bco-$can_bcoac;
		$total_tardif=$can_tar-$can_tarac;
		$total_poldif=$can_pol-$can_polac;
		$total_gral=$can_tar+$can_ofi+$can_cob+$can_bco+$can_pol;
		$total_gralac=$can_tarac+$can_ofiac+$can_cobac+$can_bcoac+$can_polac;
		$total_graldif=$total_gral-$total_gralac;
		$total=$can_rec+$total_gral;
		$totalrec=$can_rec-$can_recac;
		$totalac=$can_recac+$total_gralac;
		$totaldif=$total-$totalac;	
	
echo "<tr>
			  		<td style='text-align:center;'><b>ATRAS</b></td>	
			  		<td  bgcolor=#ABEBC6><a href='ver-detalle.php?recup=".$recup."&accion=ATRASADO&estado=2&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$total_gral."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=OFICINA&estado=2&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_ofi."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=COBRADOR&estado=2&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_cob."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=TARJETA&estado=2&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_tar."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=BANCO&estado=2&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_bco."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=POLICIA&estado=2&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_pol."</a></b></td>
			  		<td bgcolor=red>&nbsp;</td>
			  		
			  		<td  bgcolor=violet><a href='ver-detalle.php?recup=".$recup."&accion=ATRASADO&estado=1&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b>".$total_gralac."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=OFICINA&estado=1&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_ofiac."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=COBRADOR&estado=1&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_cobac."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=TARJETA&estado=1&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_tarac."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=BANCO&estado=1&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_bcoac."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=POLICIA&estado=1&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_polac."</a></b></td>
			  		<td bgcolor=red>&nbsp;</td>
			  		
			  		<td  bgcolor=orange><a href='ver-detalle.php?recup=".$recup."&accion=ATRASADO&estado=0&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$total_graldif."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=OFICINA&estado=0&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$total_ofidif."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=COBRADOR&estado=0&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$total_cobdif."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=TARJETA&estado=0&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$total_tardif."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=BANCO&estado=0&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$total_bcodif."</a></b></td>
			  		
			  		<td  ><a href='ver-detalle.php?recup=".$recup."&accion=POLICIA&estado=0&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$total_poldif."</a></b></td>

			  	
			  	</tr>";	
echo "<tr>
			  		<td style='text-align:center;'><b>RECUP</a></b></td>	

			  		<td  bgcolor=#ABEBC6><a href='ver-detalle.php?recup=".$recup."&accion=RECUPERACION&estado=2&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_rec."</a></b></td>
			  		
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		
			  		<td  bgcolor=violet><a href='ver-detalle.php?recup=".$recup."&accion=RECUPERACION&estado=1&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$can_recac."</a></b></td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		
			  		<td  bgcolor=orange xdiff_file_bdiff(old_file, new_file, dest)><a href='ver-detalle.php?recup=".$recup."&accion=RECUPERACION&estado=0&archivo=".$archivo."&mes=".$mes."&anio=".$anio."&vista=".$vista."'><b> ".$totalrec."</a></b></td>
			  	</tr>";	
echo "<tr>
	  		<td bgcolor=yellow style='text-align:center;'><b>TOT.MORA</b></td>	
	  		<td bgcolor=#ABEBC6><b> ".$total."</b></td>
	  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		<td  bgcolor=violet><b> ".$totalac."</b></td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td >&nbsp;</td>
			  		<td bgcolor=red>&nbsp;</td>
			  		<td  bgcolor=orange><b> ".$totaldif."</b></td>
			  	</tr>";	

}
}
}

function VerMoraActu($recup){
//echo 'romina';*
if (isset($_REQUEST['btn_ver'])){	
	
	$anio=$_REQUEST['anio'];
	//$mes=$_R['mes'];
	$mes=$_REQUEST['mes'];

	
	$total_ofi=0;
	$total_cob=0;
	$total_bco=0;
	$total_tar=0;
	$total_pol=0;
	$total=0;
	
	$ventas=0;
	$total_recup=0;
	$ventas_efec=0;
	$vtas_caidas=0;
	$envio=null;
	
	$archivo='mora_'.strtolower($mes);
	 $estado=1;

/*	if ($recup=='TODAS'){$rows = Otro::getOtro(4,$archivo,$estado);}
	else{$rows = Otro::getOtro(7,$archivo,$recup);}	*/

	switch ($recup) {
				case 'L': $rows = Otro::getOtro(12,$archivo,$recup);break;
				case 'P': $rows = Otro::getOtro(12,$archivo,$recup);break;
				case 'R': $rows = Otro::getOtro(12,$archivo,$recup);break;
				case 'TODAS': $rows = Otro::getOtro(4,$archivo,$estado); break;
				default: $rows = Otro::getOtro(7,$archivo,$recup);break;
			}	


	
	foreach ($rows as $row) {

		switch ($row['FORMA_PAGO']) {
				case 'TARJETA':$total_tar=$total_tar+$row['DEUDA']; break;
				case 'BANCO':$total_bco=$total_bco+$row['DEUDA']; break;
				case 'POLICIA':$total_pol=$total_pol+$row['DEUDA']; break;
				case 'COBRADOR':$total_cob=$total_cob+$row['DEUDA']; break;
				case 'OFICINA':$total_ofi=$total_ofi+$row['DEUDA']; break;
				case 'RECUPERACION':$total_recup=$total_recup+$row['DEUDA']; break;
				default:break;
			}

	}
	$total_gral=$total_tar+$total_ofi+$total_cob+$total_bco+$total_pol;
	$total=$total_recup+$total_gral;
echo "<tr>
			  		<td style='text-align:center;'><b>ATRASADOS</b></td>	
			  		<td  ><b>$ ".$total_gral."</b></td>
			  		<td  >$ ".$total_ofi."</td>
			  		<td  >$ ".$total_cob."</td>
			  		<td  >$ ".$total_tar."</td>
			  		<td  >$ ".$total_bco."</td>
			  		<td  >$ ".$total_pol."</td>
			  	
			  	</tr>";	
echo "<tr>
			  		<td style='text-align:center;'><b>RECUPERACIONES</b></td>	
			  		<td  ><b>$ ".$total_recup."</b></td>
			  		
			  	
			  	</tr>";	
echo "<tr>
	  		<td bgcolor=yellow style='text-align:center;'><b>TOTAL MORA</b></td>	
	  		<td bgcolor=yellow><b>$ ".$total."</b></td>
			  	</tr>";	




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


function Traerpago($afiliado,$mes,$anio,$grupo){
	$envio='NO';
	$total=0;
	if ($grupo==1000){$rows = Pagos::getPagos2(1,$afiliado,$mes,$anio);	}
	else{$rows = Pagos::getPagos2(0,$afiliado,$mes,$anio);
		$total=$rows->rowCount();
		if ($total==0){$rows = Pagos::getPagos2(1,$afiliado,$mes,$anio);}
	}
	
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {
			$envio='SI';
		}
	}
	
	return ($envio);
	
}


function Traer ($mes){


	switch ($mes) {
		case 1:$mes='ENERO'; break;
		case 2:$mes='FEBRERO';break;
		case 3:$mes='MARZO'; break;
		case 4:$mes='ABRIL'; break;
		case 5:$mes='MAYO'; break;
		case 6:$mes='JUNIO'; break;
		case 7:$mes='JULIO'; break;
		case 8:$mes='AGOSTO'; break;
		case 9:$mes='SEPTIEMBRE'; break;
		case 10:$mes='OCTUBRE'; break;
		case 11:$mes='NOVIEMBRE'; break;
		case 12:$mes='DICIEMBRE'; break;
		
	}

return($mes);
}
function VerRecuperador(){

	$usu=$_SESSION["usu_ide"];

	$rows = Usuario::getUsuario(3,$usu);
		foreach ($rows as $row) {
		$perfil=$row['usu_perfil'];
		$estado=$row['usu_estado'];
		$nombre=$row['usu_apellido']." ".$row['usu_nombre'];
    }
    
   
    if (($perfil=='RECUPERADOR')  ){
    	
		echo "<option value='".$usu."'>".$nombre."</option>";
    }
    else{
    		$rows = Usuario::getUsuario(11,0);
			//echo "<option value= '".$nom."' selected='selected'>".$nom."</option>";
			echo "<option value='TODAS'>TODAS</option>";
			foreach ($rows as $row) {
			
			echo "<option value='".$row['usu_ide']."'>".$row['usu_apellido']." ".$row['usu_nombre']."</option>";
			}
    }
    echo "<option value='L'>PALPALA</option>";
    echo "<option value='R'>PERICO</option>";
    echo "<option value='P'>SAN PEDRO</option>";
    
}
function VerUsuario($recup){
	
	switch ($recup) {
				case 'L':$recup='PALPALA';return $recup; break;
				case 'P':$recup='SAN PEDRO';return $recup;break;
				case 'R':$recup='PERICO';return $recup; break;
				case 'TODAS':return $recup; break;
				default: $rows = Usuario::getUsuario(3,$recup);
						foreach ($rows as $row) {
							return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
						} break;
			}


	/*if ($recup=='TODAS')or{return $recup;}
	else{	
			$rows = Usuario::getUsuario(3,$recup);
			foreach ($rows as $row) {
			return strtoupper($row['usu_apellido']." ".$row['usu_nombre']);
			}
		}	*/
}
?>