<?php
include("../../panel@impacto/conexion/conexion.php");
include("../../panel@impacto/conexion/funciones.php");

//VARIABLES
$sorteo_id=$_POST["srt_id"];
$sorteo_url=$_POST["srt_url"];
$sorteo_nombre=$_POST["srt_nombre"];
$sorteo_apellidos=$_POST["srt_apellidos"];
$sorteo_email=$_POST["srt_email"];
$sorteo_dni=$_POST["srt_dni"];
$sorteo_fecha_registro=$fechaActual;

//VERIFICAR EMAIL
$rst_ver_email=mysql_query("SELECT * FROM iev_sorteo_registro WHERE sorteo=$sorteo_id AND email='$sorteo_email' LIMIT 1", $conexion);
$num_ver_email=mysql_num_rows($rst_ver_email);
if($num_ver_email==1){ 
	$error=2; /* EMAIL EXISTE */
	header("Location:../?e=".$error);
}

if($num_ver_email==0){
	//GUARDAR DATOS
	$rst_guardar=mysql_query("INSERT INTO iev_sorteo_registro (nombre, apellidos, email, dni, sorteo, fecha_registro)
	VALUES('$sorteo_nombre', '$sorteo_apellidos', '$sorteo_email', '$sorteo_dni', '$sorteo_id', '$sorteo_fecha_registro')", $conexion);
	
	if (mysql_errno()!=0){
		echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
		mysql_close($conexion);
	}else{
		mysql_close($conexion);
		header("Location:../?e=3");
	}
	
}

?>