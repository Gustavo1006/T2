<?php
try {
$con = new Mongo();
$db = $con->test;
$people = $db->usuarios;
/*$conn = new Mongo();
$db = $conn->selectDB('blogSample');
$coll = $db->selectCollection('articulos');*/
$id=mysql_escape_string($_POST["login"]);
$pass=mysql_escape_string($_POST["pass"]);
$pass0=mysql_escape_string($_POST["pass0"]);
$pass1=md5(mysql_escape_string($_POST["pass1"]));
echo "Operacion realizada Exitosamente!...";
if($pass==$pass0){
$people->update(array("_id" => new MongoId($id)), array('$set' => array('password' => $pass1)));
?>
<script language="javascript">
alert("Operacion realizada Exitosamente!...");
document.location.href="index.php?cont=<?php echo $_GET["cont"] ?>";
</script>
<?php
} else {
?>
<script language="javascript">
alert("Operacion cancelada!...la contraseña actual no corresponde a su cuenta de usuario");
document.location.href="index.php?cont=<?php echo $_GET["cont"] ?>";
</script>
<?php
}
} catch(MongoConnectionException $e) {
	die("No es posible conectarnos a la base de datos:".$e->getMessage());
}
catch(MongoException $e) {
	die('No es posible almacenar la informacion: '.$e->getMessage());
}
/*$insert = array("user" => "admin", "password" => md5("admin"));
$people->insert($insert);*/
?>