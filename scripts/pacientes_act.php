<?php
try {
$con = new Mongo();
$db = $con->test;
$id = $_POST["idpac"];
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

if($_POST["EMP"]!=$pat){
	$people = $db->empresa;
	$qry = array("patronal" => $pat);
	$result = $people->findOne($qry);
		if($result){
		$ide = $result["_id"];
	$post = array(
		'empresa' => $emp,
		'razon_social' => $raz,
	);
	$people->update(array("patronal" => $pat), array('$set' => $post));
	} else {
		$post = array(
		'patronal' => $pat,
		'empresa' => $emp,
		'razon_social' => $raz
		);
		$people->insert($post);
		$ide = $post['_id'];
	}
}
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
//if($id!=$login){ $nlogin = $login; } else { $nlogin = $id; }
echo "Operacion realizada Exitosamente!...";
?>
<script language="javascript">
alert("Operacion realizada Exitosamente!...");
document.location.href="../index.php?cont=pacientes_act&id=<?php echo $ci; ?>";
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