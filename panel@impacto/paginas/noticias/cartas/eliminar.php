<?php
include ("../../../conexion/conexion.php");

//TIPO DE ELIMINACION
$tipo=$_REQUEST["tipo"];
$id=$_REQUEST["id"];

if($tipo=="sr"){
	mysql_query("DELETE FROM ".$tabla_suf."_cartas WHERE id=$id;",$conexion);
	if (mysql_errno()!=0){
		mysql_close($conexion);
		header("Location:listar_sr.php?mensaje=6");
	} else {
		mysql_close($conexion);
		header("Location:listar_sr.php?mensaje=3");
	}
}else{
	mysql_query("DELETE FROM ".$tabla_suf."_cartas WHERE id=$id;",$conexion);
	if (mysql_errno()!=0){
		mysql_close($conexion);
		header("Location:listar.php?mensaje=6");
	} else {
		mysql_close($conexion);
		header("Location:listar.php?mensaje=3");
	}
}
?>