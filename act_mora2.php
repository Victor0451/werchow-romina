<?php
include "config.php";
include "libs/class/otro.class.php";
include "libs/class/cuo_fija.class.php";
include "libs/class/usuario.class.php";
include "libs/class/Pagos.class.php";

include "libs/class/produccion.class.php";
$cant=0;
$archivo='mora052019';

$rows=Otro::getOtro(14,$archivo,0);

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
//echo $afi.'<BR>';
$rows = Pagos::getPagos(6,$afi);

    foreach ($rows as $row) {
        $tot=$tot+$row['IMPORTE'];
    }


//echo $afi.'<br>';
   /* if (($ver=='RECUPERACION')or($ver=='REINCIDENTE')or($ver=='3 CUOTAS')){$tot=$tot+$row['IMPORTE'];}
    else{
           $cuo=VerCuota($afi);
       
            if (($row['MES']==9) AND ($row['ANO']==2018) and ($row['IMPORTE']==$cuo)) {*/
              
/*	        $tot=$tot+$row['IMPORTE'];    
    //}
}
}*/
/*898989$rows = Pagos::getPagos(7,$afi);
//if($rows->rowCount()!=0){
foreach ($rows as $row) {
        $tot=$tot+$row['IMPORTE'];    
}89898*/
//}
$buscar=$tot;
return $buscar;
}

?>