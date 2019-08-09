<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/usuario.class.php";
   include "libs/class/produccion.class.php";


if (isset($_REQUEST['btn_ver'])){
	$desde=$_REQUEST['desde'];
	$hasta=$_REQUEST['hasta'];
}
  
  

 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Estados de Fichas</title>
	<link href="libs/css/marco.css" rel="stylesheet" type="text/css" media="screen" />
	<link type="image/x-icon" href="libs/img/logo_wer.png" rel="shortcut icon"/>
	<script src="libs/js/jquery-1.7.2.js"></script>
	<style type="text/css">
		a.nl:link{	text-decoration: none; }
	</style>

</head>

<body>
	<div id="encabezado"><img src="libs/img/encabezado22.jpg"/></div>
	<div id="menu-wrapper">
		<div id="menu"><?php TraerPerfil(); ?></div>
	</div>	
	<div id="contenido">	
		
		<div id="doctip"><h1>ESTADO DE FICHAS</h1></div>

		<form action="" id="formulario" action="" >
		<p style="font-size:0.8em;"><b>Fecha&nbsp;&nbsp;&nbsp;&nbsp;</b> <input type="date" name="desde" value="<?php echo $desde; ?>">&nbsp;&nbsp;A&nbsp;&nbsp;<input type="date" name="hasta" value="<?php echo $hasta; ?>">&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" name="btn_ver" value="Consultar">
		</p>	
		
		
		<h2>RESUMEN &nbsp;-&nbsp;&nbsp;&nbsp;&nbsp;TOTAL:&nbsp;<?php echo VerTotal(); ?>			
		</h2>	
		<table width="50%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%" bgcolor=#B2BABB>PENDIENTES</th>
				<th widt="15%" bgcolor=#B2BABB>ENTREGADOS</th>
				<th widt="15%" bgcolor=#B2BABB>CARGADOS</th>
				<th widt="15%" bgcolor=#B2BABB>RECHAZADOS</th>
				<th widt="15%" bgcolor=#B2BABB>MOROSOS</th>
				
								
			</thead>
			<tbody>
				<?php VerResumen(); ?>
			</tbody>
		</table>
		
		

	<p><input type="button" name="btn_volver" value="Volver" onclick="location.href = 'asesores.php'">

	</p>		
</form>
	</div>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php
function VerTotal(){
$ver=0;
if (isset($_REQUEST['btn_ver'])){
		$desde=$_REQUEST['desde'];
		$hasta=$_REQUEST['hasta'];
		
		$rows = Produccion::getProduccion2(7,0,$desde,$hasta,0);
		
		$ver=$rows->rowCount();
 }

return $ver;
	
}

function VerResumen(){
$entregado=0;
$pend=0;
$rech=0;
$cargado=0;
$pend=0;
$moroso=0;

if (isset($_REQUEST['btn_ver'])){
		$desde=$_REQUEST['desde'];
		$hasta=$_REQUEST['hasta'];
		

		$rows = Produccion::getProduccion2(7,0,$desde,$hasta,0);

		if($rows->rowCount()!=0){
	
	foreach ($rows as $row) {

		switch ($row['prod_estado']) {
				case 'PENDIENTE':$pend=$pend+1;;break;
				case 'ENTREGADO':$entregado=$entregado+1;;break;
				case 'CARGADO':$cargado=$cargado+1;break;
				case 'RECHAZADO':$rech=$rech+1;break;
				case 'MOROSO':$moroso=$moroso+1;break;
            	default:break;
        }

	
}
echo "<tr>
			  <td style='text-align:center;'><B>".$pend."</B></td>	
			  <td style='text-align:center;'><B>".$entregado."</B></td>
			  <td style='text-align:center;'><B>".$cargado."</B></td>
			  <td style='text-align:center;'><B>".$rech."</B></td>
			  <td style='text-align:center;'><B>".$moroso."</B></td>
			 
		
		    </tr>";	
}	    
else
	echo 'CONSULTA VACIA';	
	
}

}

function TraerPerfil(){
$usu=$_SESSION["usu_ide"];

$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$perfil=$row['usu_perfil'];

	}
switch ($perfil) {
				case 'VENTAS':include ('menu_vta.php'); break;
				case 'ASESOR':include ('menu_vta.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				case 'RENDICION':include ('menu.php'); break;
				default:break;
			}

}
?>
