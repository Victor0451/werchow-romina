<?php
include "config.php";
include "libs/class/so.class.php";
include "libs/class/pagos.class.php";


/*$fecha_actual=date("d/m/Y");
$fecha_det= explode("/",$fecha_actual);
$mes = $fecha_det[1]; // imprimiría el mes  
$anio= $fecha_det[2];// imprimiría el año  

$mesactual2=$mes;*/
$fecha = date("d/m/Y",time());
	$fch = explode("/",$fecha); 
	$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$fechac=$fecha;
	$anio=$fch[2];
	$archivo='SO'.$fch[1].$fch[2];

 $zona='L';
 $rows=SO::getSo(17,$archivo,$zona);
//$rows=Maestro::getMaestro(0,0);
 $ver=$rows->rowCount();
 //echo $ver;
foreach ($rows as $row){
 $ver2=0;	
 $contrato= $row['CONTRATO'];
 $grupo=$row['GRUPO'];
if ($grupo==1000){
	$rows2=Pagos::getPagos(8,$contrato);}
 	
else{ $rows2=Pagos::getPagos(9,$contrato);}

if($rows2->rowCount()==0){echo $contrato.'<br>';
}
//else{echo 'vacio';}

 		/*foreach ($rows2 as $row2){
 			$ver2=$ver2+1;
 		}	
 	//$ver2=$rows2->rowCount();
 	if ($ver2==0){echo $contrato.'<br>';}
	//if($rows2->rowCount()!=0){ echo $contrato.'<br>';}*/
}	




/*if($rows->rowCount()!=0){
	foreach ($rows as $row){
		$ver=0;
		$contrato=$row['CONTRATO'];
		$fec= explode("-", $row['ALTA']);
		//echo $row['ALTA']."-".$contrato;
		$mesalta=$fec[1];
		$anioalta=$fec[0];
		$diaalta=$fec[2];
		
		if ($diaalta >= 16) {$mesalta=$mesalta +1;}
		$mesalta2=$mesalta;

		$difanio=$anio-$anioalta;
		$cuotas=$difanio*12;
		$cuotas=$cuotas+1;

		if ($mesalta<$mes){
		while($mesalta2<$mes){
			$cuotas=$cuotas+1;
			$mesalta2=$mesalta2+1;
		}
	
		}
		else if ($mesalta>$mes){
		while($mesalta>$mesactual2){
			$cuotas=$cuotas-1;
			$mesactual2=$mesactual2+1;
			}
		}
	$rows2=Pagos::getPagos(4,$contrato);
	if($rows->rowCount()!=0){ echo 'hHAY ALGO';}
	else{echo 'NADA';}
	
	//$ver=$rows2->rowCount();




 
	
	//echo 'CANTIDAD: '.$ver.' LEGAJO:'.$contrato.'<br>';
	//}	

	//echo 'CONTRATO: '.$contrato.' MES: '.$mesalta.' ANIO ALTA: '.$anioalta.' CUOTAS: '.$cuotas.' PENDIENTES: '.$pendientes.'<br>';	

	}	
	
}
*/
			
?>


