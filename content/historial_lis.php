<?php 
error_reporting(E_ALL);
ini_set('display_errors', '0');
	$id=$_GET["id"];
	$pid = $_GET["pid"];
	$mid = $_GET["mid"];
	if(!empty($_GET["tip"]) and $_GET["tip"]!='undefined'){
		$tip = $_GET["tip"];
	} else {
		$tip="";
	}
	$cei = $_GET["cei"];
	$nua = $_GET["nua"];
	$apa = $_GET["apa"];
	$m = new MongoClient();
		$coleca = $m->selectCollection("test","historial");
	    $coa=$coleca->find()->sort(array("creacion_exp"=>1));     
		//var_dump($coa->getNext());
		$n = $coa->count();
		$c=1;
		foreach($coa as $coal){
			if($c==1){
				$fechaI = $coal["creacion_exp"];
				$FI = explode("-",$coal["creacion_exp"]);
			} else if($c==$n){
				$fechaF = $coal["creacion_exp"];
				$FF = explode("-",$coal["creacion_exp"]);
			}
		$c++;}
		if(!empty($_GET["FEI"])){ 
				$F = explode("-",$_GET["FEI"]);
				$FID = $F[2];
				$FIM = $F[1];
				$FIA = $F[0];
				$fechaI = $_GET["FEI"];
			} else {
				$FID = $FI[2];
				$FIM = $FI[1];
				$FIA = $FI[0];
			}
		if(!empty($_GET["FEF"])){ 
				$F = explode("-",$_GET["FEF"]);
				$FFD = $F[2];
				$FFM = $F[1];
				$FFA = $F[0];
				$fechaF = $_GET["FEF"];
			} else {
				$FFD = $FF[2];
				$FFM = $FF[1];
				$FFA = $FF[0];
			}
		?>
<table width="100%" cellpadding="0" cellspacing="0">
		<TR id="color2">
		<TD align="left">ID</TD>
        <TD align="left">FECHA</TD>
		<TD align="left">PACIENTE</TD>
		<TD align="left">MEDICO</TD>
        <TD align="left">OBSERVACIONES</TD>
		<TD align="center">EVOLUCION Y TRATAMIENTO</TD>
        <TD align="center">LABORATORIO</TD>
        <TD align="center">IMAGENOLOGIA</TD>
        <TD align="center">DOC. INTERNACION</TD>
        <TD align="center">DOC. EXTERNOS</TD>
		</TR>
