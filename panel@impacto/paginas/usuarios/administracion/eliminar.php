<?php
include ("../../../conexion/conexion.php");

$usuario=$_REQUEST["usuario"];

mysql_query("DELETE FROM ".$tabla_suf."_usuario WHERE usuario='$usuario';",$conexion);
mysql_query("DELETE FROM ".$tabla_suf."_usuario_privilegios WHERE usuario='$usuario';",$conexion);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>