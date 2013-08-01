<?php
include ("../../conexion/conexion.php");

mysql_query("DELETE FROM ".$tabla_suf."_encuesta_preguntas WHERE id=".$_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>