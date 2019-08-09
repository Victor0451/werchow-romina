<?php
//incluyo la clase
require 'DataGrid.php';

//voy a crear un array para tener datos que mostrar en el data grid
$alumnos = array(
	array("id" => 1, "nombre" => "Pepe Perez", "curso" => "Informatica básica", "nivel" => 2),
	array("id" => 2, "nombre" => "María Suarez", "curso" => "Informatica avanzada", "nivel" => 1),
	array("id" => 3, "nombre" => "Roberto Soriano", "curso" => "Sistemas operativos", "nivel" => 2),
	array("id" => 5, "nombre" => "Alberto Rodriguez", "curso" => "Inglés técnico", "nivel" => 1),
	array("id" => 7, "nombre" => "Julia Marcos", "curso" => "Sociología", "nivel" => 3),
	array("id" => 10, "nombre" => "Socorro Rozas", "curso" => "Informatica básica", "nivel" => 1),
	array("id" => 11, "nombre" => "Pablo Reñones", "curso" => "Informatica básica", "nivel" => 2)
);

function nivel_estrellas($num){
	$estrellas = "";
	for ($i=0; $i<$num; $i++){
		$estrellas .= "*";
	}
	return $estrellas;
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Ejemplo de uso de data grid</title>
<style type="text/css">
.fila{background-color:#ffffcc;}
.filaalterna{background-color:#ffcc99;}
.fdg_sortable {cursor:pointer;text-decoration:underline;color:#00c;}
</style>
</head>

<body>

<?php

//instancio el objeto data grid, pasando como parámetro el array anterior
Fete_ViewControl_DataGrid::getInstance($alumnos)
//VOY LANZANDO DIVERSOS MÉTODOS SOBRE ESTE OBJETO INSTANCIADO
//atributos generales para la tabla
->setGridAttributes(array('cellspacing' => '3', 'cellpadding' => '4', 'border' => '0'))
//permito que haya características de ordenación
->enableSorting(true)
//hago un setup de las columnas del data grid, indicando el valor que se mostrará en la primera fila, cabecera del data grid
->setup(array(
	'id' => array('header' => 'ID'),
    'nombre' => array('header' => 'Nombre'),
    'curso' => array('header' => 'Curso'),
    'nivel' => array('header' => 'Nivel curso')
))
//defino el estilo para las filas
->setRowClass('fila')
//defino el estilo para las filas alternas
->setAlterRowClass('filaalterna')
//llamo al método para mostrar el datagrid
->render();
?>


</body>
</html>
