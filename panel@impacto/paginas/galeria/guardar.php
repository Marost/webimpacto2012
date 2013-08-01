<?php
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$url=getUrlAmigable(eliminarTextoURL($titulo));
$contenido=$_POST["contenido"];
$fecha=fechaPost();
$hora=date("H:i");
$usuario=$usuario_user;
$carpeta=fechaCarpeta()."/";

mysql_query("INSERT INTO ".$tabla_suf."_galeria(url, titulo, contenido, fecha, hora, usuario) VALUES('$url', '$titulo', '$contenido', '$fecha', '$hora', '$usuario');", $conexion);

$rst_chica16=mysql_query("SELECT * FROM ".$tabla_suf."_galeria WHERE id>0 ORDER BY id DESC", $conexion);
$fila_chica16=mysql_fetch_array($rst_chica16);
$idchica16=$fila_chica16["id"];

$cont=0;
while($_POST['flash_uploader_'.$cont.'_tmpname']<>""){
	$imagen=$_POST['flash_uploader_'.$cont.'_tmpname'];
	//THUMB
	$thumb{$cont}=PhpThumbFactory::create("../../../imagenes/galeria/".$carpeta."".$imagen."");
	$thumb{$cont}->adaptiveResize(290,210);
	$thumb{$cont}->save("../../../imagenes/galeria/".$carpeta."thumb/".$imagen."", "jpg");
	//THUMB 75x75
	$thumbm{$cont}=PhpThumbFactory::create("../../../imagenes/galeria/".$carpeta."".$imagen."");
	$thumbm{$cont}->adaptiveResize(75,75);
	$thumbm{$cont}->save("../../../imagenes/galeria/".$carpeta."thumb75/".$imagen."", "jpg");
	mysql_query("INSERT INTO ".$tabla_suf."_galeria_slide(imagen, orden, noticia, carpeta, fecha, hora, usuario) VALUES ('$imagen', $cont, $idchica16, '$carpeta', '$fecha', '$hora', '$usuario')",$conexion);
	$cont++;
}

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>