<?php
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$id=$_REQUEST["id"];
$titulo=$_POST["titulo"];
$fecha = date("Y-m-d H:i:s");
$cant_opciones=$_POST["cant_opciones"];

//ACTUALIZAMOS LA ENCUESTA
mysql_query("UPDATE ".$tabla_suf."_encuesta_preguntas SET (ques='".addslashes($titulo)."', created_on='$fecha' WHERE id=$id", $conexion); 

foreach ($_POST["id_opcion"] as $clave=>$valor){
	//Obtenemos el texto de la pregunta
	$preg = $_POST["resp$clave"];
	$texto = $preg;
	//Y lo insertamos
	mysql_query("UPDATE ".$tabla_suf."_encuesta_opciones SET value='$texto' WHERE id=$valor;",$conexion);
}

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>