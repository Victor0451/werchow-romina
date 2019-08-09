<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Canal 2 - Carga Call Center</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" >
</head>

<script language="javascript" type="text/javascript">

    //*** Este Codigo permite Validar que sea un campo Numerico
    function Solo_Numerico(variable){
        Numer=parseInt(variable);
        if (isNaN(Numer)){
			//alert ("Por favor ingrese solo numeros");
            return "";
			//return (alert ("Por favor ingrese dni o apellido correctamente"));
			
        }
        return Numer;
    }
    function ValNumero(Control){
        Control.value=Solo_Numerico(Control.value);
    }
    //*** Fin del Codigo para Validar que sea un campo Numerico

function Solo_Letra(variable){
        //Numer=parseInt(variable);
		//cadena= variable;
        if (isNaN(variable)){
			if( variable && !(variable.search(/[a-zA-Z]$/)+1) ){
     return""; }		
            return variable;
			//return (alert ("Por favor ingrese dni o apellido correctamente"));
			//document.insert.dni.focus()
        }
		
        return "";
    }
    function ValLetra(Control){
        Control.value=Solo_Letra(Control.value);
    }

</script>

<script language="javascript" type="text/javascript">

function valida_envia(form){

//valido nombre
	if (form.nom.value==""){
      alert("Tiene que completar el campo NOMBRE.");
      form.nom.focus();
      return false;
    }    
//valido Abonado
    if (form.selectA.value==0){
       alert("Tiene que seleccionar un ABONADO");
       form.selectA.focus();
       return false;
    }
//valido LOCALIDAD
    if (form.localidad.value==0){
       alert("Tiene que seleccionar una LOCALIDAD");
       form.localidad.focus();
       return false;
    }
//valido LOCALIDAD
    if (form.localidad.value==0){
       alert("Tiene que seleccionar una LOCALIDAD");
       form.localidad.focus();
       return false;
    }
//valido BARRIO
    if (form.barrio.value==0){
       alert("Tiene que seleccionar una BARRIO");
       form.barrio.focus();
       return false;
    }
//valido CALLE
    if (form.calle.value==0){
       alert("Tiene que seleccionar una CALLE");
       form.calle.focus();
       return false;
    }
//valido num
if (form.num.value==""){
      alert("Tiene que complete el campo Numero.");
      form.num.focus();
      return false;
    }
//valido mza
if (form.mza.value==""){
      alert("Tiene que complete el campo Manzana.");
      form.mza.focus();
      return false;
    }
//valido lote
if (form.lote.value==""){
      alert("Tiene que complete el campo Lote.");
      form.lote.focus();
      return false;
    }
//valido piso
if (form.piso.value==""){
      alert("Tiene que complete el campo Piso.");
      form.piso.focus();
      return false;
    }

//valido dpto	
if (form.dpto.value==""){
      alert("Tiene que complete el campo Departamento.");
      form.dpto.focus();
      return false;
    }
//valido telefono fijo	
if (form.tel.value==""){
      alert("Tiene que complete el campo Fijo.");
      form.tel.focus();
      return false;
    }
//valido telefono celular
if (form.cel.value==""){
      alert("Tiene que complete el campo Celular.");
      form.cel.focus();
      return false;
    }
//valido CABLE
    if (form.select1.value==0){
       alert("Tiene que seleccionar un valor al campo CABLE");
       form.select1.focus();
       return false;
    }
//valido PC
    if (form.select2.value==0){
       alert("Tiene que seleccionar un valor al campo PC");
       form.select2.focus();
       return false;
    }
//valido INTERNET
    if (form.select3.value==0){
       alert("Tiene que seleccionar un valor al campo INTERNET");
       form.select3.focus();
       return false;
    }	
//valido VELOCIDAD
    if (form.select4.value==0){
       alert("Tiene que seleccionar un valor al campo VELOCIDAD");
       form.select4.focus();
       return false;
    }	
//valido abomo
	if (form.rta1.value==""){
      alert("Tiene que complete el campo Abono.");
      form.rta1.focus();
      return false;
    }
//valido interes
    if (form.select5.value==0){
       alert("Tiene que seleccionar un valor al campo INTERES");
       form.select5.focus();
       return false;
    }	
//valido ESTADO
    if (form.select6.value==0){
       alert("Tiene que seleccionar un valor al campo ESTADO");
       form.select6.focus();
       return false;
    }	
//valido LLAMADO
    if (form.select7.value==0){
       alert("Tiene que seleccionar un valor al campo LLAMADO");
       form.select7.focus();
       return false;
    }	
//valido PROMOTOR
    if (form.select8.value==0){
       alert("Tiene que seleccionar un valor al campo PROMOTOR");
       form.select8.focus();
       return false;
    }	
}
</script>

<body>

<div id="BloqueCentral">

<div id="BloqueCentralContenido"><b>CARGA DATOS DE CALL CENTER</b></div>

