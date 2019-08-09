<?php
//MOTIVO
class Motivo {
    public function insertMotivo($descrip){
        global $db;
        //echo $descrip;
        //$sql="insert into motivo_dcto values (NULL, '$descrip')";
        $sql="insert into motivo_dcto (mtv_descrip) VALUES('$descrip')";
        $db->query($sql);
    }
    
           
    public function getMotivo($num, $val){
        global $db;
        switch ($num) {
            case 0:$sql="select * from motivo_dcto where mtv_ide=$val";break;
            case 1:$sql="select * from motivo_dcto order by mtv_descrip";break;
            /*case 2:$sql="select * from motivo-dcto order by prs_nom";break;*/
            case 2:$sql="select * from motivo_dcto";break;
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