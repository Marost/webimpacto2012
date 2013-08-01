<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
require_once('../../../../libs/thumbs/ThumbLib.inc.php');

//DECLARACION DE VARIABLES
$sorteo_id=$_REQUEST["id"];

//ELEGIR GANADOR
$rst_ganador=mysql_query("SELECT * FROM ".$tabla_suf."_sorteo_registro WHERE sorteo=$sorteo_id ORDER BY RAND() LIMIT 1;");
$fila_ganador=mysql_fetch_array($rst_ganador);
$sorteo_ganador=$fila_ganador["dni"];

//INSERTANDO DATOS
$rst_guardar=mysql_query("UPDATE ".$tabla_suf."_sorteo SET ganador='$sorteo_ganador' WHERE id=$sorteo_id;",$conexion);

if (mysql_errno()!=0){
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:lista-registro.php?id=".$sorteo_id);
}

?>