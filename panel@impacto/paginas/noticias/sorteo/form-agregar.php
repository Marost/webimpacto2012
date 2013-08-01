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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administración | </title>
<link rel="stylesheet" type="text/css" href="../../../css/estilo-panel.css"/>
<link rel="stylesheet" type="text/css" href="../../../css/style-listas.css" />

<!-- CKEDITOR -->
<script type="text/javascript" src="../../../js/ckeditor/ckeditor.js"></script>

<!-- SPRY -->
<link href="../../../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="../../../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<!-- FECHA -->
<link type="text/css" href="../../../../js/themes/ui-lightness/jquery.ui.all.css" rel="stylesheet" />
<script type="text/javascript" src="../../../../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../../../../js/jquery-ui-1.8.20.custom.min.js"></script>
<script type="text/javascript" src="../../../../js/jquery-ui-timepicker-addon.js"></script>
<script type="text/javascript" src="../../../../js/jquery-ui-sliderAccess.js"></script>
<script type="text/javascript">
var jfec = jQuery.noConflict();
jfec(function(){
	jfec('#fecha_inicio').datetimepicker({
		showOn: 'button', buttonImage: '../../../images/calendar.gif', buttonImageOnly: true, dateFormat: "yy-mm-dd",
		onClose: function(dateText, inst) {
			var endDateTextBox = jfec('#fecha_fin');
			if (endDateTextBox.val() != '') {
				var testStartDate = new Date(dateText);
				var testEndDate = new Date(endDateTextBox.val());
				if (testStartDate > testEndDate)
					endDateTextBox.val(dateText);
			}
			else {
				endDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			var start = jfec(this).datetimepicker('getDate');
			jfec('#fecha_fin').datetimepicker('option', 'minDate', new Date(start.getTime()));
		}
	});
	jfec('#fecha_fin').datetimepicker({
		showOn: 'button', buttonImage: '../../../images/calendar.gif', buttonImageOnly: true, dateFormat: "yy-mm-dd",
		onClose: function(dateText, inst) {
			var startDateTextBox = jfec('#fecha_inicio');
			if (startDateTextBox.val() != '') {
				var testStartDate = new Date(startDateTextBox.val());
				var testEndDate = new Date(dateText);
				if (testStartDate > testEndDate)
					startDateTextBox.val(dateText);
			}
			else {
				startDateTextBox.val(dateText);
			}
		},
		onSelect: function (selectedDateTime){
			var end = jfec(this).datetimepicker('getDate');
			jfec('#fecha_inicio').datetimepicker('option', 'maxDate', new Date(end.getTime()) );
		}
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
            	<h2>Agregar - Sorteo</h2>
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
            	          <textarea class="ckeditor" name="contenido" id="contenido"></textarea>
                      </p></td>
           	        </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Fecha Inicio:</strong></p></td>
            	      <td><span id="spry_fecha_inicio">
                      <input name="fecha_inicio" type="text" id="fecha_inicio" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
          	      </tr>
            	    <tr>
            	      <td align="right" ><p><strong>Fecha Fin:</strong></p></td>
            	      <td><span id="srpy_fecha_fin">
                      <input name="fecha_fin" type="text" id="fecha_fin" />
                      <span class="textfieldRequiredMsg">Se necesita un valor.</span></span></td>
          	      </tr>
                <tr>
                  <td colspan="2" align="center">
                  	<input type="submit" name="guardar" id="guardar" value="Guardar" /></td>
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
var sprytextfield1 = new Spry.Widget.ValidationTextField("srpy_fecha_fin", "none");
var sprytextfield2 = new Spry.Widget.ValidationTextField("spry_fecha_inicio", "none");
</script>
</body>
</html>