<?php
try {
$con = new Mongo();
$db = $con->test;
$people = $db->historial;
/*$conn = new Mongo();
$db = $conn->selectDB('blogSample');
$coll = $db->selectCollection('articulos');*/
$cod=mysql_escape_string($_POST["codexp"]);
$ced=mysql_escape_string($_POST["cedpro"]);
$apa=mysql_escape_string($_POST["apellido"]);
//$tip=md5(mysql_escape_string($_POST["tipop"]));
$cep=mysql_escape_string($_POST["cedpac"]);
$fee=date("Y-m-d");
$feh=date("H:m:s");
$est=mysql_escape_string($_POST["estado"]);
//$fil=mysql_escape_string($_POST["userfile"]);
//$esc=mysql_escape_string($_POST["estciv"]);
$obs=mysql_escape_string($_POST["obser"]);
$nuc=$_POST["nuc"];
$post = array(
	'num_asegurado' => $cod,
	'ci' => $ced,
	'nombre' => $cee,
	'apellido' => $apa,
	'tipo_profesion' => $tip,
	'ci_paciente' => $cep,
	'creacion_exp' => $fee,
	'creacion_exph' => $feh,
	'estado' => $est,
	'historial' => $fil,
	'observaciones' => $obs
);
echo "Operacion realizada Exitosamente!...";
$people->insert($post);
$idh = $post['_id'];
$fecha = $post['creacion_exp'];
//$idu = $this->db->insert_id();
$m = new MongoClient();
$bd = $m->selectDB("test");
$colecciones = $m->selectCollection("test","archivos");
	$col=$colecciones->find(array("hid"=>"0"));
if($est=="A"){
	$crp = "docs/ACTIVO/".$nuc;
}else{
	$crp = "docs/INACTIVO/".$nuc;	
}
mkdir($crp);
for($i=1;$i<=5;$i++){
	mkdir($crp."/".narea($i));
	if($i==3){
		for($j=1;$j<=5;$j++){
			mkdir($crp."/".narea($i)."/".nsubarea($j));
		}
	}
}
foreach($col as $cols){
	$ide = $cols["_id"];
	$arc = $cols["archivo"];
	$are = $cols["area"];
	$sub = $cols["subarea"];
	$ncrp="";
	if($sub==""){
		$ncrp= $crp."/".narea($are);	
	}else{
		$ncrp= $crp."/".narea($are)."/".nsubarea($sub);	
	} echo $ncrp."<br>";
	$arn = str_replace("-","_".$cod."_",$arc);
	if(file_exists("docs/".$arc))
	{
		copy("docs/".$arc,$ncrp."/".$arn);
		unlink("docs/".$arc);
	}
	//$con = new Mongo();
	$db = $m->test;
	$people = $db->archivos;
	$post = array(
		'hid' => $idh,
		'archivo' => $arn,
		'fecha' => $fecha
	);
	$people->update(array("_id" => new MongoId($ide)), array('$set' => $post), array("multiple" => false));
	//rename();
}
$con = new Mongo();
$db = $con->test;
$people = $db->archivos;
$post = array(
	'hid' => $idh,
	'fecha' => $fecha
);
$people->update(array("hid" => "0"), array('$set' => $post), array("multiple" => true));
?>
<script language="javascript">
/*$(document).ready(function(){
   $("#usuarios").reset();
});*/
alert("Operacion realizada Exitosamente!...");
document.location.href="index.php?cont=<?php echo $_GET["cont"] ?>";
</script>
<?php
//
} catch(MongoConnectionException $e) {
	die("No es posible conectarnos a la base de datos:".$e->getMessage());
}
catch(MongoException $e) {
	die('No es posible almacenar la informacion: '.$e->getMessage());
}
/*$insert = array("user" => "admin", "password" => md5("admin"));
$people->insert($insert);*/
?>