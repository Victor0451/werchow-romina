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
   include "libs/class/usuario.class.php";
   
   $nombre=null; $apellido=null;$sucursal=null; $estado=null;$dni=null;$perfil='ASESOR';$usu_ide=0;$ingreso=null;
   $sem1=0;$sem2=0;$sem3=0;$sem4=0;$grupo='';

$per=VerPerfil();
if ($per=='ASESOR'){print '<script language="JavaScript">'; 
	print 'alert("NO ESTA HABILITADO PARA LA OPCION SOLICITADA");'; 
	print'</script>';
	print'<script type="text/javascript">
window.location="asesores.php";
</script>';}
else{


   if (isset($_REQUEST['btn_guardar'])){
   	$fecha = date("d/m/Y",time());
		$fch = explode("/",$fecha); 
		$fecha = $fch[2]."-".$fch[1]."-".$fch[0];
   		if ($_REQUEST['usu_ide'] == 0){//NUEVO
   		$perfil='ASESOR';
   		$ingreso=$_REQUEST['ingreso'];
   		/*$fecha = date("d/m/Y",time());
		$fch = explode("/",$fecha); 
		$fecha = $fch[2]."-".$fch[1]."-".$fch[0];*/
		$v1=substr($_REQUEST['nombre'], 0, 1);
		$usu=strtolower($v1.$_REQUEST['apellido']);

		$pass='123';
		
        print '<script language="JavaScript">'; 
				print 'alert("Usuario: '.$usu.' Clave: '.$pass.'");'; 
				print'</script>';
		$semanas = $_REQUEST['semanas'];		
	//	$texto = implode(', ', $semanas);
		foreach($semanas as $semana){
		    $valor =$semana;
  			switch ($valor) {
				case 'sem1':$sem1=1; break;
				case 'sem2':$sem2=1; break;
				case 'sem3':$sem3=1; break;
				case 'sem4':$sem4=1; break;
				default:break;
			}
  
		}
	//	echo $sem1.'-'.$sem2.'-'.$sem3.'-'.$sem4;

	$rows = Usuario::insertUsuario(strtoupper($_REQUEST['apellido']),strtoupper($_REQUEST['nombre']),$usu,$pass,$_REQUEST['dni'],$_REQUEST['sucursal'],$perfil,$_REQUEST['estado'],$ingreso, $sem1,$sem2,$sem3,$sem4,$_REQUEST['grupo']);
   		
   		print'<script type="text/javascript">
		window.location="abm-asesor.php";
		</script>';
   	
   	}	
   	else{//modificacion
   		if ($_REQUEST['estado']=='BAJA'){
   			   	$baja = date("d/m/Y",time());
				$bja = explode("/",$baja); 
				$baja = $bja[2]."-".$bja[1]."-".$bja[0];}
   		else{$baja=null;}
   		//echo $perfil;
		$rows = Usuario::updateUsuario($_REQUEST['usu_ide'], $_REQUEST['dni'],strtoupper($_REQUEST['apellido']),strtoupper($_REQUEST['nombre']),$perfil,$_REQUEST['estado'],$_REQUEST['sucursal'],$baja,$_REQUEST['ingreso'],$_REQUEST['grupo']);
		//$monto=0; $accion = null; $nombre = ""; $plan=null; $fpago=null; $socio=0; $recibo=0; $cuotas=0;$total=0;$liq_id=0;
		/*print'<script type="text/javascript">
		window.location="abm-asesor.php";
		</script>';*/
	
   	}
   }
   	else{
   		if (isset($_REQUEST['op'])){
				switch ($_REQUEST['op']) {
					case 'md': //modificar
						$rows = Usuario::getUsuario(3,$_REQUEST['usu_ide']);
						$row = $rows->fetch();
						$apellido = $row['usu_apellido'];
						$nombre = $row['usu_nombre']; 
						$dni = $row['usu_dni'];
						$perfil = $row['usu_perfil'];
						$sucursal = $row['usu_obs'];
						$estado = $row['usu_estado'];
						$usu_ide = $row['usu_ide'];
						$ingreso= $row['usu_alta'];
					break;
				}	
			}
   	}
   	//$perfil='ASESOR';$dni=null;$nom=null;$ape=null;
}
 ?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nuevo Asesor</title>
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
		
		<div id="doctip"><h1>Carga nuevo Asesor</h1></div>

		<form action="" id="formulario" action="" >
		<input type="hidden" name="usu_ide" value="<?php echo $usu_ide; ?>">
		<p style="font-size:0.8em;">NOMBRE<br><input type="text" name="nombre" value="<?php echo $nombre;?>" size="80x" ></p>
		<p style="font-size:0.8em;">APELLIDO<br><input type="text" name="apellido" value="<?php echo $apellido;?>" size="80x" ></p>
		<p style="font-size:0.8em;">DNI&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FECHA INGRESO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PERFIL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUCURSAL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ESTADO<br><input type="text" name="dni" value="<?php echo $dni;?>" size="10x" onkeyUp="return ValNumero(this);" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="date" name="ingreso" value="<?php echo $ingreso;?>">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="perfil" value="<?php echo $perfil;?>" size="8x" disabled>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<select name="sucursal" id="sucursal" >
				<option value= "<?php echo $sucursal; ?>" selected="selected"><?php echo $sucursal; ?></option>
				<option value="JUJUY">JUJUY</option>
				<option value="PALPALA">PALPALA</option>
				<option value="PERICO">PERICO</option>
				<option value="SAN PEDRO">SAN PEDRO</option>
		</select>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<select name="estado" id="estado" >
				<option value= "<?php echo $estado; ?>" selected="selected"><?php echo $estado; ?></option>
				<option value="ACTIVO">ACTIVO</option>
				<option value="BAJA">BAJA</option>
		</select>
	</p>
	<p style="font-size:0.8em;">LIQUIDAR (Usuario nuevo*):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GRUPO:
	<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sem1<input type="checkbox" name="semanas[]" value='sem1' />
        
        Sem2 <input type="checkbox" name="semanas[]" value='sem2' />
        
        Sem3 <input type="checkbox" name="semanas[]" value='sem3' />

        Sem4 <input type="checkbox" name="semanas[]" value='sem4' />
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
        <select name="grupo" id="grupo" >
				<option value= "<?php echo $grupo; ?>" selected="selected"><?php echo $grupo; ?></option>
				<option value="SANDRA">SANDRA</option>
				<option value="RODRIGO">RODRIGO</option>
				<option value="PALPALA">PALPALA</option>
				<option value="PERICO">PERICO</option>
				<option value="SAN PEDRO">SAN PEDRO</option>
		</select>
        
	<p><input type="submit" name="btn_guardar" value="GUARDAR">&nbsp;<input type="button" name="btn_volver" value="SALIR" onclick="location.href = 'asesores.php'"></p>		
</form>
<h2>Lista</h2>
		<table width="100%" border=1 style="border-collapse:collapse; font-size:0.6em;">
			<thead>
				<th widt="5%">Nº</th>
				<th widt="15%">FechaAlta</th>
				<th widt="15%">Asesor</th>
				<th widt="15%">DNI</th>
				<th widt="10%">Nick</th>
				<th widt="15%">Perfil</th>
				<th widt="15%">Sucursal</th>
				<th widt="15%">Grupo</th>
				<th widt="15%">Estado</th>
				<th widt="5%">Editar</th>
				
			</thead>
			<tbody>
				<?php VerAsesor(); ?>
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

function VerPass(){
	$rows = Usuario::getUsuario(3,$_SESSION["usu_ide"]);
	
	foreach ($rows as $row) {
	
		return $row['usu_clave'];
	}
    
}

function VerAsesor(){
	$con=0;
	$rows = Usuario::getUsuario(7,0);
	foreach ($rows as $row) {
		$con=$con+1;
	echo "<tr>
			  <td style='text-align:center;'>".$con."</td>	
			  <td>".$row['usu_alta']."</td>
			  <td>".$row['usu_apellido'].' '.$row['usu_nombre']."</td>
			  <td>".$row['usu_dni']."</td>
			  <td>".$row['usu_nick']."</td>
			  <td>".$row['usu_perfil']."</td>
			  <td>".$row['usu_obs']."</td>
			   <td>".$row['usu_grupo']."</td>
			  <td>".$row['usu_estado']."</td>
			  <td><center><a href='?op=md&usu_ide=".$row['usu_ide']."'><img src='libs/img/campa.jpg' ></a><center></td>
			  
		    </tr>";
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
