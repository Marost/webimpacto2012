<?php
include ("../../conexion/conexion.php");

// IMAGEN
$name=actualizarArchivo("../../../imagenes/upload/", $_FILES["archivo"], $_POST["imagen-actual"]);

// PDF
if($_FILES['pdf']['name']!="")
{
	if(is_uploaded_file($_FILES['pdf']['tmp_name']))
	{ 
		$fileName=$_FILES['pdf']['name'];
		$uploadDir="../../../pdf/";
		$uploadFile=$uploadDir.$fileName;
		$num = 0;
		$name_pdf = $fileName;
		$extension = end(explode('.',$fileName));     
		$onlyName = substr($fileName,0,strlen($fileName)-(strlen($extension)+1));
		while(file_exists($uploadDir.$name_pdf))
		{
			$num++;         
			$name_pdf = $onlyName."".$num.".".$extension; 
		}
		$uploadFile = $uploadDir.$name_pdf; 
		move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadFile);  
		$name_pdf;
	}
}
else
{
	$name_pdf=$_POST["pdf-actual"];
	$name_pdf;
}


//DECLARACION DE VARIABLES
$fecha=$_POST["fecha"];
$anio=substr($fecha,0,4);
$mes=substr($fecha,5,2);
$revista=$_POST["revista"];

mysql_query("UPDATE ".$tabla_suf."_portada SET imagen='$name', fecha='$fecha', numero_mes=$mes, anio=$anio, pdf='$name_pdf', revista='$revista' WHERE id=". $_REQUEST["id"].";", $conexion);
	
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