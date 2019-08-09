<?php
//MOTIVO
class Liquidacion {
    public function insertLiquidacion($fecha, $socio, $recup, $nombre, $monto, $plan, $fpago, $recibo, $cuotas, $accion, $caja, $nrorec,$empresa){
        global $db;
        $fechacarga = date("d/m/Y",time());
        $fch = explode("/",$fechacarga); 
        $fechacarga = $fch[2]."-".$fch[1]."-".$fch[0];
        //echo $descrip;
        //$sql="insert into articulo values (NULL, '$descrip')";
        $sql="insert into liquidaciones (liq_fecha,liq_socio,liq_recup,liq_nombre,liq_monto,liq_plan,liq_fpago,liq_recibo, liq_cuotas, liq_accion, liq_fechacarga,liq_caja, liq_canrec, liq_emp) VALUES('$fecha',$socio,$recup,'$nombre',$monto,'$plan','$fpago',$recibo,$cuotas, '$accion','$fechacarga',$caja,$nrorec,'$empresa')";
        $db->query($sql);
    }
    
           
    public function getLiquidacion($num, $val,$recup){
        
        $fec = date("d/m/Y",time());
        $fch = explode("/",$fec); 
        $fec = $fch[2]."-".$fch[1]."-".$fch[0];
        $fec1 = $fch[2]."-".$fch[1]."-".'01';
   
        global $db;
        switch ($num) {
            case 0:$sql="select * from liquidaciones where liq_id=$val";break;
            case 1:$sql="select * from liquidaciones where (liq_recup = $recup)  and (liq_fecha between '$fec1' and '$fec')order by liq_recup";break;
            /*case 2:$sql="select * from articulo order by prs_nom";break;*/
            case 2:$sql="select * from liquidaciones";break;
            default:break;
        }
        return $db->query($sql);       
    }
    
     public function getLiquidacion2($num, $desde,$hasta,$recup){
        
        global $db;
        switch ($num) {
            case 0:$sql="select * from liquidaciones where liq_id=$val";break;
            case 1:$sql="select * from liquidaciones where (liq_recup = $recup)  and (liq_fecha between '$desde' and '$hasta')order by liq_accion, liq_fecha,liq_socio";break;
            case 2:$sql="select * from liquidaciones where (liq_fecha between '$desde' and '$hasta') and (liq_socio=$recup)order by liq_fecha,liq_socio";break;
            case 3:$sql="select * from liquidaciones where (liq_fecha between '$desde' and '$hasta')order by liq_accion, liq_fecha,liq_socio";break;
            case 4:$sql="select * from liquidaciones where (liq_fecha between '$desde' and '$hasta')order by liq_fecha,liq_recibo,liq_recup";break;
           // case 3:$sql="select * from liquidaciones where (liq_fecha between '$desde' and '$hasta') and (!) and (liq_socio=$recup)order by liq_fecha,liq_op,liq_socio";
            //break;
           
           
            default:break;
        }
        return $db->query($sql);       
    }
    public function getLiquidacion3($num, $desde,$hasta,$socio,$recup){

        global $db;
        switch ($num) {
            
            case 0:$sql="select * from liquidaciones where ((liq_fecha between '$desde' and '$hasta') and (liq_socio=$socio))order by liq_fecha,liq_socio";break;
            case 1:$sql="select * from liquidaciones where ((liq_fecha between '$desde' and '$hasta') and (liq_socio=$socio) and (liq_recup=$recup))order by liq_fecha,liq_recup,liq_socio";break;
            case 2:$sql="select * from liquidaciones where (liq_recup = $recup)  and (liq_fecha between '$desde' and '$hasta') and (liq_accion='$socio')order by liq_accion, liq_fecha,liq_socio";break;
            case 3:$sql="select * from liquidaciones where (liq_fecha between '$desde' and '$hasta') and (liq_accion='$socio')order by liq_accion, liq_fecha,liq_socio";break;
            break;
           
           
            default:break;
        }
        return $db->query($sql);       
    }
    public function updateLiquidacion($num,$socio,$nombre,$monto,$plan,$fpago,$recibo,$cuotas,$accion,$caja){
        global $db;
        $sql="update liquidaciones set liq_nombre='$nombre', liq_socio=$socio,liq_monto=$monto,liq_plan='$plan',liq_fpago='$fpago',liq_recibo=$recibo,liq_cuotas=$cuotas, liq_accion='$accion', liq_caja=$caja where liq_id=$num ";
        $db->query($sql);
    }
     public function updateLiquidacion2($num,$rendido,$fecha){
        global $db;
        $sql="update liquidaciones set liq_rendido='$rendido', liq_fechren='$fecha' where liq_id=$num ";
        $db->query($sql);
    }
    
    public function deleteLiquidacion($num){
        global $db;
        $sql="delete from liquidaciones where liq_id=$num";
        $db->query($sql);
    }
}
?>