<?php
//IMPUTAR
class Imputar {
    public function insertImputar($cod,$fecha,$usu,$periodo){
        global $db;
        //echo $descrip;
        //$sql="insert into motivo_dcto values (NULL, '$descrip')";
        $sql="insert into imputar (Id_dcto,Imp_fecha,Imp_usu,Imp_periodo) VALUES($cod,'$fecha',$usu,$periodo)";
        $db->query($sql);
    }
    
           
    public function getImputar($num, $val){
        global $db;
        switch ($num) {
            case 0:$sql="select * from imputar where (Id_dcto=$val) order by Imp_fecha ";break;
            
            default:break;
        }
        return $db->query($sql);       
    }
    
    public function updateMotivo($num,$descrip){
        global $db;
        $sql="update motivo_dcto set"
           ." mtv_descrip='$descrip'"
           ." where mtv_ide=$num ";
        $db->query($sql);
    }
    
    public function deleteMotivo($num){
        global $db;
        $sql="delete from motivo_dcto where mtv_ide=$num";
        $db->query($sql);
    }
}
?>