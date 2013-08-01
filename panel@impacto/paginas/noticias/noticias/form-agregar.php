<?php
session_start();
include("../../../conexion/conexion.php");
include("../../../conexion/verificar_sesion.php");

//CATEGORIA
$rst_categoria=mysql_query("SELECT * FROM ".$tabla_suf."_noticia_categoria WHERE id>0 ORDER BY categoria ASC;", $conexion);

//TAGS
$rst_tags=mysql_query("SELECT * FROM ".$tabla_suf."_noticia_tags WHERE id>0 ORDER BY nombre ASC;", $conexion);

//VARIABLES PARA LA HORA
$fechaTotal=date("Y-m-d H:i:s");
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
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />

<!-- CKEDITOR -->
<script type="text/javascript" src="../../../js/ckeditor.js"></script>

<!-- SPRY -->
<script src="../../../../SpryAssets/SpryValidationSelect.js" type="text/javascript"></script>
<script src="../../../../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../../../../SpryAssets/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<link href="../../../../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
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
		resize : {width : 670, height : 450, quality : 100},
		flash_swf_url : '../../../js/plupload.flash.swf'
	});
	
	jq("#video_uploader").pluploadQueue({
		runtimes : 'flash', url : 'upload_video.php', max_file_size : '150mb',
		chunk_size : '1mb', unique_names : true,
		filters : [ {title : "(.flv) | (.mp3) | (.mp4)", extensions : "flv,mp3,mp4"}],
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
            	<h2>Agregar - Noticia</h2>
    <div id="contenido_total">
        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
            <tr>
            	<td>
                <form action="guardar.php" method="post" enctype="multipart/form-data" id="form1" >
            	  <table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
            	    <tr>
            	      <td colspan="2" align="center">&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right" ><p><strong>Titulo:</strong></p></td>
            	      <td width="80%" height="30" align="left"><input name="titulo" type="text" id="titulo" size="50" /></td>
          	      </tr>
            	    <tr>
            	      <td width="20%" height="30" align="right"><p><strong>Contenido:</strong></p></td>
            	      <td width="80%" height="30" align="left" >&nbsp;</td>
          	      </tr>
            	    <tr>
            	      <td height="35" colspan="2" align="center"><p>
            	        <label>
            	          <textarea class="ckeditor" name="contenido" id="contenido"></textarea>
          	          </label>
                      </p></td>
           	        </tr>
           	      <tr>
            	      <td colspan="2"><div id="TabbedPanels1" class="TabbedPanels">
            	        <ul class="TabbedPanelsTabGroup">
            	          <li class="TabbedPanelsTab" tabindex="0">Imagen</li>
                          <li class="TabbedPanelsTab" tabindex="0">Video</li>
                          <li class="TabbedPanelsTab" tabindex="0">Tags</li>
            	        </ul>
            	        <div class="TabbedPanelsContentGroup">
            	          <div class="TabbedPanelsContent">
                          <p align="left"><strong>Selecciona una imagen para la noticia:</strong></p>
                        <div>
                        <div id="flash_uploader" style="width: 450px; height: 330px;">You browser doesn't have Flash installed.</div>
                        </div>
                          </div>
                          <div class="TabbedPanelsContent">
                            <table width="80%" border="0" align="center" cellpadding="5" cellspacing="0">
                              <tr>
                                <td width="23%"><p> <strong>
                                  <label>
                                    <input name="video" type="radio" value="youtube" />
                                    Youtube</label>
                                  &nbsp;</strong></p></td>
                                <td width="77%"><p> http://www.youtube.com/watch?v=
                                  <label for="video-youtube"></label>
                                  <input name="video-youtube" type="text" id="video-youtube" size="30" />
                                </p>
                                  <p class="texto-ejemplo"> Ejemplo:   http://www.youtube.com/watch?v=<strong>XL-Q_JtBbz8</strong></p></td>
                              </tr>
                              <tr>
                                <td width="23%"><p> <strong>
                                  <label>
                                    <input name="video" type="radio" value="vimeo" />
                                    Vimeo</label>
                                  &nbsp;</strong></p></td>
                                <td><p> http://vimeo.com/
                                  <label for="video-youtube"></label>
                                  <input name="video-vimeo" type="text" id="video-vimeo" size="30" />
                                </p>
                                  <p class="texto-ejemplo"> Ejemplo: http://vimeo.com/<strong>18625012</strong></p></td>
                              </tr>
                              <tr>
                                <td width="23%"><p> <strong>
                                  <label>
                                    <input name="video" type="radio" value="dailymotion" />
                                    Dailymotion</label>
                                  &nbsp;</strong></p></td>
                                <td><p> http://www.dailymotion.com/video/
                                  <input name="video-dailymotion" type="text" id="video-dailymotion" size="30" />
                                </p>
                                  <p class="texto-ejemplo">Ejemplo:   http://www.dailymotion.com/video/<strong>xgl1hb</strong>_nombre-video</p></td>
                              </tr>
                              <tr>
                                <td width="23%"><p> <strong>
                                  <label>
                                    <input name="video" type="radio" value="flv" />
                                    FLV</label>
                                  &nbsp;</strong></p></td>
                                <td><p>
                                  
                                </p></td>
                              </tr>
                              <tr>
                                <td colspan="2">
                                <div id="video_uploader" style="width: 450px; height: 330px;">You browser doesn't have Flash installed.</div>
                                </td>
                                </tr>
                            </table>
                          </div>
                          <div class="TabbedPanelsContent">
								<?php while($fila_tags=mysql_fetch_array($rst_tags)){ ?>
                            <div class="item_checkbox">
                                <label><input type="checkbox" name="tags[]" value="<?php echo $fila_tags["id"] ?>" id="item_tags" />
                                    <?php echo $fila_tags["nombre"] ?></label>
                            </div>
                            <?php } ?>
							</div>
            	        </div>
          	        </div></td>
           	        </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Categoria:</strong></p></td>
            	      <td><span id="spryselect">
            	        <select name="categoria" id="categoria">
            	          <option value="0">[ Seleccionar opcion ]</option>
<?php while ($fila_categoria=mysql_fetch_array($rst_categoria)){
	echo "<option value='". $fila_categoria["id"] ."'>". $fila_categoria["categoria"] ."</option>";
}?>
          	          </select>
           	          <span class="selectInvalidMsg">Selecciona una categoria.</span><span class="selectRequiredMsg">Seleccione una categoria.</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Fecha publicación:</strong></p></td>
            	      <td><input name="fecha" type="text" id="fecha" value="<?php echo $fecha_actual; ?>" size="20" /></td>
          	      </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Hora publicación:</strong></p></td>
            	      <td><span id="sprytextfield1">
                      <input name="hora" type="text" id="hora" value="<?php echo $hora_actual; ?>" size="20" />
                      <span class="textfieldRequiredMsg">Ingrese la hora a publicar</span>
                      <span class="textfieldInvalidFormatMsg">Formato no válido.</span></span></td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center"><input type="submit" name="guardar" id="guardar" value="Guardar" />                    <label>
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
var spryselect = new Spry.Widget.ValidationSelect("spryselect", {invalidValue:"0"});
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "time");
</script>
</body>
</html>