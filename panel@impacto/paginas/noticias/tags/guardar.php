<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$tag=$_POST["tag"];
$url=getUrlAmigable(eliminarTextoURL($tag));

mysql_query("INSERT INTO ".$tabla_suf."_noticia_tags (url, nombre) VALUES('$url', '$tag');",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>