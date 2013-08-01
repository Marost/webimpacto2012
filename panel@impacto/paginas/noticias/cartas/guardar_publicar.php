<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$id=$_REQUEST["id"];
$estado="A";

//MODIFICANDO ESTADO DE CARTA=A
mysql_query("UPDATE ".$tabla_suf."_cartas SET estado='$estado' WHERE id=$id", $conexion);

if (mysql_errno()!=0){
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar_sr.php?mensaje=7");
}

?>