<form name="formulario20" action="detalle-call.php" method="get" onSubmit="return valida_envia(this);">
<!--<input type="hidden" name="cod" value="<?php// echo $_GET['cod']; ?>">
<input type="hidden" name="fecha" value="<?php// echo $_GET['fecha']; ?>">
<input type="hidden" name="us" value="<?php// echo $_GET['us']; ?>">-->
<div style="position:absolute; top:70px; padding:5px;">
	Apellido y Nombre <input name="nom" type="text" id="nom" size="50px" />
</div>
<div style="position:absolute; top:70px; padding:5px; left:500px;"> Abonado?:
	<select name="selectA">
	  <option value=0> </option>
	  <option value="SI">SI</option>	
	  <option value="NO">NO</option>
	  
    </select>
</div>

<div style="position:absolute; top:110px; padding:5px;">
	<table width="100%" border="0">
  <tr>
    <td width="10%">Localidad</td>
    <td colspan="4">
	<select name="localidad">
	<option value="0">- Seleccionar -</option>
	<?php SeleccionarLocalidad(); ?>
	</select>
	</td>
  </tr>
  </table>

</div>	

<div style="position:absolute; top:110px; padding:5px; left: 375px;">
	<table width="100%" border="0">
  <tr>
    <td width="10%">Barrio</td>
    <td colspan="4">
	<select name="barrio">
	<option value="0">- Seleccionar -</option>
	<?php SeleccionarBarrio(); ?>
	</select>
	</td>
  </tr>
  </table>

</div>	

<div style="position:absolute; top:150px; padding:5px;">
<!--Calle: <input name="calle" id="calle" type="text" size="35px">-->
<table width="100%" border="0">
  <tr>
    <td width="10%">Calle</td>
    <td colspan="4">
	<select name="calle">
	<option value=0>- Seleccionar -</option>
	<?php CargarCalle(); ?>
	</select>
	</td>
  </tr>
</table>
</div>
<div style="position:absolute; top:150px; padding:5px;left:285px;">
Nro: <input name="num" id="numero" type="text" maxlength="4" size="2px" onkeyUp="return ValNumero(this);"/>
Mza: <input name="mza" id="numero" type="text" maxlength="6" size="2px" />
Lote: <input name="lote" id="numero" type="text" maxlength="4" size="2px" />
Piso: <input name="piso" id="numero" type="text" maxlength="4" size="2px" />
Dpto: <input name="dpto" id="numero" type="text" maxlength="4" size="2px" />
</div>

<div style="position:absolute; top:190px; padding:5px;">
	Telefonos: Fijo:  <input name="tel" type="text" id="telefono" size="12px" onkeyUp="return ValNumero(this);"/>
	&nbsp;&nbsp;&nbsp;Celular : <input name="cel" type="text" id="celular" size="12px" onkeyUp="return ValNumero(this);"/>
	&nbsp;&nbsp;&nbsp;E-mail : <input name="mail1" type="text" id="mail" size="18px" />
	@<input name="mail2" type="text" id="mail2" size="12px" />
</div>
<div style="position:absolute; top:230px; padding:5px;"> Cable Actual?:
 <select name="select1">
	  <option value=0>Seleccionar</option>
	  <option value="NINGUNO">NINGUNO</option>	
	  <option value="CANAL 2">CANAL2</option>
	  <option value="CANAL 4">CANAL4</option>
	  <option value="CANAL 7">CANAL7</option>
	  <option value="CABLEVISION">CABLEVISION</option>
      <option value="DIRECTV">DIRECTV</option>
	  <option value="VIDEOTEL">VIDEOTEL</option>
	  <option value="OTRO">OTRO</option>
    </select>
</div>
<div style="position:absolute; top:270px; padding:5px;"> 
<label>Tiene PC?:
<select name="select2">
	<option value="0">Seleccionar</option>
	  <option value="SI">SI</option>
	  <option value="NO">NO</option>	
	  
</select></label>
<label> Internet - Cual?: 
<select name="select3">
	<option value="0">Seleccionar</option>		
	  <option value="NINGUNO">NINGUNO</option>	
	  <option value="ARNET">ARNET</option>
	  <option value="COOTEPAL">COOTEPAL</option>
	  <option value="FIBERWAY">FIBERWAY</option>
      <option value="IMAGINE">IMAGINE</option>
	  <option value="MOVISTAR">MOVISTAR</option>
	  <option value="CLARO">CLARO</option>
	  <option value="PERSONAL">PERSONAL</option>
	  <option value="WIRENET">WIRENET</option>
    </select></label>
 <label>Qué velocidad?: 
    <select name="select4">
	   <option value="0">Seleccionar</option>
	   <option value="NINGUNO">NINGUNO</option>	
	  <option value="512KB">512 KB</option>
      <option value="640KB">640 KB</option>
	  <option value="1MB">1 MB</option>
	  <option value="2MB">2 MB</option>
	  <option value="3MB">3 MB</option>
	  <option value="5MB">5 MB</option>
	  <option value="NO SABE">No sabe</option>
    </select> </label>	
	<label>Abono?: $
      <input name="rta1" type="text" id="rta1" size="5" /> 
	</label>
