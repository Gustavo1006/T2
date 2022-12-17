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
});
	function ajaxFileUpload()
	{
       id = $("#ID").val();
	   cid = $("#CID").val();
	   nua = $("#NUA").val();
	   na = $("#NA").val();
	   op = $("#OP").val();
	   or = $("#OR").val();
		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});

		$.ajaxFileUpload
		(
			{
				url:'functions/doajaxfileupload.php?ID=' + id + '&CID=' + cid + '&OP=' + op + '&N=' + nua + '&NA=' + na,
				secureuri:false,
				fileElementId:'fileToUpload',
				dataType: 'json',
				success: function (data, status)
				{
					if(typeof(data.error) != 'undefined')
					{
						if(data.error != '')
						{
							//alert(data.error);
							$("#ar_h").load("content/archivos.php?id="+id+"&cid="+cid);
						}else
						{
							//alert(data.msg);
							$("#ar_h").load("content/archivos.php?id="+id+"&cid="+cid);
						}
					}
				},
				error: function (data, status, e)
				{
					//alert(e);
					$("#ar_h").load("content/archivos.php?id="+id+"&cid="+cid);
				}
			}
		)
		return false;
	}
</script>
<?php if(empty($_GET['action'])) { ?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
$id=$_GET["id"];
$cid=$_GET["cid"];
$nua=$_GET["na"];
/*$prod=$_GET["prod"];
$cid = cid($op);
$cimg = cimg($op);
$ctab = ctab($op);
$ccarp = ccarp($op,$prod);
$sql = "select * from $ctab where $cid=$id";
$res = mysql_query($sql,$link);
$row=@mysql_fetch_array($res);
if($op=='productos_imgs'){
   $img = "../" . $ccarp . str_replace(".","_slide.",$row[$cimg]);
} else {
   $img = "../" . $ccarp . $row[$cimg];
}*/
/*if($op=='servicios_tipo') {
   $origen = 'serviciost_edit.php';
} else if($op!='productos_imgs') {
   $origen = $op . '_edit.php';
} else {
   $origen = $op . '.php';   
}*/
?>
<table width="100%" cellpadding="0" cellspacing="0" class="admin1">
		<!--<TR id="color2">
		<TD align="left">ID</TD>
		<TD align="left">DESCRIPCI&Oacute;N</TD>
		<TD align="center">ARCHIVO</TD>
		<TD align="center">BORRAR</TD>
		</TR>--> 
<?php 
$i=1;
$m = new MongoClient();//echo $cid;
$bd = $m->selectDB("test");
$colecciones = $m->selectCollection("test","archivos");
if($cid!="" and $cid!="undefined"){
$col=$colecciones->find(array("area"=>"$id","subarea"=>"$cid","hid"=>"0"));
}else{
$col=$colecciones->find(array("area"=>"$id","hid"=>"0"));
}
$i=1;
foreach($col as $cols){
$id_ = $cols["_id"];
?>
<?php if($i%2!=0) { $color = 'color3'; } else { $color = 'color4'; } ?> 
  <tr id="<?php echo $color ?>">
	<!--<td width="12" align="left"><?php echo $i ?></td>
	<td align="left"><?php echo $cols["hid"] ?></td>-->
    <td align="left"><?php echo $cols["archivo"] ?></td>
	<td width="60" align="center"><a href="docs/<?php echo utf8_encode($cols["archivo"]) ?>" name="salas_edit.php" id="<?php echo $id_ ?>" class="EDIT" target="_blank"><img src="images/s_db.png" border="0" ></a></td>
	<td width="55" align="center"><a href="#" name="salas" id="<?php echo $id_ ?>" class="DEL"><img src="images/b_drop.png" border="0"></a></td>
   </tr>
<?php $i++;}?>
   </table>
<form name="form" action="" method="POST" enctype="multipart/form-data">
<table width="100%" border="0" align="center" cZellpadding="0" cellspacing="0">
<tr><td align="center">
<div style="border:1px solid #FFFFFF; width:100%;">
<table width="100%" border="0" align="center" cZellpadding="0" cellspacing="0" id="color1">
  <tr><td height="5px"></td></tr>
  <tr>
    <td align="center"></td>
    <td align="center">
	<img id="loading" src="images/loading1.gif" style="display:none;">
	<input id="fileToUpload" type="file" size="100" name="fileToUpload" class="input">
	<!--<input id="archivo" name="archivo" type="file" size="70">-->
	</td>
    <td align="center"><input type="hidden" name="MAX_FILE_SIZE" value="5000" />
	    </td>
  </tr>
  <tr>
    <td colspan="3" align="center">
	<!--<input id="SUBIR" name="submit" type="button" value="Subir Foto"/>-->
	<input id="buttonUpload" name="submit" type="button" value="Subir Archivo" onClick="return ajaxFileUpload();" class="boton1"/>
	<!--<input id="DELI" name="Eliminar" type="button" value="Eliminar Foto" />
	<input name="<?php echo $origen ?>?id=<?php echo $oid ?>&MAR=<?php echo $_GET[MAR] ?>&CAT=<?php echo $_GET[CAT] ?>&SUB=<?php echo $_GET[SUB] ?>" type="button" id="VOLVER" value="Volver"/>-->
	<input type="hidden" name="ID" id="ID" value="<?php echo $id ?>">
	<input type="hidden" name="OP" id="OP" value="<?php echo $op ?>">
	<input type="hidden" name="OR" id="OR" value="<?php echo $origen ?>">
	<input type="hidden" name="CID" id="CID" value="<?php echo $cid ?>">
	<input type="hidden" name="MAR" id="MAR" value="<?php echo $_GET[MAR] ?>" />
	<input type="hidden" name="CAT" id="CAT" value="<?php echo $_GET[CAT] ?>" />
	<input type="hidden" name="SUB" id="SUB" value="<?php echo $_GET[SUB] ?>" />
    <input type="hidden" name="NUA" id="NUA" value="<?php echo $i ?>" />
    <input type="hidden" name="NA" id="NA" value="<?php echo $nua ?>" />
	</td>
    </tr>
	<tr><td height="10px"></td></tr>
</table>

</div>
</td></tr>
<tr><td height="10px"></td></tr>
</table>
  </form>
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