<?php session_start(); require("security/verifica_sesion.php"); ?>
<?php
/*$m = new MongoClient();
$bd = $m->selectDB("test");
$colecciones = $m->selectCollection("test","usuarios");
$col=$colecciones->find();
foreach($col as $cols){
	//print_r($cols);
	echo "<p>" . $cols["_id"];  
    echo " @ <b><i>" . $cols["password"] . "</i></b>";  
}*/
error_reporting(E_ALL);
ini_set('display_errors', '0');
require("config/functions.php");
//include("config/config.php");
/*$link=Conectarse();
$sql = "select * from usuarios where USU_ID=".$_SESSION["admin"];
$res=mysql_query($sql,$link);
$ru=@mysql_fetch_array($res);
$nombre_u = utf8_encode($ru["USU_NOMBRE"]);
$tipo_u = $ru["USU_TIPO"];*/
if(empty($_GET["cont"])){
	$cont = "inicio";	
} else {
	$cont=$_GET["cont"];
}
if(empty($_POST["TIPO"])){
	$dir = "content";	
} else {
	$dir = "scripts";
}
?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<?php require("layouts/head.php") ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title_main; ?></title>
</head>
<body>
<div id="contenedor">
<div id="cabecera"><?php require("layouts/cabecera.php") ?></div>
<div id="cont_izq"><?php include("layouts/menu.php") ?></div>
<div id="cont_der"><?php include($dir."/".$cont.".php") ?></div>
</div>
<div id="pie"><?php require("layouts/pie.php") ?></div>
</body>
</html>