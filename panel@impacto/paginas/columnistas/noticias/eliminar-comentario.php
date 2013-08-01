<?php
include ("../../../conexion/conexion.php");

$noticia=$_REQUEST["noticia"];
$columnista=$_REQUEST["columnista"];

mysql_query("DELETE FROM ".$tabla_suf."_columnista_columna_comentario WHERE id=".$_REQUEST["id"].";",$conexion);

if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:comentarios.php?mensaje=6&id=$noticia&columnista=$columnista");
} else {
	mysql_close($conexion);
	header("Location:comentarios.php?mensaje=3&id=$noticia&columnista=$columnista");
}

?>