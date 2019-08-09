<?php
		include "config.php";

		include "info.php"; 
		include "libs/class/maestro.class.php";
		include "libs/class/usuario.class.php";
		include "libs/class/prestamo.class.php";
		require('libs/pdf_generador/fpdf.php');
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Impresion Solicitud</title>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<script src="libs/js/jquery-1.7.2.js"></script>
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
		  div {
      padding: 5px;
      background-color: #DEE1E4;
    }

		.right{
			float: right;
		}


	</style>

</head>
<?php
	$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$usu=$_SESSION['usu_ide'];

	//$afi=68368;
	$afi=$_GET['afiliado'];
	
	$cuotas=3;
	$empre='W';	
	if ($empre='W'){$rows = Maestro::getMaestro(7,$afi);}
	$row = $rows->fetch();
	$calle = $row['CALLE'];
	$nro = $row['NRO_CALLE'];
	$barrio = $row['BARRIO'];
	$fecha = $row['ALTA'];
	$loc = $row['LOCALIDAD'];
	$tel = $row['TELEFONO'];
	$cel =$row['MOVIL'];
	$domlab =$row['DOM_LAB'];
	$domcob =$row['DOMI_COBR'];
//	$mail = $row['MAIL'];
	
/*class PDF extends FPDF
{
function Header()	{

}
}
$pdf = new PDF('L', 'mm', 'A4');
//$pdf = new FPDF('L','mm','A4');
$pdf->AliasNbPages();
$pdf->AddPage();*/

?>

<body>
	
