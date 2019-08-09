    <?php
//PERSONAL
class SO {
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
    public function getSO($num, $val, $zona){
        $fecha = date("d/m/Y",time());
        $fch = explode("/",$fecha); 
        $fecha = $fch[2]."-".$fch[1]."-".$fch[0];
        $fecha1 = $fch[2]."-".$fch[1]."-".'01';
        global $db;
        switch ($num) {
            case 0: $sql = "select * from $val where GRUPO=1000 and ZONA=$zona and DEUDA=1;"; break;
            case 1: $sql = "select * from $val where GRUPO=1000 and ZONA=$zona and (DEUDA>=2);"; break;
            case 2: $sql = "select * from $val where GRUPO IN (666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500)  and SUCURSAL='$zona';"; break;
            case 3: $sql = "select CONTRATO from $val INNER JOIN PAGOS ON ($val.CONTRATO = PAGOS.CONTRATO) where ($val.GRUPO=1000) and ($val.ZONA=1) and ($val.DEUDA=1) and (PAGOS.DIA_PAG between '$fecha1' and '$fecha') ;"; break;
            //case 6:$sql="select CODIGO  from  producto INNER JOIN usuario ON (producto.NRO_DOC=usuario.usu_dni) WHERE (usuario.usu_ide=$val)";break;
            case 4: $sql = "select * from $val where GRUPO=1000 and ZONA in (1,3,5,60) and DEUDA=$zona;"; break;
            case 5: $sql = "select * from $val where GRUPO=1000 and ZONA in (1,3,5,60) and DEUDA>=$zona;"; break;
            case 6: $sql = "select * from $val where GRUPO IN (666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) ORDER BY GRUPO;"; break;
            case 7: $sql = "select * from $val ;"; break;
            case 8: $sql = "select * from $val where GRUPO NOT IN (66,1270,1500,1560,1570,2000,2001,2500,4200,3000,666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) order by grupo;"; break;
            case 9: $sql = "select * from $val where GRUPO NOT IN(666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and SUCURSAL='$zona' ;"; break;
            case 10: $sql = "select * from $val where GRUPO NOT IN (666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and SUCURSAL='$zona' and DEUDA=0 ;";break; 
            case 11: $sql = "select * from $val where GRUPO NOT IN(666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and SUCURSAL='$zona' and DEUDA=1 ;"; break;
            case 12: $sql = "select * from $val where GRUPO NOT IN(666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and SUCURSAL='$zona' and DEUDA>=2 order by GRUPO, SUCURSAL, DEUDA;"; break;
            case 13: $sql = "select * from $val where GRUPO NOT IN(666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and DEUDA=0 ;";break;
            case 14: $sql = "select * from $val where GRUPO NOT IN(666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and DEUDA=1 ;";break;
            case 15: $sql = "select * from $val where GRUPO NOT IN(666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and DEUDA>=2 ;";break; 
            case 16: $sql = "select * from $val where GRUPO IN (666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and SUCURSAL='$zona' order by sucursal, grupo;"; break;
            case 17: $sql = "select * from $val where GRUPO NOT IN (666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and SUCURSAL='$zona' and DEUDA>0 ;"; break;
            //case 18: $sql = "select ADHERENT.contrato,adherent.apellidos from ADHERENT inner join $val on ($val.contrato=adherent.contrato) where $val.grupo not in (66,1270,1500,1560,1570,2000,2001,2500,4200,3000,666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and isnull(adherent.baja) order by $val.grupo  ;"; break;
            case 18: $sql = "select ADHERENT.contrato,adherent.apellidos from ADHERENT inner join $val on ($val.contrato=adherent.contrato) where $val.grupo not in (66,1270,1500,1560,1570,2000,2001,2500,4200,3000,666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500) and (isnull(adherent.baja)or(adherent.baja > '2017-12-01')) order by $val.grupo  ;"; break;
             
             case 19: $sql = "SELECT SUM(adhs) as total FROM $val WHERE grupo not in (66,1270,1500,1560,1570,2000,2001,2500,4200,3000,666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500);";break;
              case 20: $sql = "SELECT SUM(CUOTA) as totalp FROM $val WHERE grupo not in (66,1270,1500,1560,1570,2000,2001,2500,4200,3000,666,1001,3444,3666,3777,3888,3999,4004,7700,7777,8500);";break;
           
            case 21: $sql = "select * from $val where GRUPO=1000 and ZONA=$zona order by ZONA;"; break; 
            case 22: $sql = "select * from $val where GRUPO=1000 and ZONA IN (1,3,5,60) order by ZONA;"; break;            
            case 23: $sql = "select * from $val where GRUPO=$zona order by GRUPO;"; break; 
            case 24: $sql = "select * from $val where GRUPO=1000 and ZONA=$zona and DEUDA>0 order by ZONA;"; break; 
            case 25: $sql = "SELECT SUM(IMPMOV) as total FROM $val ;";break;
            case 26: $sql = "SELECT SUM(IMPORTE) as total FROM $val ;";break;
            case 27: $sql = "select * from $val where GRUPO=1000 and ZONA in (1,3,5,60);"; break;
            default : break;
            case 28: $sql = "select * from $val where $val.convenio  in (3400,3500,3600,3700,3800,3900,4000) order by $val.convenio ;"; break;
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