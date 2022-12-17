<?php
try {
$con = new Mongo();
$db = $con->test;
$people = $db->usuarios;
/*$conn = new Mongo();
$db = $conn->selectDB('blogSample');
$coll = $db->selectCollection('articulos');*/
$nombre=mysql_escape_string($_POST["nombre"]);
$apellido=mysql_escape_string($_POST["apellido"]);
$ci=mysql_escape_string($_POST["ci"]);
$ciu=mysql_escape_string($_POST["ciudad"]);
$login=mysql_escape_string($_POST["login"]);
$pass1=md5(mysql_escape_string($_POST["pass1"]));
//$pass2=mysql_escape_string($_POST["pass2"]);
$tipo=mysql_escape_string($_POST["tipo_prof"]);
$tipou=mysql_escape_string($_POST["tipou"]);
$post = array(
	'nombre' => $nombre,
	'apellido' => $apellido,
	'ci' => $ci,
	'cod_ci' => $ciu,
	'user' => $login,
	'password' => $pass1,
	'tipo' => $tipou
);
echo "Operacion realizada Exitosamente!...";
$people->insert($post);
?>
<script language="javascript">
/*$(document).ready(function(){
   $("#usuarios").reset();
});*/
alert("Operacion realizada Exitosamente!...");
document.location.href="index.php?cont=<?php echo $_GET["cont"] ?>";
</script>
<?php
} catch(MongoConnectionException $e) {
	die("No es posible conectarnos a la base de datos:".$e->getMessage());
}
catch(MongoException $e) {
	die('No es posible almacenar la informacion: '.$e->getMessage());
}
/*$insert = array("user" => "admin", "password" => md5("admin"));
$people->insert($insert);*/
?>