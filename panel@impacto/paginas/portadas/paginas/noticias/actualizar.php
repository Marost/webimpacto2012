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

mysql_query("UPDATE ".$tabla_suf."_portada_paginas_noticias SET url='$url', titulo='".addslashes($titulo)."', contenido='$contenido', fecha='$fecha' WHERE id=". $_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2&pagina=$idpagina&portada=$idportada");
}

?>