    <?php
//PERSONAL
     set_time_limit(800);
class Maestro {
    public function insertMaestro($ape, $nom, $empre, $estado,$obs){
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
    public function getMaestro($num, $val){
        $fecha = date("d/m/Y",time());
        $fch = explode("/",$fecha); 
        $fecha1 = $fch[2]."-".$fch[1]."-".$fch[0];
        $ver=$fch[1]-1;
        $fecha2='2018-02-01';
       
        if ($ver==0){$ver2=$fch[2]-1;
            $fecha2=$ver2."-12-01";}else{$fecha2=$fch[2]."-".$ver."-01"; }
      


       //     echo $fecha2.'-'.$fecha1;
        global $db;
        switch ($num) {
            case 0: $sql = "select * from maestro where grupo=1000"; break;
            case 1: $sql = "select * from maestro as A inner join cuo_fija as B where A.contrato=B.contrato limit 1,100 ";break;
            
            //case 2: $sql = "select * from maestro where GRUPO = 1001 order by contrato limit 0,100"; break;
            case 2: $sql = "select * from maestro where GRUPO = 1001 order by contrato "; break;

            case 3: $sql = "select * from maestro inner join cuo_fija on (maestro.contrato=cuo_fija.contrato) order by maestro.contrato where cuo_fija.importe is not null"; break;

            case 4: $sql = "select * from maestro where ALTA between '$val' and '$val2' order by alta"; break;
            
            case 5: $sql = "select * from maestro where GRUPO = 1001 and ((TELEFONO ='' )OR(TELEFONO ='-' ) ) and (MOVIL = '') order by sucursal, barrio, contrato "; break;           
            case 6: $sql = "select * from maestro where GRUPO = 1001 and (LENGTH(TELEFONO) > (4) OR LENGTH(MOVIL) > (4)) order by sucursal, barrio, contrato "; break; 
            case 7: $sql = "select * from maestro where CONTRATO = $val  order by contrato "; break; 
            case 8: $sql = "select * from maestro where (NRO_DOC = $val) and (ALTA between '$fecha2'and '$fecha1')order by ALTA, NRO_DOC "; break;   
            case 9: $sql = "select * from maestro where (NRO_DOC = $val)  order by NRO_DOC"; break; 
            case 10: $sql = "select * from mutual where (NRO_DOC = $val) and (ALTA between '$fecha2'and '$fecha1')order by ALTA, NRO_DOC "; break;   
            case 11: $sql = "select * from mutual where CONTRATO = $val  order by contrato "; break;       
            case 12: $sql = "select * from adherent where CONTRATO = $val  and  baja is null order by contrato "; break;           
            case 13: $sql = "select * from est_poli  "; break; 
            case 14: $sql = "select * from maestro where ALTA = '$val'  order by alta"; break;

            default : break;                                                
        }
        return $db->query($sql);       
    }

     public function getMaestro2($num, $val,$val2){
        global $db;
        switch ($num) {
            case 0: $sql = "select * from maestro "; break;
            case 1: $sql = "select * from maestro as A inner join cuo_fija as B where A.contrato=B.contrato limit 1,100 ";break;
            
            case 2: $sql = "select * from maestro where ALTA between '$val' and '$val2' order by ALTA "; break;
            
            case 3: $sql = "select * from maestro inner join cuo_fija on (maestro.contrato=cuo_fija.contrato) order by maestro.contrato where cuo_fija.importe is not null"; break;

            case 4: $sql = "select * from maestro where ALTA between '$val' and '$val2' order by alta"; break;
            case 5: $sql = "select * from bajas where BAJA between '$val' and '$val2' order by BAJA"; break;
            case 6: $sql = "select * from maestro where ALTA between '$val' and '$val2' order by ALTA"; break;
            
            default : break;
        }
        return $db->query($sql);       
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