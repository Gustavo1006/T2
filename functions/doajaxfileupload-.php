<?php
//require("../config/config.php");
$id = $_GET[ID];
$op = $_GET[OP];
//$cnom = cnom($op);
$cid = 'ARC_ID';
$cimg = 'ARC_ARCHIVO';
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
			$ext = explode(".",$_FILES['fileToUpload']['name']);
			$cod = substr($cid,0,3);
			$img = "arc.".$ext[1];
			$rnd = rand(1000,9999);
			//$img = str_replace(".","_".$id."_". $rnd .".",$_FILES['fileToUpload']['name']);
			$img = str_replace(" ","_",$_FILES['fileToUpload']['name']);
			//Eliminar Archivo Existente
			/*$s = "select * from $ctab where $cid=$id";
			$res = mysql_query($s,$link);
			$reg = @mysql_fetch_array($res);
			@unlink("../../".$ccarp.$reg[$cimg]);*/
			//Copia de archivo
			@copy($_FILES['fileToUpload']['tmp_name'],$_FILES['fileToUpload']['name']);	
			rename($_FILES['fileToUpload']['name'],'../../'.$ccarp.$img);
			//Copia de datos en BD
			/*$sql = "update `$ctab` set $cimg='$img' where $cid = '$id'";
			$result=mysql_query($sql,$link);*/
			
	}		
	echo "{";
	echo				"error: '" . $error . "',\n";
	echo "msg: ' Archivo Adjuntado exitosamente!... '\n";
	//echo				"msg: '" . $msg . "'\n";
	echo "}";
?>