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
     //si pasaron 10 minutos o m�s 
      session_destroy(); // destruyo la sesi�n 
      //header("Location: index.php"); //env�o al usuario a la pag. de autenticaci�n 
?>
<script language="javascript">
	alert("Su session en el administrador a caducado, por favor introduzca nuevamente su Codigo y Clave.");
	document.location.href = "login.php";
</script>
<?php
      //sino, actualizo la fecha de la sesi�n 
    }else { 
      $_SESSION["ultimoAcceso"] = $ahora; 
    } 
?>
<?php } ?>

