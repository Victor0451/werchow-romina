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


</script>

<?php 
include "info.php"; 
include "config.php"; 
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/prestamo.class.php";
include "libs/class/cuo_prestamo.class.php"; 

$dni=0;$legajo=0;$operador=0;$ficha=0;$prestamo=0;$cuotas=0;$ban=0;$antiguedad=0;$neto=0;$credixa=0;


$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	

if (isset($_REQUEST['btn_simular'])){
	$ban=1;
	$prestamo=$_REQUEST['prestamo'];
	$cuotas=$_GET['cuotas'];
	$dni=$_GET['dni'];
	$prestamo=$_GET['prestamo'];
	$rows = Maestro::getMaestro(9,$dni);
	if($rows->rowCount()!=0){
		$row = $rows->fetch();
		$grupo=$row['GRUPO'];
		if ($grupo==6){echo'ro';}
		else{
			print '<script language="JavaScript">'; 
			print 'alert("EL AFILIADO NO ES POLICIA");'; 
			print'</script>';
			print'<script type="text/javascript">
			window.location="simulador.php";
			</script>';	
		}	
	}
	else{
		print '<script language="JavaScript">'; 
		print 'alert("EL AFILIADO NO EXISTE");'; 
		print'</script>';
		print'<script type="text/javascript">
			window.location="simulador.php";
			</script>';
	}	
		
}
else if (isset($_REQUEST['btn_limpiar'])){$dni=0;$monto=0;$cuotas=0;}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Simulador-Préstamos</title>
	
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
		<a href="prestamos_abm.php" class="nl"><h1>Simular Préstamo</h1></a>
		
		<form action="" id="formulario"  onSubmit="">
			
			<p style="font-size:0.7em;">Fecha:&nbsp;&nbsp;<b><?php echo $fecha; ?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Operador:&nbsp;&nbsp;<b><?php echo VerUsuario(); ?></b></p>	
			<h2>Ingresar</h2>
			<p style="font-size:0.8em;">DNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Legajo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Antiguedad&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;Neto a Cobrar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			<input type="text" name="dni"  value="<?php echo $dni; ?>" onkeyUp="return ValNumero(this);" maxlength="8" size="8px" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="legajo"  value="<?php echo $legajo; ?>" onkeyUp="return ValNumero(this);" maxlength="5" size="8px" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="antiguedad"  value="<?php echo $antiguedad; ?>" onkeyUp="return ValNumero(this);" maxlength="2" size="7px" >
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$ <input type="text" name="neto"  value="<?php echo $neto; ?>" onkeyUp="return ValNumero(this);" maxlength="12" size="8px" >
			
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			</p>
			<p style="font-size:0.8em;">Credixa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Capital solicitado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			Cuotas<br>
			<select name="credixa" id="credixa" >
				<option value= "<?php echo $credixa; ?>" selected="selected"><?php echo $credixa; ?></option>
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				<option value=5>5</option>
			</select>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			$<select name="prestamo" id="prestamo" >
				<option value= "<?php echo $prestamo; ?>" selected="selected"><?php echo $prestamo; ?></option>
				<option value=1000>1000</option>
				<option value=1500>1500</option>
				<option value=2000>2000</option>
				<option value=2500>2500</option>
				<option value=3000>3000</option>
				<option value=4000>4000</option>
				<option value=5000>5000</option>
				<option value=6000>6000</option>
				<option value=8000>8000</option>
				<option value=10000>10000</option>
				<option value=10000>12000</option>
				<option value=10000>15000</option>
			</select>	
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="cuotas" id="cuotas" >
				<option value= "<?php echo $cuotas; ?>" selected="selected"><?php echo $cuotas; ?></option>
				<option value=1>1</option>
				<option value=2>2</option>
				<option value=3>3</option>
				<option value=4>4</option>
				<option value=5>5</option>
				<option value=6>6</option>
				<option value=7>7</option>
				<option value=8>8</option>
				<option value=9>9</option>
				<option value=10>10</option>
				<option value=11>11</option>
				<option value=12>12</option>
				
			</select>
			<!--<input type="text" name="cuotas" value="<?php echo $cuotas; ?>" onkeyUp="return ValNumero(this);" onChange="Ver();" maxlength="2" size="3px" >-->
		   </p>
			<p><input type="submit" name="btn_simular" value="Simular">&nbsp;<input type="submit" name="btn_limpiar" value="Limpiar"></p>
		</form>
		
		<h2>Simular</h2>
		<p style="font-size:0.7em;">
			CAPITAL $:&nbsp;<?php echo $prestamo;?><BR>
			PERIODO:&nbsp;&nbsp;<?php echo $cuotas.' cuotas.';?><BR>
			TIA:&nbsp;120 %<BR>
			TIM:&nbsp;<?php 
				$ti=(120/100)+1;
				$m=30/360;
				$inter=(pow($ti,$m))-1;
				$tim=round(($inter*100),2);
				echo $tim.' %';
			?>
			<BR>
			CUOTA $:
			<?php
			     if ($prestamo>0)		
				{$p=1+$inter;
				$s='-'.$cuotas;
				$t=1-(pow($p,$s));
				$valor_cuo=round((($prestamo*$inter)/$t),0,2);}
			else{$valor_cuo=0;}	
				echo $valor_cuo;
			?>
			<BR>
				</p>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº Cuota</th>
				<th widt="5%">Vencimiento</th>
				<th widt="5%">Saldo Inicial</th>
				<th widt="10%">Cuota $</th>
				<th widt="15%">Intereses</th>
				<th widt="10%">Amortizacion</th>
				<th widt="15%">Saldo final Capital</th>
				
			</thead>
			<tbody>
				<?php VerSimulacion($ban); ?>
			</tbody>
		</table>
		<p>
		<input type="button" name="btn_salir" value="Generar Prestamo" onclick="location.href = 'prestamos_abm.php'"disabled>&nbsp;&nbsp;	
		<input type="button" name="btn_salir" value="Imprimir" onclick="location.href = 'prestamos_abm.php'"disabled>&nbsp;&nbsp;
			<input type="button" name="btn_salir" value="Salir" onclick="location.href = 'prestamos_abm.php'">
		</p>
	</div>
	<br>
	<div id="footer">
		<center>Werchow - Año 2018 - </center>
		<img src="" alt="" width="" height="">
	</div>
