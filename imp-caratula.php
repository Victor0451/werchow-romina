<?php
		include "config.php";
		include "libs/class/maestro.class.php";
		include "libs/class/usuario.class.php";
		include "libs/class/prestamo.class.php";
		
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Impresion Caratula</title>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<script src="libs/js/jquery-1.7.2.js"></script>
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>

</head>


<body>
	
	<div id="contenido">	
		<input type="hidden" name="ptm_id" value="<?php echo $_GET['ptm_id']; ?>">
		
		<?php
			$ficha=$_GET['ptm_id'];
			$rows = Prestamo::getPrestamo(0,$ficha,0);
				$row = $rows->fetch();
				$ficha = $row['ptm_ficha'];
				$legajo = $row['ptm_legajo']; 
				$antiguedad = $row['ptm_ant'];
				$fechasol = $row['ptm_fechasol'];
				$fch = explode("-",$fechasol); 
				$fechasol = $fch[2]."-".$fch[1]."-".$fch[0];
				$renovacion = $row['ptm_renov'];
				$prestamo = $row['ptm_prestamo'];
				$cuotas = $row['ptm_cuotas'];
				$neto = $row['ptm_neto'];
				$ptm_id=$row['ptm_id'];
				$cuo=$row['ptm_valcuota'];
				$rowsm = Maestro::getMaestro(7,$row['ptm_ficha']);
				//$op=$row['ptm_op'];
				$cod=$row['ptm_id'];
				foreach ($rowsm as $rowm) {
				$nombre=$rowm['APELLIDOS']." ".$rowm['NOMBRES'];
				$dni=$rowm['NRO_DOC'];
				switch ($rowm['SUCURSAL']) {
					case 'W':$zona='CASA CENTRAL';break;
					case 'L':$zona='PALPALA';break;
					case 'P':$zona='SAN PEDRO';break;
					case 'R':$zona='PERICO';break;
            		default:break;
        		   }
				}
			
				$rowsp = Usuario::getUsuario(6,$row['ptm_op']);
					
				foreach ($rowsp as $rowp) {
					
				 $op=$rowp['CODIGO'];
				
	    		}    
  	
				$total=$row['ptm_valcuota']*$row['ptm_cuotas'];
				$pcj=($neto*30)/100;
				if ($pcj>$row['ptm_valcuota']){$rta='PRE-APROBADO';}
				else{$rta='PRE-RECHAZO';}
			echo"<h1> <font size=6>SUBSIDIO POLICIA</font>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size=5>COD_OP:&nbsp;".$op."&nbsp;&nbsp;&nbsp;&nbsp;COD_PROC:&nbsp;".$cod."</font>
			<br><center><font size=8>".$nombre."</font></center>	<font size=6>DNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".$dni."<br>LEGAJO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".$legajo."<br>FICHA &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".$ficha."<br>ANTIGUEDAD:&nbsp;".$antiguedad."&nbsp;AÑOS
			<br>SOLICITUD&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".$fechasol."<br>ZONA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;".$zona."<br>RENOVACION:&nbsp;".$renovacion." </font>
			</h1>";	
			echo " <hr color='black' size=3>";
			echo"<h1> <font size=6> PRESTAMO &nbsp;&nbsp;&nbsp;&nbsp;: $ ".$prestamo."<br><u>CUOTAS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: ".$cuotas."<br>CADA CUOTA &nbsp;: $ <span>".$row['ptm_valcuota']."</span><br>TOTAL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: $ ".$total."</u></font>
			</h1>";
			echo " <hr color='black' size=3>";
			echo"<h1> <font size=6>NETO A COBRAR: $ ".$neto."<br>30% DEL NETO &nbsp;: $ ".$pcj."<br><br></font></h1>";
			if ($pcj>$cuo){
				echo " <h1> <font size=6 color=red>Pre-Aprobación:<br>
				El 30 % del Neto supera el valor de la cuota.</font>
				</h1>";
			}
				else{
					
					echo " <h1> <font size=6 color=red>Pre-Rechazo:<br>
					El 30 % del Neto NO supera el valor de la cuota.</font>
					</h1>";
			}
			echo " <hr color='black' size=3>";
		?>	
		 
	<p>
			
		<input type="button" name="btn_imp" value="Imprimir" onClick="JavaScript: window.print();" >&nbsp;<input type="button" name="btn_volver" value="Volver" onclick="location.href = 'abm-prestamos.php'">
	</p>
</form>
</div>
<div id="footer">
		<center>WERCHOW - Año 2018 - </center>
</div>
</body>
</html>
