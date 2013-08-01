<?php
include ("../../conexion/conexion.php");
include ("../../conexion/funciones.php");

//IMAGEN
$name=actualizarArchivo("../../../imagenes/columnistas/", $_FILES["foto"], $_POST["foto-actual"]);

//DECLARACION DE VARIABLES
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$nombre_completo=$nombre." ".$apellidos;
$url=getUrlAmigable($nombre_completo);
$descripcion=$_POST["descripcion"];
$publicar=$_POST["publicar"];

//CASILLAS DE VERIFICACION
//$lunes=descativadoCasilla($_POST["dia_lunes"]);
//$martes=descativadoCasilla($_POST["dia_martes"]);
//$miercoles=descativadoCasilla($_POST["dia_miercoles"]);
//$jueves=descativadoCasilla($_POST["dia_jueves"]);
//$viernes=descativadoCasilla($_POST["dia_viernes"]);
//$sabado=descativadoCasilla($_POST["dia_sabado"]);
//$domingo=descativadoCasilla($_POST["dia_domingo"]);

mysql_query("UPDATE ".$tabla_suf."_columnista SET url='$url', nombre='$nombre', apellidos='$apellidos', nombre_completo='$nombre_completo', foto='$name', descripcion='$descripcion', publicar=$publicar WHERE id=". $_REQUEST["id"].";", $conexion);
	
if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=5");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=2");
}

?>