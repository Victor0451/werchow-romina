<script language="javascript" type="text/javascript">

    //*** Este Codigo permite Validar que sea un campo Numerico
    function Solo_Numerico(variable){
        Numer=parseInt(variable);
        if (isNaN(Numer)){
		
            return "";
		        }
        return Numer;
    }
    function ValNumero(Control){
        Control.value=Solo_Numerico(Control.value);
    }
    
</script>
<?php
   include "info.php"; 
   include "config.php";
   include "libs/class/parcela.class.php";
   include "libs/class/usuario.class.php";
  $cmt='';$parcela='';$estado='';$manzana='';$seccion='';
$fecha = date("d/m/Y",time());
   if (isset($_REQUEST['btn_guardar'])){
   		$fecha = date("d/m/Y",time());
		$fch = explode("/",$fecha); 
		$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
   		$usu=$_SESSION["usu_ide"];
   		//echo 'HOLA'.$usu;
   		$estado='DISPONIBLE';
		$rows = Parcela::insertParcela($fecha,$_REQUEST['cmt'],$_REQUEST['manzana'],$_REQUEST['parcela'],$estado,$usu,$_REQUEST['seccion']);
   		$cmt='';$parcela='';$estado='';$manzana='';$seccion='';
   		print'<script type="text/javascript">
		window.location="abm-parcela.php";
		</script>';
   	
   	}	
 
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Alta Parcelas</title>
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
		
		<div id="doctip"><h1>ALTA PARCELAS</h1></div>

		<form action="" id="formulario" action="" >
		<input type="hidden" name="usu_ide" value="<?php echo $usu_ide; ?>">
		<p style="font-size:0.8em;">Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		Cementerio&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Manzana/Sector&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parcela&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sección
		<br> <input type="text" name="fecha" value="<?php echo $fecha;?>" size="8x" disabled>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="cmt" id="cmt" >
				<option value= "<?php echo $cmt; ?>" selected="selected"><?php echo $cmt; ?></option>
				<option value="CASTILLO">CASTILLO</option>
				<option value="SOLAR">SOLAR</option>
				<option value="ROSARIO">ROSARIO</option>
				<option value="SALVADOR">SALVADOR</option>
		</select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="text" name="manzana" value="<?php echo $manzana;?>" size="10x">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="parcela" value="<?php echo $parcela;?>" size="5x">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="seccion" value="<?php echo $seccion;?>" size="5x">
		</p>
	
        
        
	<p><input type="submit" name="btn_guardar" value="GUARDAR">&nbsp;<input type="button" name="btn_volver" value="SALIR" onclick="location.href = 'index.php'"></p>		
</form>
<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="15%">FechaAlta</th>
				<th widt="15%">Cementerio</th>
				<th widt="15%">Manzana</th>
				<th widt="10%">Parcela</th>
				<th widt="10%">Seccion</th>
				<th widt="15%">Usuario</th>
				
				
			</thead>
			<tbody>
				<?php VerParcela(); ?>
			</tbody>
		</table>
	</div>
	<br>
	<div id="footer">
		
		<center>WERCHOW - Año 2018 - </center>
	</div>
</body>
</html>

<?php

function VerUsuario(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_nombre']." ".$row['usu_apellido']);
	}
    
}

function VerPerfil(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return strtoupper($row['usu_perfil']);
	}
    
}

function VerNick(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return $row['usu_nick'];
	}
    
}

function TraerUsuario($usu){
	$rows = Usuario::getUsuario(3,$usu);
	
	foreach ($rows as $row) {

		return $row['usu_nick'];
	}
    
}

function VerParcela(){
	$con=0;
		$fecha = date("d/m/Y",time());
		$fch = explode("/",$fecha); 
		$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
	$rows = Parcela::getParcela(0,$fecha);
	if($rows->rowCount()!=0){
		foreach ($rows as $row) {
			$con=$con+1;
			$us=TraerUsuario($row['par_usualta']);
			echo "<tr>
			  <td style='text-align:center;'>".$con."</td>	
			  <td>".$row['par_fechalta']."</td>
			  <td>".$row['par_cementerio']."</td>
			  <td>".$row['par_mza']."</td>
			  <td>".$row['par_nom']."</td>
			  <td>".$row['par_seccion']."</td>
			  <td>".$us."</td>
			  
			  
			  
		    </tr>";
	    }
	}    
}

function TraerPerfil(){
$usu=$_SESSION["usu_ide"];

$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
		
		$per=$row['usu_perfil'];

	}
switch ($per) {
				case 'VENTAS':include ('menu_vta.php'); break;
				case 'ASESOR':include ('menu_vta.php'); break;
				case 'ROOT':include ('menu.php'); break;
				case 'AUDITOR':include ('menu.php'); break;
				default:break;
			}

}
?>
