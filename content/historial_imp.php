<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
require_once("../resources/tcpdf/config/lang/eng.php");
require_once("../resources/tcpdf/tcpdf.php");
//require("../conexion/conexion.php");
//include("functions.php");
//require("../config/functions.php");

//create new PDF document
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,PDF_PAGE_FORMAT,true); 
//$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT,'legal', true, 'UTF-8', false); 

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'leter', true, 'UTF-8', false); 
// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor("Marco Antonio Apaza");
$pdf->SetTitle("HISTORIAL DE PACIENTES");
$pdf->SetSubject("Historial");
$pdf->SetKeywords("Historial");

//remove default header/footer
class ConPies extends TCPDF {
    public function Header() {
        /*ponemos color al texto y a las lineas */
        $this->SetTextColor(0,0,200);
        $this->SetDrawColor(0,0,0);
        /* definimos variables con titulo y subtitulo */
        /* posicionamos el puto de insercion 2mm. debajo
           del borde del papel */
        $this->SetY(2);
        /* escribimos el titulo con la fuente que se establezca
        por el método opcion SetHeaderFont */
         /* modificamos tipografia para el subtitulo
          e insertamos este */
        /* trazamos un rectangulo sombreado que por sus dimensiones
        ocupará el area de texto de la pagina */
        /*trazamos una linea roja debajo del encabezado */
        /* insertamos una imagen de fondo con 15% de opacidad */
        $this->SetAlpha(0.15,'Normal');
        $this->Image('../images/logo.gif',55,84,180,104,
                      '','','N','','','C');
        /* recuperamos la opacidad por defecto */
        $this->SetAlpha(1,'Normal');
    }
     public function Footer() {
          /* establecemos el color del texto */
          $this->SetTextColor(0,0,0);
          /* insertamos numero de pagina y total de paginas*/
          $this->Cell(0, 10, ' La Paz - Bolivia',0, false, 'C', 0, '', 0, false, 'T', 'M');
          $this->SetDrawColor(0,0,0);
          /* dibujamos una linea roja delimitadora del pie de página */
          $this->Line(0,282,210,282);

    }
} 
//set margins
$pdf=new ConPies();
$pdf->setHeaderMargin(2);
$pdf->setFooterMargin(15);
$pdf->setFooterFont(Array('helvetica', 'I', 8));
/* fijamos el modo de visualizacion, agregamos dos paginas
   y visualizamos el resultado */


/* incluimos un rectángulo relleno para contener el formulario completo */ 

//set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO); 
//set some language-dependent strings
$pdf->setLanguageArray($l); 
//initialize document
// set font*/
$pdf->SetFont('times', '', 10);
// add a page
$pdf->AddPage();
////recuperacion de datos de la solicitud para realizar la insecion den la tabla solicitudes y madar a imprimir
$fecha = date("Y-m-d")." - ".date("h:m:s");
$ruta_img="../images/logo.gif";
$cabecera = "<table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" align=\"center\">
<tr>
  <td width=\"130\" align=\"right\"><img src=\"../images/textedit.png\" border=\"0\" height=\"100\" width=\"100\" /></td>
  <td width=\"300\" height=\"100\" align=\"left\" valign=\"middle\"><p></p><h1>HISTORIAL DE PACIENTES</h1>".$fecha."</td>
  <!--<td width=\"246\" rowspan=\"2\"  align=\"right\"><img src=\"".$ruta_img."\" border=\"0\" height=\"61\" width=\"246\" /></td>-->
</tr>
</table>";
$titulo1=$cabecera."<!--<br><strong style=\"font-size:34px;\">LISTADO DE CONSULTAS: <br />-->"; 
$pdf->writeHTML($titulo1, true, 0, true, 0); 

