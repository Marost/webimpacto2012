<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/verificar_sesion.php");

$user=$_SESSION["user-dr16"];
//PRIVILEGIOS USUARIO
$rst_prv_user=mysql_query("SELECT * FROM ".$tabla_suf."_usuario_privilegios WHERE usuario='$user';", $conexion);
$fila_prv_user=mysql_fetch_array($rst_prv_user);

//EMPRESA
$rst_empresa=mysql_query("SELECT * FROM ".$tabla_suf."_empresa WHERE id=1", $conexion);
$fila_empresa=mysql_fetch_array($rst_empresa);



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>

<link rel="stylesheet" type="text/css" href="../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css" />

<link rel="stylesheet" type="text/css" href="../../css/plupload.queue.css"/>

<link type="text/css" href="../../../js/themes/base/jquery.ui.all.css" rel="stylesheet" />

<script type="text/javascript" src="../../../js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.datepicker.js"></script>

<script type="text/javascript">
var j = jQuery.noConflict();
j(function() {
	j("#fecha").datepicker({
		showOn: 'button',
		buttonImage: '../../images/calendar.gif',
		buttonImageOnly: true
	});
});
</script>

<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.3");
</script>
<script type="text/javascript" src="../../js/gears_init.js"></script>
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
<script type="text/javascript" src="../../js/plupload.full.min.js"></script>
<script type="text/javascript" src="../../js/jquery.plupload.queue.min.js"></script>
<script>
var jq = jQuery.noConflict();
jq(function() {
	// Setup flash version
	jq("#flash_uploader").pluploadQueue({
		// General settings
		runtimes : 'flash',
		url : 'upload.php',
		max_file_size : '10mb',
		chunk_size : '1mb',
		unique_names : true,
		filters : [
			{title : "Image files", extensions : "jpg,gif,png"}
		],
		// Resize images on clientside if we can
		resize : {width : 500, height : 600, quality : 100},
		// Flash settings
		flash_swf_url : '../../js/plupload.flash.swf'
	});
});
</script>

</head>

<body>
<div id="contenedor" class="limpiar">
	<?php include("../../cabecera.php") ?>
    <div id="cuerpo" class="limpiar">
    	<div class="interior">
        	<div id="panel-izq">
				<?php include("../../menu-izq.php"); ?>
            </div><!--FIN PANEL IZQ-->
            <div id="panel-der">
            	<h2>Agregar - Portada</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="17%" height="30" align="right" class="texto_izq"><p><strong>Fecha:</strong></p></td>
            	      <td width="83%" height="30" align="left" class="texto_der"><input name="fecha" type="text" id="fecha" size="30" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right"><p><strong>PDF:</strong></p></td>
            	      <td height="30" align="left"><input type="file" name="pdf" id="pdf" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" colspan="2">
                      <p align="left"><strong>Imagenes de pagina del </strong></p>
                        <div>
                        <div id="flash_uploader" style="width: 450px; height: 330px;">You browser doesn't have Flash installed.</div>
                        </div>
                      </td>
           	        </tr>
                <tr>
                  <td colspan="2" align="center">
                  <input type="submit" name="guardar" id="guardar" value="Guardar" />
                  <label>&nbsp;&nbsp;&nbsp;
                    <input type="reset" name="button2" id="button2" value="Limpiar Datos" />
                    </label></td>
                </tr>
              </table>
                </form>
              </td>
            </tr>
        </table>
    </div><!-- FIN CONTENIDO TOTAL -->
          </div><!--FIN PANEL DER-->
        </div><!--FIN INTERIOR-->
    </div><!--FIN CUERPO-->
</div>
</body>
</html>