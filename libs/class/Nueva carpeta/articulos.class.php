<?php
//ARTICULOS
class Articulos {
    public function insertArticulos($descrip){
        global $db;
        //echo $descrip;
        //$sql="insert into arti_detalle values (NULL, '$descrip')";
        $sql="insert into arti_detalle (art_detalle) VALUES('$detalle')";
        $db->query($sql);
    }
    
           
    public function getArticulo($num, $val){
        global $db;
        switch ($num) {
            case 0:$sql="select * from arti_detalle where art_codigo=$val";break;
            case 1:$sql="select * from arti_detalle order by art_detalle";break;
            /*case 2:$sql="select * from art_detalle order by prs_nom";break;*/
            case 2:$sql="select * from arti_detalle";break;
            default:break;
        }
        return $db->query($sql);       
    }
    
    public function updateArticulos($num,$descrip){
        global $db;
        $sql="update arti_detalle set"
           ." art_detalle='$descrip'"
           ." where art_codigo=$num ";
        $db->query($sql);
    }
    
    public function deleteArticulos($num){
        global $db;
        $sql="delete from arti_detalle where art_codigo=$num";
        $db->query($sql);
    }
}
?>