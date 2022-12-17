<?php 
	$id=$_GET["id"];
	$cid=$_GET["cid"];
//$usr_password=md5($usr_password);
$con = new Mongo();
if($con){
// Select Database
$db = $con->test;
// Select Collection
$people = $db->pacientes;
$qry = array("ci" => $id);
$result = $people->findOne($qry);
	if($result){
		$nom = $result["nombre"]." ".$result["apellido"];
		$numa = $result["num_asegurado"];
		$apellido = $result["apellido"];
    } else {
		//echo "codigo incorrecto";
	}
	$nop=explode(" ",$result["nombre"]);
	$inn=substr($nop[0],0,1).substr($nop[1],0,1);
	$app=explode(" ",$result["apellido"]);
	$ina=substr($app[0],0,1).substr($app[1],0,1);
	$nuc=$numa."_".$inn.$ina;
$db = $con->test;
$people = $db->usuarios;
$qry = array("user" => $_SESSION["admin"]);
$result = $people->findOne($qry);
	if($result){
		//$nomp = $result["nombre"];
		$cid = $result["ci"];
		$matp = $result["nombre"]." ".$result["apellido"];
    } else {
		//echo "codigo incorrecto";
	}
} else {
	die("Mongo DB not installed");
}
?>
<div class="titulo">Historial del Paciente</div>

<form name="registro" id="FORM" action="index.php?cont=historial" method="post" enctype="multipart/form-data">
<table width="600" align="center" class="table1">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>DATOS HISTORIALES DEL PACIENTE</h3></td>
</tr>
<tr><td id="cont_s" class="msg_a" colspan="2"></td></tr>
<tr>
	<td class="tdatos" align="left">C&eacute;dula del Paciente</td>
	<td class="dtabla" align="left"><input type="text" name="cedpac" id="cedpac" size="12" value="<?php echo $id; ?>" />
    <select id="ciudad" name="ciudad">
    	<?php for($i=1;$i<=9;$i++){ ?>
        <option value="<?php echo ciu_cod($i) ?>"><?php echo ciu_cod($i) ?></option>
        <?php } ?>
    </select></td>
