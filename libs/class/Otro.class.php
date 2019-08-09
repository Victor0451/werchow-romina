    <?php
//PERSONAL
class Otro {
    public function insertPlanif($num, $fecha, $obs){
        global $db;
        //$sql="insert into personal values (NULL, '$ape', '$nom', '$esp', '$obs')";
        $sql="insert into planificacion (pln_usu,pln_dia,pln_obs) VALUES($num,'$fecha','$obs')";
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
    public function getOtro($num, $val, $zona){
        $fecha = date("d/m/Y",time());
        $fch = explode("/",$fecha); 
        $fecha = $fch[2]."-".$fch[1]."-".$fch[0];
        $fecha1 = $fch[2]."-".$fch[1]."-".'01';
        global $db;
        switch ($num) {
            case 0: $sql = "select * from $val where CONVENIO=$zona ORDER BY CONVENIO;"; break;
            case 1: $sql = "SELECT SUM(IMPORTE) as total FROM $val WHERE CONVENIO=$zona ;";break;
            case 2: $sql = "SELECT SUM(IMPORTE) as total FROM $val  WHERE CONVENIO IN (04000,10666,03400,03600,03700,03800,3900) ORDER BY CONVENIO;";break;
            case 3: $sql = "select * from $val where CONVENIO IN (04000,10666,03400,03600,03700,03800,3900) ORDER BY CONVENIO;"; break;
            case 4: $sql = "select * from $val  where estado=$zona ORDER BY forma_pago;"; break;
            case 5: $sql = "select * from $val where recuperador=$zona ORDER BY recuperador, id_campania,forma_pago;"; break;
    //        case 6: $sql = "select * from $val where estado=0 ORDER BY forma_pago;"; break;
            case 6: $sql = "select * from $val  ORDER BY forma_pago;"; break;
            case 7: $sql = "select * from $val where recuperador=$zona and estado= 1 ORDER BY recuperador, forma_pago;"; break;
            //case 8: $sql = "select * from $val  ORDER BY forma_pago;"; break;
            case 8: $sql = "select * from $val  where (RECUPERADOR=$zona) ORDER BY forma_pago;"; break;
            case 9: $sql = "select * from $val where sucursal='$zona' ORDER BY forma_pago;"; break;
            case 10: $sql = "SELECT SUM(DEUDA) as total FROM $val  ;";break;
            case 11: $sql = "select * from $val where recuperador=$zona ORDER BY forma_pago;"; break;
            case 12: $sql = "select * from $val where sucursal='$zona' and estado=1 ORDER BY forma_pago;"; break;
            case 13: $sql = "select * from $val where id_abonado=$zona ORDER BY forma_pago;"; break;
            case 14: $sql = "select * from $val ORDER BY forma_pago;"; break;
            case 15: $sql = "select * from $val where forma_pago='zona'ORDER BY forma_pago;"; break;
            case 16: $sql = "select *from $val WHERE  RECUPERADOR=$zona GROUP BY ID_CAMPANIA;"; break;
            case 17: $sql = "select *from $val WHERE  ID_CAMPANIA=$zona ORDER BY ID_CAMPANIA;"; break;
            case 18: $sql = "select *from $val  GROUP BY ZONA;"; break;
            case 19: $sql = "select *from $val WHERE  ZONA=$zona ORDER BY ZONA;"; break;
            
            default : break;

        }
        return $db->query($sql);       
    }
     public function getOtro2($num, $val, $recup,$accion,$estado){
       
        global $db;
        switch ($num) {
            case 0: $sql = "select * from $val where recuperador=$recup and forma_pago='$accion' ORDER BY recuperador, forma_pago;"; break;
            case 1: $sql = "select * from $val where sucursal='$recup' and forma_pago='$accion' ORDER BY recuperador, forma_pago;"; break;
            case 2: $sql = "select * from $val where forma_pago='$accion' ORDER BY recuperador, forma_pago;"; break;
            case 3: $sql = "select * from $val where forma_pago='$accion' and estado=$estado ORDER BY recuperador, forma_pago;"; break;
            case 4: $sql = "select * from $val where sucursal='$recup' and forma_pago='$accion' and estado=$estado ORDER BY recuperador, forma_pago;"; break;
            case 5: $sql = "select * from $val where recuperador=$recup and forma_pago='$accion' and estado=$estado ORDER BY recuperador, forma_pago;"; break;
            case 6: $sql = "select * from $val where forma_pago <>'$accion' ORDER BY recuperador, forma_pago;"; break;
            case 7: $sql = "select * from $val where sucursal='$recup' and forma_pago<>'$accion' ORDER BY recuperador, forma_pago;"; break;
            case 8: $sql = "select * from $val where recuperador='$recup' and forma_pago<>'$accion' ORDER BY recuperador, forma_pago;"; break;
            case 9: $sql = "select * from $val where sucursal='$recup' and forma_pago='accion' ORDER BY recuperador, forma_pago;"; break;
            case 10: $sql = "select * from $val where recuperador='$recup' and forma_pago<>'RECUPERACION' ORDER BY recuperador, forma_pago;"; break;
            case 11: $sql = "select * from $val where forma_pago ='$accion' ORDER BY recuperador, forma_pago;"; break;
            case 12: $sql = "select * from $val where sucursal='$recup' and forma_pago='$accion' ORDER BY recuperador, forma_pago;"; break;
            case 13: $sql = "select * from $val where recuperador='$recup' and forma_pago='$accion' ORDER BY recuperador, forma_pago;"; break;
            case 14: $sql = "select * from $val where forma_pago ='$accion' and estado=$estado ORDER BY recuperador, forma_pago;"; break;
            case 15: $sql = "select * from $val where forma_pago <>'$accion' and estado=$estado ORDER BY forma_pago;"; break;
            case 16: $sql = "select * from $val where forma_pago <>'$accion'and recuperador='$recup' and estado=$estado ORDER BY forma_pago;"; break;
            case 17: $sql = "select * from $val where forma_pago <>'$accion'and sucursal='$recup' and estado=$estado ORDER BY forma_pago;"; break;
            case 18: $sql = "select * from $val where forma_pago ='$accion'and sucursal='$recup' and estado=$estado ORDER BY forma_pago;"; break;
            case 19: $sql = "select * from $val where forma_pago ='$accion'and recuperador='$recup' and estado=$estado ORDER BY forma_pago;"; break;
            case 20: $sql = "select * from planificacion where pln_usu =$val and pln_dia  between '$recup' and '$accion'  ORDER BY  pln_usu, pln_dia;"; break;
            case 21: $sql = "select * from $val where ID_ABONADO=$recup and id_campania=$accion;";break;
            case 8: $sql = "select * from $val where recuperador='$recup' and forma_pago<>'$accion' ORDER BY recuperador, forma_pago;"; break;
            break;

            default : break;

        }
        return $db->query($sql);       
    }
    public function updateOtro($num, $estado, $pago){
        global $db;
        $sql="update mora052019 set"
           ." ESTADO=$estado, IMP_PAGO=$pago"
           ." where ID_ABONADO=$num ";
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