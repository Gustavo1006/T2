<?php
//require("../config/config.php");
require("../config/functions.php");
$id = $_GET[ID];
$sid = $_GET[CID];
$op = $_GET[OP];
$nua = $_GET[N];
$na = $_GET[NA];
$prod = $_GET[prod];
$cid = 'id';
$cimg = 'archivo';
$cnom = 'desc';
$ctab = 'archivos';
$ccarp = 'docs/';
	$error = "";
	$msg = "";
	$fileElementName = 'fileToUpload';
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{

			case '1':
				$error = 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
				break;
			case '2':
				$error = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
				break;
			case '3':
				$error = 'The uploaded file was only partially uploaded';
				break;
			case '4':
				$error = 'Seleccione el Archivo que desea Adjuntar...';
				break;

			case '6':
				$error = 'Missing a temporary folder';
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = 'File upload stopped by extension';
				break;
			case '999':
			default:
				$error = 'No error code avaiable';
		}
	}elseif(empty($_FILES['fileToUpload']['tmp_name']) || $_FILES['fileToUpload']['tmp_name'] == 'none')
	{
		$error = 'No file was uploaded..';
	}else 
	{
			$msg .= " Archivo: " . $_FILES['fileToUpload']['name'] . ", ";
			$msg .= " Tamaño: " . @filesize($_FILES['fileToUpload']['tmp_name']);
			//for security reason, we force to remove all uploaded file
			@unlink($_FILES['fileToUpload']);	
			/*$s = "select * from $op where $cid=$id";
			$res = mysql_query($s,$link);
			$reg = @mysql_fetch_array($res);*/
			/*$ext = explode(".",$_FILES['fileToUpload']['name']);
			$cod = substr($cid,0,3);
			$img = $reg[$cnom]."_".$cod."_".$id.".".$ext[1];
			$rnd = rand(1000,9999);*/
			$img = str_replace(".",parea($id)."-".date("dmY").".",$_FILES['fileToUpload']['name']);
			$nomi = parea($id)."-".date("dmY")."_".$nua.".pdf";
			//$img = $_FILES['fileToUpload']['name'];
			//Eliminar Archivo Existente
			/*$s = "select * from $ctab where $cid=$id";
			$res = mysql_query($s,$link);
			$reg = @mysql_fetch_array($res);
			@unlink("../../".$ccarp.$reg[$cimg]);*/
			//Copia de archivo
			/*$ncarp = "../../".$ccarp;
			mkdir($ncarp);*/
			@copy($_FILES['fileToUpload']['tmp_name'],$_FILES['fileToUpload']['name']);	
			rename($_FILES['fileToUpload']['name'],'../'.$ccarp.$nomi);
			//$_FILES['fileToUpload']['tmp_name'];
			/*if($op=='banners'){
				if(img_dimX($_FILES['fileToUpload']['tmp_name'])>str_replace("px","",'185px')) {
				   resizeImg($_FILES['fileToUpload']['tmp_name'], '../../'.$ccarp.$img_thumb,'185px','72px');
				}
				if(img_dimX($_FILES['fileToUpload']['tmp_name'])>str_replace("px","",'780px')) {
				   resizeImg($_FILES['fileToUpload']['tmp_name'], '../../'.$ccarp.$img,'780px','331px');
				}
			} else if($op=='productos_imgs'){
				resizeImg($_FILES['fileToUpload']['tmp_name'], '../../'.$ccarp.$img_thumb,'150px','120px');
				resizeImg($_FILES['fileToUpload']['tmp_name'], '../../'.$ccarp.$img_slide,'250px','200px');
				if(img_dimX($_FILES['fileToUpload']['tmp_name'])>str_replace("px","",'800px')) {
				   resizeImg($_FILES['fileToUpload']['tmp_name'], '../../'.$ccarp.$img,'800px','600px');
				}
			} else {
				if(img_dimX($_FILES['fileToUpload']['tmp_name'])>str_replace("px","",'180px')) {
				   resizeImg($_FILES['fileToUpload']['tmp_name'], '../../'.$ccarp.$img,'180px','140px');
				}
			}*/
			//Copia de datos en BD
			/*$sql = "update `$ctab` set $cimg=\"$img\" where $cid = '$id'";
			$result=mysql_query($sql,$link);*/
			
			$con = new Mongo();
			$db = $con->test;
			$people = $db->archivos;
			$post = array(
				'area' => $id,
				'subarea' => $sid,
				'hid' => "0",
				'archivo' => $nomi
			);
			$people->insert($post);
			
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo "msg: ' Archivo Adjuntado exitosamente!... '\n";
	//echo				"msg: '" . $msg . "'\n";
	echo "}";
?>