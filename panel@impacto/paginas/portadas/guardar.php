<?php
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");

//SUBIR PDF
if(is_uploaded_file($_FILES['pdf']['tmp_name']))
{ 
	$fileName=$_FILES['pdf']['name'];
	$uploadDir="../../../pdf/";
	$uploadFile=$uploadDir.$fileName;
	$num = 0;
	$pdf = $fileName;
	$extension = end(explode('.',$fileName));     
	$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
	while(file_exists($uploadDir.$pdf))
	{
		$num++;         
		$pdf = $onlyName."".$num.".".$extension; 
	}
	$uploadFile = $uploadDir.$pdf; 
	move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadFile);  
	$pdf;
}


//DECLARACION DE VARIABLES
$fecha=$_POST["fecha"];
$anio=substr($fecha,0,4);
$mes=substr($fecha,5,2);

mysql_query("INSERT INTO ".$tabla_suf."_portada (fecha, numero_mes, anio, pdf) VALUES('$fecha', $mes, $anio, '$pdf');", $conexion);

$rst_portada=mysql_query("SELECT * FROM ".$tabla_suf."_portada WHERE id>0 ORDER BY id DESC");
$fila_portada=mysql_fetch_array($rst_portada);
$idportada=$fila_portada["id"];

$cont=0;
$orden=0;
while($_POST['flash_uploader_'.$cont.'_tmpname']<>"")
{
	$imagen=$_POST['flash_uploader_'.$cont.'_tmpname'];
	mysql_query("INSERT INTO ".$tabla_suf."_portada_paginas(imagen, orden, portada) VALUES ('$imagen', $orden, $idportada)",$conexion);
	$cont++;
	$orden++;
}

if (mysql_errno()!=0)
{
	echo "error al insertar los datos ". mysql_errno() . " - ". mysql_error();
	mysql_close($conexion);
	//header("Location:listar.php?mensaje=4");
} else {
	$sql=mysql_query("SELECT * FROM ".$tabla_suf."_portada_mes_anio WHERE numero_mes=$mes AND anio=$anio;", $conexion);
	$fila_sql=mysql_fetch_array($sql);
	if($fila_sql==1){
		mysql_close($conexion);
		header("Location:listar.php?mensaje=1");
	}elseif($fila_sql==0){
		mysql_query("INSERT INTO ".$tabla_suf."_portada_mes_anio (numero_mes, anio) VALUES ($mes, $anio);", $conexion);
		mysql_close($conexion);
		header("Location:listar.php?mensaje=1");
	}
	mysql_close($conexion);
	header("Location:listar.php?mensaje=1");
}

?>