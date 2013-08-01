<?php
include ("../../../conexion/conexion.php");
include ("../../../conexion/funciones.php");

//DATOS USUARIO
$nombre=$_POST["nombre"];
$apellidos=$_POST["apellidos"];
$usuario=$_REQUEST["usuario"];
$email=$_POST["email"];
$clave=$_POST["clave"];

//PRIVILEGIOS USUARIO
//--> NOTICIA
$categoria=descativadoCasilla($_POST["categoria"]);
$noticia=descativadoCasilla($_POST["noticia"]);
$noticia_superior=descativadoCasilla($_POST["noticia_superior"]);
$multimedia=descativadoCasilla($_POST["multimedia"]);
$reportero16=descativadoCasilla($_POST["reportero16"]);
$noticia_comentarios=descativadoCasilla($_POST["noticia_comentarios"]);
$noticia_modificar=descativadoCasilla($_POST["noticia_modificar"]);
$noticia_eliminar=descativadoCasilla($_POST["noticia_eliminar"]);

//--> USUARIO
$usuarios=descativadoCasilla($_POST["usuarios"]);
$usuarios_modificar=descativadoCasilla($_POST["usuarios_modificar"]);
$usuarios_eliminar=descativadoCasilla($_POST["usuarios_eliminar"]);

mysql_query("UPDATE ".$tabla_suf."_usuario SET 
clave='$clave', 
nombre='$nombre', 
apellidos='$apellidos', 
email='$email' WHERE usuario='$usuario';",$conexion);

mysql_query("UPDATE ".$tabla_suf."_usuario_privilegios SET 
noticias_categoria=$categoria, 
noticias=$noticia,
noticias_multimedia=$multimedia, 
noticias_reportero16=$reportero16, 
noticias_not_superior=$noticia_superior, 
noticias_comentarios=$noticia_comentarios, 
noticias_modificar=$noticia_modificar, 
noticias_eliminar=$noticia_eliminar, 
portada=$portada, 
portada_comentarios=$portada_comentarios, 
portada_modificar=$portada_modificar, 
portada_eliminar=$portada_eliminar, 
columnistas=$columnistas, 
columnistas_columna=$columna, 
columnistas_comentarios=$columnistas_comentarios, 
columnistas_modificar=$columnistas_modificar, 
columnistas_eliminar=$columnistas_eliminar, 
usuarios=$usuarios, 
usuarios_modificar=$usuarios_modificar, 
usuarios_eliminar=$usuarios_eliminar,
encuesta=$encuesta, 
encuesta_modificar=$encuesta_modificar, 
encuesta_eliminar=$encuesta_eliminar,
entrevista=$entrevista,
entrevista_comentarios=$entrevista_comentarios,
entrevista_modificar=$entrevista_modificar,
entrevista_eliminar=$entrevista_eliminar,
galeria=$galeria,
galeria_modificar=$galeria_modificar,
galeria_eliminar=$galeria_eliminar WHERE usuario='$usuario';", $conexion);

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