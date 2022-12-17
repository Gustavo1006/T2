<?php //require("../config/config.php"); $op=$_GET["op"]; ?>
<script language="javascript">
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
	$(".FECHA").change(function(){
        var id = $("#id").val();
		var pid = $("#pid").val();
		var mid = $("#mid").val();
		var are = $("#area").val();
	   dia = $("#DIA").val();
	   mes = $("#MES").val();
	   anio = $("#ANIO").val();
	   fecha = anio+"-"+mes+"-"+dia;
	   dia1 = $("#DIA1").val();
	   mes1 = $("#MES1").val();
	   anio1 = $("#ANIO1").val();
	   fecha1 = anio1+"-"+mes1+"-"+dia1;
	   document.location.href = "index.php?cont=historial_bus&id="+id+"&pid="+pid+"&mid="+mid+"&are="+are+"&FEI="+fecha+"&FEF="+fecha1;
       //$('#cont_der').load("content/eventas_adm.php?PRV="+ mar + "&USU=" + cat + "&FEI=" + fecha + "&FEF=" + fecha1);
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
	$are = $_GET["are"];
?>
<h3>HISTORIALES DEL PACIENTES</h3>
<table width="100%" cellpadding="0" cellspacing="0" class="admin1">
<TR><td align="left" colspan="7">
<form action="bus_est.php">
		<input type="hidden" name="busqueda" value="sala"/>
		<table class="tabla" align="right" width="100%">
		<tr>
        <td align="left">
        <?php
		/*$coleca = $m->selectCollection("test","historial");
	    $coa=$coleca->find();
		$coa->sort(array("creacion_exp"=>1));
		$fechaI = $coa["creacion_exp"];
		$FI = explode("-",$coa["creacion_exp"]);
		$colecd = $m->selectCollection("test","historial");
	    $cod=$colecd->find();
		$cod->sort(array("creacion_exp"=>-1));
		$fechaF = $cod["creacion_exp"];
		$FF = explode("-",$cod["creacion_exp"]); */
		$FI = explode("-",date("Y-m-d"));
		$FF = explode("-",date("Y-m-d"));
		$fechaI = date("Y-m-d");
		$fechaF = date("Y-m-d");
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
        </select>
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
				$FFD = $FI[2];
				$FFM = $FI[1];
				$FFA = $FI[0];
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
		<td align="right">Area : 
			<select name="area" id="area">
			<option value="">Todas</option>
			<option value="1" <?php if($are==1){ ?>selected<?php } ?>>LABORATORIO</option>
			<option value="2" <?php if($are==2){ ?>selected<?php } ?>>RAYOS X</option>
            <option value="3" <?php if($are==3){ ?>selected<?php } ?>>EXAMENES</option>
		    </select>
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
			</td>
			<!--<td><input type="submit" value="Buscar" class="boton1"></td-->
		</tr>
		</table>
	</form>
</td></TR>
		<TR id="color2">
		<TD align="left">ID</TD>
        <TD align="left">FECHA</TD>
		<TD align="left">PACIENTE</TD>
		<TD align="left">MEDICO</TD>
        <TD align="left">AREA</TD>
        <TD align="left">OBSERVACIONES</TD>
		<TD align="center">ARCHIVO</TD>
		</TR>
<?php 
$i=1;
$m = new MongoClient();
$bd = $m->selectDB("test");
$colecciones = $m->selectCollection("test","archivos");
$start = $fechaI;
$end = $fechaF;
if($are==""){
	$col=$colecciones->find(array("fecha" => array('$gte' => $start, '$lte' => $end)));
} else {
	$col=$colecciones->find(array("area"=>$are,"fecha" => array('$gt' => $start, '$lte' => $end)));
}
$col->sort(array("_id"=>-1));
$i=1;
foreach($col as $cols){
$id_ = $cols["_id"];
	$coleccionesh = $m->selectCollection("test","historial");
	$colh=$coleccionesh->findOne(array("_id" => $cols["hid"]));
	$coleccionesp = $m->selectCollection("test","pacientes");
	$colp=$coleccionesp->findOne(array("ci" => $colh["ci_paciente"]));
	$coleccionesm = $m->selectCollection("test","usuarios");
	$colm=$coleccionesm->findOne(array("ci" => $colh["ci"]));
?>
<?php if($i%2!=0) { $color = 'color3'; } else { $color = 'color4'; } ?> 
  <tr id="<?php echo $color ?>">
	<td width="12" align="left"><?php echo $i ?></td>
    <td align="left"><?php echo utf8_encode($colh["creacion_exp"]) ?></td>
    <td align="left"><?php echo utf8_encode($colp["nombre"]." ".$colp["apellido"]) ?></td>
	<td align="left"><?php echo utf8_encode($colm["nombre"]) ?></td>
	<td align="left"><?php echo area($cols["area"]) ?></td>
    <td align="left"><?php echo $colh["observaciones"] ?></td>
	<td width="60" align="center"><a href="docs/<?php echo utf8_encode($cols["archivo"]) ?>" name="salas_edit.php" id="<?php echo $id_ ?>" class="EDIT" target="_blank"><img src="images/s_db.png" border="0" ></a></td>
	<!--<td width="55" align="center"><a href="#" name="salas" id="<?php echo $id_ ?>" class="DEL"><img src="images/b_drop.png" border="0"></a></td>-->
   </tr>
<?php $i++;}?>
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