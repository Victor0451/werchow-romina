    <?php
//PERSONAL
class Adherente {
    public function insertAdherente($contrato,$fecha,$fechafi,$asesor,$ape, $nom, $dni, $fechanac,$paren,$recibo,$monto,$pago,$estado){
        global $db;
        //$sql="insert into personal values (NULL, '$ape', '$nom', '$esp', '$obs')";
        $sql="insert into alta_adhe (adhe_fechacarga,adhe_fechafi,adhe_asesor,adhe_contrato,adhe_apellido,adhe_nombre,adhe_dni,adhe_fecnac,adhe_paren,adhe_recibo,adhe_monto,adhe_pago,adhe_estado) VALUES('$fecha','$fechafi',$asesor,$contrato,'$ape','$nom',$dni,'$fechanac','$paren',$recibo,$monto,'$pago','$estado')";
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
    public function getAdherente($num, $val){
        global $db;
        switch ($num) {
            case 0: $sql = "select * from adherent where contrato=$val and isnull(adherent.baja);"; break;
            case 1: $sql = "select * from alta_adhe where adhe_asesor=$val ;"; break;
            case 2: $sql = "select * from alta_adhe ;"; break;
            case 3: $sql = "select * from alta_adhe where adhe_id=$val;"; break;
            default : break;
        }
        return $db->query($sql);       
    }
    
    public function updateAdherente($num, $ape, $nom, $emp, $obs, $esta){
        global $db;
        $sql="update alta_adhe set"
           ." prs_ape='$ape', prs_nom='$nom', prs_empre='$emp', prs_obs='$obs',prs_estado='$esta' "
           ." where adhe_id=$num ";
        $db->query($sql);
    }
    
    public function deleteAdherente($num){
        global $db;
        $sql="delete from alta_adhe where adhe_id=$num";
        //$sql="update personal set prs_estado='$estado' where prs_ide=$num ";
        
        $db->query($sql);
    }
}
?>  