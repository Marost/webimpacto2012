<?php
session_start();
include("conexion/conexion.php");
include("conexion/verificar_sesion.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | Diario16</title>
<link rel="stylesheet" type="text/css" href="css/estilo-panel.css"/>
</head>

<body>
<div id="contenedor" class="limpiar">
	<?php include("cabecera.php") ?>
    <div id="cuerpo" class="limpiar">
    	<div class="interior">
        	<div id="panel-izq">
				<?php include("menu-izq.php"); ?>
            </div><!--FIN PANEL IZQ-->
            <div id="panel-der">
           	  
          </div><!--FIN PANEL DER-->
        </div><!--FIN INTERIOR-->
    </div><!--FIN CUERPO-->
</div>
</body>
</html>