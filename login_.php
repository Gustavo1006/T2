<?php 
/*$con = new Mongo();
$db = $con->test;
$people = $db->usuarios;
$pass1 = md5("admin");
$people->update(array("user" => "admin"), array('password' => $pass1));*/

error_reporting(E_ALL);
ini_set('display_errors', '0');
//$m = new MongoClient();
//$m = new Mongo($server="mongodb://localhost:4554");
require("config/functions.php");
if(isset($_SESSION["admin"]) or $_SESSION["admin"]==""){ ?>
<?php
/*$con = new Mongo();
$db = $con->test;
$people = $db->usuarios;
$insert = array("user" => "admin", "password" => md5("admin"), "tipo" => "1");
$people->insert($insert);*/
?>
<?php
include_once("config/config.php");
/*$collection = $db->createCollection("usuarios");
$document = array(
"title" => "usuariio",
"description" => "usuario ingresao",
"likes" => 100,
"url" => "",
"by", "sistema"
);
$collection->insert($document);*/

/*if(loggedIn()):
header('Location: members.php');
endif;
if(isset($_POST["submit"])):
  if(!($row = checkPass($_POST["login"], $_POST["password"]))):
    echo "<p>Incorrect login/password, try again</p>";
    exit;
  endif;
  cleanMemberSession($_POST["login"], $_POST["password"]);
  header("Location: members.php");
endif;*/
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<link rel="stylesheet" type="text/css" href="css/forms.css" />
<link rel="stylesheet" type="text/css" href="css/tables.css" />
<script type="text/javascript"	src="js/jquery.js"></script>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Sist_Obre</title>
</head>
  <style type="text/css">
#frm_login{
	/*background-image: url(images/fnd_cabecera.png);*/
	background-position:top;
	background-repeat:no-repeat;
	/*background-color:#000;*/
	width:40%;
	padding:30px 25px 35px 25px;
	margin:100px 0px 10px 0px;
	-moz-border-radius: 30px;
	-webkit-border-radius: 30px;
	border-radius: 30px;
	border: 1px solid #adaa9f;
	-moz-box-shadow: 0 3px 3px #036;
	-webkit-box-shadow: 0 3px 3px #036;
}
fieldset {
width:320px;
font-family:Verdana, Arial, Helvetica, sans-serif;
font-size:14px;
padding:15px;
background-color:#F5F5F5;
-moz-border-radius: 10px;
-webkit-border-radius: 10px;
border-radius: 10px;
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
}
</style>
<body>
  <div align="center">
  <div class="titulo"><!--<div align="center" class="Estilo1">Entrada al Sistema  </div>--></div>
  <br />
  <br />
  <div align="center" id="frm_login">
  <img src="images/logo.gif" border="0"/>
  <br />
  <br />
  <!--<img  align="center" src="images/escudo.gif" WIDTH=250	HEIGHT=260  alt="Hidrofalcon" />-->
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
  </div>
  </div>
</body>
</html>
<?php } else { ?>
<script language="javascript">document.location.href = "main.php";</script>
<?php } ?>
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

