<?php
//MOTIVO
class Produccion
{
    public function insertProduccion($fecha, $fechac, $asesor, $mes, $anio, $apellido, $nombre, $dni, $localidad, $recibo, $monto, $plan, $pago, $cta_tar, $estado, $cierre, $rendido, $empresa)
    {
        global $db;

        $sql = "insert into produccion (prod_fechacarga,prod_fechaafi,prod_asesor,prod_mes,prod_anio,prod_apeafi,prod_nomafi,prod_dniafi, prod_local, prod_recibo, prod_monto,prod_plan,prod_pago, prod_cta_tar,prod_estado, prod_cierre , prod_rendido, prod_empre) VALUES('$fecha','$fechac',$asesor,'$mes',$anio,'$apellido','$nombre',$dni,$localidad,$recibo,$monto,'$plan','$pago',$cta_tar,'$estado',$cierre,'$rendido','$empresa')";
        $db->query($sql);
    }


    public function getProduccion($num, $val)
    {
        global $db;
        switch ($num) {
            case 0:
                $sql = "select * from produccion where (prod_asesor=$val)and (prod_estado='PENDIENTE') order by prod_asesor";
                break;
            case 1:
                $sql = "select * from produccion where (prod_estado='PENDIENTE') order by prod_asesor";
                break;
            case 2:
                $sql = "select * from produccion where (prod_ide=$val) order by prod_ide";
                break;
            case 3:
                $sql = "select * from produccion where (prod_asesor=$val) and (prod_estado='PENDIENTE') order by prod_asesor, prod_fechaafi";
                break;
            case 4:
                $sql = "select localidad.local_descrip from localidad inner join produccion where (produccion.prod_local=localidad.local_id)  order by localidad.local_id";
                break;
            case 5:
                $sql = "select * from produccion where (prod_estado='ENTREGADO')or(prod_estado='APROBADO') or (prod_estado='CARGADO')order by prod_fechaafi";
                break;
            case 6:
                $sql = "select * from produccion where (prod_estado='ENTREGADO')or(prod_estado='APROBADO') order by prod_fechaafi";
                break;

            default:
                break;
        }
        return $db->query($sql);
    }
    public function getProduccion2($num, $val, $mes, $anio, $estado)
    {
        //ECHO 'ENTRE-'.$num.'-'.$val.'-'.$mes.'-'.$anio.'-'.$estado;
        global $db;
        switch ($num) {

            case 0:
                $sql = "select * from produccion where (prod_asesor=$val) and (prod_mes='$mes')and (prod_anio=$anio) and (prod_estado='$estado') order by prod_asesor, prod_fechaafi";
                break;
                //            case 1:$sql="select * from produccion where (prod_mes='$mes') and (prod_anio=$anio) order by prod_asesor, prod_fechaafi";break; 
            case 1:
                $sql = "select * from  produccion LEFT JOIN usuario ON produccion.prod_asesor = usuario.usu_ide where (usuario.usu_obs='$estado')AND(produccion.prod_mes='$mes') and (produccion.prod_anio=$anio) order by prod_asesor, prod_fechaafi";
                break;
           /* case 2:
                $sql = "select * from produccion where (prod_mes='$mes')and (prod_anio=$anio) and (prod_estado='$estado') order by prod_asesor, prod_semana, prod_fechaafi, prod_estado";
                break;*/
            case 2:
                $sql = "select * from  produccion LEFT JOIN usuario ON produccion.prod_asesor = usuario.usu_ide where (usuario.usu_obs='$estado')AND(produccion.prod_mes='$mes') and (produccion.prod_anio=$anio) and (produccion.prod_estado='$val') order by prod_asesor, prod_fechaafi";
                break;    
            case 3:
                $sql = "select * from produccion where (prod_asesor=$val) and (prod_mes='$mes')and (prod_anio=$anio) order by prod_asesor, prod_fechaafi, prod_estado";
                break;

            case 4:
                $sql = "select * from produccion where (prod_mes='$mes') and (prod_anio=$anio) and (prod_semana=$val) order by prod_asesor, prod_semana";
                break;
            case 5:
                $sql = "select * from produccion where (prod_asesor=$val) and (prod_mes='$mes')and (prod_anio=$anio) and (prod_estado='$estado')order by prod_asesor, prod_fechaafi, prod_estado";
                break;
            case 6:
                $sql = "select * from produccion where (prod_semana=$val) and (prod_mes='$mes')and (prod_anio=$anio) and (prod_estado='$estado')order by prod_asesor, prod_semana, prod_fechaafi, prod_estado";
                break;
            case 7:
                $sql = "select * from produccion where (prod_fechacarga between '$mes' and '$anio') order by prod_fechacarga, prod_asesor,prod_estado";
                break;
            case 8:
                $sql = "select * from produccion where (prod_mes = '$mes') and (prod_anio=$anio) and (prod_estado='$estado') order by prod_mes, prod_anio, prod_asesor,prod_estado";
                break;
            case 9:
                $sql = "select * from produccion where (prod_asesor=$val) and (prod_mes='$mes')and (prod_anio=$anio) and ((prod_estado='CARGADO')OR(prod_estado='ENTREGADO'))order by prod_asesor, prod_fechaafi, prod_estado";
                break; // PARA ESTIMAR VENTAS

                // case 10:$sql="select * from produccion left join usuarios on usuario.usu_ide=produccion.prod_asesor where (produccion.prod_mes='$mes') and (produccion.prod_anio=$anio) and (usuario.usu_grupo='$estado') order by produccion.prod_asesor, produccion.prod_fechaafi";break;// Todos x grupo
            case 10:
                $sql = " select * from  produccion LEFT JOIN usuario ON produccion.prod_asesor = usuario.usu_ide 
WHERE (produccion.prod_mes='$mes') and (produccion.prod_anio=$anio)";
                break;
            case 11:
                $sql = " select * from  produccion LEFT JOIN usuario ON produccion.prod_asesor = usuario.usu_ide 
WHERE (produccion.prod_mes='$mes') and (produccion.prod_anio=$anio)and (produccion.prod_estado='$val')";
                break;
            case 12:
                $sql = "select * from produccion where (prod_asesor=$val) and (prod_fechaafi between '$mes' and '$anio') and (prod_estado='$estado')order by prod_asesor, prod_fechaafi, prod_estado";
                break;
                /*case 3:$sql="select * from produccion where (prod_asesor=$val) and (prod_mes='$mes')and (prod_anio=$anio) order by prod_asesor, prod_fechaafi, prod_estado";break;
             case 13:$sql=" select * from  produccion LEFT JOIN usuario ON produccion.prod_asesor = usuario.usu_ide 
WHERE (usuario.usu_obs='JUJUY')  AND (produccion.prod_mes='$mes') and (produccion.prod_anio=$anio)and (produccion.prod_asesor='$val')";break; */
                //solo para ver todas pendientes de sucur
            case 15:
                $sql = "select * from produccion where (prod_asesor=$val) and (prod_mes='$mes')and (prod_anio=$anio)order by prod_asesor, prod_fechaafi, prod_estado";
                break;
            default:
                break;
        }
        return $db->query($sql);
    }

