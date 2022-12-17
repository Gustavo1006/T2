<?php 
//include_once("../config/config.php");
/*ini_set("session.use_only_cookies","1"); 
ini_set("session.use_trans_sid","0");*/
session_start(); 

//session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0); 

$ci=mysql_escape_string($_GET["id"]);
$cid=mysql_escape_string($_GET["cid"]);
//$usr_password=md5($usr_password);
$con = new Mongo();
if($con){
// Select Database
$db = $con->test;
// Select Collection
$people = $db->usuarios;
$qry = array("ci" => $ci);
$result = $people->findOne($qry);
	if($result){
		//$success = "You are successully loggedIn";
		echo utf8_encode('Datos Verificados Exitosamente!...');
	// Rest of code up to you.... 
	?>
    <script language="javascript">
	/*$(document).ready(function(){
		$("#codexp").val("dsfsf"); alert("dfsd");
	});*/
		document.location.href="index.php?cont=historial&id=<?php echo $cid ?>&cid=<?php echo $result["ci"] ?>";
		//alert('Datos Verificados Exitosamente!...');
    </script> 
    <?php
	} else {
		echo utf8_encode('No se encuentran Usuarios con el texto ingresado!..');
	?>
		<script language="javascript">
		//alert('Error! Codigo o password incorrectos!.. Verifique los datos Ingresados...');
		//document.location.href="../index.php?cont=usuarios_mod";
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

