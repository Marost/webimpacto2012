<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$url=getUrlAmigable(eliminarTextoURL($titulo));
$contenido=$_POST["contenido"];
$fecha_inicio=$_POST["fecha_inicio"].":00";
$fecha_fin=$_POST["fecha_fin"].":00";

//INSERTANDO DATOS
$rst_guardar=mysql_query("INSERT INTO ".$tabla_suf."_sorteo (url,
titulo, 
contenido, 
fecha_inicio,
fecha_fin) VALUES('$url',
'".addslashes($titulo)."',
'$contenido',
'$fecha_inicio',
'$fecha_fin');",$conexion);

if (mysql_errno()!=0){
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>