/*$sm = "select * from clientes where CLI_ID=".$_GET["PRV"];
$rm = mysql_query($sm);
if($rma = @mysql_fetch_array($rm)){
	$proveedor = $rma["CLI_NOMBRE"]." ".$rma["CLI_APELLIDO"];
} else {
	$proveedor= "";
}
$sc = "select * from usuarios where USU_ID=".$_GET["USU"];
$rc = mysql_query($sc);
if($rca = @mysql_fetch_array($rc)){
	$usuario = $rca["USU_NOMBRE"];
} else {
	$usuario = "";
}*/
//if(!empty($_GET["PRV"]) or !empty($_GET["USU"])){
$datos="<table border=\"1\" cellpadding=\"3\" cellspacing=\"3\" style=\"font-size:32px;\">
  <tr>
	<td align=\"center\" bgcolor=\"#ededed\" width=\"15%\">PROVEEDOR:</td>
	<td align=\"center\" width=\"35%\">".utf8_encode($proveedor)."</td>
	<td align=\"center\" bgcolor=\"#ededed\" width=\"15%\">USUARIO:</td>
	<td align=\"center\" width=\"35%\">".utf8_encode($usuario)."</td>
  </tr>
  </table>";
   
//$pdf->writeHTML($datos, true, 0, true, 0);
//}
$cont1="<table border=\"1\" cellpadding=\"3\" cellspacing=\"3\" style=\"font-size:32px;\">
  <tr>
  <td align=\"center\" bgcolor=\"#ededed\" width=\"35\">ID</td>
    <td align=\"center\" bgcolor=\"#ededed\" width=\"65\">FECHA</td>
	<td align=\"center\" bgcolor=\"#ededed\" width=\"80\">PACIENTE</td>
	<td align=\"center\" bgcolor=\"#ededed\" width=\"80\">MEDICO</td>
    <td align=\"center\" bgcolor=\"#ededed\" width=\"80\">OBS</td>
   <td align=\"center\" bgcolor=\"#ededed\" width=\"61\">EVOL. Y TRATAM.</td>
    <td align=\"center\" bgcolor=\"#ededed\" width=\"61\">LABORATORIO</td>
    <td align=\"center\" bgcolor=\"#ededed\" width=\"61\">IMAGENOLOGIA</td>
    <td align=\"center\" bgcolor=\"#ededed\" width=\"61\">DOC. INTERN.</td>
	<td align=\"center\" bgcolor=\"#ededed\" width=\"61\">DOC. EXTERN.</td>
  </tr>";
$id=$_GET["id"];
$pid = $_GET["pid"];
$mid = $_GET["mid"];
if(!empty($_GET["tip"]) and $_GET["tip"]!='undefined'){
	$tip = $_GET["tip"];
} else {
	$tip="";
}
$cei = $_GET["cei"];
$nua = $_GET["nua"];
$apa = $_GET["apa"];
if(!empty($_GET["FEI"])){ 
	$fechaI = $_GET["FEI"];
}
if(!empty($_GET["FEF"])){ 
	$fechaF = $_GET["FEF"];
}

