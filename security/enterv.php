<?php 
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
		echo utf8_encode('Datos Verificados Exitosamente!...'); 
	?>
    <script language="javascript">
		document.location.href="password.php?id=<?php echo $result["_id"] ?>";
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

