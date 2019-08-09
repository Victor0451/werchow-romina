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


$archivo='banco052018';
	
$rows = SO::getSO(28,$archivo,0);
/*$total=$rows->rowCount();
ECHO $total;*/
foreach ($rows as $row) {
	$afi=$row['ID_ABONADO'];
	//echo $afi.'<br>';
	$rows = SO::getSO(28,$archivo,0);

}


?>
