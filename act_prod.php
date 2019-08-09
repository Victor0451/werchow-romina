<?php
include "config.php";
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/produccion.class.php";

$rows=Produccion::getProduccion(5,0);
if($rows->rowCount()!=0){
	foreach ($rows as $row){

        $dni=$row['prod_dniafi'];
        $cod=$row['prod_ide'];
        $plan=$row['prod_plan'];
        if ($plan=='PROVINCIAL'){$buscar=BuscarMutual($dni);}
        else{$buscar=BuscarMaestro($dni);}    
        
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
function BuscarMaestro($dni){
$buscar=0;
	$rows = Maestro::getMaestro(8,$dni);
	foreach ($rows as $row) {
        //if ($row['CONTRATO']==7432) {echo 'entro'; }
		$buscar=$row['CONTRATO'];
	}
return $buscar;
}
function BuscarMutual($dni){
$buscar=0;
    $rows = Maestro::getMaestro(10,$dni);
    foreach ($rows as $row) {
        //if ($row['CONTRATO']==7432) {echo 'entro'; }
        $buscar=$row['CONTRATO'];
    }
return $buscar;
}

?>