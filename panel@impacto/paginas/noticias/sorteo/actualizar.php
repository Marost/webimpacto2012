<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$idnoticia=$_REQUEST["id"];
$titulo=$_POST["titulo"];
$contenido=$_POST["contenido"];
$fecha_inicio=$_POST["fecha_inicio"];
$fecha_fin=$_POST["fecha_fin"];

//GUARDAR DATOS
mysql_query("UPDATE ".$tabla_suf."_sorteo SET titulo='".addslashes($titulo)."', 
contenido='$contenido', 
fecha_inicio='$fecha_inicio',
fecha_fin='$fecha_fin' WHERE id=$idnoticia;", $conexion);
	
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