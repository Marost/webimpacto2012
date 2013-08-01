<?php
session_start();
include("../../conexion/conexion.php");
include("../../conexion/funciones.php");
include("../../conexion/verificar_sesion.php");

//NOTICIA
$rst_query=mysql_query("SELECT * FROM ".$tabla_suf."_videos WHERE id=". $_REQUEST["id"].";", $conexion);
$fila_query=mysql_fetch_array($rst_query);

//CATEGORIA
$rst_categoria=mysql_query("SELECT * FROM ".$tabla_suf."_videos_categoria WHERE id>0 ORDER BY categoria ASC;", $conexion);

//PUBLICAR
$rst_comentarios=mysql_query("SELECT * FROM ".$tabla_suf."_publicar WHERE id>0 ORDER BY id ASC;", $conexion);

//TAGS
$tags=explode(",", $fila_query["tags"]);	//SEPARACION DE ARRAY CON COMAS
$rst_tags=mysql_query("SELECT * FROM ".$tabla_suf."_videos_tags WHERE id>0 ORDER BY nombre ASC;", $conexion);

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
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../css/style-listas.css" />
<script src="../../js/ckeditor.js" type="text/javascript"></script>

<script src="../../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link href="../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<!-- FECHA -->
<link type="text/css" href="../../../js/themes/base/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.core.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.widget.js"></script>
<script type="text/javascript" src="../../../js/ui/jquery.ui.datepicker.js"></script>
<script type="text/javascript">
var jfec = jQuery.noConflict();
jfec(function() {
	jfec("#fecha").datepicker({
		showOn: 'button',
		buttonImage: '../../images/calendar.gif',
		buttonImageOnly: true
	});
});
</script>

<!-- PLUPLOAD -->
<link rel="stylesheet" type="text/css" href="../../css/plupload.queue.css"/>
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
	jq("#flash_uploader").pluploadQueue({
		runtimes : 'flash', url : 'upload.php', max_file_size : '10mb',
		chunk_size : '1mb', unique_names : true,
		filters : [ {title : "Image files", extensions : "jpg,gif,png"}],
		resize : {width : 670, height : 450, quality : 100},
		flash_swf_url : '../../js/plupload.flash.swf'
	});
	
	jq("#video_uploader").pluploadQueue({
		runtimes : 'flash', url : 'upload_video.php', max_file_size : '150mb',
		chunk_size : '1mb', unique_names : true,
		filters : [ {title : "(.flv) | (.mp3) | (.mp4)", extensions : "flv,mp3,mp4"}],
		flash_swf_url : '../../js/plupload.flash.swf'
	});
	
});
</script>

<!-- VIDEO -->
<script type="text/javascript" src="../../../js/flowplayer-3.2.6.min.js"></script>

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
            	<h2>Modificar - Videos</h2>
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
            	      <td width="20%" height="30" align="right"><p><strong>Titulo:</strong></p></td>
            	      <td width="80%" height="30" align="left"><input name="titulo" type="text" id="titulo" value='<?php echo $fila_query["titulo"] ?>' size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td colspan="2"><div id="TabbedPanels1" class="TabbedPanels">
            	        <ul class="TabbedPanelsTabGroup">
                          <li class="TabbedPanelsTab" tabindex="0">Video</li>
                          <li class="TabbedPanelsTab" tabindex="0">Imagen</li>
</ul>
            	        <div class="TabbedPanelsContentGroup">
                          <div class="TabbedPanelsContent">
                            <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0">
                              <tr>
                                <td width="23%"><p> <strong>
                                  <label>
                                    <?php if($fila_query["tipo_video"]=="youtube"){ ?>
                                    <input name="video" type="radio" value="youtube" checked="checked" />
                                    <?php }else{ ?>
                                    <input name="video" type="radio" value="youtube" />
                                    <?php } ?>
                                    Youtube</label>
                                  &nbsp;</strong></p></td>
                                <td width="77%"><p>http://www.youtube.com/watch?v=
                                  <?php if($fila_query["tipo_video"]=="youtube"){ ?>
                                  <input name="video-youtube" type="text" id="video-youtube" value="<?php echo $fila_query["video"] ?>" size="30" />
                                  <?php }else{ ?>
                                  <input name="video-youtube" type="text" id="video-youtube" size="30" />
                                  <?php } ?>
                                </p>
                                  <p class="texto-ejemplo"> Ejemplo:   http://www.youtube.com/watch?v=<strong>XL-Q_JtBbz8</strong></p></td>
                              </tr>
                              <tr>
                                <td width="23%"><p> <strong>
                                  <label>
                                    <?php if($fila_query["tipo_video"]=="flv"){ ?>
                                    <input name="video" type="radio" value="flv" checked="checked"/>
                                    <?php }else{ ?>
                                    <input name="video" type="radio" value="flv" />
                                    <?php } ?>
                                    FLV</label>
                                  &nbsp;</strong></p></td>
                                <td><p>
                                  <?php if($fila_query["tipo_video"]=="flv"){ ?>
                                  <input name="video_actual" type="hidden" id="video_actual" value="<?php echo $fila_query["video"] ?>" />
                                  <input name="carpeta_video" type="hidden" id="carpeta_video" value="<?php echo $fila_query["carpeta_video"] ?>" />
                                  <?php }else{ ?>
                                  <input name="video_actual" type="hidden" id="video_actual" />
                                  <?php } ?>
                                  </p></td>
                              </tr>
                              <tr>
                                <td colspan="2"><div id="video_uploader" style="width: 450px; height: 330px;">You browser doesn't have Flash installed.</div></td>
                              </tr>
                              <tr>
                                <td align="right"><p><strong>Video actual:</strong></p></td>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td align="right">&nbsp;</td>
                                <td><?php echo 
                                tipoVideo($fila_query["tipo_video"], 
                                $fila_query["carpeta_video"],
                                $fila_query["video"],
                                $fila_query["imagen"],
                                $fila_query["carpeta_imagen"],
                                $fila_query["id"], 400, 260, $web) ?></td>
                              </tr>
                            </table>
                          </div>
                          <div class="TabbedPanelsContent">
                            <table width="100%" border="0" cellpadding="5" cellspacing="0">
                              <tr>
                                <td width="20%" align="right"><p><strong>Imagen actual:</strong></p></td>
                                <td width="80%" align="left"><img src="../../../imagenes/upload/<?php echo $fila_query["carpeta_imagen"]."".$fila_query["imagen"] ?>" alt="" width="150" />
                                  <input name="imagen_actual" type="hidden" id="imagen_actual" value="<?php echo $fila_query["imagen"] ?>" />
                                  <input name="carpeta_imagen" type="hidden" id="carpeta_imagen" value="<?php echo $fila_query["carpeta_imagen"] ?>" /></td>
                              </tr>
                              <tr>
                                <td colspan="2"><p align="left"><strong>Selecciona una imagen para la noticia:</strong></p>
                                  <div>
                                    <div id="flash_uploader" style="width: 450px; height: 330px;">You browser doesn't have Flash installed.</div>
                                  </div></td>
                              </tr>
                            </table>
                          </div>
</div>
          	        </div></td>
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
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "time");
</script>
</body>
</html>