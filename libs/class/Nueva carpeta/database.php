<?php

class Database extends PDO{
	
	public function __construct(){
		try{
			parent::__construct('mysql:host=localhost;dbname=werchow','root','');
         parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} 
		catch (Exception $ex){ die('LA BD SELECCIONADA NO EXISTE');}
	}
}

?>

