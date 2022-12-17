<?php 
error_reporting(E_ALL);
ini_set('display_errors', '0');
$id=$_GET["id"];
//$usr_password=md5($usr_password);
$con = new Mongo();
if($con){
// Select Database
$db = $con->test;
// Select Collection
$people = $db->usuarios;
$qry = array("_id" => new MongoId($id));
$result = $people->findOne($qry);
	if($result){
		$id_ = $result["_id"];
		$nom = $result["nombre"];
		$ci = $result["ci"];
		$log = $result["user"];
		$pas = $result["password"];
		$tip = $result["cargo"];
		$tipu = $result["tipo"];
    } else {
		//echo "codigo incorrecto";
	}
} else {
	die("Mongo DB not installed");
}  
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<?php require("layouts/head.php") ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title_main; ?></title>
</head>
<body style="background:none; padding-top:100px;">
<div class="titulo">Cambiar Contrase&ntilde;a</div><br />
<form name="usuarios" id="FORM" action="scripts/password.php" method="post">
<input type="hidden" name="iduser" value="<?php echo $iduser;?>">
<table class="table1" align="center" width="500">
<tr>
	<td colspan="2" class="tdatos" align="center"><h3>DATOS DEL MEDICO</h3></td>
</tr>
<tr><td id="cont_s" class="msg_a" colspan="2"></td></tr>
<tr>
	<td class="tdatos" align="left">Nombre</td>
	<td align="left"><!--<input type="text" name="nombre" size="45">--><?php echo $nom ?></td>
</tr>
<tr>
	<td class="tdatos" align="left">CI</td>
	<td align="left"><!--<input type="text" name="nombre" size="45">--><?php echo $ci ?></td>
</tr>
<tr>
	<td class="tdatos" align="left">Login</td>
	<td align="left"><!--<input type="text" name="login" size="45" value="<?php echo $log ?>">--><?php echo $log ?></td>
</tr>
<tr>
	<td class="tdatos" align="left">Password Actual</td>
	<td align="left"><input type="password" name="pass0" id="pass0" size="45" value="<?php echo $pas ?>"><input type="hidden" name="pass" id="pass" size="45" value="<?php echo $pas ?>"></td>
</tr>

<tr>
	<td class="tdatos" align="left">Nueva Password</td>
	<td align="left"><input type="password" name="pass1" id="pass1" size="45"></td>
</tr>
<tr>
	<td class="tdatos" align="left">Repetir Password</td>
	<td align="left"><input type="password" name="pass2" id="pass2" size="45"></td>
</tr>
<!--<tr>
	<td class="tdatos" align="left">Tipo</td>
	<td align="left"><?php echo $tip ?>
		<select name="tipo">
			<option value="ADMINISTRADOR" <?php if ($tipo=="ADMINISTRADOR") echo "selected" ?>>ADMINISTRADOR</option>
			<option value="AS" <?php if ($tipo=="ASISTENTE") echo "selected" ?>>ASISTENTE</option>			
		</select>
	</td>
</tr>-->
<tr>
	<td colspan="2" align="center"><input type="submit" id="enviar" name="acc" value="Guardar" size="20" class="boton1" onClick="return false;">
    <input type="button" id="cancelar" name="can" value="Cancelar" size="20" class="boton1">
    <input type="hidden" name="login" size="45" value="<?php echo $id_ ?>">
    <input type="hidden" name="TIPO" id="TIPO" value="1">
    </td>
</tr>
</table>
</form>
</body>
<script language="javascript">
$(document).ready(function(){
   $("#enviar").click(function(){
	   pas = $("#pass").val();
	   pas0 = $("#pass0").val();
	   pas1 = $("#pass1").val();
	   pas2 = $("#pass2").val();
	   if(pas0=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca su Password!...");
		  $("#pass0").focus();
	   } else if(pas1=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca su Nuevo Password!...");
		  $("#pass1").focus();
	   } else if(pas2=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Repita su Nuevo Password!...");
		  $("#pass2").focus();
	   } else if(pas1!=pas2) {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("El pasword confirmado no coincide con el ingresado!...");
		  $("#pass2").focus();
	   } else {
	      $("#FORM").submit();
		  //$('#cont_s').load("scripts/password.php",{"nombre":nom,"ci":ci,"login":login,"pass1":pas1,"tipo_prof":tipo});
	   }
   });
   $("#cancelar").click(function(){
	  document.location.href="login.php"; 
   });
});
</script>