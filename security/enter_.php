<?php 
@session_start(); 
ini_set("session.use_only_cookies","1"); 
//ini_set("session.use_trans_sid","0");
include_once("../config/config.php");

//session_set_cookie_params(0, "/", $HTTP_SERVER_VARS["HTTP_HOST"], 0); 
//$_SESSION["loggedInUser"] = $username;

    try {
        // open connection to MongoDB server
        $conn = new Mongo('localhost');

        // access database
        $db = $conn->test;

        // access collection
        $collection = $db->items;

        $username=mysql_escape_string($_POST["username"]);
        $password=mysql_escape_string($_POST["password"]);


        $user = $db->$collection->findOne(array('username'=> $username, 'password'=> $password));

        foreach($user as $obj) {
            echo 'Username' . $obj['username'];
            echo 'password: ' . $obj['password'];
            if($username == 'username' && $password == 'password'){
                echo 'found' ;          
            }
            else{
                echo 'not found' ;           
            }

        }

        // disconnect from server
        $conn->close();

    } catch (MongoConnectionException $e) {
        die('Error connecting to MongoDB server');
    } catch (MongoException $e) {
        die('Error: ' . $e->getMessage());
		session_name($row["USU_ID"]);
        $_SESSION["admin"] = $row["USU_ID"]; 
        $_SESSION["ultimoAcceso"]= date("Y-n-j H:i:s");
    }

//$_SESSION["loggedInUser"] = $correct;
/*if($row = @mysql_fetch_array($res)){
   $pagina="$DESTINO";*/
   
?>
<script language="javascript">
//$(document).ready(function(){ $("#msg").css({ "background-image" : "url(images/s_okay.png)" }); });
</script> 
<?php //echo utf8_encode('Datos Verificados Exitosamente!... Bienvenido!'); ?>
<script language="javascript">
//$(document).ready(function(){ $("#frm_ingreso").submit(); });
</script> 
<?php
/*}
else{
    echo utf8_encode('Error! Codigo o contraseña incorrectos!.. Verifique los datos Ingresados...');
}*/
?>

