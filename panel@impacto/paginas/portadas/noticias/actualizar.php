<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$idnoticia=$_REQUEST["id"];
$titulo=$_POST["titulo"];
$nombre=$_POST["nombre_edicion"];

//FECHA PUBLICACION
$fecha_publicacion=$_POST["fecha"];
$hora_publicacion=$_POST["hora"];
$fecha_pub=$fecha_publicacion." ".$hora_publicacion.":00";

//IMAGEN Y VIDEO
if($_POST['flash_uploader_0_tmpname']==""){
	$imagen=$_POST["imagen_actual"];
}elseif($_POST['flash_uploader_0_tmpname']<>""){
	$imagen=$_POST['flash_uploader_0_tmpname'];
}

//GUARDAR DATOS
mysql_query("UPDATE ".$tabla_suf."_edicion SET titulo='".addslashes($titulo)."', 
nombre_edicion='$nombre', imagen='$imagen', 
dato_usuario='$usuario_user', fecha_publicacion='$fecha_pub' WHERE id=$idnoticia;", $conexion);
	
if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>