<!--	<div id="contenido">-->
		<input type="hidden" name="ptm_id" value="<?php echo $_GET['ptm_id']; ?>">
		
		<!--<div id="doctip"><center><h2>SOLICITUD DE INGRESO</h2></center></div>-->
		<p><img src="libs/img/tit.png"/>	</p>
		<font size=3><b>AFILIADO Nº:&nbsp;<input type="texto" name="afi" value="<?php echo $afi;?>" size="5px" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		FECHA:&nbsp;<input type="date" name="fechac" value="<?php echo $fecha; ?>" size="8px" disabled> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		COD:&nbsp;<input type="texto" name="afi" value="<?php echo $usu;?>" size="3px" disabled><BR> 
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</b></font>
		<br>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%" bgcolor=#85C1E9>Apellido y Nombre</th>
				<th widt="5%" bgcolor=#85C1E9>Edad</th>
				<th widt="5%" bgcolor=#85C1E9>Fecha Nac.</th>
				<th widt="5%" bgcolor=#85C1E9>DNI</th>
				<th widt="5%" bgcolor=#85C1E9>Parentesco</th>
				<th widt="5%" bgcolor=#85C1E9>O.Social</th>
				<th widt="5%" bgcolor=#85C1E9>Subsidio</th>
				<th widt="5%" bgcolor=#85C1E9>Traslado</th>
				<th widt="5%" bgcolor=#85C1E9>Vigencia</th>
			</thead>
			<thead>
				<!--<th widt="5%" >Apellido y Nombre</th>-->
				<?php VerTitular(); ?>
			<thead>	
		</table>

		
		<hr color=#85C1E9 size=2>
		<div style="font-size:0.6em;"><b>DOMICILIO</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Calle:&nbsp;<b> <?php echo strtoupper($calle);?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nº:&nbsp;<b><?php echo $nro;?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bº:&nbsp;<b><?php echo $barrio;?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Loc:&nbsp;<b><?php echo $loc;?></b>&nbsp;&nbsp;&nbsp;Tel:&nbsp;<b><?php echo $tel;?></b><br><b>PARTICULAR</b>
		</div>	
		<hr color=#85C1E9 size=2>
		<div style="font-size:0.6em;">Celular:&nbsp;<b><?php echo $cel;?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
		Claro<input type="radio" name="empresa" value="C">&nbsp;
		Personal<input type="radio" name="empresa" value="P">&nbsp;
		Movistar<input type="radio" name="empresa" value="M">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		PROPIETARIO<input type="radio" name="dclio" value="P">&nbsp;
		ALQUILA<input type="radio" name="dclio" value="A">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Lugar de Trabajo:&nbsp;<b><?php echo $domlab;?></b>&nbsp;&nbsp;&nbsp;	</div>
		
		<hr color=#85C1E9 size=2>
		<div style="font-size:0.6em;">DEBITO BANCARIO<input type="radio" name="pago" value="DT">&nbsp;
		TARJETA<input type="radio" name="pago" value="TT">&nbsp;
		CONVENIO<input type="radio" name="pago" value="CN" checked>&nbsp;
		COB.A DOMICILIO<input type="radio" name="pago" value="CB">&nbsp;
		EN EL TRABAJO<input type="radio" name="pago" value="TR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<!-- Mail:&nbsp;<b><?php echo $mail;?></b> -->
		</div>
		<hr color=#85C1E9 size=2>

		<div style="font-size:0.6em;"><b>DOMICILIO</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><?php echo $domcob;?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DIAS DE COBRANZA (Vencimiento: 15 c/mes)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;hs:&nbsp;&nbsp;<br>
		<b>COBRANZA</b>
		</div>	
		<hr color=#85C1E9 size=2>
		<br>
		<table width="70%" border=0 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th align="justify">Werchow Servicios Sociales S.R.L. no es Compañia de Seguros, Obra Social, o Medicina Prepaga. Todos los afiliados que figuran en la presente declaran conocer y aceptar los planes de Werchow Servicio Sociales S.R.L.. Para la utilización de los servicios, los afiliados deberán exhibir el carnet de la empresa y la constancia de pago del mes en curso</th>
			</thead>
		</table><br>
		<p style="font-size:0.6em;">OBSERVACIONES:___________________________________________________________________________________________________________________________________________________________________<BR><br>
		___________________________________________________________________________________________________________________________________________________________________________________</p> 
		<table width="70%" border=0 style="border-collapse:collapse; font-size:0.6em;"  >
			<thead>
				<th align="justify">Programa de fidelización: El presente programa tiene como destinatarios a todos los AFILIADOS de WERCHOW SERVICIOS SOCIALES S.R.L., que cumplan con cada uno de los siguientes requisitos, sin excepción alguna: Poseer un PLAN de SERVICIOS SOCIALES, con la cuota abonada al dia, NO mantener deuda alguna con la EMPRESA y cumplir con la cantidad de cuotas abonadas (del plan de servicios sociales elegido) al día y sin retraso o mora. El Programa de Fidelización, es un programa estímulo de Beneficios que se otorgan SIN CARGO para los AFILIADOS que cumplan con los requisitos que se mencionan en el cuadro "A". SI EL AFILIADO RENUNCIARA O POR CUALQUIER OTRO MOTIVO (FALTA DE PAGO, FALSEDAD DE DATOS, OTROS INCUMPLIMIENTOS, ETC) DEJARA DE TENER LA CALIDAD DE AFILIADO, NO PODRÁ EXIGIR, DE DARSE EL SUPUESTO, LA PRESENTACIÓN DEL PREMIO CONSISTENTE EN SERVICIO DE SEPELIO, CREMACION, ETC, ES DECIR, PERDERA TODO DERECHO AL MISMO, SIN PODER EXIGIR RESTITUCIÓN DINERARIA ALGUNA A LA EMPRESA, PORQUE LA PRESENTACION DEL SERVICIO DE SEPELIO EN QUE CONSISTE EL PREMIO RESPECTIVO ESTÁ CONDICIONADA A LA PUNTUALIDAD EN EL PAGO DE LAS CUOTAS Y A LA PERMANENCIA DE LA CALIDAD DE AFILIADO</th>
				
			</thead>
		</table>
		<font size=1><B>CUADRO "A"</B></font>
		<table width="55%" border=1 style="border-collapse:collapse; font-size:0.45em;">
			<thead>
				<th widt="10%" bgcolor=#DCDCDC>EDAD</th>
				<th widt="5%" bgcolor=#DCDCDC>SCIO CLASICO S/CARGO</th>
				<th widt="5%" bgcolor=#DCDCDC>CREMACION S/CARGO</th>
				<th widt="5%" bgcolor=#DCDCDC>PARC.MUNIC S/CARGO</th>
				<th widt="5%" bgcolor=#DCDCDC>MEJORA 1 S/CARGO</th>
				<th widt="5%" bgcolor=#DCDCDC>MEJORA 2 S/CARGO</th>
				<th widt="5%" bgcolor=#DCDCDC>MEJORA 3 S/CARGO</th>
			</thead>
			<thead>
				<th widt="10%">01 a 45</th>
				<th widt="5%" >90 dìas</th>
				<th widt="5%" >90 dìas</th>
				<th widt="5%" >300 dìas</th>
				<th widt="5%" >1830 dìas</th>
				<th widt="5%" >2550 dìas</th>
				<th widt="5%" >2070 dìas</th>
			
			</thead>	
			<thead>
				<th widt="10%" >46 a 55</th>
				<th widt="5%" >150 dìas</th>
				<th widt="5%" >150 dìas</th>
				<th widt="5%" >300 dìas</th>
				<th widt="5%" >2010 dìas</th>
				<th widt="5%" >2730 dìas</th>
				<th widt="5%" >3450	 dìas</th>
			
			</thead>	
			<thead>
				<th widt="10%">56 a 60</th>
				<th widt="5%" >180 dìas</th>
				<th widt="5%" >180 dìas</th>
				<th widt="5%" >No corresponde</th>
				<th widt="5%" >2190 dìas</th>
				<th widt="5%" >2910 dìas</th>
				<th widt="5%" >3630 dìas</th>
			
			</thead>	
			<thead>
				<th widt="10%">61 a 65</th>
				<th widt="5%" >300 dìas</th>
				<th widt="5%" >300 dìas</th>
				<th widt="5%" >No corresponde</th>
				<th widt="5%" >2370 dìas</th>
				<th widt="5%" >3090 dìas</th>
				<th widt="5%" >3810 dìas</th>
			</thead>
			
		<div class="right">----------------------------------------------</div><br><br>
	<h5 class="right">FIRMA Y ACLARACION DEL TITULAR</h5>	

	
		</table>	

	<p>




		<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_volver" value="Volver" onclick="location.href = 'abm.php'">
	</p>
