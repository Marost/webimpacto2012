<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
require_once('../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$url=getUrlAmigable(eliminarTextoURL($titulo));
//$contenido=$_POST["contenido"];
$fecha=fechaLarga();
$hora=date("H:i");
$tipo_video=$_POST["video"];

//FECHA PUBLICACION
$fecha_publicacion=$_POST["fecha"];
$hora_publicacion=$_POST["hora"];
$fecha_pub=$fecha_publicacion." ".$hora_publicacion.":00";

//IMAGEN Y VIDEO
if($tipo_video=="youtube"){
	$video=$_POST["video-youtube"];
}elseif($tipo_video=="flv"){
	$carpeta_video=fechaCarpeta()."/";
	if($_POST['video_uploader_0_tmpname']<>""){ $video=$_POST['video_uploader_0_tmpname'];}		
	if($_POST['flash_uploader_0_tmpname']<>""){
		$imagen=$_POST['flash_uploader_0_tmpname'];
		$carpeta_imagen=fechaCarpeta()."/";	
		$thumb=PhpThumbFactory::create("../../../imagenes/upload/".$carpeta_imagen."".$imagen."");
		$thumb->adaptiveResize(290,193);
		$thumb->save("../../../imagenes/upload/".$carpeta_imagen."thumb/".$imagen."", "jpg");	
	}
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_videos (url,
titulo, 
imagen, 
tipo_video, 
video, 
dato_fecha, 
dato_hora, 
dato_usuario,
carpeta_imagen,
carpeta_video,
fecha_publicacion) VALUES('$url',
'".addslashes($titulo)."',
'$imagen', 
'$tipo_video', 
'$video', 
'$fecha', 
'$hora',
'$usuario_user', 
'$carpeta_imagen',
'$carpeta_video',
'$fecha_pub');",$conexion);

if (mysql_errno()!=0){
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_query("INSERT INTO ".$tabla_suf."_videos_contador (noticia, ip, fecha, hora, horau, diau) VALUES ('$identificador', '$ipnoticia', '$fecha_contador', '$hora', '$horau', '$diau')", $conexion);
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>