<?php 
//include_once("../config/config.php");
/*ini_set("session.use_only_cookies","1"); 
ini_set("session.use_trans_sid","0");*/
session_start(); 

//session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0); 

$cp=mysql_escape_string($_GET["id"]);
//$usr_password=md5($usr_password);
$con = new Mongo();
if($con){
// Select Database
$db = $con->test;
// Select Collection
$people = $db->empresa;
$qry = array("patronal" => $cp);
$result = $people->findOne($qry);
	if($result){
		//$success = "You are successully loggedIn";
		echo utf8_encode('Empresa Registrada!...');
	// Rest of code up to you.... 
	?>
    <script language="javascript">
	/*$(document).ready(function(){
		$("#codexp").val("dsfsf"); alert("dfsd");
	});*/
		document.location.href="index.php?cont=pacientes_add&id=<?php echo $result["patronal"] ?>";
		//alert('Datos Verificados Exitosamente!...');
    </script> 
    <?php
	} else {
		echo utf8_encode('Empresa no Registrada!..');
	?>
		<script language="javascript">
		$(document).ready(function(){
			$("#empresa").attr("disabled", false);
			$("#razons").attr("disabled", false);
		});
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

