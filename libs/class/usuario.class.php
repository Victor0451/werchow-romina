<?php
class Usuario {
    //put your code here
    public function insertUsuario($ape, $nom,$usu,$pass,$dni,$obs,$perfil,$estado,$fecha,$sem1,$sem2,$sem3,$sem4,$grupo){
        
        global $db;
     
        $sql="insert into usuario (usu_apellido,usu_nombre,usu_nick,usu_clave,usu_dni,usu_obs,usu_estado,usu_perfil, usu_alta, usu_sem1, usu_sem2, usu_sem3, usu_sem4,usu_grupo) VALUES('$ape','$nom','$usu','$pass',$dni,'$obs','$estado','$perfil','$fecha',$sem1,$sem2,$sem3,$sem4,'$grupo')";
        //$sql="insert into usuario values ('', '$ape', $nom', '$nic', '$cla', '$est', '$obs')";
        $db->query($sql);
    }
    
    public function getUsuario($num, $val){
        //echo $val;

        global $db;
        switch ($num) {
            case 0:$sql="select * from usuario where (usu_estado='ACTIVO')order by usu_apellido";break;
            case 1:$sql="select * from usuario where usu_nick='$val'";break;
            case 2:$sql="select * from usuario where usu_apellido like '$val'";break;
            case 3:$sql="select * from usuario where (usu_ide=$val)";break;
            case 5:$sql="select * from usuario where (usu_perfil='RECUPERADOR') and (usu_estado='ACTIVO')";break;
            case 6:$sql="select CODIGO  from  producto INNER JOIN usuario ON (producto.NRO_DOC=usuario.usu_dni) WHERE (usuario.usu_ide=$val)";break;
            case 7:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_estado='ACTIVO') order by usu_obs,usu_apellido";break;
            case 8:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_obs='$val')and (usu_estado='ACTIVO') order by usu_apellido";break;
            //case 7:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_estado='ACTIVO')order by usu_obs,usu_apellido";break;
            //case 8:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_estado='ACTIVO')and (usu_obs='$val')order by usu_apellido";break;
            case 9:$sql="select * from localidad order by local_descrip";break;
            case 10:$sql="select * from localidad where (local_id=$val)order by local_descrip";break;
            case 11:$sql="select * from usuario where (usu_perfil='RECUPERADOR') ";break;
            case 12:$sql="select * from usuario where (usu_estado='ACTIVO') and usu_perfil in ('RECUPERADOR','AUDITOR','RENDICION','VENTAS')";break;
            case 13:$sql="select * from usuario where (usu_perfil='ASESOR')  order by usu_obs,usu_apellido";break;
            case 14:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_estado='ACTIVO') and (usu_grupo='$val') order by usu_obs,usu_apellido";break;
            case 15:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_estado='ACTIVO')order by usu_obs,usu_apellido";break;
            case 16:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_grupo='$val') order by usu_obs,usu_apellido";break;
            case 17:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_estado='ACTIVO')AND (usu_obs='$val') order by usu_obs,usu_apellido";break;
            
        default:break;
        }
        return $db->query($sql);        
    }
    public function getUsuario2($num, $val,$grupo){
        //echo $val;
        global $db;
        switch ($num) {
     
            case 0:$sql="select * from usuario where (usu_perfil='ASESOR') and (usu_obs='$val')and (usu_estado='ACTIVO') and (usu_grupo='$grupo') order by usu_apellido";break;
            
            default:break;
        }
        return $db->query($sql);        
    }
    
    public function validaUsuario($usu, $cla){
		global $db;
		$sql = "select * from usuario where usu_nick='$usu' and usu_clave='$cla'";
		return $db->query($sql);
		}
    
    public function updateUsuario($num, $dni,$ape, $nom, $perfil, $estado,$obs, $baja, $ingreso){
       // echo $ingreso;
        global $db;
        $sql="update usuario set 
              usu_apellido='$ape', usu_nombre='$nom', usu_dni=$dni,usu_perfil='$perfil', usu_estado='$estado',usu_obs='$obs', usu_baja='$baja', usu_alta='$ingreso' where usu_ide=$num";
        $db->query($sql);
    }

     public function updateUsuario1($num, $pass){
        global $db;
        $sql="update usuario set 
              usu_clave='$pass' where usu_ide=$num";
        $db->query($sql);
    }
    public function updateUsuario2($num, $pass){
        global $db;
        $sql="update usuario set 
              usu_clave='$pass' where usu_ide=$num";
        $db->query($sql);
    }
    
    public function deleteUsuario($num,$esta){
        global $db;
        //$sql="delete from usuario where usu_ide=$num";
        $sql="update usuario set usu_estado='$esta'  where usu_ide=$num";
        $db->query($sql);
    }

}

?>
