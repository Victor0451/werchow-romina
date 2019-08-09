
<?php
//PERSONAL
class Cuo_prestamo {
    public function insertCuo_Fija($ape, $nom, $empre, $estado,$obs){
        global $db;
        //$sql="insert into personal values (NULL, '$ape', '$nom', '$esp', '$obs')";
        $sql="insert into personal (prs_ape,prs_nom,prs_empre,prs_obs,prs_estado) VALUES('$ape','$nom','$empre','$obs','$estado')";
        $db->query($sql);
    }
    
    /*public function getPersonal($num, $val){
        global $db;
        switch ($num) {
            case 0:$sql="select * from personal order by prs_ape, prs_nom";break;
            case 1:$sql="select * from personal where prs_ide=$val";break;
            default:break;
        }
        return $db->query($sql);         */
    public function getCuo_prestamo($num,$val, $val2){
        global $db;
        switch ($num) {
            case 0: $sql = "select * from cuota_prestamo where ((cuoptm_capital=$val) and (cuoptm_cantidad=$val2));"; break;
            default : break;
        }
        return $db->query($sql);       
    }
    
    public function updateCuo_Fija($num, $ape, $nom, $emp, $obs, $esta){
        global $db;
        $sql="update personal set"
           ." prs_ape='$ape', prs_nom='$nom', prs_empre='$emp', prs_obs='$obs',prs_estado='$esta' "
           ." where prs_ide=$num ";
        $db->query($sql);
    }
    
    public function deleteCuo_Fija($num,$estado){
        global $db;
        //$sql="delete from personal where prs_ide=$num";
        $sql="update personal set prs_estado='$estado' where prs_ide=$num ";
        
        $db->query($sql);
    }
}
?>  