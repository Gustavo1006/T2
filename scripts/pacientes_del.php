<?php 
//$op=$_GET["OP"];
$ID=$_GET["ID"];
$m = new MongoClient();
$col = $m->selectCollection("test","pacientes");
$col->remove(array("_id" => new MongoId($ID)));
?>
<script language="javascript">
	alert("Registro Eliminado Exitosamente!..");
	document.location.href="../index.php?cont=pacientes_act";
</script>