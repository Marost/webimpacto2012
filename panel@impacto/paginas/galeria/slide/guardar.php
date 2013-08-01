<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
require_once('../../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$idnoticia=$_REQUEST["noticia"];
$fecha=fechaPost();
$hora=date("H:i");
$usuario=$usuario_user;
$carpeta=fechaCarpeta()."/";

//CONSULTA PARA SABER SI EXISTEN IMAGENES DE LA NOTICIA
$rst_notgaleria=mysql_query("SELECT * FROM ".$tabla_suf."_galeria_slide WHERE noticia=$idnoticia", $conexion);
$num_notgaleria=mysql_num_rows($rst_notgaleria);
$fila_notgaleria=mysql_fetch_array($rst_notgaleria);

if($num_notgaleria>0){
	$cont=0; $cont_img=$num_notgaleria;
	while($_POST['flash_uploader_'.$cont.'_tmpname']<>""){
		$imagen=$_POST['flash_uploader_'.$cont.'_tmpname'];
		//THUMB
		$thumb{$cont}=PhpThumbFactory::create("../../../../imagenes/galeria/".$carpeta."".$imagen."");
		$thumb{$cont}->adaptiveResize(290,210);
		$thumb{$cont}->save("../../../../imagenes/galeria/".$carpeta."thumb/".$imagen."", "jpg");
		//THUMB 75x75
		$thumbm{$cont}=PhpThumbFactory::create("../../../../imagenes/galeria/".$carpeta."".$imagen."");
		$thumbm{$cont}->adaptiveResize(75,75);
		$thumbm{$cont}->save("../../../../imagenes/galeria/".$carpeta."thumb75/".$imagen."", "jpg");
		mysql_query("INSERT INTO ".$tabla_suf."_galeria_slide(fecha, hora, usuario, imagen, noticia, carpeta, orden) 
		VALUES ('$fecha', '$hora', '$usuario','$imagen', $idnoticia, '$carpeta', $cont_img)",$conexion);
		$cont++; $cont_img++;
	}
}elseif($num_notgaleria==0){
	$cont=0;
	while($_POST['flash_uploader_'.$cont.'_tmpname']<>""){
		$imagen=$_POST['flash_uploader_'.$cont.'_tmpname'];
		//THUMB
		$thumb{$cont}=PhpThumbFactory::create("../../../../imagenes/galeria/".$carpeta."".$imagen."");
		$thumb{$cont}->adaptiveResize(290,210);
		$thumb{$cont}->save("../../../../imagenes/galeria/".$carpeta."thumb/".$imagen."", "jpg");
		//THUMB 75x75
		$thumbm{$cont}=PhpThumbFactory::create("../../../../imagenes/galeria/".$carpeta."".$imagen."");
		$thumbm{$cont}->adaptiveResize(75,75);
		$thumbm{$cont}->save("../../../../imagenes/galeria/".$carpeta."thumb75/".$imagen."", "jpg");
		mysql_query("INSERT INTO ".$tabla_suf."_galeria_slide(fecha, hora, usuario, imagen, noticia, carpeta, orden)
		VALUES ('$fecha', '$hora', '$usuario','$imagen', $idnoticia, '$carpeta', $cont)",$conexion);
		$cont++;
	}
}

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1&noticia=$idnoticia");
}

?>