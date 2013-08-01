<?php
include ("../../../conexion/conexion.php");

//VARIABLES
$id=$_REQUEST["id"];

mysql_query("UPDATE ".$tabla_suf."_saludos SET estado_saludo='A' WHERE id=$id;",$conexion);
if (mysql_errno()!=0){
	mysql_close($conexion);
	header("Location:listar.php?mensaje=6");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=3");
}
?>