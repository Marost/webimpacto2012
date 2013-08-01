<?php
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");

//DECLARACION DE VARIABLES
$titulo=$_POST["titulo"];
$fecha = date("Y-m-d H:i:s"); 

//Insertamos la nueva encuesta
$sql = "INSERT INTO ".$tabla_suf."_encuesta_preguntas (ques, created_on) VALUES ('".addslashes($titulo)."', '$fecha') "; 
$sql = mysql_query($sql,$conexion); 

//Ahora obtenemos el ID de la encuesta que acabamos de insertar
$sql = "SELECT id FROM ".$tabla_suf."_encuesta_preguntas ORDER BY created_on DESC LIMIT 0,1";
$sql = mysql_query($sql,$conexion);
while($row = mysql_fetch_array($sql)){ $id=$row["id"]; } 

//Recorremos todas las preguntas
for($i=1; $i<=$_POST["respuestas"]; $i++){
	//Obtenemos el texto de la pregunta
	$preg = $_POST["p$i"];
	$texto = $preg;
	//Y lo insertamos
	$sql = "INSERT INTO ".$tabla_suf."_encuesta_opciones (ques_id, value) VALUES($id, '$texto');";
	$sql = mysql_query($sql,$conexion);
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