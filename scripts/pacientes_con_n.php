<?php 
//include_once("../config/config.php");
/*ini_set("session.use_only_cookies","1"); 
ini_set("session.use_trans_sid","0");*/
session_start(); 

//session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0); 

$usr_email=mysql_escape_string($_POST["numa1"]);
//$usr_password=md5($usr_password);
$con = new Mongo();
if($con){
// Select Database
$db = $con->test;
// Select Collection
$people = $db->pacientes;
$qry = array("num_asegurado" => $usr_email);
$result = $people->findOne($qry);
	if($result){
		//$success = "You are successully loggedIn";
		echo utf8_encode('Datos Verificados Exitosamente!... Bienvenido!');
	// Rest of code up to you.... 
	?>
    <script language="javascript">
		document.location.href="../index.php?cont=pacientes_con&id=<?php echo $result["ci"] ?>";
		alert('Datos Verificados Exitosamente!...');
    </script> 
    <?php
	} else {
		echo utf8_encode('Error! Codigo o contraseña incorrectos!.. Verifique los datos Ingresados...');
	?>
		<script language="javascript">
		alert('Error! Numero de Asegurado No Registrado!.. Verifique los datos Ingresados...');
		document.location.href="../index.php?cont=pacientes_con";
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

