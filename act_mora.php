<?php
include "config.php";
include "libs/class/otro.class.php";
include "libs/class/cuo_fija.class.php";
include "libs/class/usuario.class.php";
include "libs/class/Pagos.class.php";

include "libs/class/produccion.class.php";

$archivo='mora_septiembre';
$rows=Otro::getOtro(6,$archivo,0);
	foreach ($rows as $row){

        $afi=$row['ID_ABONADO'];
        $deuda=$row['DEUDA'];
        $ver=$row['FORMA_PAGO'];
        $buscar=BuscarPago($afi,$deuda,$ver);
        
        if ($buscar>0){
            //echo 'ENTRE--'.$buscar;
        	$estado=1;
        	$pago=$buscar;
        	$rows = otro::updateOtro($afi, $estado,$pago);
        }
    }

			
?>
<?php 
function BuscarPago($afi,$deuda,$ver){
$buscar=0;
$tot=0;

$rows = Pagos::getPagos(6,$afi);
foreach ($rows as $row) {
    if (($ver=='RECUPERACION')or($ver=='REINCIDENTE')){$tot=$tot+$row['IMPORTE'];}
    else{
           $cuo=VerCuota($afi);
          // echo $row['IMPORTE'].'*'.$cuo.'-';
            if (($row['MES']==9) AND ($row['ANO']==2018) and ($row['IMPORTE']==$cuo)) {
              
	        $tot=$tot+$row['IMPORTE'];    }       //echo 'ENTRE--'.$tot;
    }
}
$buscar=$tot;
return $buscar;
}
function VerCuota($afi)
{
    $rows = cuo_fija::getCuo_fija(0,$afi);
    foreach ($rows as $row) {

            $buscar=$row['IMPORTE'];
       
}

return $buscar;
}
?>