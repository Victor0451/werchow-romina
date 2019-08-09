<?php
 include "info.php"; 
 include "config.php";
 include "libs/class/usuario.class.php";
 include "libs/class/maestro.class.php";
 include "libs/class/SO.class.php";
 include "libs/class/Otro.class.php";
 include "libs/class/pagos.class.php";
 $ofi=3;
 $fecha = date("d/m/Y",time());
 //echo $fecha;
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$con=0;
	$tot_gral=0;
	$total=0;
	$tot_p=0;
	$con_p=0;
	$coni=0;
	$deuda=0;


$archivo='SO'.$fch[1].$fch[2];
	
	switch ($ofi) {
				case 1:$nom='CASA CENTRAL'; break;
				case 3:$nom='PALPALA'; break;
				case 5:$nom='PERICO'; break;
				case 60:$nom='SANPEDRO'; break;
				default:break;
			}	
			
$rows = SO::getSO(24,$archivo,$ofi);
foreach ($rows as $row) {
	$ban=0;
	$interes=0;
	$cuo2=0;
	$deuda=$row['DEUDA'];
	//$tot=$row['CUOTA']*$row['DEUDA'];
	$cuo=$row['CUOTA'];
	
	$interes=($row['CUOTA']*10)/100;
	//echo 'ROMINA'.round($interes).'<BR>';
	//echo 'ro'.$interes;
	$cuo2=$row['CUOTA']+round($interes);

	$con=$con+1;
	$mes=null;
	//$tot_gral=$tot_gral+$tot;
	$afi=$row['CONTRATO'];


	$rowsp = Pagos::getPagos(6,$afi);
	$total=$rowsp->rowCount();
	if ($total==0){echo $afi.' <br>';}
	else 	 {if ($total<$deuda){
		foreach ($rowsp as $rowp)
		{		
		 echo $afi.'-'.$deuda.' <br>';
	    }
	}
   }
	/*foreach ($rowsp as $rowp) {
		if (($rowp['IMPORTE']==$cuo)or($rowp['IMPORTE']==$cuo2)){
			$con_p=$con_p+1;
			$ban=1;
			$tot_p=$tot_p+$rowp['IMPORTE'];
			$mes=$rowp['MES'];
		}
		else{$coni=$coni+1; echo $coni.'-'.$afi.' * '.$cuo.'/'.$cuo2.' * '.$rowp['IMPORTE'].'<br>';}
	}*/

}	


?>
