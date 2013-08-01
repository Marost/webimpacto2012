<?php
include("../../../../conexion/conexion.php");
include("../../../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$url=getUrlAmigable($titulo);
$contenido=$_POST["contenido"];
$fecha=$_POST["fecha"];
$idportada=$_REQUEST["portada"];
$idpagina=$_REQUEST["pagina"];

mysql_query("INSERT INTO ".$tabla_suf."_portada_paginas_noticias (url, titulo, contenido, fecha, pagina, portada) VALUES('$url', '".addslashes($titulo)."', '$contenido', '$fecha', $idpagina, $idportada);", $conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1&portada=$idportada&pagina=$idpagina");
}

?>