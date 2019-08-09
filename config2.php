<?php

class Database extends PDO{
	public function _construct(){
		try{
			parent::_construct('mysql:host=localhost;dbname=crud','root','');
			parent::SetAtributte(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		} 
		catch (Exception $ex){ die('LA BD SELECCIONADA NO EXISTE')}
	}
}

?>