</tr>
<tr><td id="cont_dp" class="msg_a" colspan="2" align="left"></td></tr>
<?php if(!empty($_GET["id"])){ ?>
<tr>
	<td class="tdatos" align="left">Nro. de Asegurado</td>
	<td class="dtabla" align="left"><input type="text" name="codexp" id="codexp" size="12" value="<?php echo $numa; ?>" readonly /></td>
</tr>
<tr>
	<td class="tdatos" align="left">Nombre</td>
	<td class="dtabla" align="left"><input type="text" name="nom" id="nom" size="30" value="<?php echo $nom; ?>" readonly /></td>
</tr>
<?php } ?>
<!--<tr>
	<td  class="tdatos" align="left">Creaci&oacute;n del Expediente</td>
	<td class="dtabla" align="left">
    <select name="DIA" id="DIA">
        	<?php for($i=1;$i<=31;$i++){ ?>
            <option value="<?php echo $i ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>/
        <select name="MES" id="MES">
        	<?php for($i=1;$i<=12;$i++){ ?>
            <option value="<?php echo $i ?>"><?php echo mes($i); ?></option>
            <?php } ?>
        </select>/
        <select name="ANIO" id="ANIO">
        	<?php for($i=2015;$i<=2020;$i++){ ?>
            <option value="<?php echo $i ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
    d&iacute;a/mes/a&ntilde;o</td>
</tr>-->
<tr>
	<td class="tdatos" align="left">C&eacute;dula del Profesional</td>
	<td class="dtabla" align="left"><input type="text" name="cedpro" id="cedpro" size="12" value="<?php echo $cid; ?>" readonly /></td>
</tr>
<?php //if(!empty($_GET["cid"])){ ?>
<tr>
	<td class="tdatos" align="left">Nombre</td>
	<td class="dtabla" align="left"><input type="text" name="matpro" id="matpro" size="30" value="<?php echo $matp; ?>" readonly /></td>
</tr>
<?php //} ?>
<tr><td id="cont_dpr" class="msg_a" colspan="2" align="left"></td></tr>
<!--<tr>
	<td class="tdatos" align="left">Nombre del Profesional</td>
	<td class="dtabla" align="left"><input type="text" name="cedest" id="cedest" size="12" /></td>
      </tr>
     <tr>
	<td class="tdatos" align="left">Tipo de Profesi&oacute;n</td>
	<td class="dtabla" align="left"><input type="text" name="tipop" id="tipop" size="12" /></td>
      </tr>-->
<!--<tr>
	<td class="tdatos" align="left">Historial</td>
	<td class="dtabla" align="left"><input name="userfile" type="file"/></td>
</tr>
<tr>
	<td class="tdatos" align="left">Area</td>
	<td class="dtabla" align="left">
		<select name="estciv">
			<option value="">Seleccione</option>
			<option value="">LABORATORIO</option>
			<option value="">RAYOS X</option>
            <option value="">EXAMENES</option>
		
		</select>
	</td>
</tr>-->
<tr>
	<td class="tdatos" align="left">Observaciones</td>
	<td class="dtabla" align="left"><textarea rows="4" name="obser" cols="40"></textarea></td>
</tr>
<tr>
	<td class="tdatos" align="left">Estado</td>
	<td class="dtabla" align="left">
		<select name="estado">
			<option value="A">ACTIVO</option>
			<option value="I">INACTIVO</option>
		</select>
	</td>
</tr>
<tr>
	<td colspan="2" align="center"><input type="submit" name="acc" id="enviar" value="Registrar" class="boton1" onclick="return false;">
    <input type="hidden" name="TIPO" id="TIPO" value="1">
    <input type="hidden" name="apellido" id="apellido" value="<?php echo $apellido ?>">
    <input type="hidden" name="nuc" id="nuc" value="<?php echo $nuc ?>"></td>
</tr>
</table>
</form><br />
<table width="600" align="center" class="table1">
<tr>
	<td class="tdatos" colspan="2" align="center"><h3>ARCHIVOS DE HISTORIALES DEL PACIENTE</h3></td>
</tr>
<tr>
	<td class="tdatos" align="left">Area</td>
	<td class="dtabla" align="left">
		<select name="estciv" id="estciv">
			<option value="">Seleccione</option>
			<option value="1">EVOLUCIÓN Y TRATAMIENTO</option>
			<option value="2">LABORATORIO</option>
            <option value="3">IMAGENOLOGÍA</option>
            <option value="4">DOC. INTERNACIÓN</option>
            <option value="5">DOC. EXTERNOS</option>
		</select>
        <select name="suba" id="suba" style="display:none">
			<option value="">Seleccione</option>
			<option value="1">ECOGRAFÍA</option>
			<option value="2">RAYOS X</option>
            <option value="3">TOMOGRAFÍA</option>
            <option value="4">ENDOSCOPÍA</option>
		</select>
	</td>
</tr>
<tr>
	<td class="dtabla" align="center" id="ar_h" colspan="2"><!--<input name="userfile" type="file"/>--></td>
</tr>
</table>
<script language="javascript">
$(document).ready(function(){
   $("#cedpac").keyup(function(){
   		var ci = $(this).val();
		$("#cont_dp").load("scripts/verifica_pac.php?id="+ci);
		//$("#pass1").val(nom4+nom0+nom2+ci1+"#");
   });
   /*$("#cedpro").keyup(function(){
   		var ci = $(this).val();
		var cid = $("#cedpac").val();
		$("#cont_dpr").load("scripts/verifica_pro.php?id="+ci+"&cid="+cid);
		//$("#pass1").val(nom4+nom0+nom2+ci1+"#");
   });*/
   $("#estciv").change(function(){
   		var id = $(this).val();
		var nua = $("#codexp").val();
		if(id==3){
			$("#suba").show();
		}else {
			$("#suba").hide();
		}
		if(id=="3" & $("#suba").val()==""){
			alert("Seleccione un area!...");
			$("#suba").focus();
			$("#ar_h").html("");
		} else if(id!="" & id!="3"){
			$("#ar_h").load("content/archivos.php?id="+id+"&na="+nua);
		} else{
			//alert("Seleccione un area!...");
			$("#ar_h").html("");
			$("#estciv").focus();
		}
   });
   $("#suba").change(function(){
   		var cid = $(this).val();
		var id = $("#estciv").val();
		if(id!=""){ 
		$("#ar_h").load("content/archivos.php?id="+id+"&cid="+cid);
		} else{
			//alert("Seleccione un area!...");
			$("#ar_h").html("");
			$("#estciv").focus();
		}
   });
   $("#enviar").click(function(){
	   cpa = $("#cedpac").val();
	   cod = $("#codexp").val();
	   cp = $("#cedpro").val();  
	   if(cpa=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca su Cedula de identidad!...");
		  $("#cedpac").focus();
	   } else if(cp=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca la Cedula del Profesional!...");
		  $("#cedpro").focus();
	   } else if(cp=="") {
		  //alert("Introduzca la Descripcion en Español!...");
		  $('#cont_s').html("Introduzca la Cedula del Profesional!...");
		  $("#cedpro").focus();
	   } else {
	      $("#FORM").submit();
		  //$('#cont_s').load("scripts/usuarios_add.php",{"nombre":nom,"ci":ci,"login":login,"pass1":pas1,"tipo_prof":tipo});
	   }
   });
});
</script>