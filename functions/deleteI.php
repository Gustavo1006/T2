<?php 
$ID=$_GET["id"];
$TABLA=$_GET[tabla];
$CID=$_GET[iden];
$AID=$_GET[idenI];
$ORIGEN="../" . $_GET[origen] . "&tem=" .$_GET[tem];
$CARPETA=$_GET[carpeta];
include("../conexion/conexion.php");
$link=Conectarse();
$sql = "select * from $TABLA where $CID=$ID";
$res = mysql_query($sql,$link);
$row = @mysql_fetch_array($res);
$img = $row[$AID];
$dir= '../' . $CARPETA . $img; 
if(file_exists($dir))
{
	if(unlink($dir))
	  print "El archivo fue borrado".'<br>';
}
else
  print "Este archivo no existe";
$img=str_replace(".","_thumb.",$img); 
$dir= '../' . $CARPETA . $img;
if(file_exists($dir))
{
	if(unlink($dir))
	  print "El archivo adjunto fue borrado";
}
else
  print "Este archivo no contiene archivo adjunto";
$sql = "UPDATE $TABLA SET $AID='' WHERE $CID=$ID" ;
$res=mysql_query($sql,$link);
$sql = "UPDATE $TABLA SET GAL_IMG_S='' WHERE $CID=$ID";
$res = mysql_query($sql,$link);
?>
<script language="javascript">
self.location='<?php echo $ORIGEN."&tip=".$_GET[tip]; ?>';
</script>