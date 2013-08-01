<?php
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");

//IMAGEN
$imagen=guardarArchivo("../../../imagenes/columnistas/", $_FILES["foto"]);

//DECLARACION DE VARIABLES
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$nombre_completo=$nombre." ".$apellidos;
$url=getUrlAmigable($nombre_completo);
$descripcion=$_POST["descripcion"];
$publicar=1;

//CASILLAS DE VERIFICACION
//$lunes=descativadoCasilla($_POST["dia_lunes"]);
//$martes=descativadoCasilla($_POST["dia_martes"]);
//$miercoles=descativadoCasilla($_POST["dia_miercoles"]);
//$jueves=descativadoCasilla($_POST["dia_jueves"]);
//$viernes=descativadoCasilla($_POST["dia_viernes"]);
//$sabado=descativadoCasilla($_POST["dia_sabado"]);
//$domingo=descativadoCasilla($_POST["dia_domingo"]);

mysql_query("INSERT INTO ".$tabla_suf."_columnista (url, nombre, apellidos, nombre_completo, foto, descripcion, publicar) 
VALUES('$url', '$nombre', '$apellidos', '$nombre_completo', '$imagen', '$descripcion', $publicar);",$conexion);

if (mysql_errno()!=0){
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}
?>