<?php
//MOTIVO
class Prestamo {
    public function insertPrestamo($fecha, $ficha, $op, $legajo, $ant, $fechasol, $renov, $prestamo,$cuotas, $neto,$estado,$valcuota){
        global $db;
        /*$fechacarga = date("d/m/Y",time());
        $fch = explode("/",$fechacarga); 
        $fechacarga = $fch[2]."-".$fch[1]."-".$fch[0];*/
        //echo $descrip;
        //$sql="insert into articulo values (NULL, '$descrip')";
        $sql="insert into prestamos (ptm_fechacarga,ptm_op,ptm_ficha,ptm_legajo,ptm_ant,ptm_fechasol,ptm_renov,ptm_prestamo, ptm_cuotas, ptm_neto, ptm_estado,ptm_valcuota) VALUES('$fecha',$op,$ficha,$legajo,'$ant','$fechasol','$renov',$prestamo,$cuotas, $neto,'$estado',$valcuota)";
        $db->query($sql);
    }
    
           
    public function getPrestamo($num, $val,$operador){
        
        $fec = date("d/m/Y",time());
        $fch = explode("/",$fec); 
        $fec = $fch[2]."-".$fch[1]."-".$fch[0];
        $fec1 = $fch[2]."-".$fch[1]."-".'01';
   
        global $db;
        switch ($num) {
            case 0:$sql="select * from prestamos where ptm_id=$val";break;
            case 1:$sql="select * from prestamos where (ptm_op = $operador)  and (ptm_fechacarga between '$fec1' and '$fec')order by ptm_op";break;
            /*case 2:$sql="select * from articulo order by prs_nom";break;*/
            case 2:$sql="select * from prestamos where (ptm_estado='PENDIENTE')";break;
            case 3:$sql="select * from prestamos where (ptm_ficha=$operador)";break;
            case 4:$sql="select * from prestamos where (ptm_estado='ACTIVO')or(ptm_estado='APROBADO')";break;
            case 5:$sql="select * from prestamos where (ptm_estado='APROBADO')";break;
            case 6:$sql="select * from prestamos where (ptm_ficha=$val)";break;
            
            default:break;
        }
        return $db->query($sql);       
    }

     public function getPrestamo2($num, $desde,$hasta,$estado){
        global $db;
        switch ($num) {
            case 0:$sql="select * from prestamos order by ptm_fechasol";break;
            case 1:$sql="select * from prestamos where ((ptm_fechasol between '$desde' and '$hasta') and (ptm_estado = '$estado')) order by ptm_fechasol"
            ;break;
            case 2:$sql="select * from prestamos where (ptm_fechasol between '$desde' and '$hasta') order by ptm_fechasol";break;
            
            default:break;
        }
        return $db->query($sql);       
    }
    
     public function getLiquidacion2($num, $desde,$hasta,$recup){
        
        global $db;
        switch ($num) {
            case 0:$sql="select * from liquidaciones where liq_id=$val";break;
            case 1:$sql="select * from liquidaciones where (liq_recup = $recup)  and (liq_fecha between '$desde' and '$hasta')order by liq_accion, liq_fecha,liq_socio";break;
           
            default:break;
        }
        return $db->query($sql);       
    }



    public function updatePrestamo($num,$legajo,$neto,$ant,$fechasol,$renov,$cuotas,$prestamo,$valcuota){
        global $db;
        $sql="update prestamos set ptm_neto=$neto, ptm_legajo=$legajo,ptm_ant=$ant,ptm_fechasol='$fechasol',ptm_renov='$renov',ptm_prestamo=$prestamo,ptm_cuotas=$cuotas, ptm_valcuota=$valcuota where ptm_id=$num ";
        $db->query($sql);
    }
    
    public function updatePrestamo1($num,$estado){
        global $db;
        $sql="update prestamos set ptm_estado='$estado' where ptm_id=$num ";
        $db->query($sql);
    }

    
    public function deletePrestamo($num){
        global $db;
        $sql="delete from prestamos where ptm_id=$num";
        $db->query($sql);
    }
}
?>