</form>
<?php
/*	$pdf->AddPage();	
	$pdf->Output();*/
?>
<!--</div>-->
<!--<div id="footer">
		<center>WERCHOW - Año 2018 - </center>
</div>-->

</body>
</html>
<?php
function VerTitular(){
$afi=$_GET['afiliado'];
$p='';
/*$empre=$_GET['empresa'];*/
//$afi=68368;
$empre='W';
if ($empre=='W'){
	$rows = Maestro::getMaestro(7,$afi);
	$row = $rows->fetch();
	$nom=$row['APELLIDOS'].' '.$row['NOMBRES']; 
	$adhe=$row['ADHERENTES'];
	$nac=$row['NACIMIENTO'];
	$edad=busca_edad($nac);
	$dni=$row['NRO_DOC'];
	$obra=$row['OBRA_SOC'];
	$dni=$row['NRO_DOC'];
	$plan=$row['PLAN'].$row['SUB_PLAN']; 
	//$fecha = date('Y-m-j');
	$fecha = $row['ALTA'];
	$nuevafecha = strtotime ( '+3 month' , strtotime ( $fecha ) ) ;
	$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
 }
 if ($obra==47){$p='WERCHOW';}
echo'<th widt="5%" align="left" >'.$nom.'</th>

<th widt="5%" >'.$edad.'</th>
<th widt="5%" >'.$nac.'</th>
<th widt="5%" >'.$dni.'</th>
<th widt="5%" >TITULAR</th>
<th widt="5%" >'.$p.'</th>
<th widt="5%" ></th>
<th widt="5%" >'.$plan.'</th>
<th widt="5%" >'.$fecha.'</th>
';
$cont=1;
if ($adhe>0){
	$cont=1;
	$rowsa = Maestro::getMaestro(12,$afi);
	foreach ($rowsa as $rowa) {
		$nomadh=$rowa['APELLIDOS'].' '.$rowa['NOMBRES'];
		$fecadh=$rowa['NACIMIENTO'];
		$edad2=busca_edad($fecadh);
		$dniadh=$rowa['NRO_DOC'];
		$obraadh=$rowa['OBRA_SOC'];
		$planadh=$rowa['PLAN'].$rowa['SUB_PLAN'];
		$paren=$rowa['PARENT'];
	//	$mail=$rowa['MAIL'];
		switch ($paren) {
			case 1:$ver='ESPOSO/A';	break;
			case 2:$ver='HIJO/A';	break;
			case 3:$ver='PADRE/MADRE';	break;
			default: $ver='OTRO';break;
		}
		echo'<thead><th widt="5%" align="left">'.$nomadh.'</th>
			
			<th widt="5%">'.$edad2.'</th>
			<th widt="5%">'.$fecadh.'</th>
			<th widt="5%">'.$dniadh.'</th>	
			<th widt="5%">'.$ver.'</th>	
			<th widt="5%">'.$obraadh.'</th>		
			<th widt="5%"></th>
			<th widt="5%">'.$planadh.'</th>	
			<th widt="5%">'.$nuevafecha.'</th>		
		</thead>';	
		$cont=$cont+1;
	}
	}
	while($cont<12){
		$nomadh=' - ';
		echo'<thead><th widt="5%" >'.$nomadh.'</th>
		<th widt="5%" ></th>
		<th widt="5%" ></th>
		<th widt="5%" ></th>
		<th widt="5%" ></th>
		<th widt="5%" ></th>
		<th widt="5%" ></th>
		<th widt="5%" ></th>
		<th widt="5%" ></th>
		</thead>';	

		$cont=$cont+1;
	}
//}			
}
function busca_edad($fecha_nacimiento){
$dia=date("d");
$mes=date("m");
$ano=date("Y");


$dianaz=date("d",strtotime($fecha_nacimiento));
$mesnaz=date("m",strtotime($fecha_nacimiento));
$anonaz=date("Y",strtotime($fecha_nacimiento));


//si el mes es el mismo pero el día inferior aun no ha cumplido años, le quitaremos un año al actual

if (($mesnaz == $mes) && ($dianaz > $dia)) {
$ano=($ano-1); }

//si el mes es superior al actual tampoco habrá cumplido años, por eso le quitamos un año al actual

if ($mesnaz > $mes) {
$ano=($ano-1);}

 //ya no habría mas condiciones, ahora simplemente restamos los años y mostramos el resultado como su edad

$edad=($ano-$anonaz);

return $edad;	
}
?>