<?php 
//include "info.php"; 
include "config.php"; 
include "libs/class/maestro2.class.php"; 
/*include "libs/class/personal.class.php"; 
include "libs/class/motivo.class.php"; 
include "libs/class/imputar.class.php"; */

$contrato=68368; $nombre = "";$apellido = "";$dni = "";$telefono= "";$obs="";
		
				$rows = Maestro2::getMaestro2($contrato);
				//$row = mysql_query($rows);
				//o $res = mysqli_query($sql); 
				$row = $rows->fetch();
				$contrato = $row['contrato'];
				$dni = $row['nro_doc']; 
				$nombre = $row['nombres']; 
				$apellido = $row['apellidos']; 
				$telefono = $row['telefono']; 
echo $nombre;				
?>