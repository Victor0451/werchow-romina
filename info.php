<?php
//control de sesion
session_start();
if(!isset($_SESSION['auth'])){header("location:log.php"); }
else{
	if(isset($_REQUEST['cerrar'])){
		session_unset();
		session_destroy();
		header("location:log.php");
		}
	}
?>