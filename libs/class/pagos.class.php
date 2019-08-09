    <?php

class Pagos {
    public function insertPagos($ape, $nom, $empre, $estado,$obs){
        global $db;
        $sql="insert into pagos ()";
        $db->query($sql);
    }
    
    public function getPagos($num, $val){
         $fecha = date("d/m/Y",time());
        $fch = explode("/",$fecha); 
        $fecha = $fch[2]."-".$fch[1]."-".$fch[0];
        $fecha1 = $fch[2]."-".$fch[1]."-".'01';
        //echo $fecha;
        global $db;
        //echo $val.'<br>';
        switch ($num) {
            case 0: $sql = "select * from pagos where pagos.contrato=68368;"; break;
            case 3: $sql = "select * from pagos limit 0,100;"; break;
            case 1: $sql = "select p.DIA_PAG PAGO, p.MES MES, p.ANO ANO, p.CONTRATO CONTRATO, p.NRO_RECIBO RECIBO, p.IMPORTE IMPORTE, m.NRO_DOC DNI, m.APELLIDOS APELLIDO, m.NOMBRES NOMBRE, p.SUCURSAL SUCURSAL from pagos as p inner join maestro as m on m.contrato=p.contrato where (p.sucursal='R') and (p.dia_pag between '2017-11-01' and '2017-11-31') order by p.dia_pag, p.contrato;"; break;
            case 2: $sql = "select p.dia_pag as pago, p.mes mes, p.ano año, p.contrato contrato, p.nro_recibo recibo, p.importe importe, m.nro_doc dni, m.apellidos apellido, m.nombres nombre, p.sucursal sucursal from pagos as p inner join maestro as m on m.contrato=p.contrato where (p.sucursal='R') and (p.dia_pag between '2017-11-01' and '2017-11-31') order by p.dia_pag, p.contrato;"; break;
            //case 4: $sql = "select * from pagos where (pagos.contrato=$val) and (pagos.movim='P')order by pagos.contrato, pagos.movim;"; break;
            case 4: $sql = "select ano, mes from pagos where (contrato=$val) and (movim='P') union select ano, mes from pago_bco where (contrato=$val) order by contrato, ano, mes ;"; break;
            case 5: $sql = "select ano, mes from pagos where (contrato=$val) and (movim='P') union select ano, mes from pago_bco where (contrato=$val) and (DIA_PAG between '$fecha1' and '$fecha') order by contrato, ano, mes ;"; break;

           // case 6: $sql = "select * from pagos where (DIA_PAG between '2019-02-01' and '$fecha')and (CONTRATO=$val) and (MOVIM='P') order by DIA_PAG, CONTRATO ;"; break;
            case 6: $sql = "select * from pagos where (DIA_PAG between '$fecha1' and '$fecha')and (CONTRATO=$val) and (MOVIM='P') order by DIA_PAG, CONTRATO ;"; break;
            case 7: $sql = "select * from pago_bco where (CONTRATO=$val) and (DIA_PAGO between '2019-02-01' and '$fecha') order by DIA_PAGO, contrato ;"; break;
            case 8: $sql = "select * from pagos where (CONTRATO=$val) and (MES=3) AND (ANO=2018) and (MOVIM='P') order by CONTRATO,ANO, MES ;"; break;
            case 9: $sql = "select * from pago_bco where (CONTRATO=$val) and (MES=3) AND (ANO=2018) order by contrato,ANO, MES ;"; break;

            case 10: $sql = "select * from pago_bco where (CONTRATO=$val) and (DIA_PAGO between '$fecha1' and '$fecha') order by DIA_PAGO, contrato ;"; break;
            case 11: $sql = "select * from pagos_perico where (CONTRATO=$val) and (DIA_PAG between '$fecha1' and '$fecha') and (MOVIM='P') order by DIA_PAG, CONTRATO ;"; break;
            case 12: $sql = "select * from pagos_palpala where (CONTRATO=$val) and (DIA_PAG between '$fecha1' and '$fecha') and (MOVIM='P') order by DIA_PAG, CONTRATO ;"; break;
            case 13: $sql = "select * from pagos_sanpedro where (CONTRATO=$val) and (DIA_PAG between '$fecha1' and '$fecha') and (MOVIM='P') order by DIA_PAG, CONTRATO ;"; break;
	    case 14: $sql = "select * from pagos_mutual where (DIA_PAG between '$fecha1' and '$fecha')and (CONTRATO=$val) and (MOVIM='P') order by DIA_PAG, CONTRATO ;"; break;	
           //case 11: $sql = "select CONTRATO, IMPORTE from pagos where (CONTRATO=$val) and (DIA_PAG between '$fecha1' and '$fecha') and (MOVIM ='P') UNION SELECT CONTRATO, IMPORTE pago_bco where (CONTRATO=$val) and (DIA_PAGO between '$fecha1' and '$fecha')order by DIA_PAGO, contrato ;"; break;
        default : break;

        
            
        }
        return $db->query($sql);       
    }
    
