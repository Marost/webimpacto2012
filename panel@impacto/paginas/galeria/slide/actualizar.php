<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
require_once('../../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$idnoticia=$_REQUEST["noticia"];
$titulo=$_POST["titulo"];
$fecha=fechaPost();
$hora=date("H:i");
$usuario=$_SESSION["user-dr16"];

if($_POST['flash_uploader_0_tmpname']==""){
	$imagen=$_POST["imagen_actual"];
	$carpeta=$_POST["carpeta"];
}else{
	$carpeta=fechaCarpeta()."/";
	$imagen=$_POST['flash_uploader_0_tmpname'];
	//THUMB
	$thumb{$cont}=PhpThumbFactory::create("../../../../imagenes/galeria/".$carpeta."".$imagen."");
	$thumb{$cont}->adaptiveResize(290,210);
	$thumb{$cont}->save("../../../../imagenes/galeria/".$carpeta."thumb/".$imagen."", "jpg");
	//THUMB 75x75
	$thumbm{$cont}=PhpThumbFactory::create("../../../../imagenes/galeria/".$carpeta."".$imagen."");
	$thumbm{$cont}->adaptiveResize(75,75);
	$thumbm{$cont}->save("../../../../imagenes/galeria/".$carpeta."thumb75/".$imagen."", "jpg");
}

mysql_query("UPDATE ".$tabla_suf."_galeria_slide SET titulo='$titulo', fecha='$fecha', hora='$hora', usuario='$usuario', imagen='$imagen', carpeta='$carpeta' WHERE id=". $_REQUEST["id"].";", $conexion);
	
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