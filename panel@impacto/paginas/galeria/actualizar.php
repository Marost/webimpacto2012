<?php
session_start();
include ("../../conexion/conexion.php");
include ("../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$contenido=$_POST["contenido"];
$fecha=fechaPost();
$hora=date("H:i");
$usuario=$usuario_user;

mysql_query("UPDATE ".$tabla_suf."_galeria SET titulo='$titulo', contenido='$contenido', fecha='$fecha', hora='$hora', usuario='$usuario' WHERE id=". $_REQUEST["id"].";", $conexion);
	
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