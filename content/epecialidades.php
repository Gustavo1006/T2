<table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0"  >
  <tr><td height="10px"></td></tr>
     <tr><td colspan="5" ><div align="center" class="titulo">ESPECIALIDADES</div></td></tr>
    <tr>
      <td align="center">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <TR>
		<TD colspan="8" id="color1" align="right"><a href="index.php?cont=salas_add" class="link" name="categorias_add.php" id="ADD">Adicionar Registro <!--<img src="images/b_usrcheck.png" width="16" height="16" border="0" align="absmiddle" />--></a>  </td>
		</TR>
		<tr><td>
		<table width="100%" cellpadding="0" cellspacing="0" class="admin1">
		<TR id="color2">
		<TD align="left">ID</TD>
		<TD align="left">NOMBRE</TD>
		<TD align="left">DESCRIPCI&Oacute;N</TD>
		<TD align="center">MODIFICAR</TD>
		<!--<TD align="center">BORRAR</TD>-->
		</TR>
		 
<?php 
$i=1;
$m = new MongoClient();
$bd = $m->selectDB("test");
$colecciones = $m->selectCollection("test","especialidades");
$col=$colecciones->find();
$i=1;
foreach($col as $cols){
$id_ = $cols["_id"];
?>
<?php if($i%2!=0) { $color = color3; } else { $color = color4; } ?> 
  <tr id="<?php echo $color ?>">
	<td width="12" align="left"><?php echo $i ?></td>
	<td align="left"><?php echo utf8_encode($cols["nombre"]) ?></td>
    <td align="left"><?php echo utf8_encode($cols["descripcion"]) ?></td>
	<td width="60" align="center"><a href="index.php?cont=salas_mod" name="salas_edit.php" id="<?php echo $id_ ?>" class="EDIT"><img src="images/b_edit.png" border="0" ></a></td>
	<!--<td width="55" align="center"><a href="#" name="salas" id="<?php echo $id_ ?>" class="DEL"><img src="images/b_drop.png" border="0"></a></td>-->
   </tr>
<?php $i++;}?>
   </table>
   </td></tr>
   </table>
 </td>
 </tr>
 <tr><td height="10px"></td></tr>
</table>
