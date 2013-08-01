<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/funciones.php");
include("../../../conexion/verificar_sesion.php");

//NOTICIA
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_edicion_fr WHERE id=". $_REQUEST["id"].";", $conexion);
$fila_query=mysql_fetch_array($rst_query);

//VARIABLES PARA LA HORA
$fechaTotal=$fila_query["fecha_publicacion"];
$fecha=explode(" ", $fechaTotal);
$fecha_actual=$fecha[0];
$hora=explode(":", $fecha[1]);
$hora_actual=$hora[0].":".$hora[1];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración</title>
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />

<!-- CKEDITOR -->
<script src="../../../js/ckeditor.js" type="text/javascript"></script>

<!-- VIDEO -->
<script type="text/javascript" src="../../../../js/flowplayer-3.2.6.min.js"></script>

<!-- SPRY -->
<link href="../../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<!-- FECHA -->
<link type="text/css" href="../../../../js/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../../js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../../../../js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../../../js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../../../../js/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
var jfec = jQuery.noConflict();
jfec(function() {
	jfec("#fecha").datepicker({
		showOn: 'button',
		buttonImage: '../../../images/calendar.gif',
		buttonImageOnly: true,
		dateFormat: "yy-mm-dd"
	});
});
</script>

<!-- PLUPLOAD -->
<link rel="stylesheet" type="text/css" href="../../../css/plupload.queue.css"/>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
<script type="text/javascript">
	google.load("jquery", "1.3");
</script>
<script type="text/javascript" src="../../../js/gears_init.js"></script>
<script type="text/javascript" src="http://bp.yahooapis.com/2.4.21/browserplus-min.js"></script>
<script type="text/javascript" src="../../../js/plupload.full.min.js"></script>
<script type="text/javascript" src="../../../js/jquery.plupload.queue.min.js"></script>
<script>
var jq = jQuery.noConflict();
jq(function() {
	jq("#flash_uploader").pluploadQueue({
		runtimes : 'flash', url : 'upload.php', max_file_size : '10mb',
		chunk_size : '1mb', unique_names : true,
		filters : [ {title : "Image files", extensions : "jpg,gif,png"}],
		resize : {width : 520, height : 700, quality : 100},
		flash_swf_url : '../../../js/plupload.flash.swf'
	});	
});
</script>

</head>

<body>
<div id="contenedor" class="limpiar">
	<?php include("../../../cabecera.php") ?>
    <div id="cuerpo" class="limpiar">
    	<div class="interior">
        	<div id="panel-izq">
				<?php include("../../../menu-izq.php"); ?>
            </div><!--FIN PANEL IZQ-->
            <div id="panel-der">
            	<h2>Modificar - Edición</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="actualizar.php?id=<?php echo $_REQUEST["id"]; ?>" method="post" enctype="multipart/form-data" name="form1" id="form1">
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right"><p><strong>Número Eidición:</strong></p></td>
            	      <td width="80%" height="30" align="left"><input name="titulo" type="text" id="titulo" value='<?php echo $fila_query["titulo"] ?>' size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td height="30" align="right"><p><strong>Nombre Eidición:</strong></p></td>
            	      <td height="30" align="left"><input name="nombre_edicion" type="text" id="nombre_edicion" value='<?php echo $fila_query["nombre_edicion"]; ?>' size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td colspan="2"><table width="100%" border="0" cellpadding="5" cellspacing="0">
            	        <tr>
            	          <td width="20%" align="right"><p><strong>Imagen actual:</strong></p></td>
            	          <td width="80%" align="left"><img src="../../../../imagenes/revista/<?php echo $fila_query["imagen"] ?>" alt="" width="150" />
            	            <input name="imagen_actual" type="hidden" id="imagen_actual" value="<?php echo $fila_query["imagen"] ?>" />
          	          </tr>
            	        <tr>
            	          <td colspan="2"><p align="left"><strong>Selecciona una imagen para la noticia:</strong></p>
            	            <div>
            	              <div id="flash_uploader" style="width: 450px; height: 330px;"> You browser doesn't have Flash installed.</div>
          	              </div></td>
          	          </tr>
          	        </table></td>
           	        </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Fecha publicación:</strong></p></td>
            	      <td><input name="fecha" type="text" id="fecha" value="<?php echo $fecha_actual; ?>" size="20" /></td>
          	      </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Hora publicación:</strong></p></td>
            	      <td><span id="sprytextfield1">
            	        <input name="hora" type="text" id="hora" value="<?php echo $hora_actual; ?>" size="20" />
            	        <span class="textfieldRequiredMsg">Ingrese la hora a publicar</span> <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
          	      </tr>
            	    <tr>
            	      <td colspan="2" align="center"><label>
            	        <input type="submit" name="guardar" id="guardar" value="Guardar" />
            	        &nbsp;
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
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "time");
</script>
</body>
</html>