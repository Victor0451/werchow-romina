<?php
//conexion DB
require 'libs/class/database.php';
$objData = new Database();

//print_r($_POST);

$sth= $objData->prepare('INSERT INTO datos values (:id, :nombre, :descrip)'); 

$idDato='';
$nombre= $_POST['nombre'];
$descrip= $_POST['descrip'];


$sth->bindParam(':id', $idDato);
$sth->bindParam(':nombre', $nombre);
$sth->bindParam(':descrip', $descrip);

$sth->execute();

//header('location: prueba3.php');
?>