<?php 
$i=1;
$bd = $m->selectDB("test");
$colecciones = $m->selectCollection("test","historial");
$start = $fechaI;
$end = $fechaF; 
if($tip=="" and $cei=="" and $nua=="" and $apa==""){ 
	$col=$colecciones->find(array("creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei=="" and $nua=="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei=="" and $nua!="" and $apa==""){
	$col=$colecciones->find(array("num_asegurado"=>new MongoRegex("/^$nua/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei!="" and $nua=="" and $apa==""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei=="" and $nua=="" and $apa==""){
	$col=$colecciones->find(array("estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei=="" and $nua!="" and $apa!=""){
	$col=$colecciones->find(array("num_asegurado"=>new MongoRegex("/^$nua/"),"apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei!="" and $nua=="" and $apa!=""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei=="" and $nua=="" and $apa!=""){
	$col=$colecciones->find(array("estado"=>$tip,"apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei!="" and $nua!="" and $apa==""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"num_asegurado"=>new MongoRegex("/^$nua/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));	
} else if($tip!="" and $cei=="" and $nua!="" and $apa==""){
	$col=$colecciones->find(array("estado"=>$tip,"num_asegurado"=>new MongoRegex("/^$nua/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));	
} else if($tip!="" and $cei!="" and $nua=="" and $apa==""){
	$col=$colecciones->find(array("estado"=>$tip,"ci_paciente"=>new MongoRegex("/^$cei/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));	
} else if($tip=="" and $cei!="" and $nua!="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"num_asegurado"=>new MongoRegex("/^$nua/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei!="" and $nua=="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei!="" and $nua!="" and $apa==""){
	$col=$colecciones->find(array("num_asegurado"=>new MongoRegex("/^$nua/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei=="" and $nua!="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"num_asegurado"=>new MongoRegex("/^$nua/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei!="" and $nua!="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"num_asegurado"=>new MongoRegex("/^$nua/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
}
//$db->users->find(array("name" => new MongoRegex("/^Joe/")));
$col->sort(array("creacion_exp"=>-1));
$i=1;
foreach($col as $cols){
$id_ = $cols["_id"];
	$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->findOne(array("hid" => $id_));
	$coleccionesp = $m->selectCollection("test","pacientes");
	$colp=$coleccionesp->findOne(array("ci" => $cols["ci_paciente"]));
	$coleccionesm = $m->selectCollection("test","usuarios");
	$colm=$coleccionesm->findOne(array("ci" => $cols["ci"]));
?>
<?php if($i%2!=0) { $color = 'color3'; } else { $color = 'color4'; } ?> 
  <tr id="<?php echo $color ?>">
	<td width="12" align="left"><?php echo $i ?></td>
    <td align="left"><?php echo $cols["creacion_exp"] . " " . $cols["creacion_exph"] ?></td>
    <td align="left"><?php echo utf8_encode($colp["nombre"]." ".$colp["apellido"]) ?></td>
	<td align="left"><?php echo utf8_encode($colm["nombre"]) ?></td>
    <td align="left"><?php echo $cols["observaciones"] ?></td>
    <?php 
	$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => new MongoId($id_),"area" => "1"));
	$n=0;
	foreach($colh as $colsh){
		$n=$n+1;
	}
?>
	<td width="60" align="center">
    <?php if($n>0){ ?>
    <a href="index.php?cont=archivos_his&id=<?php echo $id_ ?>&are=1&pid=<?php echo $colp["_id"] ?>&mid=<?php echo $colm["_id"] ?>" id="<?php echo $id_ ?>" class="EDIT"><?php echo $n ?></a>
    <?php }else{ ?>
    <?php echo $n ?>
    <?php } ?>
    </td>
    <?php 
	$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => $id_,"area" => "2"));
	$n=0;
	foreach($colh as $colsh){
		$n=$n+1;
	}
?>
	<td width="60" align="center">
    <?php if($n>0){ ?>
    <a href="index.php?cont=archivos_his&id=<?php echo $id_ ?>&are=2&pid=<?php echo $colp["_id"] ?>&mid=<?php echo $colm["_id"] ?>" id="<?php echo $id_ ?>" class="EDIT"><?php echo $n ?></a>
    <?php }else{ ?>
    <?php echo $n ?>
    <?php } ?>
    </td>
    <?php 
	$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => $id_,"area" => "3"));
	$n=0;
	foreach($colh as $colsh){
		$n=$n+1;
	}
?>
	<td width="60" align="center">
    <?php if($n>0){ ?>
    <a href="index.php?cont=archivos_his&id=<?php echo $id_ ?>&are=3&pid=<?php echo $colp["_id"] ?>&mid=<?php echo $colm["_id"] ?>" id="<?php echo $id_ ?>" class="EDIT"><?php echo $n ?></a>
    <?php }else{ ?>
    <?php echo $n ?>
    <?php } ?>
    </td>
    <?php 
	$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => $id_,"area" => "4"));
	$n=0;
	foreach($colh as $colsh){
		$n=$n+1;
	}
?>
	<td width="60" align="center">
    <?php if($n>0){ ?>
    <a href="index.php?cont=archivos_his&id=<?php echo $id_ ?>&are=4&pid=<?php echo $colp["_id"] ?>&mid=<?php echo $colm["_id"] ?>" id="<?php echo $id_ ?>" class="EDIT"><?php echo $n ?></a>
    <?php }else{ ?>
    <?php echo $n ?>
    <?php } ?>
    </td>
    <?php 
	$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => $id_,"area" => "5"));
	$n=0;
	foreach($colh as $colsh){
		$n=$n+1;
	}
?>
	<td width="60" align="center">
    <?php if($n>0){ ?>
    <a href="index.php?cont=archivos_his&id=<?php echo $id_ ?>&are=5&pid=<?php echo $colp["_id"] ?>&mid=<?php echo $colm["_id"] ?>" name="salas_edit.php"><?php echo $n ?></a>
    <?php }else{ ?>
    <?php echo $n ?>
    <?php } ?>
    </td>
   </tr>
<?php $i++;}?>
   </table>