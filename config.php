<?php
$CFG = new stdClass;
$CFG->urlweb="../werchow";
$CFG->servidor="localhost";
$CFG->db="werchow";
$CFG->usuario="root";
$CFG->clave="";
$CFG->rootdir="/werchow/";
$db=new PDO('mysql:host='.$CFG->servidor.';dbname='.$CFG->db,$CFG->usuario,$CFG->clave);
global $db;
?>