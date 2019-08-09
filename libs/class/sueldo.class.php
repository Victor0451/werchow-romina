<?php
class Sueldo {
    //put your code here
    public function insertUsuario($ape, $nom,$usu,$pass, $obs,$perfil,$estado){
        
        global $db;
        $sql="insert into usuario (usu_apellido,usu_nombre,usu_nick,usu_clave,usu_estado,usu_obs,usu_perfil) VALUES('$ape','$nom','$usu','$pass','ACTIVO','$obs','$perfil')";
        //$sql="insert into usuario values ('', '$ape', $nom', '$nic', '$cla', '$est', '$obs')";
        $db->query($sql);
    }
    
    public function getSueldo($num, $ver){
        global $db;
        switch ($num) {
            case 0:$sql="select * from usuario where (usu_estado='ACTIVO')order by usu_apellido";break;
            case 1:$sql="select * from sueldos where sld_perfil='$ver'order by sld_perfil";break;
            case 2:$sql="select * from usuario where usu_apellido like '$val'";break;
            case 3:$sql="select * from usuario where (usu_ide=$val)";break;
            case 5:$sql="select * from usuario where (usu_perfil='RECUPERADOR') and (usu_estado='ACTIVO')";break;
            default:break;
        }
        return $db->query($sql);        
    }
    
    public function validaUsuario($usu, $cla){
		global $db;
		$sql = "select * from usuario where usu_nick='$usu' and usu_clave='$cla'";
		return $db->query($sql);
		}
    
    public function updateUsuario($num, $ape, $nom, $usu, $pass, $perfil, $obs){
        global $db;
        $sql="update usuario set 
              usu_apellido='$ape', usu_nombre='$nom', 
              usu_nick='$usu', usu_clave='$pass', 
              usu_perfil='$perfil', usu_obs='$obs' where usu_ide=$num";
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
