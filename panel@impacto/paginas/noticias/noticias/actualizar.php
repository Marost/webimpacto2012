<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
require_once('../../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$idnoticia=$_REQUEST["id"];
$titulo=$_POST["titulo"];
$contenido=$_POST["contenido"];
$categoria=$_POST["categoria"];
$comentarios=$_POST["comentarios"];;
$fecha=fechaLarga();
$hora=date("H:i");
$multimedia=2;
$tipo_multimedia=$_POST["tipo_multimedia"];
$tags=$_POST["tags"];
if($tags==""){ $union_tags=0; }
elseif($tags<>""){ $union_tags=implode(",", $tags);}

//MOVER NOTICIA
$mover_noticia=$_POST["mover_noticia"];
if($mover_noticia=="ninguno"){
	$noticia=1;
	$noticia_superior=2;
}elseif($mover_noticia=="not_mes"){
	$noticia=2;
	$noticia_superior=1;
}

//FECHA PUBLICACION
$fecha_publicacion=$_POST["fecha"];
$hora_publicacion=$_POST["hora"];
$fecha_pub=$fecha_publicacion." ".$hora_publicacion.":00";

//SELECCIONAR REGISTRO PARA VERIFICAR IMAGEN
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_noticia WHERE id=$idnoticia LIMIT 1;", $conexion);
$fila_query=mysql_fetch_array($rst_query);

if($tipo_multimedia==""){
	$imagen="";
	$carpeta_imagen="";
	$video="";
	$carpeta_video="";
	$tipo_video="";
	$mostrar_imagen=2; $mostrar_video=2;
}else{
	//IMAGEN Y VIDEO
	if($tipo_multimedia=="imagen"){
		if($_POST['flash_uploader_0_tmpname']==""){
			$imagen=$_POST["imagen_actual"];
			$carpeta_imagen=$_POST["carpeta_imagen"];
			$video=$fila_query["video"];
			$carpeta_video=$fila_query["carpeta_video"];
			$tipo_video=$fila_query["tipo_video"];
		}elseif($_POST['flash_uploader_0_tmpname']<>""){
			$imagen=$_POST['flash_uploader_0_tmpname'];
			$carpeta_imagen=fechaCarpeta()."/";
			$thumb=PhpThumbFactory::create("../../../../imagenes/upload/".$carpeta_imagen."".$imagen."");
			$thumb->adaptiveResize(620,380);
			$thumb->save("../../../../imagenes/upload/".$carpeta_imagen."thumb/".$imagen."", "jpg");
			$video=$fila_query["video"];
			$carpeta_video=$fila_query["carpeta_video"];
			$tipo_video=$fila_query["tipo_video"];
		}
		$mostrar_imagen=1; $mostrar_video=2;
	}elseif($tipo_multimedia=="video"){
		if($_POST["video"]=="youtube"){
			$video=$_POST["video-youtube"];
			$tipo_video=$_POST["video"];
		}elseif($_POST["video"]=="vimeo"){
			$video=$_POST["video-vimeo"];
			$tipo_video=$_POST["video"];
		}elseif($_POST["video"]=="dailymotion"){
			$video=$_POST["video-dailymotion"];
			$tipo_video=$_POST["video"];
		}if($_POST["video"]=="flv"){
			$carpeta_video=fechaCarpeta()."/";
			if($_POST['video_uploader_0_tmpname']<>""){
				$video=$_POST['video_uploader_0_tmpname'];
			}
			$tipo_video=$_POST["video"];
		}
		$carpeta_imagen=$_POST["carpeta_imagen"]; 
		$imagen=$_POST["imagen_actual"]; $mostrar_imagen=2; $mostrar_video=1;
	}

}

//GUARDAR DATOS
mysql_query("UPDATE ".$tabla_suf."_noticia SET titulo='".addslashes($titulo)."', 
contenido='$contenido', 
imagen='$imagen', 
mostrar_imagen=$mostrar_imagen, 
tipo_video='$tipo_video',
video='$video',
mostrar_video=$mostrar_video, 
multimedia=$multimedia, 
dato_fecha='$fecha', 
dato_hora='$hora', 
dato_usuario='$usuario_user', 
categoria=$categoria,
carpeta_imagen='$carpeta_imagen',
carpeta_video='$carpeta_video',
tags='0,$union_tags,0',
comentarios=$comentarios,
fecha_publicacion='$fecha_pub',
noticia=$noticia,
noticia_superior=$noticia_superior WHERE id=$idnoticia;", $conexion);
	
if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	//echo "si subio";
	//echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>