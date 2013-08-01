<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

//SUBIR PORTADA
$name=guardarArchivo("../../../../imagenes/upload/", $_FILES["archivo"]);

//DECLARACION DE VARIABLES
$idfotografo=$_REQUEST["fotografo"];

mysql_query("INSERT INTO ".$tabla_suf."_fotografo_foto (foto, fotografo) VALUES('$name', $idfotografo);",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1&fotografo=$idfotografo");
}

?>