</div>
<div style="position:absolute; top:310px; padding:5px;"> 
<label>Interes:
<select name="select5">
		<option value="0">Seleccionar</option>
	   <!--<option value="Ninguno">NINGUNO</option>-->
	   <option value="CABLE">CABLE</option>
	   <option value="FIBERWAY">FIBERWAY</option>	
	   <option value="PACK DUO">PACK DUO</option>	
</select></label>
<label>&nbsp;&nbsp;&nbsp;Estado:
<select name="select6">
		<option value="0">Seleccionar</option>
	  <option value="Dato">Dato</option>
	  <option value="Sin Interes">Sin Interes</option>	
	  
</select></label>
<label>&nbsp;&nbsp;&nbsp;Llamado:
<select name="select7">
		<option value="0">Seleccionar</option>
	  <option value="Entrante">Entrante</option>
	  <option value="Saliente">Saliente</option>	
	  
</select></label>

<label>&nbsp;&nbsp;&nbsp;Desea Promotor? 
<select name="select8">
		<option value="0"> </option>
	  <option value="SI">SI</option>
	  <option value="NO">NO</option>	
	  
</select></label>

</div>
<div style="position:absolute; top:350px; padding:5px;">Observacion: </div>
<div style="position:absolute; top:370px; padding:5px;"><textarea name="observacion" cols="80"></textarea></div>

<div style="position:absolute; top:440px; padding:5px;"> Próximo Contacto (día dd/mm/aaaa):
<input name="contacto" type="text"value="<?php echo MostrarFPC(); ?>" >
</div>

<div style="position:absolute; top:520px; padding:5px;left:200px;">
	<input name="" value="GRABAR" type="submit" />
	<!--<input type="button"  value="CARGAR NUEVA FICHA" onClick="location.href='carga-rastrillaje.php'"/>-->

	<input type="button"  value="CANCELAR" onClick="location.href='menu-control.php'"/>

</div>

<?php
include ('conex.php');
$SQL="select UsuarioAcceso as Usu from usuario where (UsuarioCodigo=".$_COOKIE['usuario'].");";
$resSQL = mysql_query($SQL, $conexion) or die(mysql_error());
while ($rowSQL = mysql_fetch_assoc($resSQL)) 
	{
	$usua=$rowSQL['Usu'];
	};
?>
</form>
</div>
<div style="position:absolute; left:850px; top:150px; padding:0px;"><font size=2><b><?php echo "Usuario: ".$usua;?></font></b></div>
<?php include('header1.php') ?>
</body>
</html>


<?php
function ObtenerNomBarrio()
{
	if ($_GET['barrio']!=0)
		{
		include "conex.php";
		$sql = "select * from barrios where codigo=".$_GET['barrio'];
		$res = mysql_query($sql, $conexion) or die(mysql_error());
		$row = mysql_fetch_assoc($res);
		return $row['nombarrio'];
	/*	}
	else
		{
		return "Todos";*/
		};
}
//Mostrar Fecha Proximo Contacto
function MostrarFPC()
	{
		$hoy = date("d/m/Y",time());
		return $hoy;
	}
	
function CargarCalle()
{

include ('conex.php');

$queEmp ="SELECT * FROM calles ORDER BY nombre";

$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());

$totEmp = mysql_num_rows($resEmp);

if ($totEmp> 0) {
	while ($rowEmp = mysql_fetch_assoc($resEmp)) {
				
		echo "<option value=".$rowEmp['codigo']." >".$rowEmp['nombre']." </option>";
	
     };
		
    }
	else
	{
	echo "<option value=0 >--- NO EXISTE DATOS SIMILARES AL INGRESADO ---</option>";
	  }
}

function SeleccionarBarrio()
{

include ('conex.php');

$queEmp ="SELECT * FROM barrios order by nombarrio";

$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());

$totEmp = mysql_num_rows($resEmp);

if ($totEmp> 0) {
	while ($rowEmp = mysql_fetch_assoc($resEmp)) {
				
		echo "<option value=".$rowEmp['codigo']." >".strtolower($rowEmp['nombarrio'])." </option>";
	
     };
		
    }
	else
	{
	echo "<option value=0 >--- NO EXISTE DATOS SIMILARES AL INGRESADO ---</option>";
	  }
}
	  
function SeleccionarLocalidad()
{

include ('conex.php');

$queEmp ="SELECT * FROM localidad order by nomlocalidad";

$resEmp = mysql_query($queEmp, $conexion) or die(mysql_error());

$totEmp = mysql_num_rows($resEmp);

if ($totEmp> 0) {
	while ($rowEmp = mysql_fetch_assoc($resEmp)) {
				
		echo "<option value=".$rowEmp['codigo']." >".strtolower($rowEmp['nomlocalidad'])." </option>";
	
     };
		
    }
	else
	{
	echo "<option value=0 >--- NO EXISTE DATOS SIMILARES AL INGRESADO ---</option>";
	  }
}

?>