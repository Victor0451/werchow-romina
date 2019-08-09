    <?php
//PERSONAL
class Maestro2 {
    public function insertPersonal($ape, $nom, $empre, $estado,$obs){
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
    public function getMaestro2($val){
        global $db;
        /*switch ($num) {
            case 0:$sql="select * from personal where contrato=$val";break;
            case 1:$sql="select * from personal where (prs_estado='ACTIVO')order by prs_ape";break;
            case 2:$sql="select * from personal order by prs_nom";break;
            case 3:$sql="select * from personal order by prs_ape";break;
            //case 3:$sql="select * from personal Where (prs_empre='$empre') and (prs_rubro='$rubro') order by prs_ape";break;
            default:break;
        }*/
         //$result = $this->$conn->query($query); 
        $sql="select * from maestro where contrato=$val";
        //$res = mysql_query($sql);o $res = mysqli_query($sql); – Kevin el 24 may. a la
        echo 'ROMINA';
        $res =  mysqli_query($sql);
        
        //return $db->mysql_query($sql);       
        //return $conn->query($query); 
        return query($consulta, PDO::FETCH_ASSOC)
    }
    
    public function updatePersonal($num, $ape, $nom, $emp, $obs, $esta){
        global $db;
        $sql="update personal set"
           ." prs_ape='$ape', prs_nom='$nom', prs_empre='$emp', prs_obs='$obs',prs_estado='$esta' "
           ." where prs_ide=$num ";
        $db->query($sql);
    }
    
    public function deletePersonal($num,$estado){
        global $db;
        //$sql="delete from personal where prs_ide=$num";
        $sql="update personal set prs_estado='$estado' where prs_ide=$num ";
        
        $db->query($sql);
    }
}
?>  