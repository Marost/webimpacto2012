<?php
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$url=getUrlAmigable(eliminarTextoURL($titulo));
$contenido=$_POST["contenido"];
$fecha=$_POST["fecha"];
$idcolumnista=$_REQUEST["columnista"];

mysql_query("INSERT INTO ".$tabla_suf."_columnista_columna (url, titulo, contenido, fecha, columnista) VALUES('$url', '".addslashes($titulo)."', '$contenido', '$fecha', $idcolumnista);",$conexion);

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1&columnista=$idcolumnista");
}

?>