<?php
set_time_limit(500);
include "config.php";
include "libs/class/maestro.class.php";
include "libs/class/usuario.class.php";
include "libs/class/produccion.class.php";

$rows=Produccion::getProduccion(6,0);
if($rows->rowCount()!=0){
	foreach ($rows as $row){

        $dni=$row['prod_dniafi'];
        $cod=$row['prod_ide'];
        $buscar=BuscarMaestro($dni);
        if ($buscar>0){
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
		$buscar=$row['CONTRATO'];
	}
return $buscar;
}

?>