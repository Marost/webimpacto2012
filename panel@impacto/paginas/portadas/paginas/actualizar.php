<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

// IMAGEN
$pagina=actualizarArchivo("../../../../imagenes/upload/", $_FILES["archivo"], $_POST["foto-actual"]);

//DECLARACION DE VARIABLES
$idportada=$_REQUEST["portada"];

mysql_query("UPDATE ".$tabla_suf."_portada_paginas SET imagen='$pagina' WHERE id=". $_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2&portada=$idportada");
}

?>