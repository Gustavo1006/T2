<?php
$a = array(
"USR_ID" => 1,
"USR_NOMBRE" => "marco",
"USR_PASS" => 666,
"USR_CARGO" => 'Administrador'
);
insert($a,usuarios);
foreach($a as $k => $v) {
print "\$a[$k] => $v.\n";
}
function insert($v,$tabla)
{  $i = 0;
  $operacion = "insert into ";
  foreach($v as $c => $val) {
    if($i==0) {
	   $sql = $operacion . " `" . $tabla . "` " . "(" . "$c";
	   $sql1 = ") " . "values" . " (" . $v[$c];
	} else {
	   $sql = $sql . "," . "$c";
	   $sql1 = $sql1 . "," . $v[$c];
    }
  $i++;
  }
  echo "\"" . $sql . $sql1 . ")\"";
}
?>
<script language="javascript">
  document.location.href="<?php echo "../" . $ORIGEN ?>";
</script>