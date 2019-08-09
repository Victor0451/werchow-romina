<?php
include "config.php";
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/produccion.class.php";
include "libs/class/pagos.class.php";

$rows=Produccion::getProduccion(5,0);
if($rows->rowCount()!=0){
	foreach ($rows as $row){

        $dni=$row['prod_dniafi'];
		$recibo=$row['prod_recibo'];
		$monto=$row['prod_monto'];
        $cod=$row['prod_ide'];
        $plan=$row['prod_plan'];
        if (($plan=='PROVINCIAL')or($plan=='NOA')){$buscar=BuscarMutual($dni,$recibo,$monto);
           if ((($plan=='NOA')or ($plan=='PROVINCIAL'))AND($buscar==0)){$buscar=BuscarMaestro($dni,$recibo,$monto);}
        }
        else{$buscar=BuscarMaestro($dni,$recibo,$monto);}    
        
        if ($buscar>0){
           // echo $buscar.'<br>';
        	$estado='CARGADO';
        	$afiliado=$buscar;
        	$rows = Produccion::updateProduccion1(2,$cod, $estado,$afiliado);
        }
    }
}		
else {echo 'CONSULTA VACIA';}	


			
?>
<?php 
function BuscarMaestro($dni,$recibo,$monto){
$buscar=0;
	$rows = Maestro::getMaestro(8,$dni);
	foreach ($rows as $row) {
        //if ($row['CONTRATO']==7432) {echo 'entro'; }
/*
	$bu=$row['CONTRATO'];
	$precio=BuscarPago($bu,'W',$recibo,$monto);
	if ($precio==1){$buscar=$row['CONTRATO'];}*/
	$buscar=$row['CONTRATO'];
	}
return $buscar;
}
function BuscarMutual($dni,$recibo,$monto){
$buscar=0;
    $rows = Maestro::getMaestro(10,$dni);
    foreach ($rows as $row) {
        //if ($row['CONTRATO']==7432) {echo 'entro'; }
        //$buscar=$row['CONTRATO'];
	/*$bu=$row['CONTRATO'];
	
	$precio=BuscarPago($bu,'M',$recibo,$monto);
	if ($precio==1){$buscar=$row['CONTRATO'];}*/
	$buscar=$row['CONTRATO'];
    }
return $buscar;
}
function BuscarPago($bu,$emp,$recibo,$monto){
$precio=0;
if ($emp=='W'){$rows = Pagos::getPagos(6,$bu);
	 foreach ($rows as $row) {
	 if (($row['NRO_RECIBO']==$recibo)and ($row['IMPORTE']==$monto)){$precio=1;}	
	}
}
else{$rows = Pagos::getPagos(14,$bu);
	 foreach ($rows as $row) {
 		 if (($row['NRO_RECIBO']==$recibo)and ($row['IMPORTE']==$monto)){$precio=1;}	
	 }
}
return $precio;
}

?>