<?php
include ("../../../conexion/conexion.php");

//VARIABLES
$sorteo_id=$_REQUEST["sorteo"];
$sorteo_registro=$_REQUEST["registro"];

mysql_query("DELETE FROM ".$tabla_suf."_sorteo_registro WHERE id=".$sorteo_registro.";",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:lista-registro.php?mensaje=6&id=".$sorteo_id);
} else {
	mysql_close($conexion);
	header("Location:lista-registro.php?mensaje=3&id=".$sorteo_id);
}

?>