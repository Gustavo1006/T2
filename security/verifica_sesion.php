<?php 
error_reporting(E_ALL);
ini_set('display_errors', '0');
if(!isset($_SESSION["admin"])){ ?>
<script language="javascript">
	alert("Su session en el administrador a caducado, por favor introduzca nuevamente su Codigo y Clave.");
	document.location.href = "login.php";
</script>
<?php } else { ?>
<?php
    //sino, calculamos el tiempo transcurrido 
    $fechaGuardada = $_SESSION["ultimoAcceso"]; 
    $ahora = date("Y-m-d H:i:s"); 
    $tiempo_transcurrido = (strtotime($ahora)-strtotime($fechaGuardada)); 

    //comparamos el tiempo transcurrido 
     if($tiempo_transcurrido >= 1000) { 
     //si pasaron 10 minutos o más 
      session_destroy(); // destruyo la sesión 
      //header("Location: index.php"); //envío al usuario a la pag. de autenticación 
?>
<script language="javascript">
	alert("Su session en el administrador a caducado, por favor introduzca nuevamente su Codigo y Clave.");
	document.location.href = "login.php";
</script>
<?php
      //sino, actualizo la fecha de la sesión 
    }else { 
      $_SESSION["ultimoAcceso"] = $ahora; 
    } 
?>
<?php } ?>

