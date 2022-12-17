<?php
try {
$con = new Mongo();
$db = $con->test;
$people = $db->salas;
/*$conn = new Mongo();
$db = $conn->selectDB('blogSample');
$coll = $db->selectCollection('articulos');*/
$nombre=mysql_escape_string($_POST["nombre"]);
$desc=mysql_escape_string($_POST["desc"]);
$post = array(
	'nombre' => $nombre,
	'descripcion' => $desc,
);
echo "Operacion realizada Exitosamente!...";
$people->insert($post);
?>
<script language="javascript">
/*$(document).ready(function(){
   $("#usuarios").reset();
});*/
alert("Operacion realizada Exitosamente!...");
document.location.href="index.php?cont=salas";
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