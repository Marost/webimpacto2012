<?php
include ("../../../conexion/conexion.php");

$noticia=$_REQUEST["noticia"];
mysql_query("UPDATE ".$tabla_suf."_noticia_comentario SET estado_comentario='A' WHERE id=".$_REQUEST["id"].";",$conexion);

if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:comentarios.php?mensaje=6&id=$noticia");
} else {
	mysql_close($conexion);
	header("Location:comentarios.php?mensaje=3&id=$noticia");
}

?>