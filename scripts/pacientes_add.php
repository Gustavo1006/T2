<?php
try {
$con = new Mongo();
$db = $con->test;
/*$conn = new Mongo();
$db = $conn->selectDB('blogSample');
$coll = $db->selectCollection('articulos');*/
$num=mysql_escape_string($_POST["num_asegurado"]);
$ci=mysql_escape_string($_POST["cedula"]);
$cci=mysql_escape_string($_POST["ciudad"]);
$nom=mysql_escape_string($_POST["nombre"]);
$ape=mysql_escape_string($_POST["apellido"]);
$fec=mysql_escape_string($_POST["ANIO"]."-".$_POST["MES"]."-".$_POST["DIA"]);
$sex=mysql_escape_string($_POST["sexo"]);
$tel=mysql_escape_string($_POST["telefono"]);
$dir=mysql_escape_string($_POST["direccion"]);
$estc=mysql_escape_string($_POST["estciv"]);

$pat=mysql_escape_string($_POST["cempresa"]);
$emp=mysql_escape_string($_POST["empresa"]);
$raz=mysql_escape_string($_POST["razons"]);

$people = $db->empresa;
$post = array(
	'patronal' => $pat,
	'empresa' => $emp,
	'razon_social' => $raz,
);
//echo "Operacion realizada Exitosamente!...";
$people->insert($post);
$ide = $post['_id'];
$people = $db->pacientes;
$post = array(
	'num_asegurado' => $num,
	'ci' => $ci,
	'cod_ci' => $cci,
	'nombre' => $nom,
	'apellido' => $ape,
	'fecha_nac' => $fec,
	'sexo' => $sex,
	'telefono' => $tel,
	'direccion' => $dir,
	'estado_civil' => $estc,
	'empresa' => $ide
);
$people->insert($post);
echo "Operacion realizada Exitosamente!...";
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