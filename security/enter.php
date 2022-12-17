<?php 
//include_once("../config/config.php");
/*ini_set("session.use_only_cookies","1"); 
ini_set("session.use_trans_sid","0");*/
session_start(); 

//session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0); 

$usr_email=mysql_escape_string($_POST["username"]);
$usr_password=mysql_escape_string($_POST["password"]);
//$usr_password=md5($usr_password);
$con = new Mongo();
if($con){
// Select Database
$db = $con->test;
// Select Collection
$people = $db->usuarios;
$qry = array("user" => $usr_email,"password" => md5($usr_password));
$result = $people->findOne($qry);
	if($result){
		//$success = "You are successully loggedIn";
		echo utf8_encode('Datos Verificados Exitosamente!... Bienvenido!');
		//session_name($result);
		$_SESSION["admin"] = $result["user"]; 
		$_SESSION["nombre"] = $result["nombre"]." ".$result["apellido"];
		$_SESSION["tipo_u"]=$result["tipo"];
		$_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
	// Rest of code up to you.... 
	?>
    <script language="javascript">
		document.location.href="index.php";
		//alert('Datos Verificados Exitosamente!... Bienvenido!');
    </script> 
    <?php
	} else {
		echo utf8_encode('Error! Codigo o contraseña incorrectos!.. Verifique los datos Ingresados...');
	?>
		<script language="javascript">
		//document.location.href="index.php";
		//alert('Error! Codigo o password incorrectos!.. Verifique los datos Ingresados...');
        </script> 
	<?php
    }
} else {
	die("Mongo DB not installed");
}  
?>
<script language="javascript">
//$(document).ready(function(){ $("#msg").css({ "background-image" : "url(images/s_okay.png)" }); });
</script> 
<script language="javascript">
//$(document).ready(function(){ $("#frm_ingreso").submit(); });
</script> 

