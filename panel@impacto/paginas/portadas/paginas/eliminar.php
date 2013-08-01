<?php
include ("../../../conexion/conexion.php");

$idportada=$_REQUEST["portada"];

mysql_query("DELETE FROM ".$tabla_suf."_portada_paginas WHERE id=".$_REQUEST["id"].";",$conexion);

if (mysql_errno()!=0)
{
	mysql_close($conexion);
	header("Location:listar.php?mensaje=6&portada=$idportada");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=3&portada=$idportada");
}

?>