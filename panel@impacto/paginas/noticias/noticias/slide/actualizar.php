<?php
include("../../../../conexion/conexion.php");
include("../../../../conexion/funciones.php");
require_once('../../../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$idnoticia=$_REQUEST["noticia"];
$fecha=fechaPost();
$hora=date("H:i");

if($_POST['flash_uploader_0_tmpname']==""){
	$imagen=$_POST["imagen_actual"];
	$carpeta=$_POST["carpeta"];
}else{
	$carpeta=fechaCarpeta()."/";
	$imagen=$_POST['flash_uploader_0_tmpname'];
	$thumb{$cont}=PhpThumbFactory::create("../../../../../imagenes/upload/".$carpeta."".$imagen."");
	$thumb{$cont}->adaptiveResize(670,400);
	$thumb{$cont}->save("../../../../../imagenes/upload/".$carpeta."thumb/".$imagen."", "jpg");	
}

mysql_query("UPDATE ".$tabla_suf."_noticia_slide SET titulo='$titulo', fecha='$fecha', hora='$hora', usuario='$usuario_user', imagen='$imagen', carpeta='$carpeta' WHERE id=". $_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2&noticia=$idnoticia");
}

?>