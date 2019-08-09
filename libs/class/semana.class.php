    <?php
//PERSONAL
class Semana {
    public function insertSemana($fecha, $asesor, $mes, $semana,$venta, $carga, $anio){
        global $db;
        //$sql="insert into personal values (NULL, '$ape', '$nom', '$esp', '$obs')";
        $sql="insert into semana_asesor (semase_fecha,semase_asesor,semase_mes,semase_semana,semase_ventas,semase_codcar, semase_anio) VALUES('$fecha',$asesor,'$mes',$semana,$venta,$carga,$anio)";
        $db->query($sql);
    }
    
    
    public function getSemana($num, $val){
        $fec = date("d/m/Y",time());
        $fch = explode("/",$fec); 
        $fec = $fch[2]."-".$fch[1]."-".$fch[0];
        $fec1 = $fch[2]."-".$fch[1]."-".'01';

        global $db;
        switch ($num) {
            case 0:$sql="select * from cuo_fija where cuo_fija.contrato=$val;"; break;
            case 1:$sql="select * from semana_asesor where (semase_asesor = $val)  and (semase_fecha between '$fec1' and '$fec')order by semase_asesor, semase_fecha, semase_semana";break;
            case 2:$sql="select * from semana_asesor where (semase_semana = $val)  and (semase_fecha between '$fec1' and '$fec')order by semase_fecha, semase_semana";break;
            case 3:$sql="select * from semana_asesor where (semase_fecha between '$fec1' and '$fec')order by semase_fecha, semase_semana";break;

            case 4:$sql="select * from semana_asesor where (semase_id = $val)order by semase_id,semase_fecha";break;

            default : break;
        }
        return $db->query($sql);       
    }
     public function getSemana2($num, $val,$mes,$anio){
        
        global $db;
        switch ($num) {
            
            case 0:$sql="select * from semana_asesor where (semase_asesor = $val) and (semase_mes = '$mes')  and (semase_anio = $anio)order by semase_asesor, semase_anio, semase_mes,semase_semana";break;
            case 1:$sql="select * from semana_asesor where (semase_mes = '$mes')  and (semase_anio = $anio) and (semase_semana = $val)order by  semase_anio, semase_mes,semase_semana";break;
            case 2:$sql="select * from semana_asesor where (semase_mes = '$mes')  and (semase_anio = $anio) order by  semase_anio, semase_mes,semase_semana";break;
            default : break;
        }
        return $db->query($sql);       
    }
    
    public function updateSemana($num, $semana, $venta){
        global $db;
        $sql="update semana_asesor set"
           ." semase_semana=$semana, semase_ventas=$venta "
           ." where semase_id=$num ";
        $db->query($sql);
    }
    
    

    public function deleteSemana($num){
        global $db;
        $sql="delete from semana_asesor where semase_id=$num";
        $db->query($sql);
    }
}
?>  