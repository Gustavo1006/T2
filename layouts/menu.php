<?php 
/*if(empty($_GET["id"])){
	$id=$_SESSION["admin"];
} else {
	$id=$_GET["id"];
}*/
$idu=$_SESSION["admin"];
//$usr_password=md5($usr_password);
$con = new Mongo();
if($con){
// Select Database
$db = $con->test;
// Select Collection
$people = $db->usuarios;
$qry = array("user" => $idu);
$result = $people->findOne($qry);
	if($result){
		$nomc = $result["nombre"];
		$logc = $result["user"];
		$pasc = $result["password"];
		$tipc = $result["cargo"];
		$tipuc = $result["tipo"];
    } else {
		//echo "codigo incorrecto";
	}
} else {
	die("Mongo DB not installed");
}  
?>
<!-- *****************  Administracion del sistema ********************** -->
<div style="height:10px;"></div>
<!-- *****************  CAJA OPCIONES 1 ********************** -->
		<!--<div class="menu_tit"> Datos Institucionales</div>
		<div class="menu_contenedor">
        <a href="index.php?cont=salas" id="" title="Salas" class="B">Salas</a><br />
        <a href="index.php?cont=especialidad" id="" title="Especialidades" class="B">Especialidades</a><br />
	    </div>-->
<!-- *****************  CAJA OPCIONES 2 ********************** -->
		
        <div class="menu_tit"> Registro para Pacientes</div>
		<div class="menu_contenedor">
        <?php if($tipuc==1){ ?>
        <a href="index.php?cont=pacientes_add" id="" title="Pacientes" class="B">Registrar Pacientes</a><br />
        <a href="index.php?cont=pacientes_act" id="" title="Pacientes" class="B">Actualizar Datos de Pacientes</a><br />
        <?php } ?>
        <a href="index.php?cont=pacientes_con" id="" title="Pacientes" class="B">Consulta de Pasciente</a>
	    </div>
        
<!-- *****************  CAJA OPCIONES 3 ********************** -->
		<?php if($tipuc==1){ ?>
        <div class="menu_tit"> Historial</div>
		<div class="menu_contenedor">
        <a href="index.php?cont=historial" id="" title="Historial" class="B">Registrar Historial</a><br />
        <!--<a href="index.php?cont=historial_mod" id="" title="Historial" class="B">Editar Historial</a><br />-->
        <a href="index.php?cont=historial_bus" id="" title="Historial" class="B">Buscar Historial</a>
	    </div>
        <?php } ?>
<!-- *****************  CAJA OPCIONES 1 ********************** -->
		<?php if($tipuc==1){ ?>
        <div class="menu_tit"> Administraci&oacute;n del Sistema</div>
		<div class="menu_contenedor">
        <a href="index.php?cont=usuarios_add" id="" title="Usuarios" class="B">Registrar Usuarios</a><br />
        <a href="index.php?cont=usuarios_mod" id="" title="Usuarios" class="B">Configuraci&oacute;n de Usuarios</a><br />
        <a href="index.php?cont=usuarios_con" id="" title="Usuarios" class="B">Cambiar Contrase&ntilde;a de Usuarios</a><br />
		<!--<a href="security/cerrar_sesion.php" title="Usuarios" class="B" >Cerrar sesi&oacute;n</a>-->
	    </div>
        <?php } ?>
        <?php //}else{ ?>
        <!--<div class="menu_tit"> Historial</div>
        <a href="index.php?cont=historial_bus" id="" title="Historial" class="B">Buscar Historial</a>
	    </div>-->
        
<!-- **************************************************************-->

