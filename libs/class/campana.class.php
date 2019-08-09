<?php
class Campana
{
    //put your code here
    public function insertUsuario($ape, $nom, $usu, $pass, $dni, $obs, $perfil, $estado, $fecha)
    {

        global $db;

        $sql = "insert into usuario (usu_apellido,usu_nombre,usu_nick,usu_clave,usu_dni,usu_obs,usu_estado,usu_perfil, usu_alta) VALUES('$ape','$nom','$usu','$pass',$dni,'$obs','$estado','$perfil','$fecha')";
        //$sql="insert into usuario values ('', '$ape', $nom', '$nic', '$cla', '$est', '$obs')";
        $db->query($sql);
    }

    public function getCampana($num, $socio)
    {

        $fecha = date("d/m/Y", time());
        $fch = explode("/", $fecha);
        $fecha = $fch[2] . "-" . $fch[1] . "-" . $fch[0];
        $fecha1 = $fch[2] . "-" . $fch[1] . "-" . '01';
        //echo $val;
        //ECHO 'RO'.$socio;
        global $db;
        switch ($num) {
                //case 0:$sql="select Campana from campanas INNER JOIN campanascasos ON (campanas.IDCampana=campanascasos.IDCampana) where (campanascasos.Legajo=$socio) AND (campanas.Finalizada=0) order by campanas.IDCampana ";break;
                //case 0:$sql="select campanas.IDCAMPANA,campanas.Tipo,campanascasos.IDCASO,campanas.CAMPANA FROM CAMPANAS INNER JOIN campanascasos ON (campanas.IDCAMPANA=campanascasos.idcampana)where campanascasos.legajo=$socio and campanas.finalizada=0 and (campanascasos.cerrado=0)";break;
            case 0:
                $sql = "select campanas.IDCAMPANA,campanas.Tipo,campanascasos.IDCASO,campanas.CAMPANA FROM CAMPANAS INNER JOIN campanascasos ON (campanas.IDCAMPANA=campanascasos.idcampana)where campanascasos.legajo=$socio and ((campanas.finalizada=0)and(campanascasos.cerrado=0))";
                break;
                /*case 0:$sql="select campanas.IDCAMPANA,campanas.Tipo,campanascasos.IDCASO,campanas.CAMPANA FROM CAMPANAS INNER JOIN campanascasos ON (campanas.IDCAMPANA=campanascasos.idcampana)where campanascasos.legajo=$socio and campanas.finalizada=0 and ((campanascasos.Cerrado=0) or (campanascasos.FechaPago BETWEEN ('2018-12-01')and ('$fecha')))ORDER BY campanascasos.Legajo";break;  ESTA ES LA ORIGINAL DEMORABA*/




            default:
                break;
        }
        return $db->query($sql);
    }
}
