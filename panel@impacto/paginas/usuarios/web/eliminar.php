<?php
include ("../../../conexion/conexion.php");

$usuario=$_REQUEST["id"];

mysql_query("DELETE FROM ".$tabla_suf."_usuarios_web WHERE id='$usuario';",$conuserweb);

if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=3");
}

?>