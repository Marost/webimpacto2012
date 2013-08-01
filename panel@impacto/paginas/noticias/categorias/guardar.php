<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$categoria=$_POST["categoria"];
$url=getUrlAmigable(eliminarTextoURL($categoria));

mysql_query("INSERT INTO ".$tabla_suf."_noticia_categoria (categoria, url) VALUES('$categoria', '$url');",$conexion);

if (mysql_errno()!=0){
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>