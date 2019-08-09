<?php
include "config.php";
include "libs/class/maestro.class.php";
include "libs/class/pagos.class.php";
include "libs/class/prestamo.class.php";

$rows=Prestamo::getPrestamo(4,0,0);
if($rows->rowCount()!=0){
	foreach ($rows as $row){
	
	$fech=$row['ptm_fechasol'];
		$cuo=$row['ptm_cuotas'];
		$id=$row['ptm_id'];
		$vcuo=$row['ptm_valcuota'];
        $fch = explode("-",$fech); 
        $anio=$fch[0];
        $mes=$fch[1];
        $dia=$fch[2];
        $rest = substr($anio, -2);
        $cant=0;
        $cont=1;
        $afiliado=$row['ptm_ficha'];

        if ($dia>=20){if ($mes==12){$mes=2;$rest=$rest+1;$anio=$anio+1;}else if ($mes==11){$mes=1;$rest=$rest+1;$anio=$anio+1;}else{$mes=$mes+2;}}

        else{ if ($mes==12) {$mes=1;$rest=$rest+1;$anio=$anio+1;}else{$mes=$mes+1;}    }
    

        while ($cont<=$cuo){
        	$fpago=Traerpago($afiliado,$mes,$anio,$vcuo);
        	if ($fpago<>''){$cant=$cant+1;}
        	$cont=$cont+1;
        	$mes=$mes+1;
        	if($mes>12){$mes=1;$rest=$rest+1;$anio=$anio+1;}
        }	
	if ($cant == $cuo) {$estado='CANCELADO';$rows = Prestamo::updatePrestamo1($id, $estado);}

	}
}		
else {echo 'CONSULTA VACIA';}	


			
?>
<?php 
function Traerpago($afiliado,$mes,$anio,$vcuo){
	$envio='';
	
	$rows = Pagos::getPagos2(0,$afiliado,$mes,$anio);
	foreach ($rows as $row) {
		if ($row['IMPORTE'] > $vcuo){
			$envio=$row['DIA_PAGO'].' - $ '.$row['IMPORTE'];

		}
		//$nombre=$row['APELLIDOS']." ".$row['NOMBRES'];
	return ($envio);
	
	}
    
}	
?>