</body>
</html>

<?php
function VerSimulacion($ban){
$fecha = date("d/m/Y",time());
$fch = explode("/",$fecha); 
$fecha = $fch[0]."-".$fch[1]."-".$fch[2];
$tia=120;
$ti=($tia/100)+1;
$m=30/360;
$inter=((pow($ti,$m))-1);
$tim=$inter*100;
$cont=0;
$ven='';
$valor_cuo=0;

if ($ban==1){
	$cuotas=$_GET['cuotas'];
	$prestamo=$_GET['prestamo'];
	$p=1+$inter;
	$s='-'.$cuotas;
	$t=1-(pow($p,$s));
	$valor_cuo=($prestamo*$inter)/$t;
	$cuo_final= round($valor_cuo, 2);
	
	while ($cont <= $cuotas) {
/*	echo "<tr>
			  <td>".$cont."</td>	
		  </tr>";*/
		switch ($cont) {
			  	case 0:
			  	echo "<tr><td>".$cont."</td>
			  		<td>".$fecha."</td>
			  		<td></td>
			  		<td></td>
			  		<td></td>
			  		<td></td>
			  		<td></td>
			  	</tr>";
		  		break;
			  	case 1:
			  		$f = $fch[1]+1;
			  		if($f<=9){$f='0'.$f;}
			  		else{if($f>12){$fch[2]=$fch[2]+1;$f='01';}}
			  		$fe="15-".$f."-".$fch[2];
			  		$interes=round(($prestamo*$inter),2);
			  		$amor=$cuo_final-$interes;	
			  		$saldo=$prestamo-$amor;
			  		echo "<tr><td>".$cont."</td>
			  			  <td>".$fe."</td>
			  			  <td>$ ".$prestamo."</td>
			  			  <td>$ ".$cuo_final."</td>
			  			  <td>$ ".$interes."</td>
			  			  <td>$ ".$amor."</td>
			  			  <td>$ ".$saldo."</td>
			  		</tr>";
			  		break;
			  	default:$f = $f+1;
			  		    if($f<=9){$f='0'.$f;}
			  		    else{if($f>12){$fch[2]=$fch[2]+1;$f='01';}}
			  		    $fe="15-".$f."-".$fch[2];
			  			$sal=$saldo;
			  			$interes=round(($sal*$inter),2);
			  			
			  			$amor=$cuo_final-$interes;
			  			$saldo=$sal-$amor;
			  		echo "<tr><td>".$cont."</td>
			  			  <td>".$fe."</td>
			  			  <td>$ ".$sal."</td>
			  			  <td>$ ".$cuo_final."</td>
			  			  <td>$ ".$interes."</td>
			  			  <td>$ ".$amor."</td>
			  			  <td>$ ".$saldo."</td>
			  		</tr>";
			  		break;
			  }	  
	$cont=$cont+1;	     
   }
}

}
function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return ($row['usu_nick']);
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
				case 'RECUPERADOR':include ('menu_rec.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}
}	
?>