    public function getPagos2($num, $afi, $mes, $anio){
        global $db;
        //echo $val.'<br>';
        //echo $afi.'-'.$mes.'-'.$anio;
         $fecha = date("d/m/Y",time());
        $fch = explode("/",$fecha); 
        $fecha = $fch[2]."-".$fch[1]."-".$fch[0];
        $fec=$fch[1]-2;
        if ($fec<1){$fec=12;$fch[2]=$fch[2]-1;}
        $fecha1 = $fch[2].'-'.$fec.'-01';
        switch ($num) {
            case 0: $sql = "select * from pago_bco where (DIA_PAGO between '$fecha1' and '$fecha') AND (CONTRATO=$afi) and (MES=$mes) and (ANO=$anio) order by DIA_PAGO, CONTRATO, ANO, MES ;"; break;
            case 1: $sql = "select * from pagos where (DIA_PAG between '$fecha1' and '$fecha') AND (CONTRATO=$afi) and (MES=$mes) and (ANO=$anio) and (MOVIM='P') order by DIA_PAG,CONTRATO, ANO, MES ;"; break;
            case 2: $sql = "select * from pago_bcom where (DIA_PAGO between '$fecha1' and '$fecha') AND (CONTRATO=$afi) and (MES=$mes) and (ANO=$anio) order by DIA_PAGO, CONTRATO, ANO, MES ;"; break;
            case 3: $sql = "select * from pagos_mutual where (DIA_PAG between '$fecha1' and '$fecha') AND (CONTRATO=$afi) and (MES=$mes) and (ANO=$anio) and (MOVIM='P') order by DIA_PAG,CONTRATO, ANO, MES ;"; break;    
        default : break;
            
        }
        return $db->query($sql);       
    }
 
    public function getPagos3($num, $socio, $recibo, $desde){
        global $db;
        //echo $val.'<br>';
        //echo $afi.'-'.$mes.'-'.$anio;
        $fecha = date("d/m/Y",time());
        $fch = explode("/",$fecha); 
        $fecha = $fch[2]."-".$fch[1]."-".'31';
        $fecha1 = $fch[2]."-".$fch[1]."-".'01';
        switch ($num) {
            case 0: $sql = "select * from pagos where (CONTRATO=$socio) and (DIA_PAG between '$desde' and '$fecha')  and (NRO_RECIBO=$recibo) and (MOVIM='P') order by CONTRATO,DIA_PAG, NRO_RECIBO ;"; break;
            case 1: $sql = "select * from pagos where (CONTRATO=$socio) and (DIA_PAG between '$desde' and '$fecha') and (MOVIM='P') order by CONTRATO,DIA_PAG, NRO_RECIBO ;"; break;
            case 2: $sql = "select * from pago_bco where (CONTRATO=$socio) and (DIA_PAGO between '$desde' and '$fecha') order by CONTRATO,DIA_PAGO ;"; break;
            case 3: $sql = "select * from pagos_mutual where (CONTRATO=$socio) and (DIA_PAG between '$desde' and '$fecha')  and (NRO_RECIBO=$recibo) and (MOVIM='P') order by CONTRATO,DIA_PAG, NRO_RECIBO ;"; break;
            case 4: $sql = "select * from pagos_mutual where (CONTRATO=$socio) and (DIA_PAG between '$desde' and '$fecha') and (MOVIM='P') order by CONTRATO,DIA_PAG, NRO_RECIBO ;"; break;
            case 5: $sql = "select * from pago_bcom where (CONTRATO=$socio) and (DIA_PAGO between '$desde' and '$fecha') order by CONTRATO,DIA_PAGO ;"; break;
           
        default : break;
            
        }
        return $db->query($sql);       
    }

     public function getPagos4($num, $arch,$val){
        $fecha = date("d/m/Y",time());
        $fch = explode("/",$fecha); 
        $fecha = $fch[2]."-".$fch[1]."-".'31';
        $fecha1 = $fch[2]."-".$fch[1]."-".'01';
        global $db;
        //echo $val.'<br>';
        switch ($num) {
          
            case 0: $sql = "select * from $arch where (CONTRATO=$val) and (DIA_PAG between '$fecha1' and '$fecha') and (MOVIM='P') order by DIA_PAG, CONTRATO ;"; break;
            default : break;
       }
        return $db->query($sql);       
    }
    public function updatePagos($num, $ape, $nom, $emp, $obs, $esta){
        global $db;
        $sql="update personal set"
           ." prs_ape='$ape', prs_nom='$nom', prs_empre='$emp', prs_obs='$obs',prs_estado='$esta' "
           ." where prs_ide=$num ";
        $db->query($sql);
    }
    
    public function deletePagos($num,$estado){
        global $db;
        //$sql="delete from personal where prs_ide=$num";
        $sql="update personal set prs_estado='$estado' where prs_ide=$num ";
        
        $db->query($sql);
    }
}
?>  