$i=1;
$m = new MongoClient();
$bd = $m->selectDB("test");
$colecciones = $m->selectCollection("test","historial");
$start = $fechaI;
$end = $fechaF; 
if($tip=="" and $cei=="" and $nua=="" and $apa==""){ 
	$col=$colecciones->find(array("creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei=="" and $nua=="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei=="" and $nua!="" and $apa==""){
	$col=$colecciones->find(array("num_asegurado"=>new MongoRegex("/^$nua/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei!="" and $nua=="" and $apa==""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei=="" and $nua=="" and $apa==""){
	$col=$colecciones->find(array("estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei=="" and $nua!="" and $apa!=""){
	$col=$colecciones->find(array("num_asegurado"=>new MongoRegex("/^$nua/"),"apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei!="" and $nua=="" and $apa!=""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei=="" and $nua=="" and $apa!=""){
	$col=$colecciones->find(array("estado"=>$tip,"apellido"=>new MongoRegex("/^$apa/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip=="" and $cei!="" and $nua!="" and $apa==""){
	$col=$colecciones->find(array("ci_paciente"=>new MongoRegex("/^$cei/"),"num_asegurado"=>new MongoRegex("/^$nua/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));	
} else if($tip!="" and $cei=="" and $nua!="" and $apa==""){
	$col=$colecciones->find(array("estado"=>$tip,"num_asegurado"=>new MongoRegex("/^$nua/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));	
} else if($tip!="" and $cei!="" and $nua=="" and $apa==""){
	$col=$colecciones->find(array("estado"=>$tip,"ci_paciente"=>new MongoRegex("/^$cei/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));	
} else if($tip=="" and $cei!="" and $nua!="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"num_asegurado"=>new MongoRegex("/^$nua/"),"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei!="" and $nua=="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei!="" and $nua!="" and $apa==""){
	$col=$colecciones->find(array("num_asegurado"=>new MongoRegex("/^$nua/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei=="" and $nua!="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"num_asegurado"=>new MongoRegex("/^$nua/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
} else if($tip!="" and $cei!="" and $nua!="" and $apa!=""){
	$col=$colecciones->find(array("apellido"=>new MongoRegex("/^$apa/"),"num_asegurado"=>new MongoRegex("/^$nua/"),"ci_paciente"=>new MongoRegex("/^$cei/"),"estado"=>$tip,"creacion_exp" => array('$gte' => $start, '$lte' => $end)));
}
//$db->users->find(array("name" => new MongoRegex("/^Joe/")));
$col->sort(array("creacion_exp"=>-1));
$i=1; $tt1=0;$tt2=0;$tt3=0;$tt4=0;$tt5=0;
foreach($col as $cols){
$id_ = $cols["_id"];
	$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->findOne(array("hid" => $id_));
	$coleccionesp = $m->selectCollection("test","pacientes");
	$colp=$coleccionesp->findOne(array("ci" => $cols["ci_paciente"]));
	$coleccionesm = $m->selectCollection("test","usuarios");
	$colm=$coleccionesm->findOne(array("ci" => $cols["ci"]));
	
$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => new MongoId($id_),"area" => "1"));
	$n1=0;
	foreach($colh as $colsh){
		$n1=$n1+1;
	}
	$tt1=$tt1+$n1;
$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => $id_,"area" => "2"));
	$n2=0;
	foreach($colh as $colsh){
		$n2=$n2+1;
	}
	$tt2=$tt2+$n2;
$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => $id_,"area" => "3"));
	$n3=0;
	foreach($colh as $colsh){
		$n3=$n3+1;
	}
	$tt3=$tt3+$n3;
$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => $id_,"area" => "4"));
	$n4=0;
	foreach($colh as $colsh){
		$n4=$n4+1;
	}
	$tt4=$tt4+$n4;
$coleccionesh = $m->selectCollection("test","archivos");
	$colh=$coleccionesh->find(array("hid" => $id_,"area" => "5"));
	$n5=0;
	foreach($colh as $colsh){
		$n5=$n5+1;
	}
	$tt5=$tt5+$n5;
$cont2.="<tr>
    <td align=\"center\"  width=\"35\">".$i."</td>
	<td align=\"center\"  width=\"65\">".$cols["creacion_exp"] . " " . $cols["creacion_exph"]."</td>
    <td align=\"center\"  width=\"80\">".utf8_encode($colp["nombre"]." ".$colp["apellido"])."</td>
    <td align=\"center\"  width=\"80\">".utf8_encode($colm["nombre"])."</td>
	<td align=\"center\"  width=\"80\">".utf8_encode($cols["observaciones"])."</td>
    <td align=\"center\"  width=\"61\">".$n1."</td>
	<td align=\"center\"  width=\"61\">".$n2."</td>
    <td align=\"center\"  width=\"61\">".$n3."</td>
    <td align=\"center\"  width=\"61\">".$n4."</td>
	<td align=\"center\"  width=\"61\">".$n5."</td>
  </tr>";
$i++;}
$cont3="<tr>
    <td align=\"right\"  width=\"352\" colspan=\"5\">TOTAL : </td>
    <td align=\"center\"  width=\"61\">".$tt1."</td>
	<td align=\"center\"  width=\"61\">".$tt2."</td>
	<td align=\"center\"  width=\"61\">".$tt3."</td>
	<td align=\"center\"  width=\"61\">".$tt4."</td>
    <td align=\"center\"  width=\"61\">".$tt5."</td>
  </tr>";
$cont4="</table>";

$cont = $cont1.$cont2.$cont3.$cont4;
$pdf->writeHTML($cont, true, 0, true, 0);

$pdf->Output("compras.pdf", "I", "I");

?>
