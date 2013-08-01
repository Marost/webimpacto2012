<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../../libs/thumbs/ThumbLib.inc.php');

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
	$thumb{$cont}=PhpThumbFactory::create("../../../imagenes/upload/".$carpeta."".$imagen."");
	$thumb{$cont}->adaptiveResize(150,35);
	$thumb{$cont}->save("../../../imagenes/upload/".$carpeta."thumb/".$imagen."", "jpg");	
}

mysql_query("UPDATE ".$tabla_suf."_slide_superior SET titulo='$titulo', dato_fecha='$fecha', dato_hora='$hora', dato_usuario='$usuario_user', imagen='$imagen', carpeta_imagen='$carpeta' WHERE id=". $_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>