    public function getProduccion3($num, $asesor, $mes, $anio, $estado, $sem)
    {

        global $db;
        switch ($num) {

            case 0:
                $sql = "select * from produccion where (prod_asesor=$asesor) and (prod_mes='$mes') and (prod_anio=$anio) and (prod_estado='$estado') and (prod_semana=$sem) order by prod_asesor, prod_fechaafi";
                break;
            case 1:
                $sql = "select * from produccion where (prod_asesor=$asesor) and (prod_mes='$mes') and (prod_anio=$anio) and ((prod_estado='CARGADO')OR(prod_estado='ENTREGADO')) and (prod_semana=$sem) order by prod_asesor, prod_fechaafi";
                break;
            case 2:
                $sql = "select * from produccion where (prod_asesor=$asesor) and (prod_mes='$mes') and (prod_anio=$anio) and (prod_estado='$estado')order by prod_asesor, prod_fechaafi";
                break;
            case 3:
                $sql = "select * from produccion where (prod_asesor=$asesor) and (prod_mes='$mes') and (prod_anio=$anio)  order by prod_asesor, prod_fechaafi";
                break;

            default:
                break;
        }
        return $db->query($sql);
    }


    public function updateProduccion($num, $fechac, $mes, $anio, $asesor, $apellido, $nombre, $dni, $localidad, $recibo, $monto, $plan, $pago, $cta_tar, $empresa)
    {
        global $db;

        $sql = "update produccion set prod_fechaafi='$fechac', prod_mes='$mes',prod_anio=$anio,prod_asesor=$asesor,prod_apeafi='$apellido',prod_nomafi='$nombre',prod_dniafi=$dni, prod_local=$localidad, prod_recibo=$recibo, prod_monto=$monto, prod_plan='$plan', prod_pago='$pago', prod_cta_tar=$cta_tar,prod_empre='$empresa' where prod_ide=$num ";
        $db->query($sql);
    }

    public function updateProduccion1($cod, $num, $est, $sem)
    {
        $fecha = date("d/m/Y", time());
        $fch = explode("/", $fecha);
        $fecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];
        global $db;
        switch ($cod) {
            case 0:
                $sql = "update produccion set prod_estado='$est', prod_semana=$sem where prod_ide=$num ";
                break;
            case 1:
                $sql = "update produccion set prod_estado='$est', prod_obs='$sem' where prod_ide=$num ";
                break;
            case 2:
                $sql = "update produccion set prod_estado='$est', prod_afiliado='$sem' where prod_ide=$num ";
                break;
            case 3:
                $sql = "update produccion set prod_rendido='$est',prod_recibosis=$sem,prod_fechren='$fecha' where prod_ide=$num ";
                break;
            default:
                break;
        }
        $db->query($sql);
    }
    public function updateProduccion2($cod, $num, $est, $sem, $dni)
    {
        global $db;
        switch ($cod) {

            case 1:
                $sql = "update produccion set prod_estado='$est', prod_obs='$sem', prod_dniafi=$dni where prod_ide=$num ";
                break;

            default:
                break;
        }
        $db->query($sql);
    }


    public function deleteProduccion($num)
    {
        global $db;
        $sql = "delete from produccion where prod_ide=$num";
        $db->query($sql);
    }
}
