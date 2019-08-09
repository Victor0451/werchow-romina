<?php
class Caracter {
    
    public function insertCaracter($fecha,$hora,$carga,$emple, $motivo, $obs, $imputar, $monto, $cuotas,$estado,$fechafin, $articulo, $cantidad, $remito){
        global $db;
       
        $sql="insert into descuentos (Dcto_fecha,Dcto_hora,Dcto_carga,Dcto_emple,Dcto_mtv,Dcto_descrip,Dcto_monto, Dcto_periodo,Dcto_cuotas,Dcto_estado,Dcto_fechafin,Dcto_articulo,Dcto_cantidad,Dcto_remito)VALUES('$fecha','$hora',$carga,$emple,$motivo,'$obs','$monto',$imputar,$cuotas,'$estado','$fechafin','$articulo','$cantidad','$remito')";

        $db->query($sql);
    }
    
    public function getCaracter($num, $val){
        global $db;
         switch ($num) {
            case 0:$sql="select * from descuentos where Id_dcto=$val";break;
            case 1:$sql="select * from descuentos where (Dcto_estado = 'ACTIVO') and (Dcto_emple=$val)order by Dcto_fecha";break;
            case 2:$sql="select * from descuentos where (Dcto_emple=$val) and ((Dcto_estado ='ACTIVO')OR(Dcto_estado ='PROCESO'))  order by Dcto_Fecha";break;
            case 3:$sql="select * from caracter where car_nom like '%TA%'";break;
            case 4:$sql="select * from descuentos where ((Dcto_estado = 'ACTIVO')or(Dcto_estado = 'PROCESO')) order by Dcto_emple, Dcto_fecha";break;
            case 5:$sql="select * from descuentos where (Dcto_emple=$val) and (Dcto_estado !='ELIMINADO') and  order by Dcto_Fecha";break;
            default:break;
        }
        return $db->query($sql);         
    }
 public function getCaracter1($num, $val,$fechainf){
        global $db;
         switch ($num) {
            case 0:$sql="select * from descuentos where (Dcto_emple=$val)and(Dcto_fechafin >= '$fechainf')and (Dcto_estado!='ELIMINADO') order by Dcto_fecha";break;
            case 1:$sql="select * from descuentos where (Dcto_fechafin >= '$fechainf')and (Dcto_estado!='ELIMINADO') order by Dcto_emple, Dcto_fecha";break;
            case 2:$sql="select * from descuentos where (Dcto_mtv=$val)and(Dcto_fechafin >= '$fechainf')and (Dcto_estado!='ELIMINADO') order by Dcto_fecha";break;
            case 3:$sql="select * from descuentos where (Dcto_fechafin >= '$fechainf')and (Dcto_estado!='ELIMINADO') order by Dcto_mtv, Dcto_fecha";break;
           
            default:break;
        }
         //echo $sql;
        return $db->query($sql);         
    }
  
    public function updateCaracter($fecha,$num, $mtv, $descrip, $periodo, $monto, $cuotas,$fechafin, $articulo, $cantidad, $remito){
        global $db;
        
        $sql="update descuentos set Dcto_fecha='$fecha',Dcto_mtv=$mtv,Dcto_descrip='$descrip',Dcto_periodo='$periodo', Dcto_monto='$monto',Dcto_cuotas=$cuotas,Dcto_fechafin='$fechafin',Dcto_articulo=$articulo,Dcto_cantidad=$cantidad,Dcto_remito=$remito where Id_dcto=$num ";
        //echo $sql;
        $db->query($sql);
    }
    
    public function updateCaracter1($cod, $estado, $num){
        global $db;
        
        $sql="update descuentos set Dcto_estado='$estado',Dcto_num=$num where Id_dcto=$cod ";
        //echo $sql;
        $db->query($sql);
    }
    public function deleteCaracter($num,$estado){
        global $db;
        //$sql="delete from caracter where car_ide=$num";
        $sql="update descuentos set Dcto_estado='$estado' where Id_dcto=$num ";
        $db->query($sql);
    }
    
}
?>

