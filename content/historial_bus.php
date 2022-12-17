<?php //require("../config/config.php"); $op=$_GET["op"]; ?>
<script language="javascript">
/*window.onload= function(){
    document.FRM.apa.focus()
}*/
$(document).ready(function(){
   $("#DELI").click(function(){
       id = $("#ID").val();
	   op = $("#OP").val();
	   var mar = $("#MAR").val(); 
	   var cat = $("#CAT").val(); 
	   var subc = $("#SUB").val(); 
	   archivo = $("#archivo").val();
	   if(confirm("Esta seguro que desea Eliminar la Imagen?...")) {
	      $('#cont_der').load("content/" + op + "_edit.php?id=" + id + "&MAR="+ mar + "&CAT=" + cat + "&SUB=" + subc);
		  $.ajax({
			type: "POST",
			url: "content/fotos_edit.php?action=1",
			data: '&ID='+id+'&OP='+op
		  });
		  $('#cont_der').load("content/" + op + "_edit.php?id=" + id + "&MAR="+ mar + "&CAT=" + cat + "&SUB=" + subc);
	   }
   });
	$("#area").change(function(){
		var id = $("#id").val();
		var pid = $("#pid").val();
		var mid = $("#mid").val();
		var are = $(this).val();
		document.location.href = "index.php?cont=historial_bus&id="+id+"&pid="+pid+"&mid="+mid+"&are="+are;
	});
	$("#tipo").change(function(){
		var cei = $("#ci").val();
		var nua = $("#nua").val();
		var apa = $("#apa").val();
		var id = $("#id").val();
		var pid = $("#pid").val();
		var mid = $("#mid").val();
		var tip = $("#tipo").val();
		dia = $("#DIA").val();
	    mes = $("#MES").val();
	    anio = $("#ANIO").val();
	    fecha = anio+"-"+mes+"-"+dia;
	    dia1 = $("#DIA1").val();
	    mes1 = $("#MES1").val();
	    anio1 = $("#ANIO1").val();
	    fecha1 = anio1+"-"+mes1+"-"+dia1;
		$("#listado").load("content/historial_lis.php?id="+id+"&pid="+pid+"&mid="+mid+"&tip="+tip+"&FEI="+fecha+"&FEF="+fecha1+"&cei="+cei+"&nua="+nua+"&apa="+apa);
		//document.location.href = "index.php?cont=historial_bus&id="+id+"&pid="+pid+"&mid="+mid+"&tip="+tip+"&FEI="+fecha+"&FEF="+fecha1+"&cei="+cei+"&apa="+apa;
	});
	$(".fil").keyup(function(){
   		var cei = $("#ci").val();
		var nua = $("#nua").val();
		var apa = $("#apa").val();
		var id = $("#id").val();
		var pid = $("#pid").val();
		var mid = $("#mid").val();
		var tip = $("#tipo").val();
		dia = $("#DIA").val();
	    mes = $("#MES").val();
	    anio = $("#ANIO").val();
	    fecha = anio+"-"+mes+"-"+dia;
	    dia1 = $("#DIA1").val();
	    mes1 = $("#MES1").val();
	    anio1 = $("#ANIO1").val();
	    fecha1 = anio1+"-"+mes1+"-"+dia1;
		$("#listado").load("content/historial_lis.php?id="+id+"&pid="+pid+"&mid="+mid+"&tip="+tip+"&FEI="+fecha+"&FEF="+fecha1+"&cei="+cei+"&nua="+nua+"&apa="+apa);
		//document.location.href = "index.php?cont=historial_bus&id="+id+"&pid="+pid+"&mid="+mid+"&tip="+tip+"&FEI="+fecha+"&FEF="+fecha1+"&cei="+cei+"&apa="+apa;
   });
	$(".FECHA").change(function(){
        var cei = $("#ci").val();
		var nua = $("#nua").val();
		var apa = $("#apa").val();
		var id = $("#id").val();
		var pid = $("#pid").val();
		var mid = $("#mid").val();
		var tip = $("#tipo").val();
	   dia = $("#DIA").val();
	   mes = $("#MES").val();
	   anio = $("#ANIO").val();
	   fecha = anio+"-"+mes+"-"+dia;
	   dia1 = $("#DIA1").val();
	   mes1 = $("#MES1").val();
	   anio1 = $("#ANIO1").val();
	   fecha1 = anio1+"-"+mes1+"-"+dia1;
		$("#listado").load("content/historial_lis.php?id="+id+"&pid="+pid+"&mid="+mid+"&tip="+tip+"&FEI="+fecha+"&FEF="+fecha1+"&cei="+cei+"&nua="+nua+"&apa="+apa);
	   //document.location.href = "index.php?cont=historial_bus&id="+id+"&pid="+pid+"&mid="+mid+"&tip="+tip+"&FEI="+fecha+"&FEF="+fecha1;
   });
   $("#imprimir").click(function(){
   		var cei = $("#ci").val();
		var nua = $("#nua").val();
		var apa = $("#apa").val();
		var id = $("#id").val();
		var pid = $("#pid").val();
		var mid = $("#mid").val();
		var tip = $("#tipo").val();
		dia = $("#DIA").val();
	    mes = $("#MES").val();
	    anio = $("#ANIO").val();
	    fecha = anio+"-"+mes+"-"+dia;
	    dia1 = $("#DIA1").val();
	    mes1 = $("#MES1").val();
	    anio1 = $("#ANIO1").val();
	    fecha1 = anio1+"-"+mes1+"-"+dia1;
		window.open("content/historial_imp.php?id="+id+"&pid="+pid+"&mid="+mid+"&tip="+tip+"&FEI="+fecha+"&FEF="+fecha1+"&cei="+cei+"&nua="+nua+"&apa="+apa, "_blank");
   });
});
</script>
<?php if(empty($_GET['action'])) { ?>
<?php
	$id=$_GET["id"];
	$m = new MongoClient();
	$bd = $m->selectDB("test");
	$pid = $_GET["pid"];
	$mid = $_GET["mid"];
	if(!empty($_GET["tip"]) and $_GET["tip"]!='undefined'){
		$tip = $_GET["tip"];
	} else {
		$tip="";
	}
	$cei = $_GET["cei"];
	$apa = $_GET["apa"];
?>
<h3>HISTORIALES DEL PACIENTES</h3>
<table width="100%" cellpadding="0" cellspacing="0" class="admin1">
<TR><td align="left">
<form action="bus_est.php" name="FRM">
		<input type="hidden" name="busqueda" value="sala"/>
		<table class="tabla" align="right" width="100%">
		<tr>
        <td align="left">
        <?php //echo date("h:m:s");
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
		/*$FI = explode("-",date("Y-m-d"));
		$FF = explode("-",date("Y-m-d"));
		$fechaI = date("Y-m-d");
		$fechaF = date("Y-m-d");*/
		?>
        &nbsp;FECHA : del
		<select name="DIA" id="DIA" class="FECHA">
        	<?php 
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
			?>
			<?php for($i=1;$i<=31;$i++){ ?>
			<option value="<?php echo $i ?>" <?php if($FID==$i){ ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
            <?php } ?>
        </select>
        <select name="MES" id="MES" class="FECHA">
        	<?php for($i=1;$i<=12;$i++){ ?>
            <option value="<?php echo $i ?>" <?php if($FIM==$i){ ?>selected="selected"<?php } ?>><?php echo mes($i); ?></option>
            <?php } ?>
        </select>
        <select name="ANIO" id="ANIO" class="FECHA">
        	<?php for($i=$FI[0];$i<=$FF[0];$i++){ ?>
            <option value="<?php echo $i ?>" <?php if($FIA==$i){ ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
            <?php } ?>
        </select><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		al
		<select name="DIA1" id="DIA1" class="FECHA">
        	<?php 
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
			<?php for($i=1;$i<=31;$i++){ ?>
            <option value="<?php echo $i ?>" <?php if($FFD==$i){ ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
            <?php } ?>
        </select>
        <select name="MES1" id="MES1" class="FECHA">
        	<?php for($i=1;$i<=12;$i++){ ?>
            <option value="<?php echo $i ?>" <?php if($FFM==$i){ ?>selected="selected"<?php } ?>><?php echo mes($i); ?></option>
            <?php } ?>
        </select>
        <select name="ANIO1" id="ANIO1" class="FECHA">
        	<?php for($i=$FI[0];$i<=$FF[0];$i++){ ?>
            <option value="<?php echo $i ?>" <?php if($FFA==$i){ ?>selected="selected"<?php } ?>><?php echo $i; ?></option>
            <?php } ?>
        </select>
        </td>
		<td align="right">
        CI:
        <input type="text" name="ci" id="ci" size="7" value="<?php echo $cei; ?>" class="fil" />
        Num/A.:
        <input type="text" name="nua" id="nua" size="7" value="<?php echo $cei; ?>" class="fil" />
        Apellido:
        <input type="text" name="apa" id="apa" size="10" value="<?php echo $apa; ?>" class="fil" />
        Estado : 
			<select name="tipo" id="tipo">
			<option value="">Todas</option>
			<option value="A" <?php if($tip=="A"){ ?>selected<?php } ?>>ACTIVO</option>
			<option value="I" <?php if($tip=="I"){ ?>selected<?php } ?>>INACTIVO</option>
		    </select>
        <!--Area : 
			<select name="area" id="area">
			<option value="">Todas</option>
			<option value="1" <?php if($are==1){ ?>selected<?php } ?>>LABORATORIO</option>
			<option value="2" <?php if($are==2){ ?>selected<?php } ?>>RAYOS X</option>
            <option value="3" <?php if($are==3){ ?>selected<?php } ?>>EXAMENES</option>
		    </select>-->
            <input type="hidden" id="id" value="<?php echo $id ?>">
            <input type="hidden" id="pid" value="<?php echo $pid ?>">
            <input type="hidden" id="mid" value="<?php echo $mid ?>">
            <!--<select name="sala">
			<option value="">Seleccione</option>
			<?php
				/*$colecciones = $m->selectCollection("test","salas");
				$col=$colecciones->find();
				$i=1;
				foreach($col as $cols){
					echo "<option value=\"".$cols["nombre"]."\">".$cols["nombre"]."</option>\n";
				}*/
			?>
			</select>-->
            <!--<a href="content/historial_imp.php?id=<?php echo $id ?>&pid=<?php echo $pid ?>&mid=<?php echo $mid ?>&tip=<?php echo $tip ?>&FEI=<?php echo $fechaI ?>&FEF=<?php echo $fechaF ?>&cei=<?php echo $cei ?>&nua=<?php echo $nua ?>&apa=<?php echo $apa ?>" target="_blank" id="<?php echo $id_ ?>">Imprimir</a>-->
            <a href="#" id="imprimir"><img src="images/b_print1.jpg" border="0" hspace="2" align="absmiddle" />Imprimir</a>
			</td>
			<!--<td><input type="submit" value="Buscar" class="boton1"></td-->
		</tr>
		</table>
	</form>
</td></TR>
<TR><TD id="listado">
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
if($tip=="" and $cei=="" and $apa==""){ 
	$col=$colecciones->find(array("creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei=="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei!="" and $apa==""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei=="" and $apa==""){
	$col=$colecciones->find(array("estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei!="" and $apa!=""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei=="" and $apa!=""){
	$col=$colecciones->find(array("estado"=>$tip,"apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei!="" and $apa==""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei!="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
}
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
   </TD></TR>
   </table>
<?php } else { ?>
<?php if($_FILES['archivo']['name'] == "") { ?>
<script language="javascript">
   document.location.href="fotos_mod.php?id=<?php echo $_POST[id] ?>&t=<?php echo $_POST[t] ?>&tem=<?php echo $_POST[tem] ?>";
   //document.back();
   alert("Seleccione una imagen");
</script>
<?php } ?>
<?php
$ID = $_POST[ID];
$OP = $_POST[OP];
deleteI($OP,$ID,$link);
?>
<?php } ?>