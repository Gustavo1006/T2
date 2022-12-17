<?php
try {
$con = new Mongo();
$db = $con->test;
$people = $db->usuarios;
/*$conn = new Mongo();
$db = $conn->selectDB('blogSample');
$coll = $db->selectCollection('articulos');*/
$id = $_POST["iduser"];
$nombre=mysql_escape_string($_POST["nombre"]);
$apellido=mysql_escape_string($_POST["apellido"]);
$ci=mysql_escape_string($_POST["ci"]);
$ciu=mysql_escape_string($_POST["ciudad"]);
$login=mysql_escape_string($_POST["login"]);
$pas=mysql_escape_string($_POST["pas"]);
$pass1=mysql_escape_string($_POST["pass"]);
if($pas!=$pass1){ $pass1=md5($pass1); }
//$pass2=mysql_escape_string($_POST["pass2"]);
$tipo=mysql_escape_string($_POST["tipos"]);
$tipou=mysql_escape_string($_POST["tipou"]);
$post = array(
	'nombre' => $nombre,
	'apellido' => $apellido,
	'ci' => $ci,
	'cod_ci' => $ciu,
	'tipo' => $tipou
);
if($id!=$login){ $nlogin = $login; } else { $nlogin = $id; }
echo "Operacion realizada Exitosamente!...";
?>
<script language="javascript">
alert("Operacion realizada Exitosamente!...");
document.location.href="../index.php?cont=usuarios_mod&id=<?php echo $nlogin; ?>";
</script>
<?php
$people->update(array("_id" => new MongoId($id)), array('$set' => $post));
} catch(MongoConnectionException $e) {
	die("No es posible conectarnos a la base de datos:".$e->getMessage());
}
catch(MongoException $e) {
	die('No es posible almacenar la informacion: '.$e->getMessage());
}
/*$insert = array("user" => "admin", "password" => md5("admin"));
$people->insert($insert);*/
?>