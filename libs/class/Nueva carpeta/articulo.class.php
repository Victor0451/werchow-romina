<?php
//MOTIVO
class Articulo {
    public function insertArticulo($descrip, $codigo){
        global $db;
        //echo $descrip;
        //$sql="insert into articulo values (NULL, '$descrip')";
        $sql="insert into articulo (art_detalle,art_codigo) VALUES('$descrip','$codigo')";
        $db->query($sql);
    }
    
           
    public function getArticulo($num, $val){
        global $db;
        switch ($num) {
            case 0:$sql="select * from articulo where art_id=$val";break;
            case 1:$sql="select * from articulo order by art_codigo";break;
            /*case 2:$sql="select * from articulo order by prs_nom";break;*/
            case 2:$sql="select * from articulo";break;
            default:break;
        }
        return $db->query($sql);       
    }
    
    public function updateArticulo($num,$descrip,$codigo){
        global $db;
        $sql="update articulo set"
           ." art_detalle='$descrip', art_codigo='$codigo' "
           ." where art_id=$num ";
        $db->query($sql);
    }
    
    public function deleteArticulo($num){
        global $db;
        $sql="delete from articulo where art_id=$num";
        $db->query($sql);
    }
}
?>