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
		document.location.href = "index.php?cont=archivos_adm&id="+id+"&pid="+pid+"&mid="+mid+"&are="+are;
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
	$coleccionesp = $m->selectCollection("test","pacientes");
	$colp=$coleccionesp->findOne(array("_id" => new MongoId($pid)));
	$coleccionesm = $m->selectCollection("test","usuarios");
	$colm=$coleccionesm->findOne(array("_id" => new MongoId($mid)));
?>
<h3>ARCHIVOS DE HISTORIALES DEL PACIENTE</h3>
<table width="100%" cellpadding="0" cellspacing="0" class="admin1">
<TR><td align="left" colspan="5">
<form action="bus_est.php">
		<input type="hidden" name="busqueda" value="sala"/>
		<table class="tabla" align="right" width="100%">
		<tr>
        <td align="left">Paciente : <?php echo $colp["nombre"]." ".$colp["apellido"] ?>&nbsp;&nbsp;|&nbsp;&nbsp;Doctor : <?php echo $colm["nombre"] ?></td>
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
				$colecciones = $m->selectCollection("test","salas");
				$col=$colecciones->find();
				$i=1;
				foreach($col as $cols){
					echo "<option value=\"".$cols["nombre"]."\">".$cols["nombre"]."</option>\n";
				}
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
        <TD align="left">AREA</TD>
		<TD align="left">DESCRIPCI&Oacute;N</TD>
		<TD align="center">ARCHIVO</TD>
		<TD align="center">BORRAR</TD>
		</TR>
<?php 
$i=1;
$m = new MongoClient();
$bd = $m->selectDB("test");
$colecciones = $m->selectCollection("test","archivos");
if($are==""){
	$col=$colecciones->find(array("hid"=>new MongoId($id)));
} else {
	$col=$colecciones->find(array("hid"=>new MongoId($id),"area"=>$are));
}
$i=1;
foreach($col as $cols){
$id_ = $cols["_id"];
	/*$coleccionesp = $m->selectCollection("test","pacientes");
	$colp=$coleccionesp->findOne(array("ci" => $cols["ci_paciente"]));*/
?>
<?php if($i%2!=0) { $color = 'color3'; } else { $color = 'color4'; } ?> 
  <tr id="<?php echo $color ?>">
	<td width="12" align="left"><?php echo $i ?></td>
	<td align="left"><?php echo area($cols["area"]) ?></td>
    <td align="left"><?php echo utf8_encode($cols["archivo"]) ?></td>
	<td width="60" align="center"><a href="docs/<?php echo utf8_encode($cols["archivo"]) ?>" name="salas_edit.php" id="<?php echo $id_ ?>" class="EDIT" target="_blank"><img src="images/s_db.png" border="0" ></a></td>
	<td width="55" align="center"><a href="#" name="salas" id="<?php echo $id_ ?>" class="DEL"><img src="images/b_drop.png" border="0"></a></td>
   </tr>
<?php $i++;}?>
  <tr><td colspan="5" align="right"><a href="index.php?cont=pacientes_con&id=<?php echo $colp["ci"] ?>" name="salas" id="<?php echo $id_ ?>"><< Volver</a></td></tr>
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