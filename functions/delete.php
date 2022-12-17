<?php 
$op=$_POST["OP"];
$ID=$_POST["ID"];
$m = new MongoClient();
if($TABLA=='') {
    $COLEC = $op;
}
$col = $m->selectCollection("test","archivos");
$col->remove(array("_id" => new MongoId($ID)));
?>