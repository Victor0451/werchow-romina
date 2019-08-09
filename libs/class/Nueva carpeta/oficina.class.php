<?php
class Oficina {
    
    public function insertOficina($cod, $nom, $obs){
        global $db;
        $sql="insert into oficina values ('', '$cod', '$nom', '$obs')";
        $db->query($sql);
    }
    
    public function getOficina($num, $val){
        global $db;
        switch ($num) {
            case 0:$sql="select * from oficina where ofi_ide=$val";break;
            case 1:$sql="select * from oficina order by ofi_nom";break;
            case 2:$sql="select * from oficina order by ofi_cod";break;
            case 3:$sql="select * from oficina";break;
            default:break;
        }
        return $db->query($sql);         
    }
    
    public function updateOficina($num, $cod, $nom, $obs){
        global $db;
        $sql="update oficina set ofi_cod='$cod', ofi_nom='$nom', ofi_obs='$obs' where ofi_ide=$num ";
        $db->query($sql);
    }
    
    public function deleteOficina($num){
        global $db;
        $sql="delete from oficina where ofi_ide=$num";
        $db->query($sql);
    }
    
}
?>
