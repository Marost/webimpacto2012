<?php
include ("../../../conexion/conexion.php");

$idcolumnista=$_REQUEST["columnista"];

mysql_query("DELETE FROM ".$tabla_suf."_columnista_columna WHERE id=".$_REQUEST["id"].";",$conexion);

if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:listar.php?mensaje=6&columnista=$idcolumnista");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=3&columnista=$idcolumnista");
}

?>