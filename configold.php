<?php
/*$CFG = new stdClass;
$CFG->urlweb="../descuentos";
$CFG->servidor="localhost";
$CFG->db="descuentos";
$CFG->usuario="root";
$CFG->clave="";
$CFG->rootdir="/xampp/htdocs/descuentos/";
$db=new PDO('mysql:host='.$CFG->servidor.';dbname='.$CFG->db,$CFG->usuario,$CFG->clave);
$db=new PDO('mysql:host=localhost;dbname=descuentos', 'root', '');
global $db;*/


/* Conectar a una base de datos de MySQL invocando al controlador */
$dsn = 'mysql:dbname=descuentos;host=localhost';
$usuario = 'root';
$contraseña = '';

try {
    $gbd = new PDO($dsn, $usuario, $contraseña);
} catch (PDOException $e) {
    echo 'Falló la conexión: ' . $e->getMessage();
}



?>
