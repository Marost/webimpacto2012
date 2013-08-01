<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$idnoticia=$_REQUEST["id"];
$titulo=$_POST["titulo"];
$fecha=fechaLarga();
$hora=date("H:i");

//SELECCIONAR REGISTRO PARA VERIFICAR IMAGEN
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_videos WHERE id=$idnoticia LIMIT 1;", $conexion);
$fila_query=mysql_fetch_array($rst_query);

//FECHA PUBLICACION
$fecha_publicacion=$_POST["fecha"];
$hora_publicacion=$_POST["hora"];
$fecha_pub=$fecha_publicacion." ".$hora_publicacion.":00";

//VIDEO E IMAGEN
if($_POST["video"]<>""){
	if($_POST["video"]=="youtube"){
		$video=$_POST["video-youtube"];
		$tipo_video=$_POST["video"];
	}elseif($_POST["video"]=="flv"){
		$carpeta_video=fechaCarpeta()."/";
		if($_POST['video_uploader_0_tmpname']<>""){ $video=$_POST['video_uploader_0_tmpname'];
		}else{ $video=$_POST["video_actual"];}
		$tipo_video=$_POST["video"];
		if($_POST['flash_uploader_0_tmpname']==""){
			$imagen=$_POST["imagen_actual"];
			$carpeta_imagen=$_POST["carpeta_imagen"];
		}elseif($_POST['flash_uploader_0_tmpname']<>""){
			$imagen=$_POST['flash_uploader_0_tmpname'];
			$carpeta_imagen=fechaCarpeta()."/";
			$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$carpeta_imagen."".$imagen."");
			$thumb->adaptiveResize(290,193);
			$thumb->save("../../../imagenes/upload/".$carpeta_imagen."thumb/".$imagen."", "jpg");
		}	
	}
}


//GUARDAR DATOS
mysql_query("UPDATE ".$tabla_suf."_videos SET titulo='".addslashes($titulo)."',
imagen='$imagen', 
tipo_video='$tipo_video',
video='$video',
dato_fecha='$fecha', 
dato_hora='$hora', 
dato_usuario='$usuario_user', 
carpeta_imagen='$carpeta_imagen',
carpeta_video='$carpeta_video', fecha_publicacion='$fecha_pub' WHERE id=$idnoticia;", $conexion);
	
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