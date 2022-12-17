<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
require("config/functions.php");
if(empty($_GET["cont"])){
	$cont = "inicio";	
} else {
	$cont=$_GET["cont"];
}
if(empty($_POST["TIPO"])){
	$dir = "content";	
} else {
	$dir = "scripts";
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<?php require("layouts/head.php") ?>
  <style type="text/css">
fieldset {
width:320px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:14px;
padding:15px;
background-color:#F5F5F5;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 10px;
margin:120px 0px 10px 0px;
-moz-box-shadow: 0 3px 3px #3E6E82;
-webkit-box-shadow: 0 3px 3px #3E6E82;
}
legend {
width:200px;
text-align:center;
background:#DDE7F0;
border:solid 1px;
margin:1px;
font-weight:bold;
color:#003366;
padding:10px;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 10px;
-moz-box-shadow: 0 3px 3px #3E6E82;
-webkit-box-shadow: 0 3px 3px #3E6E82;
}
</style>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title_main; ?></title>
</head>
<body>
<div id="contenedor">
<div id="cabecera">
<table width="100%" height="150px" cellpadding="0" cellspacing="0" border="0">
<tr>
<td align="left"><img src="images/logo.gif" border="0"/></td>
<td align="right" colspan="7" valign="bottom" height="120px"></td>
</tr>
<tr>
<td align="left" height="30px"><script language="JavaScript" type="text/javascript">MostrarFecha();</script></td>
<td align="right"><script type="text/javascript">inicio()</script></td>
</tr>
</table>

</div>
	<div align="center">
		<form name="form1" method="post" action="security/enter.php">
		<fieldset>
		<legend>Login de Usuarios</legend>
		<table width="100%" cellpadding="5" cellspacing="5">
		<!--<tr><td colspan="2" align="center"><img src="images/logo.gif" border="0"/></td></tr>-->
		<tr><td id="cont_s" colspan="2" style="color:#900; font-size:12px;"></td></tr>
		<tr>
		<td><label for="login">Username:</label></td><td><input name="username" type="text" id="username" size="30" /></td>
		</tr>
		<tr>
		<td><label for="password">Password:</label></td><td><input name="password" type="password" id="password" size="30" /></td>
		</tr>
		<tr>
		<td class="submit" colspan="2" align="center"><input name="submit" id="submit" type="submit" value="Ingresar" class="boton1" onClick="return false" /> <input name="mop" id="mop" type="button" value="Cambiar Password" class="boton1" /></td>
		</tr>
		</table>
		</fieldset>
		</form>
		<br><br><br><br><br><br>
	</div>
<!--<div id="cont_izq"><?php //include("layouts/menu.php") ?></div>
<div id="cont_der"><?php include($dir."/".$cont.".php") ?></div>-->
</div>
<div id="pie"><?php require("layouts/pie.php") ?></div>
</body>
</html>
<script language="javascript">
$(document).ready(function(){
   $("#submit").click(function(){
	   usr = $("#username").val();
	   pas = $("#password").val();
	   if(usr=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca su codigo de Usuario!...");
		  $("#username").focus();
	   } else if(pas=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca su password!...");
		  $("#password").focus();
	   } else {
	      $('#cont_s').load("security/enter.php",{"username":usr,"password":pas});
	   }
   });
   $("#mop").click(function(){
	   usr = $("#username").val();
	   pas = $("#password").val();
	   if(usr=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca su codigo de Usuario!...");
		  $("#username").focus();
	   } else if(pas=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca su password!...");
		  $("#password").focus();
	   } else {
	      $('#cont_s').load("security/enterv.php",{"username":usr,"password":pas});
	   }
   });
});
</script>