<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
require_once('../../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$url=getUrlAmigable(eliminarTextoURL($titulo));
$contenido=$_POST["contenido"];
$categoria=$_POST["categoria"];
$fecha=fechaLarga();
$hora=date("H:i");
$tipo_video=$_POST["video"];
$noticia=1;
$comentarios=1;
$tags=$_POST["tags"]; //ARRAY DE TAGS
if($tags==""){ $union_tags=0;}
elseif($tags<>""){ $union_tags=implode(",", $tags); } //JUNTAR ARRAY DE TAGS

//FECHA PUBLICACION
$fecha_publicacion=$_POST["fecha"];
$hora_publicacion=$_POST["hora"];
$fecha_pub=$fecha_publicacion." ".$hora_publicacion.":00";

//VARIABLES PARA CONTADOR
$identificador=codigoAleatorio(30,true,true,false);
$fecha_contador=date("Y-m-d");
$ipnoticia="0.0.0.0";
$horau=date("H");
$diau=date("z");

//IMAGEN O VIDEO
if($_POST['flash_uploader_0_tmpname']<>""){
	$mostrar_imagen=1;
	$imagen=$_POST['flash_uploader_0_tmpname'];
	$carpeta_imagen=fechaCarpeta()."/";	
	$thumb=PhpThumbFactory::create("../../../../imagenes/upload/".$carpeta_imagen."".$imagen."");
	$thumb->adaptiveResize(620,380);
	$thumb->save("../../../../imagenes/upload/".$carpeta_imagen."thumb/".$imagen."", "jpg");
	if($tipo_video=="youtube"){
		$mostrar_video=1;
		$video=$_POST["video-youtube"];
	}elseif($tipo_video=="vimeo"){
		$mostrar_video=1;
		$video=$_POST["video-vimeo"];
	}elseif($tipo_video=="dailymotion"){
		$mostrar_video=1;
		$video=$_POST["video-dailymotion"];
	}elseif($tipo_video=="flv"){
		$mostrar_video=1;
		$carpeta_video=fechaCarpeta()."/";
		$video=$_POST['video_uploader_0_tmpname'];
	}else{
		$mostrar_video=0;
	}
}else{
	$imagen=="";
	$video="";
	$carpeta_imagen="";
	$carpeta_video="";
	$mostrar_imagen=0;
	$mostrar_video=0;
}

//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_noticia (url,
titulo, 
contenido, 
imagen, 
mostrar_imagen, 
tipo_video, 
video, 
mostrar_video, 
dato_fecha, 
dato_hora, 
dato_usuario, 
categoria, 
carpeta_imagen,
carpeta_video,
identificador, 
tags, 
comentarios,
noticia,
fecha_publicacion) VALUES('$url',
'".addslashes($titulo)."',
'$contenido',
'$imagen', 
$mostrar_imagen, 
'$tipo_video', 
'$video', 
$mostrar_video, 
'$fecha', 
'$hora',
'$usuario_user', 
$categoria, 
'$carpeta_imagen',
'$carpeta_video',
'$identificador', 
'0,$union_tags,0', 
$comentarios,
$noticia,
'$fecha_pub');",$conexion);

if (mysql_errno()!=0){
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_query("INSERT INTO ".$tabla_suf."_noticia_contador (noticia, ip, fecha, hora, horau, diau) VALUES ('$identificador', '$ipnoticia', '$fecha_contador', '$hora', '$horau', '$diau')", $conexion);
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>